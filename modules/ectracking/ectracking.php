<?php
/**
 * 2007-2015 PrestaShop
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
 *  @author    PrestaShop SA <contact@prestashop.com>
 *  @copyright 2007-2015 PrestaShop SA
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

if (!defined('_PS_VERSION_'))
	exit;

class Ectracking extends Module
{
	protected $js_state = 0;
	protected $eligible = 0;
	protected $filterable = 1;
	protected static $products = array();
	protected $_debug = 0;

	public function __construct()
	{
		$this->name = 'ectracking';
		$this->tab = 'ectracking';
		$this->version = '1.0';
		$this->author = 'Bruno电商技术™';

		parent::__construct();

		$this->displayName = $this->l('EC Tracking');
		$this->description = $this->l('variety of e-commerce tracking');
		$this->confirmUninstall = $this->l('Are you sure you want to uninstall? You will lose all the data related to this module.');
		/* Backward compatibility */
		if (version_compare(_PS_VERSION_, '1.5', '<'))
			die('can not support too low version');

		$this->checkForUpdates();
	}

	public function install()
	{
		if (version_compare(_PS_VERSION_, '1.5', '>=') && Shop::isFeatureActive())
			Shop::setContext(Shop::CONTEXT_ALL);

		if (!parent::install()
			|| !$this->registerHook('header')
			|| !$this->registerHook('footer')
			|| !$this->registerHook('home')
			|| !$this->registerHook('productfooter')
			|| !$this->registerHook('orderConfirmation')
			)
			return false;

		return true;
	}

	public function uninstall()
	{
		if (!parent::uninstall())
			return false;

		return true;
	}

	public function hookHeader()
	{
		
	}

	/**
	 * To track transactions
	 */
	public function hookOrderConfirmation($params)
	{
		$order = $params['objOrder'];
		if (Validate::isLoadedObject($order) && $order->getCurrentState() != (int)Configuration::get('PS_OS_ERROR'))
		{
			$id_order = $order->id;
			$total_paid = $order->total_paid;
			$total_shipping = $order->total_shipping;
			$total_without_shipping = $total_paid - $total_shipping;

			$this->smarty->assign(array(
				'order' => $order,
			));

$google_ppc_js = '
<!-- Google Code for conv Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 923345832;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "S8U_CJCfxQ4QqMekuAM";
var google_conversion_value = ' . $total_paid . ';
var google_conversion_currency = "USD";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/923345832/?value=' . $total_paid . '&amp;currency_code=USD&amp;label=S8U_CJCfxQ4QqMekuAM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
';

if (false) { // old version, TOBEREMOVED
$google_ppc_js = '
<!-- Google Code for conv Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 923345832;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "S8U_CJCfxQ4QqMekuAM";
var google_conversion_value = ' . $total_paid . ';
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/923345832/?value=' . $total_paid . '&amp;label=S8U_CJCfxQ4QqMekuAM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
';
}

if (false) { // repeated, TOBEREMOVED
'
<!-- Google Code for conv Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 923345832;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "S8U_CJCfxQ4QqMekuAM";
var google_conversion_value =  '. $total_paid .';
var google_conversion_currency = "USD";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/971076500/?value=' . $total_paid . '&amp;label=kKWmCKSJ3QoQlOeFzwM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
';
}


$this->smarty->assign('google_ppc_js', $google_ppc_js);


$bing_ppc_js = '
<script type="text/javascript">
if (!window.mstag) mstag = {loadTag : function(){},time : (new Date()).getTime()};
</script>
<script id="mstag_tops" type="text/javascript" src="//flex.atdmt.com/mstag/site/1917a6d4-f18d-4d68-be35-bc304cbfba55/mstag.js"></script>
<script type="text/javascript">
mstag.loadTag("analytics", {dedup:"1",domainId:"1856927",type:"1",nonadvertisingcost:"",revenue:"'.$total_paid.'",actionid:"131934"})
</script>
<noscript>
<iframe src="//flex.atdmt.com/mstag/tag/1917a6d4-f18d-4d68-be35-bc304cbfba55/analytics.html?dedup=1&domainId=1856927&type=1&nonadvertisingcost=&revenue='.$total_paid.'&actionid=131934" frameborder="0" scrolling="no" width="1" height="1" style="visibility:hidden;display:none">
</iframe>
</noscript>
';
$this->smarty->assign('bing_ppc_js', $bing_ppc_js);


$shareasale_js = '<img height="1" width="1" style="border-style:none;" alt="" src="https://shareasale.com/sale.cfm?amount=' . $total_without_shipping . '&tracking=' . $id_order . '&transtype=sale&merchantID=47218"/>';
$this->smarty->assign('shareasale_js', $shareasale_js);


			return $this->display(__FILE__, 'ectracking-order-confirm.tpl');
		}
	}

	/**
	 * hook footer to load JS script for standards actions such as product clicks
	 */
	public function hookFooter()
	{
		$ecomm_prodid = '';
		$ecomm_pagetype = '';
		$ecomm_totalvalue = '';

		$ecomm_pagetype = Dispatcher::getInstance()->getController();
		if ($ecomm_pagetype == 'product') {
			// $product = $this->smarty->getTemplateVars('product');
			// NG
		}

		$this->smarty->assign(array(
			'ecomm_prodid' => $ecomm_prodid,
			'ecomm_pagetype' => $ecomm_pagetype,
			'ecomm_totalvalue' => $ecomm_totalvalue,
		));

		return $this->display(__FILE__, 'ectracking-footer.tpl');
	}

	/**
	 * hook home to display generate the product list associated to home featured, news products and best sellers Modules
	 */
	public function hookHome()
	{
		return '';
	}

	/**
	 * hook product page footer to load JS for product details view
	 */
	public function hookProductFooter($params)
	{
		return '';
	}

	protected function checkForUpdates()
	{
		
	}

	protected function _debugLog($function, $log)
	{
		if (!$this->_debug)
			return true;

		$myFile = _PS_MODULE_DIR_.$this->name.'/logs/ectracking.log';
		$fh = fopen($myFile, 'a');
		fwrite($fh, date('F j, Y, g:i a').' '.$function."\n");
		fwrite($fh, print_r($log, true)."\n\n");
		fclose($fh);
	}
}
