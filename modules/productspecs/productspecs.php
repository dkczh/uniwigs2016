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

class ProductSpecs extends Module
{
	public function __construct()
	{
		$this->name = 'productspecs';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'Bruno';
		$this->need_instance = 0;

		$this->bootstrap = true;
		parent::__construct();

		$this->displayName = $this->l('Product Specifications');
		$this->description = $this->l('Shows information on a product page: Product Specifications.');
	}

	public function install()
	{
		if (!parent::install())
			return false;

		/* Default configuration values */
		Configuration::updateValue('PS_PRODUCTSPECS_ENABLED', 1);
		Configuration::updateValue('PS_PRODUCTSPECS_TITLE', "Product Specifications");

		return $this->registerHook('displayHeader')
			&& $this->registerHook('displayFooterProduct')
			&& $this->registerHook('displayProductSpecs')
			&& $this->registerHook('displayProductFeatures');
	}

	public function uninstall()
	{
		if (!Configuration::deleteByName('PS_PRODUCTSPECS_ENABLED')
			|| !Configuration::deleteByName('PS_PRODUCTSPECS_TITLE')
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

	public function getContent_bak()
	{
		$html = '';

		/* Update values in DB */
// 		if (Tools::isSubmit('SubmitToolTip'))
// 		{
// 			Configuration::updateValue('PS_PTOOLTIP_PEOPLE', (int)Tools::getValue('PS_PTOOLTIP_PEOPLE'));
// 			Configuration::updateValue('PS_PTOOLTIP_DATE_CART', (int)Tools::getValue('PS_PTOOLTIP_DATE_CART'));
// 			Configuration::updateValue('PS_PTOOLTIP_DATE_ORDER', (int)Tools::getValue('PS_PTOOLTIP_DATE_ORDER'));
// 			Configuration::updateValue('PS_PTOOLTIP_DAYS', ((int)(Tools::getValue('PS_PTOOLTIP_DAYS') < 0 ? 0 : (int)Tools::getValue('PS_PTOOLTIP_DAYS'))));
// 			Configuration::updateValue('PS_PTOOLTIP_LIFETIME', ((int)(Tools::getValue('PS_PTOOLTIP_LIFETIME') < 0 ? 0 : (int)Tools::getValue('PS_PTOOLTIP_LIFETIME'))));

// 			$html .= $this->displayConfirmation($this->l('Settings updated'));
// 		}

		global $cookie;
		//$token = Tools::getAdminToken("AdminBanner" . intval(Tab::getIdFromClassName("AdminBanner")) . intval($cookie->id_employee));  //NG
		//$token = Tools::getAdminToken('ProductSpecs'.(int)(Tab::getIdFromClassName('ProductSpecs')).(int)$this->context->employee->id);  //NG
		//$token = $this->token  //NG
		//$token = Tools::getAdminTokenLite('ProductSpecs');  //NG
		//$token = Tools::getAdminTokenLite('ProductSpecs',$this->context);  //NG
		$token = Tools::getAdminTokenLite('AdminModules');
		
		//$this->smarty->assign('token', $token);  //NG
		$this->context->smarty->assign('token', $token);

		$id = Tools::getValue('id_spec','');
		$opr = Tools::getValue('opr');
		
		$all_specs = Db::getInstance()->ExecuteS('
		select * from px_specifications order by visible desc,sortindex asc,id_specification asc
		');
		//$this->smarty->assign('all_specs', $all_specs);
		$this->context->smarty->assign('all_specs', $all_specs);
		
		$link_base = 'index.php?controller=AdminModules&token='.$token.'&configure=productspecs&tab_module=front_office_features&module_name=productspecs';
		$this->context->smarty->assign('link_base', $link_base);
		
		$msg = "";
		if ($opr == 'edit' || $opr == 'add') {
			if ($opr == 'edit') {
				$rec = Db::getInstance()->getRow("select * from px_specifications where id_specification=$id");
			} else {
				$rec = array(
						'id'=>0,
						'name'=>'',
						'name_cn'=>'',
						'description'=>'',
						'content'=>'',
						'visible'=>1,
						'sortindex'=>100,
				);
			}
			$this->context->smarty->assign('rec', $rec);
			if ($_POST && Tools::isSubmit('op_save')) {
				if (isset($_POST['name'])) $_POST['name'] = trim($_POST['name']);
				if (isset($_POST['name_cn'])) $_POST['name_cn'] = trim($_POST['name_cn']);
				if (isset($_POST['description'])) $_POST['description'] = trim($_POST['description']);
				if (isset($_POST['content'])) $_POST['content'] = trim($_POST['content']);
				$rec = array_merge($rec, $_POST);
		
				if (empty($rec["name"])
						|| empty($rec["content"])
						|| !isset($rec["visible"])
						|| empty($rec["sortindex"])
				) {
					$msg = "数据不完整，name content visible sortindex为必填项";
				} else {
					if ($opr == 'edit') {
						if (FALSE === Db::getInstance()->Execute('update px_specifications set name=\''.pSQL($rec["name"]).'\',name_cn=\''.pSQL($rec["name_cn"]).'\',description=\''.pSQL($rec["description"], true).'\',content=\''.pSQL($rec["content"], true).'\',visible=\''.pSQL($rec["visible"]).'\',sortindex=\''.pSQL($rec["sortindex"]).'\' where id_specification='.$id)) {
							$msg = "id={$id}编辑失败";
						}
					} else {
						if (FALSE === Db::getInstance()->Execute('insert into px_specifications(name,name_cn,description,content,visible,sortindex) values(\''.pSQL($rec["name"]).'\',\''.pSQL($rec["name_cn"]).'\',\''.pSQL($rec["description"], true).'\',\''.pSQL($rec["content"], true).'\',\''.pSQL($rec["visible"]).'\',\''.pSQL($rec["sortindex"]).'\')')) {
							$msg = "添加失败";
						}
					}
				}
		
				if (empty($msg)) {
					header("Location: $link_base&from=$opr");
					exit();
				}
			}

			//$html .= $this->display(__FILE__, 'specification_add_edit.tpl');
			$html .= $this->context->smarty->fetch($this->local_path.'views/templates/admin/specification_add_edit.tpl');
		} elseif ($opr == 'del') {
			if ($id) {
				if (FALSE !== Db::getInstance()->Execute("update px_specifications set visible=0 where id_specification=$id")) {
					$msg = "id={$id}删除成功";
		
					$all_specs = Db::getInstance()->ExecuteS('
		select * from px_specifications order by visible desc,sortindex asc,id_specification asc
		');
				} else {
					$msg = "id={$id}删除失败";
				}
			}
		} elseif ($opr == 'undel') {
			if ($id) {
				if (FALSE !== Db::getInstance()->Execute("update px_specifications set visible=1 where id_specification=$id")) {
					$msg = "id={$id}恢复成功";
		
					$all_specs = Db::getInstance()->ExecuteS('
		select * from px_specifications order by visible desc,sortindex asc,id_specification asc
		');
				} else {
					$msg = "id={$id}恢复失败";
				}
			}
		} else {
			$from = Tools::getValue('from');
			if ($from == 'edit') {
				$msg = "修改成功";
			} elseif ($from == 'add') {
				$msg = "添加成功";
			}
		}

		//$html .= $this->display(__FILE__, 'specification_list.tpl');
		$html .= $this->context->smarty->fetch($this->local_path.'views/templates/admin/specification_list.tpl');
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

	public function hookDisplayProductSpecs($params)
	{
		if (!Configuration::get('PS_PRODUCTSPECS_ENABLED')) return '';

		$id_product = (int)$params['product']->id;

		$specs = Db::getInstance()->ExecuteS("
		select sp.name,sp.content,sp.description
		from px_product_specifications ps
		left join ps_product p on ps.sku=p.reference
		left join ps_product_lang pl on pl.id_product=p.id_product and id_lang=1 and id_shop=1
		left join px_specifications sp on sp.id_specification=ps.id_specification
		where sp.visible=1
		and p.id_product=$id_product
		order by sp.sortindex asc,sp.id_specification asc
		");
		
		$this->context->smarty->assign(array(
			'specs' => $specs
		));

		if ($specs)
			return $this->display(__FILE__, 'specs.tpl');

		return '';
	}

	public function hookDisplayProductFeatures($params)
	{
		// if (!Configuration::get('PS_PRODUCTSPECS_ENABLED')) return '';

		$id_product = (int)$params['product']->id;

		$features = Db::getInstance()->ExecuteS("
		select fl.name as feature_name,fvl.value as feature_value
		from ps_feature_product fp
		left join ps_product p on p.id_product=fp.id_product
		left join ps_product_lang pl on pl.id_product=p.id_product and pl.id_lang=1 and id_shop=1
		left join ps_feature_lang fl on fl.id_feature=fp.id_feature and fl.id_lang=1
		left join ps_feature f on fl.id_feature=f.id_feature
		left join ps_feature_value_lang fvl on fvl.id_feature_value=fp.id_feature_value and fvl.id_lang=1
		where 1
		and p.id_product=$id_product
		order by f.position asc,feature_name asc
		");

		$this->context->smarty->assign(array(
			'features' => $features
		));

		if ($features)
			return $this->display(__FILE__, 'features.tpl');

		return '';
	}

}
