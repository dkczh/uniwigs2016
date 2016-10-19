<?php
/*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class LoyaltyModule extends ObjectModel
{
	public $id_loyalty_state;
	public $id_customer;
	public $id_order;
	public $id_cart_rule;
	public $points;
	public $date_add;
	public $date_upd;

	public $id_item = 0;
	public $remark;

	/**
	 * @see ObjectModel::$definition
	 */
	public static $definition = array(
		'table' => 'loyalty',
		'primary' => 'id_loyalty',
		'fields' => array(
			'id_loyalty_state' =>	array('type' => self::TYPE_INT, 'validate' => 'isInt'),
			'id_customer' =>		array('type' => self::TYPE_INT, 'validate' => 'isInt', 'required' => true),
			'id_order' =>			array('type' => self::TYPE_INT, 'validate' => 'isInt'),
			'id_cart_rule' =>		array('type' => self::TYPE_INT, 'validate' => 'isInt'),
			'points' =>				array('type' => self::TYPE_INT, 'validate' => 'isInt', 'required' => true),
			'date_add' =>			array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
			'date_upd' =>			array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
			'remark' =>				array('type' => self::TYPE_DATE)
		)
	);

	public function save($nullValues = false, $autodate = true)
	{
		parent::save($nullValues, $autodate);
		$this->historize();
	}

	public static function getByOrderId($id_order)
	{
		if (!Validate::isUnsignedId($id_order))
			return false;

		$result = Db::getInstance()->getRow('
		SELECT f.id_loyalty
		FROM `'._DB_PREFIX_.'loyalty` f
		WHERE f.id_order = '.(int)($id_order));

		return isset($result['id_loyalty']) ? $result['id_loyalty'] : false;
	}

	public static function getOrderNbPoints($order)
	{
		if (!Validate::isLoadedObject($order))
			return false;
		return self::getCartNbPoints(new Cart((int)$order->id_cart));
	}

	public static function getCartNbPoints($cart, $newProduct = NULL)
	{
		$total = 0;
		if (Validate::isLoadedObject($cart))
		{
			$currentContext = Context::getContext();
			$context = clone $currentContext;
			$context->cart = $cart;
			// if customer is logged we do not recreate it
			if(!$context->customer->isLogged(true))
				$context->customer = new Customer($context->cart->id_customer);
			$context->language = new Language($context->cart->id_lang);
			$context->shop = new Shop($context->cart->id_shop);
			$context->currency = new Currency($context->cart->id_currency, null, $context->shop->id);

			$cartProducts = $cart->getProducts();
			$taxesEnabled = Product::getTaxCalculationMethod();
			if (isset($newProduct) AND !empty($newProduct))
			{
				$cartProductsNew['id_product'] = (int)$newProduct->id;
				if ($taxesEnabled == PS_TAX_EXC)
					$cartProductsNew['price'] = number_format($newProduct->getPrice(false, (int)$newProduct->getIdProductAttributeMostExpensive()), 2, '.', '');
				else
					$cartProductsNew['price_wt'] = number_format($newProduct->getPrice(true, (int)$newProduct->getIdProductAttributeMostExpensive()), 2, '.', '');
				$cartProductsNew['cart_quantity'] = 1;
				$cartProducts[] = $cartProductsNew;
			}
			foreach ($cartProducts AS $product)
			{
				if (!(int)(Configuration::get('PS_LOYALTY_NONE_AWARD')) AND Product::isDiscounted((int)$product['id_product']))
				{
					if (isset(Context::getContext()->smarty) AND is_object($newProduct) AND $product['id_product'] == $newProduct->id)
						Context::getContext()->smarty->assign('no_pts_discounted', 1);
					continue;
				}
				$total += ($taxesEnabled == PS_TAX_EXC ? $product['price'] : $product['price_wt'])* (int)($product['cart_quantity']);
			}
			foreach ($cart->getCartRules(false) AS $cart_rule)
				if ($taxesEnabled == PS_TAX_EXC)
					$total -= $cart_rule['value_tax_exc'];
				else
					$total -= $cart_rule['value_real'];

		}

		return self::getNbPointsByPrice($total);
	}

	public static function getVoucherValue($nbPoints, $id_currency = NULL)
	{
		$currency = $id_currency ? new Currency($id_currency) : Context::getContext()->currency->id;

		return (int)$nbPoints * (float)Tools::convertPrice(Configuration::get('PS_LOYALTY_POINT_VALUE'), $currency);
	}

	public static function getNbPointsByPrice($price)
	{
		if (Configuration::get('PS_CURRENCY_DEFAULT') != Context::getContext()->currency->id)
		{
			if (Context::getContext()->currency->conversion_rate)
				$price = $price / Context::getContext()->currency->conversion_rate;
		}

		/* Prevent division by zero */
		$points = 0;
		if ($pointRate = (float)(Configuration::get('PS_LOYALTY_POINT_RATE')))
			$points = floor(number_format($price, 2, '.', '') / $pointRate);

		return (int)$points;
	}

	public static function getPointsByCustomer($id_customer)
	{

		$validity_period = Configuration::get('PS_LOYALTY_VALIDITY_PERIOD');
		$sql_period = '';
		if ((int)$validity_period > 0)
			$sql_period = ' AND datediff(NOW(),f.date_add) <= '.$validity_period;

		return
			Db::getInstance()->getValue('
		SELECT SUM(f.points) points
		FROM `'._DB_PREFIX_.'loyalty` f
		WHERE f.id_customer = '.(int)($id_customer).'
		AND f.id_loyalty_state IN ('.(int)(LoyaltyStateModule::getValidationId()).', '.(int)(LoyaltyStateModule::getNoneAwardId()).')
		'.$sql_period)
			+
			Db::getInstance()->getValue('
		SELECT SUM(f.points) points
		FROM `'._DB_PREFIX_.'loyalty` f
		WHERE f.id_customer = '.(int)($id_customer).'
		AND f.id_loyalty_state = '.(int)LoyaltyStateModule::getCancelId().'
		AND points < 0
		'.$sql_period);
	}
	
	//获取最新的当前客户id积分
	public static function getNewPointsByCustomer($id_customer)
	{

		return Db::getInstance()->getValue('SELECT points  FROM px_customer_point where id_customer='.$id_customer);
			
	}
	

	public static function getAllByIdCustomer($id_customer, $id_lang, $onlyValidate = false, $pagination = false, $nb = 10, $page = 1)
	{

		$validity_period = Configuration::get('PS_LOYALTY_VALIDITY_PERIOD');
		$sql_period = '';
		if ((int)$validity_period > 0)
			$sql_period = ' AND datediff(NOW(),f.date_add) <= '.$validity_period;

		$query = '
		SELECT f.id_order AS id, f.date_add AS date, (o.total_paid - o.total_shipping) total_without_shipping,
		f.points,f.remark as remark, f.id_loyalty, f.id_loyalty_state, fsl.name state
		FROM `'._DB_PREFIX_.'loyalty` f
		LEFT JOIN `'._DB_PREFIX_.'orders` o ON (f.id_order = o.id_order)
		LEFT JOIN `'._DB_PREFIX_.'loyalty_state_lang` fsl ON (f.id_loyalty_state = fsl.id_loyalty_state AND fsl.id_lang = '.(int)($id_lang).')
		WHERE f.id_customer = '.(int)($id_customer).$sql_period;
		if ($onlyValidate === true)
			$query .= ' AND f.id_loyalty_state = '.(int)LoyaltyStateModule::getValidationId();
		$query .= ' GROUP BY f.id_loyalty '.
			($pagination ? 'LIMIT '.(((int)($page) - 1) * (int)($nb)).', '.(int)($nb) : '');
	/* 	echo '<pre>';
		var_dump($query);
		
		echo '</pre>';
		exit; */
		
		
		return Db::getInstance()->executeS($query);
	}

	public static function getDiscountByIdCustomer($id_customer, $last = false)
	{
		$query = '
		SELECT f.id_cart_rule AS id_cart_rule, f.date_upd AS date_add
		FROM `'._DB_PREFIX_.'loyalty` f
		LEFT JOIN `'._DB_PREFIX_.'orders` o ON (f.`id_order` = o.`id_order`)
		WHERE f.`id_customer` = '.(int)($id_customer).'
		AND f.`id_cart_rule` > 0

		GROUP BY f.id_cart_rule';
		if ($last)
			$query.= ' ORDER BY f.id_loyalty DESC LIMIT 0,1';

		return Db::getInstance()->executeS($query);
	}
	//获取新的用户折扣券
	public static function getNewDiscountByIdCustomer($id_customer, $last = false)
	{
		$query = '
		SELECT  id_cart_rule, date_upd AS date_add
		FROM `'._DB_PREFIX_.'cart_rule` 
		WHERE `id_customer` = '.(int)($id_customer).'
		AND `id_cart_rule` > 0
		GROUP BY id_cart_rule';
		if ($last)
			$query.= ' ORDER BY f.id_loyalty DESC LIMIT 0,1';

		return Db::getInstance()->executeS($query);
	}
	public static function registerDiscount($cartRule)
	{
		if (!Validate::isLoadedObject($cartRule))
			die(Tools::displayError('Incorrect object CartRule.'));
		$items = self::getAllByIdCustomer((int)$cartRule->id_customer, NULL, true);
		$associated = false;
		foreach ($items AS $item)
		{
			$lm = new LoyaltyModule((int)$item['id_loyalty']);

			/* Check for negative points for this order */
			$negativePoints = (int)Db::getInstance()->getValue('SELECT SUM(points) points FROM '._DB_PREFIX_.'loyalty WHERE id_order = '.(int)$item['id'].' AND id_loyalty_state = '.(int)LoyaltyStateModule::getCancelId().' AND points < 0');

			if ($lm->points + $negativePoints <= 0)
				continue;

			$lm->id_cart_rule = (int)$cartRule->id;
			$lm->id_loyalty_state = (int)LoyaltyStateModule::getConvertId();
			$lm->save();
			$associated = true;
		}
		return $associated;
	}

	public static function getOrdersByIdDiscount($id_cart_rule)
	{
		$items = Db::getInstance()->executeS('
		SELECT f.id_order AS id_order, f.points AS points, f.date_upd AS date
		FROM `'._DB_PREFIX_.'loyalty` f
		WHERE f.id_cart_rule = '.(int)$id_cart_rule.' AND f.id_loyalty_state = '.(int)LoyaltyStateModule::getConvertId());

		if (!empty($items) AND is_array($items))
		{
			foreach ($items AS $key => $item)
			{
				$order = new Order((int)$item['id_order']);
				$items[$key]['id_currency'] = (int)$order->id_currency;
				$items[$key]['id_lang'] = (int)$order->id_lang;
				$items[$key]['total_paid'] = $order->total_paid;
				$items[$key]['total_shipping'] = $order->total_shipping;
			}
			return $items;
		}

		return false;
	}
	
	//获取设计师 的数据报告
	public static function getDesignerData()
	{
		$items = Db::getInstance()->executeS("SELECT
					o.id_order AS id,
				  group_concat(concat(od.product_reference,'(',od.product_price,')') SEPARATOR '</br>') as skus,
					od.product_price as price,
					o.total_discounts AS Discount,
					o.total_paid AS payment,
					os.`name` AS STATUS ,
					o.date_add AS paydate,
				  IF((os.`name`='Shipped'),o.date_upd,'no') as delidate
					
				FROM
					ps_orders o 

				LEFT JOIN ps_order_state_lang  os 
				on os.id_order_state=o.current_state and os.id_lang=1
				LEFT JOIN ps_order_detail od
				on od.id_order=o.id_order 
				left join ps_product pp on pp.id_product=od.product_id
				where o.date_add between date_sub(now(), interval 1 week)  and  now()
				and  pp.id_category_default =40462
				and o.total_paid !=0
				GROUP BY o.id_order
				");

		if (!empty($items) AND is_array($items))
		{
			return $items;
		}

		return false;
	}
	/* Register all transaction in a specific history table */
	//增加  新的积分表的插入px_customer_point
	private function historize()
	{	
	
	
	$id_customer = Db::getInstance()->getValue('
		SELECT f.id_customer
		FROM `'._DB_PREFIX_.'loyalty` f
		WHERE f.id_loyalty = '.(int)($this->id));
	 $cur_points = Db::getInstance()->getValue('
		SELECT points from px_customer_point  where id_customer ='.$id_customer); 
	/* $cur_points = Db::getInstance()->getValue('
		SELECT points from px_customer_point  where id_customer =11111');
		 */
	
			
	$now_points =	(int)$cur_points+(int)($this->points);	
	
	if($now_points<0){
		$now_points=0;
		
	};
	
		Db::getInstance()->execute('
		INSERT INTO `'._DB_PREFIX_.'loyalty_history` (`id_loyalty`, `id_loyalty_state`, `points`, `date_add`)
		VALUES ('.(int)($this->id).', '.(int)($this->id_loyalty_state).', '.(int)($this->points).', NOW())');
		Db::getInstance()->execute("INSERT INTO px_customer_point (id_customer, points, mark) VALUES (".$id_customer.",".$now_points.",'".$this->mark."') ON DUPLICATE KEY UPDATE id_customer=VALUES(id_customer), points=VALUES(points),mark=VALUES(mark);");
		
		Db::getInstance()->execute("INSERT INTO px_customer_point_history 
				(id_customer, points,action,ccomment,date,id_item) 
				VALUES ($id_customer,".(int)($this->points).",'+','".$this->mark."',now(),".$this->id_item.")");
		
		
	}

}
