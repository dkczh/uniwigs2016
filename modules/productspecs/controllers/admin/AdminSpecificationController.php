<?php

if (!defined('_PS_VERSION_'))
	exit;

class AdminSpecificationController extends ModuleAdminController
{
	public function __construct()
	{
		$this->bootstrap = true;
		$this->display = 'view';
		$this->meta_title = $this->l('Specification Management');
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
		$this->toolbar_title[] = $this->l('Specification Management');
	}

	public function initPageHeaderToolbar()
	{
		parent::initPageHeaderToolbar();
		unset($this->page_header_toolbar_btn['back']);
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
		$view = $this->createTemplate('specification_list.tpl');

		$link_base = Context::getContext()->link->getAdminLink('AdminSpecification');
		$view->assign('link_base', $link_base);

		$all_specs = $this->_get_all_specs();

		$id = Tools::getValue('id_spec','');
		$opr = Tools::getValue('opr');
		$msg = "";
		if ($opr == 'edit' || $opr == 'add') {
			if ($opr == 'edit') {
				$rec = Db::getInstance()->getRow("select * from px_specifications where id_specification=$id", false);
			} else {
				$rec = array(
					'id_specification'=>0,
					'name'=>'',
					'name_cn'=>'',
					'description'=>'',
					'content'=>'',
					'visible'=>1,
					'sortindex'=>100,
				);
			}

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

			$html .= $this->createTemplate('specification_add_edit.tpl')
				->assign(array(
					'rec'=>$rec,
					'link_base'=>$link_base,
				))
				->fetch();
		} elseif ($opr == 'del') {
			if ($id) {
				if (FALSE !== Db::getInstance()->Execute("update px_specifications set visible=0 where id_specification=$id")) {
					$msg = "id={$id}删除成功";

					$all_specs = $this->_get_all_specs();
				} else {
					$msg = "id={$id}删除失败";
				}
			}
		} elseif ($opr == 'undel') {
			if ($id) {
				if (FALSE !== Db::getInstance()->Execute("update px_specifications set visible=1 where id_specification=$id")) {
					$msg = "id={$id}恢复成功";

					$all_specs = $this->_get_all_specs();
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

		$view->assign(array(
			'all_specs' => $all_specs,
			'msg' => $msg,
		));

		$html .= $view->fetch();
		return $html;
	}

	public function postProcess()
	{

	}
}
