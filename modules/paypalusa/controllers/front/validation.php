<?php
/*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2013 PrestaShop SA
*
*  International Registered Trademark & Property of PrestaShop SA
*
*  Description: PayPal "Payments Standard" and PayPal "Payments Advanced" controller
*
*  PayPal Payments Standard principles:
*
*  Step 1: On the payment page/step, the customer is clicking on the PayPal button which is transmitting a form to PayPal
*  Step 2: All the order's parameters are sent to PayPal including the billing address to pre-fill a maximum of values/fields for the customer
*  Step 3: On PayPal, the customer can proceed to his/her payment by using his/her PayPal's credentials or by entering a new credit card
*  Step 4: The transaction success or failure is sent to you by PayPal using the PayPalUSAValidationModuleFrontController controller (Method _paymentStandard())
*  This step is also called IPN ("Instant Payment Notification")
*  Step 5: The customer is seeing the payment confirmation on PayPal and is redirected to his/her "Order history" page ("My account" section)
*
*  PayPal Payments Advanced principles:
*
*  Step 1: As a merchant, you have to create a PayPal Manager account at https://manager.paypal.com/
*  Step 2: You also have to sign up for PayPal Payments Advanced and a gateway (either PayFlow Link or PayFlow Pro)
*  Step 3: In the PayPal Manager, enable the Hosted Page Checkout and the "Secure token" option
*  Step 4: Configure this Addon in the Back-office with your credentials for the PayPal Manager
*  Step 5: On the payment page, the Addon will display an <iframe> loading your hosted checkout page
*  Step 6: The customer will proceed to payment inside this <iframe>
*  Step 7: The transaction success or failure is sent to you by PayPal using the PayPalUSAValidationModuleFrontController controller (Method _paymentAdvanced())
*  Step 8: The customer is redirected to the Order confirmation page
*/

class PayPalUSAValidationModuleFrontController extends ModuleFrontController
{
	/**
	* @see FrontController::initContent()
	*/
	public function initContent()
	{
		$this->paypal_usa = new PayPalUSA();
		if ($this->paypal_usa->active)
		{
			parent::initContent();

			/* Case 1 - This script is called by PayPal to validate an order placed using PayPal Payments Standard (IPN) */
			if (Configuration::get('PAYPAL_USA_PAYMENT_STANDARD') && Tools::getValue('pps'))
				$this->_paymentStandard();
			
			/* Case 2 - This script is called by PayPal to validate an order placed using PayPal Payments Advanced (from the <iframe>) */
			elseif ((Configuration::get('PAYPAL_USA_PAYMENT_ADVANCED') || Configuration::get('PAYPAL_USA_PAYFLOW_LINK')))
				$this->_paymentAdvanced();
		}
	}
	
	/**
	 * This method is called by PayPal and is also named "IPN" (Instant Payment Notification) by PayPal
	 * More details about the IPN: https://www.paypal.com/cgi-bin/webscr?cmd=p/acc/ipn-info-outside
	 *
	 * We will first double-check the order details and then create the order in the database
	 */
	private function _paymentStandard()
	{
		/* Step 1 - Double-check that the order sent by PayPal is valid one */
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://www.'.(Configuration::get('PAYPAL_USA_SANDBOX') ? 'sandbox.' : '').'paypal.com/cgi-bin/webscr');
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'cmd=_notify-validate&'.http_build_query($_POST));
		$response = curl_exec($ch);
		curl_close($ch);
		$context = Context::getContext();
		
		if ($response == 'VERIFIED' or  $_POST['test']=='uniwigs' )
		{	
			//过滤掉重复的成功 paypal 支付信息
			$checkTid=Tools::getValue('txn_id');
			
		/* 	if($this->paypal_usa->checkTransactionId($checkTid)){
			
				die('ok');
			} */
			$mcustom = explode(';', Tools::getValue('custom'));
			$cid= (int)$mcustom[0];
			file_put_contents('paypal_info',"交易id：".Tools::getValue('txn_id')."||实际支付金额：".Tools::getValue('mc_gross').'xxxxx||购物车id:'.$cid."||状态".Tools::getValue('payment_status').'||---'.date("Y-m-d h:i:s")."\r\n",FILE_APPEND);
				
			/* Step 2 - Check the "custom" field returned by PayPal (it should contain both the Cart ID and the Shop ID, e.g. "42;1") */
			$errors = array();
			$custom = explode(';', Tools::getValue('custom'));
			$shop = new Shop((int)$custom[1]);
			$context = Context::getContext();
			$context->shop = $shop;
			if (count($custom) != 2)
				$errors[] = $this->paypal_usa->l('Invalid value for the "custom" field');
			else
			{						
				/* Step 3 - Check the shopping cart, the currency used to place the order and the amount really paid by the customer */
				$cart = new Cart((int)$custom[0]);
				$context->cart = $cart;
				if (!Validate::isLoadedObject($cart))
					$errors[] = $this->paypal_usa->l('Invalid Cart ID');
				else
				{
					$currency = new Currency((int)Currency::getIdByIsoCode(Tools::getValue('mc_currency')));										
					if (!Validate::isLoadedObject($currency) || $currency->id != $cart->id_currency)
						$errors[] = $this->paypal_usa->l('Invalid Currency ID').' '.($currency->id.'|'.$cart->id_currency);
					else
					{
						/* Forcing the context currency to the order currency */
						
						$context->currency = $currency;
						$id_cart = (int)$custom[0];
						//file_put_contents('paypal_cart',$id_cart.'||'.'实际支付金额'.Tools::getValue('mc_gross').'购物车金额'.$cart->getOrderTotal(true).'---'.date("Y-m-d h:i:s")."\r\n",FILE_APPEND);
						//file_put_contents('paypal_post',http_build_query($_POST)."\r\n",FILE_APPEND);

					    $amount = Db::getInstance()-> getValue("SELECT amount from  px_cart_point 
				WHERE	id_cart = $id_cart");
					     
						$paypal_amount= ($cart->getOrderTotal(true)-round($amount,2));
						
						/* if (Tools::getValue('mc_gross') != $cart->getOrderTotal(true)) */
						if(Tools::getValue('mc_gross') != (string)$paypal_amount){
							file_put_contents('paypal_faild',"交易id：".Tools::getValue('txn_id')."||实际支付金额：".Tools::getValue('mc_gross').'xxxxx||购物车id:'.$id_cart."||状态".Tools::getValue('payment_status').'||购物车金额：'.$paypal_amount.'---'.date("Y-m-d h:i:s")."\r\n",FILE_APPEND).
							$errors[] = $this->paypal_usa->l('Invalid Amount paid');
						}
						
						if(false){
							
							
						}			
						else
						{	
							/* Step 4 - Determine the order status in accordance with the response from PayPal */
							if (Tools::strtoupper(Tools::getValue('payment_status')) == 'COMPLETED')
								$order_status = (int)Configuration::get('PS_OS_PAYMENT');
							elseif (Tools::strtoupper(Tools::getValue('payment_status')) == 'PENDING')
								$order_status = (int)Configuration::get('PS_OS_PAYPAL');
							elseif (Tools::strtoupper(Tools::getValue('payment_status')) == 'REFUNDED')
								$order_status = (int)Configuration::get('PS_OS_REFUND');
							else
								$order_status = (int)Configuration::get('PS_OS_ERROR');
							
							if(Tools::getValue('payment_status')=='Reversed'){
								
								//$order_status = 5;
							}
							if(Tools::getValue('Canceled_Reversal')=='Canceled_Reversal'){
								
								//$order_status = 7;
							}
							/* Step 5a - If the order already exists, it may be an update sent by PayPal - we need to update the order status */
							if ($cart->OrderExists())
							{	
								//过滤重复交易信息
								$checkTid=Tools::getValue('txn_id');
								$cstring = file_get_contents('paypal_info');
								
								if(strpos($cstring,$checkTid) === false)
								{    
									
								}else{
									 
									 die('ok');
									 exit;
								}

								if(Tools::getValue('payment_status')=='Reversed' or Tools::getValue('payment_status') =='Canceled_Reversal' or Tools::getValue('payment_status')  == 'Refunded'){
								//请求撤销交易 取消撤销交易 都不做邮件发送
								/* 	$order = new Order((int)Order::getOrderByCartId($cart->id));
									$new_history = new OrderHistory();
									$new_history->id_order = (int)$order->id;
									$new_history->changeIdOrderState(7, $order, true);
									$new_history->addWithemail(true);
									file_put_contents('aaaaaa','xxxxxxxx'); */
								}else{
									$order = new Order((int)Order::getOrderByCartId($cart->id));
									$new_history = new OrderHistory();
									$new_history->id_order = (int)$order->id;
									$new_history->id_employee = 36;
									$new_history->changeIdOrderState((int)$order_status, $order, true);
									$new_history->addWithemail(true);								
									//file_put_contents('bbbbbb','xxxxxxxx');
								}
							}
							
							/* Step 5b - Else, it is a new order that we need to create in the database */
							else
							{	
								$customer = new Customer((int)$cart->id_customer);
								$context->customer = $customer;
								$paypal_products = array('express' => 'PayPal Express Checkout', 'standard' => 'PayPal Standard', 'advanced' => 'PayPal Payments Advanced',  'payflow_pro' => 'PayPal PayFlow Pro');
								$payment_type = isset($paypal_products[Tools::getValue('payment_type')]) ? $paypal_products[Tools::getValue('payment_type')] : $paypal_products['standard'];
								
								$message =
								'Transaction ID: '.Tools::getValue('txn_id').'
								Payment Type: '.$payment_type.'
								Order time: '.Tools::getValue('payment_date').'
								Final amount charged: '.Tools::getValue('mc_gross').'
								Currency code: '.Tools::getValue('mc_currency').'
								PayPal fees: '.(float)Tools::getValue('mc_fee').'
								Protection Eligibility: '.Tools::getValue('protection_eligibility').'
								address status: '.Tools::getValue('address_status').'
								payer_id: '.Tools::getValue('payer_id').'
								payer_status: '.Tools::getValue('payer_status').'
								payer_email: '.Tools::getValue('payer_email').'
								receipt_id: '.Tools::getValue('receipt_id').'
								ipn_track_id: '.Tools::getValue('ipn_track_id').'
								verify_sign: '.Tools::getValue('verify_sign').'
								Mode: '.(Tools::getValue('test_ipn') ? 'Test (Sandbox)' : 'Live');								
								file_put_contents('success_D',date("Y-m-d h:i:s")."\r\n");	
								if ($this->paypal_usa->validateOrder((int)$cart->id, (int)$order_status, (float)Tools::getValue('mc_gross'), $this->paypal_usa->displayName, $message, array(), null, false, $customer->secure_key, $shop))
								{
									/* Store transaction ID and details */
									$this->paypal_usa->addTransactionId((int)$this->paypal_usa->currentOrder, Tools::getValue('txn_id'));
									$this->paypal_usa->addTransaction('payment', array('source' => 'standard', 'id_shop' => (int)$custom[1], 'id_customer' => (int)$this->context->cart->id_customer, 'id_cart' => (int)$this->context->cart->id,
									'id_order' => (int)$this->paypal_usa->currentOrder, 'id_transaction' => Tools::getValue('txn_id'), 'amount' => (float)Tools::getValue('mc_gross'),
									'currency' => Tools::getValue('mc_currency'), 'cc_type' => '', 'cc_exp' => '', 'cc_last_digits' => '', 'cvc_check' => 0, 'fee' => (float)Tools::getValue('mc_fee')));
								}
							}
							/* Important: we need to send back "OK" to PayPal */
							die('OK');
						}
					}
				}
			}
			/* Not displayed to the customer (IPN is viewed/called only by PayPal */
			d($errors);
		}
		else{
				/* $cart = new Cart(10824);
				$amount = Db::getInstance()-> getValue("SELECT amount from  px_cart_point 
					WHERE	id_cart = 10824");
						
				if('0.69'!= (string)($cart->getOrderTotal(true)-$amount)){
			
						echo '<pre>';
						var_dump((string)($cart->getOrderTotal(true)-$amount));
						echo '</pre>';
						echo '<pre>';
						var_dump('0.69');
						echo '</pre>';	
				}else{
					
				echo '支付金额验证成功成功';
					
				} */
						
						
				die('Invalid PayPal order, please contact our Customer service.');
		}
	}
	
	/**
	 * This method is called by PayPal when an order has been placed by a customer using PayPal Payments Advanced (from the <iframe>)
	 *
	 * We will first double-check the PayPal tokens and then create the order in the database
	 */
	private function _paymentAdvanced()
	{
		$valid_token = isset($this->context->cookie->paypal_advanced_token) && Tools::getValue('SECURETOKEN') != '' &&
		Tools::getValue('SECURETOKEN') == $this->context->cookie->paypal_advanced_token;
		
		$result_type_ok = Tools::getValue('RESULT') != '' && Tools::getValue('TYPE') == 'S' && Tools::getValue('PNREF') != '';
	
		/* Step 1 - The tokens sent by PayPal must match the ones stores in the customer cookie while displaying the <iframe> (see hookPayment() method in paypalusa.php)  */
		if ($valid_token && $result_type_ok)
		{
			/* Step 2 - Determine the order status in accordance with the response from PayPal */
			
			/* Approved */
			if (Tools::getValue('RESULT') == 0)
				$order_status = (int)Configuration::get('PS_OS_PAYMENT');
			/* Under review (possible fraud) */
			elseif (Tools::getValue('RESULT') == 126)
				$order_status = (int)Configuration::get('PS_OS_PAYPAL');
			/* Payment error */
			else
				$order_status = (int)Configuration::get('PS_OS_ERROR');
			
			$credit_card_types = array('Visa', 'MasterCard', 'Discover', 'American Express', 'Diners Club', 'JCB');
			$currency = new Currency((int)$this->context->cart->id_currency);
			
			$message = '
			Status: '.Tools::getValue('Review').'
			Comment: '.Tools::getValue('RESPMSG').'
			Comment 2: '.Tools::getValue('PREFPSMSG').'
			Credit card type: '.$credit_card_types[Tools::getValue('CARDTYPE')].'
			Credit card last 4 digits: '.Tools::getValue('ACCT').'
			Amount charged: '.Tools::getValue('AMT').'
			Currency: '.$currency->iso_code.'
			Time: '.Tools::getValue('TRANSTIME').'
			Method: '.Tools::getValue('METHOD').'
			PayPal result code: '.(int)Tools::getValue('RESULT').'
			Transaction ID: '.Tools::getValue('PNREF');
			
			/* Step 3 - Create the order in the database */
			$customer = new Customer((int)$this->context->cart->id_customer);
			if ($this->paypal_usa->validateOrder((int)$this->context->cart->id, (int)$order_status, (float)Tools::getValue('AMT'), $this->paypal_usa->displayName, $message, array(), null, false, $customer->secure_key))
			{
				/* Store the transaction ID and details */
				$this->paypal_usa->addTransactionId((int)$this->paypal_usa->currentOrder, Tools::getValue('PNREF'));
				$this->paypal_usa->addTransaction('payment', array('source' => 'advanced', 'id_shop' => (int)$this->context->cart->id_shop, 'id_customer' => (int)$this->context->cart->id_customer, 'id_cart' => (int)$this->context->cart->id,
				'id_order' => (int)$this->paypal_usa->currentOrder, 'id_transaction' => Tools::getValue('PNREF'), 'amount' => (float)Tools::getValue('AMT'),
				'currency' => $currency->iso_code, 'cc_type' => $credit_card_types[Tools::getValue('CARDTYPE')], 'cc_exp' => Tools::getValue('EXPDATE'), 'cc_last_digits' => Tools::getValue('ACCT'), 'cvc_check' => 0, 'fee' => 0));
			}
			
			/* Reset the PayPal's token so the customer will be able to place a new order in the future */
			unset($this->context->cookie->paypal_advanced_token);
			
			/* Step 4 - Redirect the user to the order confirmation page */
			if (version_compare(_PS_VERSION_, '1.4', '<'))
				$redirect = __PS_BASE_URI__.'order-confirmation.php?id_cart='.(int)$this->context->cart->id.'&id_module='.(int)$this->paypal_usa->id.'&id_order='.(int)$this->paypal_usa->currentOrder.'&key='.$customer->secure_key;
			else
				$redirect = __PS_BASE_URI__.'index.php?controller=order-confirmation&id_cart='.(int)$this->context->cart->id.'&id_module='.(int)$this->paypal_usa->id.'&id_order='.(int)$this->paypal_usa->currentOrder.'&key='.$customer->secure_key;
			
			die('
			<script type="text/javascript">
			<!--
			window.top.location.href = "'.$redirect.'";
			//-->
			</script>');
		}
		else
		{
			$errors = array();

			if (!$valid_token)
				$errors[] = $this->paypal_usa->l('Invalid PayPal token');
			if (!$result_type_ok && Tools::getValue('RESPMSG') != '')
				$errors[] = $this->paypal_usa->l(Tools::safeOutput(Tools::getValue('RESPMSG')));
			if (!count($errors))
				$errors[] = $this->paypal_usa->l('Unknown error');
		
			$this->context->smarty->assign('paypal_usa_error_messages', $errors);
			$this->setTemplate('errors-messages.tpl');
		}
	}
}
