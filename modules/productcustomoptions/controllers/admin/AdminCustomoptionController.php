<?php

if (!defined('_PS_VERSION_'))
	exit;

class AdminCustomoptionController extends ModuleAdminController
{
	public function __construct()
	{
		$this->bootstrap = true;
		$this->display = 'view';
		$this->meta_title = $this->l('Custom Options Management');
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
		$this->toolbar_title[] = $this->l('Custom Options Management');
	}

	public function initPageHeaderToolbar()
	{
		parent::initPageHeaderToolbar();
		unset($this->page_header_toolbar_btn['back']);
	}

	private $page_total;
	private $pa;
	private function _get_all_customoptions()
	{
		$pa = Tools::getValue('pa', 1);
		$totalnum = 0;
		$page_size = 50;
		$page_total = 0;

		$totalnum = Db::getInstance()->ExecuteS('
select count(1) as totalnum
from px_custom_options
where deleted=0
', true, false);
		if (! $totalnum) {
			return array();
		}

		$totalnum = $totalnum[0]['totalnum'];
		$page_total = ceil($totalnum / $page_size);
		if ($pa > $page_total) $pa = $page_total;
		if ($pa < 1) $pa = 1;

		$this->page_total = $page_total;
		$this->pa = $pa;

		$curr_ind = $page_size * ($pa-1);

		return Db::getInstance()->ExecuteS("
select *
from px_custom_options
where deleted=0
order by add_time desc
limit $curr_ind,$page_size
		", true, false);
	}

	private function _mem_del_product_custom_options($option_label)
	{
		/*global $mem;
		$option_label = strtolower($option_label);
		$option_label_signature = md5($option_label);
		if ($mem) {
			$mem->delete('product_custom_options_'.$option_label_signature);
		}*/
	}

	public function renderView()
	{
		$html = '';
		$view = $this->createTemplate('customoption_list.tpl');

		$link_base = Context::getContext()->link->getAdminLink('AdminCustomoption');
		$view->assign('link_base', $link_base);

		$custom_options = $this->_get_all_customoptions();

		$id = Tools::getValue('id','');
		$opr = Tools::getValue('opr');
		$msg = "";
		if ($opr == 'edit' || $opr == 'add') {
			if ($opr == 'edit') {
				$rec = Db::getInstance()->getRow("
				select *
				from px_custom_options
				where deleted=0 and id='$id'
				order by add_time desc
				", false);
			} else {
				$rec = array(
					'option_label'=>'',
					'option_values'=>'',
					'custom_time'=>'',
					'custom_price'=>0,
					'add_time'=>date('Y-m-d H:i:s'),
					'upd_time'=>date('Y-m-d H:i:s'),
					'deleted'=>0,
				);
			}

			if ($_POST && Tools::isSubmit('op_save')) {
				if (isset($_POST['option_label'])) $_POST['option_label'] = trim($_POST['option_label']);
				if (isset($_POST['option_values'])) $_POST['option_values'] = trim($_POST['option_values']);
				if (isset($_POST['custom_time'])) $_POST['custom_time'] = trim($_POST['custom_time']);
				if (isset($_POST['custom_price'])) $_POST['custom_price'] = trim($_POST['custom_price']);
				if ($_POST['option_values']) {
					$_POST['option_values'] = str_replace('，', ',', $_POST['option_values']);
				}
				$rec = array_merge($rec, $_POST);
				$rec['custom_price'] = floatval($rec['custom_price']);

				if (empty($rec["option_label"])
						|| empty($rec["option_values"])
				) {
					$msg = "数据不完整，option_label option_values为必填项";
				} else {
					if ($opr == 'edit') {
						Db::getInstance()->Execute('
						update px_custom_options set
						option_label=\''.pSQL($rec["option_label"]).'\',
						option_values=\''.pSQL($rec["option_values"]).'\',
						custom_time=\''.pSQL($rec["custom_time"]).'\',
						custom_price=\''.$rec["custom_price"].'\',
						upd_time="'.date('Y-m-d H:i:s').'"
						where id="'.$id.'"');

						$this->_mem_del_product_custom_options($rec["option_label"]);
						//$msg = "id={$id}编辑失败";
					} else {
						$res = Db::getInstance()->Execute('
							insert into px_custom_options(option_label,option_values,custom_time,custom_price,add_time,upd_time)
							values(\''.pSQL($rec["option_label"]).'\',
								\''.pSQL($rec["option_values"]).'\',
								\''.$rec["custom_time"].'\',
								\''.$rec["custom_price"].'\',
								"'.date('Y-m-d H:i:s').'","'.date('Y-m-d H:i:s').'")'
						);
						$new_id = Db::getInstance()->Insert_ID();

						$this->_mem_del_product_custom_options($rec["option_label"]);
						//$msg = "添加失败";
					}
				}

				if (empty($msg)) {
					header("Location: $link_base&from=$opr");
					exit();
				}
			}

			$html .= $this->createTemplate('customoption_add_edit.tpl')
				->assign(array(
					'rec'=>$rec,
					'link_base'=>$link_base,
				))
				->fetch();
		} elseif ($opr == 'del') {
			if ($id) {
				if (FALSE !== Db::getInstance()->Execute("update px_custom_options set deleted=1,upd_time='".date('Y-m-d H:i:s')."' where id='$id'")
					) {
					$msg = "id={$id}删除成功";

					$custom_options = $this->_get_all_customoptions();
				} else {
					$msg = "id={$id}删除失败";
				}

				$label_rec = Db::getInstance()->getRow('select option_label from px_custom_options where id='.$id, false);
				if ($label_rec && $label_rec['option_label']) $this->_mem_del_product_custom_options($label_rec['option_label']);
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
			'custom_options' => $custom_options,
			'msg' => $msg,
		));

		$html .= $view->fetch();
		$html .= $this->createTemplate('pagination.tpl')->assign(array(
			'page_total' => $this->page_total,
			'pa' => $this->pa,
			'link_base'=>$link_base,
		))->fetch();
		return $html;
	}

	public function postProcess()
	{

	}
}
