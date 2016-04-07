<?php

if (!defined('_PS_VERSION_'))
	exit;

//include_once dirname(__FILE__).'/../../classes/Condition.php';

class AdminProductSpecificationController extends ModuleAdminController
{
	public function __construct()
	{
		$this->bootstrap = true;
		$this->display = 'view';
		$this->meta_title = $this->l('Product Specification Management');
		parent::__construct();
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
		$this->override_folder = '';
	}

	public function setMedia()
	{
// 		$this->addJqueryUI('ui.progressbar');
// 		$this->addJS(_MODULE_DIR_.$this->module->name.'/views/js/bubble-popup.js');

// 		if (version_compare(_PS_VERSION_, '1.6.0', '>=') === true)
// 			$this->addJs(_MODULE_DIR_.$this->module->name.'/views/js/gamification_bt.js');
// 		else
// 			$this->addJs(_MODULE_DIR_.$this->module->name.'/views/js/gamification.js');

// 		$this->addJs(_MODULE_DIR_.$this->module->name.'/views/js/jquery.isotope.js');
// 		$this->addCSS(array(_MODULE_DIR_.$this->module->name.'/views/css/bubble-popup.css', _MODULE_DIR_.$this->module->name.'/views/css/isotope.css'));

		return parent::setMedia();
	}

	public function initToolBarTitle()
	{
		$this->toolbar_title[] = $this->l('Administration');
		$this->toolbar_title[] = $this->l('Product Specification Management');
	}

	public function initPageHeaderToolbar()
	{
		parent::initPageHeaderToolbar();
		unset($this->page_header_toolbar_btn['back']);
	}

	private function _get_product_specs_list()
	{
		$product_specs_list = array();
		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
		select ps.sku,group_concat(sp.id_specification) as id_specifications,group_concat(sp.name) as specifications
		from px_product_specifications ps
		left join ps_product p on p.reference=ps.sku
		left join px_specifications sp on sp.id_specification=ps.id_specification
		group by ps.sku
		order by ps.sku
		', true, false);
		if ($result) {
			$product_specs_list = & $result;
		}
		return $product_specs_list;
	}

	private function _get_all_specs()
	{
		return Db::getInstance()->ExecuteS('
		select * from px_specifications order by visible desc,sortindex asc,id_specification asc
		', true, false);
	}

	public function renderView()
	{
		$html = '';
		$view = $this->createTemplate('product_specs_list.tpl');

		$link_base = Context::getContext()->link->getAdminLink('AdminProductSpecification');
		$view->assign('link_base', $link_base);

		$product_specs_list = $this->_get_product_specs_list();
		$all_specs = $this->_get_all_specs();

		$sku = Tools::getValue('sku','');
		$opr = Tools::getValue('opr');
		$msg = "";
		if ( $opr == 'add' && empty($sku) ) {
			$msg = "数据不完整，SKU为必填项";
		}
		if (empty($msg) && $opr == 'edit' || $opr == 'add') {
			if ($opr == 'edit') {
				$product_specs = Db::getInstance()->getRow('
				select ps.sku,group_concat(sp.id_specification) as id_specifications,group_concat(sp.name) as specifications
				from px_product_specifications ps
				left join ps_product p on p.reference=ps.sku
				left join px_specifications sp on sp.id_specification=ps.id_specification
				where ps.sku="'.pSQL($sku).'"
				group by ps.sku', false);
				if (!empty($product_specs['id_specifications'])) {
					$product_specs['id_specifications'] = explode(',', $product_specs['id_specifications']);
					foreach ($all_specs as &$spec) {
						$spec['checked'] = in_array($spec['id_specification'], $product_specs['id_specifications']);
					}
				}
			} else {
				$product_specs = array(
					'sku'=>'',
					'id_specifications'=>array(),
					'specifications'=>'',
				);
			}

			if ($_POST && Tools::isSubmit('op_save')) {
				$id_specifications = Tools::getValue('id_specifications', array());
				$res = true;
				if ($opr == 'edit') {
					$res = Db::getInstance()->Execute('delete from px_product_specifications where sku="'.pSQL($sku).'"');
				}
				foreach ($id_specifications as $id_spec) {
					if (!$res) {
						break;
					}
					$res = Db::getInstance()->Execute('insert into px_product_specifications(sku,id_specification) value("'.pSQL($sku).'",'.$id_spec.')');
					if (!$res) {
						$res = FALSE;
					}
				}
				if (FALSE === $res) {
					if ($opr == 'edit') {
						$msg = "sku={$sku}编辑失败";
					} else {
						$msg = "添加失败";
					}
				}

				if (empty($msg)) {
					header("Location: $link_base&from=$opr");
					exit();
				}
			}

			$html .= $this->createTemplate('product_specs_add_edit.tpl')
				->assign(array(
					'link_base'=>$link_base,
					'product_specs'=>$product_specs,
					'all_specs'=>$all_specs,
					'opr'=>$opr,
				))
				->fetch();
		} elseif ($opr == 'del') {
			if ($sku) {
				if (FALSE !== Db::getInstance()->Execute('delete from px_product_specifications where sku="'.pSQL($sku).'"')) {
					$msg = "sku={$sku}删除成功";

					$product_specs_list = $this->_get_product_specs_list();
				} else {
					$msg = "sku={$sku}删除失败";
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

		$view->assign(array(
			'msg' => $msg,
			'product_specs_list' => $product_specs_list,
		));

		$html .= $view->fetch();
		return $html;

		/* NG
		$this->tpl_view_vars = array(
			'product_specifications' => $product_specifications,
		);
		if (version_compare(_PS_VERSION_, '1.5.6.0', '>')) {
			$this->base_tpl_view = 'product_specifications.tpl';
			//Fatal error: Uncaught --> Smarty: Unable to load template file 'helpers/view/product_specifications.tpl'
		}
		//not to test  // echo $this->module->display(_PS_MODULE_DIR_.$this->module->name.DIRECTORY_SEPARATOR.$this->module->name.'.php', 'config.tpl');
		return parent::renderView();
		*/
	}

	public function ajaxProcessDisableNotification()
	{
		Configuration::updateGlobalValue('GF_NOTIFICATION', 0);
	}

	public function processRefreshData()
	{
		return $this->module->refreshDatas();
	}

	public function postProcess()
	{
// 		die('123123');
	}
}
