<?php

include($_SERVER['DOCUMENT_ROOT'].'/config/config.inc.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/init.php'); 

set_time_limit(0);
$test_dev = true; //测试环境 开启  所有邮件 发送到指定邮箱 554301430@qq.com
			
// 24小时未发货 


$unpaids = Db::getInstance()->ExecuteS("
select id_customer,id_cart
from ps_cart
where left(date_add,10)='".date("Y-m-d",strtotime("-1 days"))."'
and id_cart not in(
	select o.id_cart from
	ps_orders as o left join ps_order_history as oh
	on o.id_order=oh.id_order
	where oh.id_order_state>1 )
and  id_customer >0 
limit 2  
");



$unpaidCustomers = array();
foreach ($unpaids as $unpaid) {
    $cart = new Cart($unpaid['id_cart']);
    if (is_object($cart) and $cart->checkQuantities()) {
        $unpaidCustomers[] = $unpaid;
    }
}		


/* echo '<pre>';
	var_dump($unpaidCustomers);
	echo '</pre>';
	exit;
		 */


if (is_array($unpaidCustomers) and $unpaidCustomers) {
	
	  foreach ($unpaidCustomers as $unpaidCustomer) {
		  
		   if ($unpaidCustomer['id_customer'] > 0) 
		   {
		  	
				
				$cart = new Cart($unpaidCustomer['id_cart']);
				$customer = new Customer($cart->id_customer);	
				$products = $cart->getProducts();
				$customizedDatas = Product::getAllCustomizedDatas(intval($unpaidCustomer['id_cart']));
				Product::addCustomizationPrice($products, $customizedDatas);
				$productsList='';
				foreach ($products AS $key => $product) {
				   
				   $productsList .=
								'<tr style="background-color: ' . ($key % 2 ? '#DDE2E6' : '#EBECEE') . ';">
								<td style="padding: 0.6em 0.4em;">' . $product['reference'] . '</td>
								<td style="padding: 0.6em 0.4em;"><strong>' .$product['name']. '</strong></td>
								<td style="padding: 0.6em 0.4em; text-align: center;">' .$product['price']. '</td>
								<td style="padding: 0.6em 0.4em; text-align: center;">' .$product['quantity']  . '</td>
								<td style="padding: 0.6em 0.4em; text-align: center;">' .$product['total'] . '</td>
								
							</tr>'.'</p>';
						
				} 
			
				$discounts = $cart->getDiscounts();
			
				$discountsList = '';
				foreach ($discounts AS $discount) {
					$objDiscount = new Discount(intval($discount['id_cart_rule']));
					
			
			   $value = $objDiscount->getValue(sizeof($discounts), $cart->getOrderTotal(true, 1), 0, $cart->id);



					$discountsList .=
							'<tr style="background-color:#EBECEE;">
								<td colspan="5" style="padding: 0.6em 0.4em; text-align: center;">'.'Coupon code:  '.$objDiscount->name[1].'</td>
								<td style="padding: 0.6em 0.4em; text-align: center;">-' . Tools::displayPrice($value) .'</td>
						</tr>';
				}
				
				
			//测试
			if($test_dev==true)
			$customer->email ='554301430@qq.com';

			 if ($customer->firstname and $customer->lastname) {
					$subject =$customer->firstname.", you have unpaid item in your cart";
					$str= file_get_contents( $_SERVER['DOCUMENT_ROOT'].'/mails/en/cart_remind.html');
					$str= str_replace('{firstname}',$customer->firstname,$str);
					$str= str_replace('{lastname}',$customer->lastname,$str);
					$str= str_replace('{shop_name}','uniwigs',$str);
				
				} else {
					$subject ="You have unpaid item in your cart";
					$str= file_get_contents( $_SERVER['DOCUMENT_ROOT'].'/mails/en/cart_remind_withoutname.html');
					$str= str_replace('{shop_name}','uniwigs',$str);
			  
				}
				$str= str_replace('{productsList}',$productsList,$str);
				$str= str_replace('{discountsList}',$discountsList,$str); 
			$header = "From:uniwigs\n";
			$header .= "Return-Path: <uniwigs@uniwigs.com>\n";     //防止被当做垃圾邮件，但在sina邮箱里不起作用
			$header .= "MIME-Version: 1.0\n";
			$header .= "Content-type: text/html; charset=utf-8\n";    //邮件内容为utf-8编码
			$header .= "Content-Transfer-Encoding: 8bit\r\n";    //注意header的结尾，只有这个后面有\r
			ini_set('sendmail_from', 'uniwigs@uniwigs.com');     //解决mail的一个bug
			$send_message = wordwrap($str, 70);     //每行最多70个字符,这个是mail方法的限制
			
		
			if(mail($customer->email, $subject, $send_message, $header)){
				file_put_contents('emaillog.txt','发送邮件'.$customer->email."成功\n",FILE_APPEND);
				//echo '发送邮件'.$customer->email.'成功'.'</br>';
			}else{
				
				file_put_contents('emaillog.txt','发送邮件'.$customer->email."失败\n",FILE_APPEND);
				//echo '发送邮件'.$customer->email.'失败'.'</br>';
			}

		}
		  
	  }
	
}
	
	
	
	
// 72小时未发货 
$unpaids = Db::getInstance()->ExecuteS("
select id_customer,id_cart
from ps_cart
where left(date_add,10)='".date("Y-m-d",strtotime("-3 days"))."'
and id_cart not in(
	select o.id_cart from
	ps_orders as o left join ps_order_history as oh
	on o.id_order=oh.id_order
	where oh.id_order_state>1 )
and  id_customer >0 
limit 2   
");
$unpaidCustomers = array();
foreach ($unpaids as $unpaid) {
    $cart = new Cart($unpaid['id_cart']);
    if (is_object($cart) and $cart->checkQuantities()) {
        $unpaidCustomers[] = $unpaid;
    }
}		



if (is_array($unpaidCustomers) and $unpaidCustomers) {
	
	  foreach ($unpaidCustomers as $unpaidCustomer) {
		  
		   if ($unpaidCustomer['id_customer'] > 0) 
		   {
		  	
				
				$cart = new Cart($unpaidCustomer['id_cart']);
				$customer = new Customer($cart->id_customer);	
				$products = $cart->getProducts();
				$customizedDatas = Product::getAllCustomizedDatas(intval($unpaidCustomer['id_cart']));
				Product::addCustomizationPrice($products, $customizedDatas);
				$productsList='';
				foreach ($products AS $key => $product) {
				   
				   $productsList .=
								'<tr style="background-color: ' . ($key % 2 ? '#DDE2E6' : '#EBECEE') . ';">
								<td style="padding: 0.6em 0.4em;">' . $product['reference'] . '</td>
								<td style="padding: 0.6em 0.4em;"><strong>' .$product['name']. '</strong></td>
								<td style="padding: 0.6em 0.4em; text-align: center;">' .$product['price']. '</td>
								<td style="padding: 0.6em 0.4em; text-align: center;">' .$product['quantity']  . '</td>
								<td style="padding: 0.6em 0.4em; text-align: center;">' .$product['total'] . '</td>
								
							</tr>'.'</p>';
						
				} 
			
				$discounts = $cart->getDiscounts();
			
				$discountsList = '';
				foreach ($discounts AS $discount) {
					$objDiscount = new Discount(intval($discount['id_cart_rule']));
					
			
			   $value = $objDiscount->getValue(sizeof($discounts), $cart->getOrderTotal(true, 1), 0, $cart->id);



					$discountsList .=
							'<tr style="background-color:#EBECEE;">
								<td colspan="5" style="padding: 0.6em 0.4em; text-align: center;">'.'Coupon code:  '.$objDiscount->name[1].'</td>
								<td style="padding: 0.6em 0.4em; text-align: center;">-' . Tools::displayPrice($value) .'</td>
						</tr>';
				}
				
				
			//测试
			if($test_dev==true)
			$customer->email ='554301430@qq.com';

			 if ($customer->firstname and $customer->lastname) {
					$subject =$customer->firstname.", you have unpaid item in your cart";
					$str= file_get_contents( $_SERVER['DOCUMENT_ROOT'].'/mails/en/cart_remind.html');
					$str= str_replace('{firstname}',$customer->firstname,$str);
					$str= str_replace('{lastname}',$customer->lastname,$str);
					$str= str_replace('{shop_name}','uniwigs',$str);
				
				} else {
					$subject ="You have unpaid item in your cart";
					$str= file_get_contents( $_SERVER['DOCUMENT_ROOT'].'/mails/en/cart_remind_again_withoutname.html');
					$str= str_replace('{shop_name}','uniwigs',$str);
			  
				}
				$str= str_replace('{productsList}',$productsList,$str);
				$str= str_replace('{discountsList}',$discountsList,$str); 
			$header = "From:uniwigs\n";
			$header .= "Return-Path: <uniwigs@uniwigs.com>\n";     //防止被当做垃圾邮件，但在sina邮箱里不起作用
			$header .= "MIME-Version: 1.0\n";
			$header .= "Content-type: text/html; charset=utf-8\n";    //邮件内容为utf-8编码
			$header .= "Content-Transfer-Encoding: 8bit\r\n";    //注意header的结尾，只有这个后面有\r
			ini_set('sendmail_from', 'uniwigs@uniwigs.com');     //解决mail的一个bug
			$send_message = wordwrap($str, 70);     //每行最多70个字符,这个是mail方法的限制
			
		
			if(mail($customer->email, $subject, $send_message, $header)){
				file_put_contents('emaillog.txt','发送邮件'.$customer->email."成功\n",FILE_APPEND);
				//echo '发送邮件'.$customer->email.'成功'.'</br>';
			}else{
				
				file_put_contents('emaillog.txt','发送邮件'.$customer->email."失败\n",FILE_APPEND);
				//echo '发送邮件'.$customer->email.'失败'.'</br>';
			}

		}
		  
	  }
	
}
	
		





