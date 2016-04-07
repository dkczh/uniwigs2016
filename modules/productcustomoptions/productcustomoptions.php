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

class ProductCustomoptions extends Module
{
	public function __construct()
	{
		$this->name = 'productcustomoptions';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'Bruno';
		$this->need_instance = 0;

		$this->bootstrap = true;
		parent::__construct();

		$this->displayName = $this->l('Product Custom Options');
		$this->description = $this->l('Shows information on a product page: Product Custom Options.');
	}

	public function install()
	{
		if (!parent::install())
			return false;

		/* Default configuration values */
		Configuration::updateValue('PS_PRODUCTCUSTOMOPTIONS_ENABLED', 1);
		Configuration::updateValue('PS_PRODUCTCUSTOMOPTIONS_TITLE', "Product Custom Options");

		return $this->registerHook('displayHeader')
			&& $this->registerHook('displayFooterProduct')
			&& $this->registerHook('displayProductCustomoptions');
	}

	public function uninstall()
	{
		if (!Configuration::deleteByName('PS_PRODUCTCUSTOMOPTIONS_ENABLED')
			|| !Configuration::deleteByName('PS_PRODUCTCUSTOMOPTIONS_TITLE')
			|| !parent::uninstall()
		)
			return false;

		return true;
	}

	public function getContent()
	{
		$html = '';
		//$html .= $this->context->smarty->fetch($this->local_path.'views/templates/admin/specification_list.tpl');
		return $html;
	}

	public function hookDisplayHeader($params)
	{
// 		$this->context->controller->addJQueryPlugin('growl');
	}

	public function hookDisplayFooterProduct($params)
	{
// 		$id_product = (int)$params['product']->id;

// 		$specs = Db::getInstance()->ExecuteS('
// 		select * from px_specifications order by visible desc,sortindex asc,id_specification asc
// 		');

// 		if ((isset($nb_people['nb']) && $nb_people['nb'] > 0) || isset($order['date_add']) || isset($cart['date_add']))
// 			return $this->display(__FILE__, 'producttooltip.tpl');
	}

	public function hookDisplayProductCustomoptions($params)
	{
		
	}

}
