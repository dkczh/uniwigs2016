<?php
/*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
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
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/


require_once(dirname(__FILE__).'/../config/config.inc.php');
//Dispatcher::getInstance()->dispatch();



/******  for reference  *****
// Cart is needed for some requests
Context::getContext()->cart = new Cart();

$context = Context::getContext();


$sql = 'SELECT p.`id_product`, pl.`link_rewrite`, p.`reference`, pl.`name`, MAX(image_shop.`id_image`) id_image, il.`legend`, p.`cache_default_attribute`
		FROM `'._DB_PREFIX_.'product` p
		'.Shop::addSqlAssociation('product', 'p').'
		LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (pl.id_product = p.id_product AND pl.id_lang = '.(int)Context::getContext()->language->id.Shop::addSqlRestrictionOnLang('pl').')
		LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product`)'.
		Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
		LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)Context::getContext()->language->id.')
		WHERE (pl.name LIKE \'%'.pSQL($query).'%\' OR p.reference LIKE \'%'.pSQL($query).'%\')'.
		(!empty($excludeIds) ? ' AND p.id_product NOT IN ('.$excludeIds.') ' : ' ').
		($excludeVirtuals ? 'AND p.id_product NOT IN (SELECT pd.id_product FROM `'._DB_PREFIX_.'product_download` pd WHERE (pd.id_product = p.id_product))' : '').
		($exclude_packs ? 'AND (p.cache_is_pack IS NULL OR p.cache_is_pack = 0)' : '').
		' GROUP BY p.id_product';
$items = Db::getInstance()->executeS($sql);


Tools::jsonEncode(new stdClass);


$dir = Context::getContext()->smarty->getTemplateDir(0).'controllers'.DIRECTORY_SEPARATOR.trim($con->override_folder, '\\/').DIRECTORY_SEPARATOR;
$footer_tpl = file_exists($dir.'footer.tpl') ? $dir.'footer.tpl' : 'footer.tpl';
echo Context::getContext()->smarty->fetch($footer_tpl);


$this->context->controller->addCSS($this->_path.'css/live_configurator.css');
$this->context->controller->addJS($this->_path.'js/live_configurator.js');

$this->context->smarty->assign(Meta::getMetaTags($this->context->language->id, $page_name));
******  for reference END  *****/




/*
error_reporting(E_ALL ^ E_NOTICE);
@ini_set('display_errors', 'off');


//require_once(dirname(__FILE__).'/../header.php');
$controller = new FrontController();
$controller->init();
//$controller->addCSS($this->_path.'css/live_configurator.css');
//$controller->addJS($this->_path.'js/live_configurator.js');
$controller->setMedia();

$controller->displayHeader();

echo Context::getContext()->smarty->fetch(_PS_ROOT_DIR_.'/extra/tpls/custom-show.tpl');

//require_once(dirname(__FILE__).'/../footer.php');
$controller->displayFooter();
*/

class CustomerShowController extends FrontController
{
	public function init()
    {
    	parent::init();
		$cshow = 'customershow';
		$this->context->smarty->assign("cshow", $cshow);
    	$ca = '';
		if (!empty($_GET['ca'])) {
			$ca = trim($_GET['ca']);
		}
		$this->context->smarty->assign("ca", $ca);

		$caid = '';
		if (!empty($_GET['caid'])) {
			$caid = intval($_GET['caid']);
		}
		$this->context->smarty->assign("caid", $caid);

		$psku = '';
		if (!empty($_GET['psku'])) {
			$psku = trim($_GET['psku']);
		}
		$this->context->smarty->assign("psku", $psku);
    }
}

$controller = new CustomerShowController();
$controller->page_name = 'extra/customer-show';
$controller->display_column_left = false;
file_exists(_PS_THEME_MOBILE_DIR_.'layout.tpl');
if (file_exists(_PS_ROOT_DIR_.'/extra/tpls/'._THEME_NAME_.'/customer-show.tpl')) {
	$controller->setTemplate(_PS_ROOT_DIR_.'/extra/tpls/'._THEME_NAME_.'/customer-show.tpl');
} else {
	$controller->setTemplate(_PS_ROOT_DIR_.'/extra/tpls/customer-show.tpl');
}

$controller->run();



