<?php

if (!defined('_PS_VERSION_'))
	exit;

class AdminAssociationController extends ModuleAdminController
{
	public function __construct()
	{
		$this->bootstrap = true;
		$this->display = 'view';
		$this->meta_title = $this->l('Association Management');
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
		$this->toolbar_title[] = $this->l('Association Management');
	}

	public function initPageHeaderToolbar()
	{
		parent::initPageHeaderToolbar();
		unset($this->page_header_toolbar_btn['back']);
	}

	private $page_total;
	private $pa;
	private function _get_all_associations()
	{
		$pa = Tools::getValue('pa', 1);
		$totalnum = 0;
		$page_size = 50;
		$page_total = 0;

		$totalnum = Db::getInstance()->ExecuteS('
select count(1) as totalnum
from px_product_associations pa
where pa.deleted=0
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
select pad.association_id,pa.subject,GROUP_CONCAT(concat(pad.sku,':',pad.value)) as skus,pa.add_time,pa.upd_time,pa.deleted
from px_product_association_details pad
	left join px_product_associations pa on pad.association_id=pa.id
where pa.deleted=0
group by pad.association_id
order by pa.add_time desc
limit $curr_ind,$page_size
		", true, false);
	}

	private function _add_product_association_details($skus, $id) {
		$sku_arr = explode(',', $skus);
		foreach ($sku_arr as $sku) {
			if (stristr($sku, ':')) {
				$sku_info = explode(':', $sku);
				Db::getInstance()->Execute('insert into px_product_association_details(association_id,sku,id_product,value)
					values('.$id.',"'.$sku_info[0].'",0,\''.pSQL($sku_info[1]).'\')');
			}
		}
	}

	public function renderView()
	{
		$html = '';
		$view = $this->createTemplate('associations_list.tpl');

		$link_base = Context::getContext()->link->getAdminLink('AdminAssociation');
		$view->assign('link_base', $link_base);

		$all_assocs = $this->_get_all_associations();

		$id = Tools::getValue('id_assoc','');
		$opr = Tools::getValue('opr');
		$msg = "";
		if ($opr == 'edit' || $opr == 'add') {
			if ($opr == 'edit') {
				$rec = Db::getInstance()->getRow("
select pad.association_id,pa.subject,GROUP_CONCAT(concat(pad.sku,':',pad.value)) as skus,pa.add_time,pa.upd_time,pa.deleted
from px_product_association_details pad
	left join px_product_associations pa on pad.association_id=pa.id
where pa.deleted=0 and pad.association_id=$id
group by pad.association_id
order by pa.add_time desc
				", false);
			} else {
				$rec = array(
					'association_id'=>0,
					'subject'=>'',
					'skus'=>'',
					'add_time'=>date('Y-m-d H:i:s'),
					'upd_time'=>date('Y-m-d H:i:s'),
					'deleted'=>0,
				);
			}

			if ($_POST && Tools::isSubmit('op_save')) {
				if (isset($_POST['subject'])) $_POST['subject'] = trim($_POST['subject']);
				if (isset($_POST['skus'])) $_POST['skus'] = trim($_POST['skus']);
				if ($_POST['skus']) {
					$_POST['skus'] = str_replace('，', ',', $_POST['skus']);
					$_POST['skus'] = str_replace('：', ':', $_POST['skus']);
				}
				$rec = array_merge($rec, $_POST);

				if (empty($rec["subject"])
						|| empty($rec["skus"])
				) {
					$msg = "数据不完整，subject skus为必填项";
				} elseif ( !(strstr($rec["skus"], ':') && strstr($rec["skus"], ',')) ) {
					$msg = "skus格式不正确，应该是这样：\"LT001:Lace Front,LT002:Full Lace\"";
				} else {
					if ($opr == 'edit') {
						Db::getInstance()->Execute("delete from px_product_association_details where association_id=$id");
						Db::getInstance()->Execute('update px_product_associations set subject=\''.pSQL($rec["subject"]).'\',upd_time="'.date('Y-m-d H:i:s').'" where id='.$id);
						$this->_add_product_association_details($rec['skus'], $id);
						//$msg = "id={$id}编辑失败";
					} else {
						$res = Db::getInstance()->Execute('insert into px_product_associations(subject,add_time,upd_time) values(\''.pSQL($rec["subject"]).'\',"'.date('Y-m-d H:i:s').'","'.date('Y-m-d H:i:s').'")');
						//$new_id = mysql_insert_id(); // NG
						$new_id = Db::getInstance()->Insert_ID();
						/*$datas[] = array(
							'subject' => $rec["subject"],
							'add_time' => date('Y-m-d H:i:s'),
							'upd_time' => date('Y-m-d H:i:s'),
						);
						Db::getInstance()->insert('px_product_associations', $datas, false, false, Db::INSERT, false);*/
						$this->_add_product_association_details($rec['skus'], $new_id);
						//$msg = "添加失败";
					}
				}

				if (empty($msg)) {
					header("Location: $link_base&from=$opr");
					exit();
				}
			}

			$html .= $this->createTemplate('associations_add_edit.tpl')
				->assign(array(
					'rec'=>$rec,
					'link_base'=>$link_base,
				))
				->fetch();
		} elseif ($opr == 'del') {
			if ($id) {
				if (FALSE !== Db::getInstance()->Execute("update px_product_associations set deleted=1 where id=$id")
					) {
					$msg = "id={$id}删除成功";

					$all_assocs = $this->_get_all_associations();
				} else {
					$msg = "id={$id}删除失败";
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
			'all_assocs' => $all_assocs,
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
