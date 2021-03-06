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

if (!defined('_CS_DISABLE_DB_QUERY_CACHE_'))
	define('_CS_DISABLE_DB_QUERY_CACHE_', true);

require_once(dirname(__FILE__).'/../../config/config.inc.php');
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
******  for reference END  *****/


$controller = new FrontController();
$controller->page_name = 'salon-customer';
$controller->display_column_left = false;
$controller->setTemplate(_PS_ROOT_DIR_.'/extra/tpls/salon/salon-customer.tpl');
$controller->run();