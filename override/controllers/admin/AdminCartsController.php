<?php 
/*
* 2007-2015 PrestaShop
*
* 自定义导出
*/
class AdminCartsController extends AdminCartsControllerCore
{
	 public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'cart';
        $this->className = 'Cart';
        $this->lang = false;
        $this->explicitSelect = true;

        $this->addRowAction('view');
        $this->addRowAction('delete');
        $this->allow_export = true;
        $this->_orderWay = 'DESC';

     
		/* $this->_where.=' and pl.`id_shop`=1'; */
		$this->_group='	group by  a.`id_cart`';
        $this->_select = 'CONCAT(LEFT(c.`firstname`, 1), \'. \', c.`lastname`) `customer`,
		c.email,
		c.`firstname`,
		c.`lastname`,
		cpt.`points` creditBalance,
		crl.`name` coupon ,
		o.`id_order`,
		pp.`reference`,
		pod.`product_name` as name ,
		cp.`quantity`,
		a.id_cart total, ca.name carrier,
		IF (IFNULL(o.id_order, \''.$this->l('Non ordered').'\') = \''.$this->l('Non ordered').'\', IF(TIME_TO_SEC(TIMEDIFF(\''.pSQL(date('Y-m-d H:i:00', time())).'\', a.`date_add`)) > 86400, \''.$this->l('Abandoned cart').'\', \''.$this->l('Non ordered').'\'), o.id_order) AS status, IF(o.id_order, 1, 0) badge_success, IF(o.id_order, 0, 1) badge_danger, IF(co.id_guest, 1, 0) id_guest';
        $this->_join = 'LEFT JOIN '._DB_PREFIX_.'customer c ON (c.id_customer = a.id_customer)
		LEFT JOIN '._DB_PREFIX_.'currency cu ON (cu.id_currency = a.id_currency)
		LEFT JOIN '._DB_PREFIX_.'carrier ca ON (ca.id_carrier = a.id_carrier)
		LEFT JOIN '._DB_PREFIX_.'orders o ON (o.id_cart = a.id_cart)
		LEFT JOIN '._DB_PREFIX_.'cart_product cp ON (cp.id_cart = a.id_cart)
		LEFT JOIN '._DB_PREFIX_.'product_lang pl ON (pl.id_product = cp.id_product)
		LEFT JOIN ps_product pp ON (pp.id_product = cp.id_product)
		LEFT JOIN ps_order_detail pod on (pod.product_id=cp.id_product)
		LEFT JOIN ps_order_cart_rule ocl on (ocl.id_order=o.id_order)
		LEFT JOIN ps_cart_rule_lang  crl on (crl.id_cart_rule=ocl.id_cart_rule)
		LEFT JOIN px_customer_point cpt on (c.id_customer=cpt.id_customer)
		LEFT JOIN `'._DB_PREFIX_.'connections` co ON (a.id_guest = co.id_guest AND TIME_TO_SEC(TIMEDIFF(\''.pSQL(date('Y-m-d H:i:00', time())).'\', co.`date_add`)) < 1800)';
        if (Tools::getValue('action') && Tools::getValue('action') == 'filterOnlyAbandonedCarts') {
            $this->_having = 'status = \''.$this->l('Abandoned cart').'\'';
        } else {
            $this->_use_found_rows = false;
        }

        $this->fields_list = array(
            'id_cart' => array(
                'title' => $this->l('ID'),
                'align' => 'text-center',
                'class' => 'fixed-width-xs'
            ),
            'status' => array(
                'title' => $this->l('Order ID'),
                'align' => 'text-center',
                'badge_danger' => true,
                'havingFilter' => true
            ),
            'customer' => array(
                'title' => $this->l('Customer'),
                'filter_key' => 'c!lastname'
            ),
            'total' => array(
                'title' => $this->l('Total'),
                'callback' => 'getOrderTotalUsingTaxCalculationMethod',
                'orderby' => false,
                'search' => false,
                'align' => 'text-right',
                'badge_success' => true
            ),
            'carrier' => array(
                'title' => $this->l('Carrier'),
                'align' => 'text-left',
                'callback' => 'replaceZeroByShopName',
                'filter_key' => 'ca!name'
            ),
            'date_add' => array(
                'title' => $this->l('Date'),
                'align' => 'text-left',
                'type' => 'datetime',
                'class' => 'fixed-width-lg',
                'filter_key' => 'a!date_add'
            ),
            'id_guest' => array(
                'title' => $this->l('Online'),
                'align' => 'text-center',
                'type' => 'bool',
                'havingFilter' => true,
                'class' => 'fixed-width-xs',
                'icon' => array(0 => 'icon-', 1 => 'icon-user')
            )
        );
        $this->shopLinkType = 'shop';

        $this->bulk_actions = array(
            'delete' => array(
                'text' => $this->l('Delete selected'),
                'confirm' => $this->l('Delete selected items?'),
                'icon' => 'icon-trash'
            )
        );

        parent::__construct();
    }
	
	
	 public function initPageHeaderToolbar()
    {
       if (empty($this->display)) {
            $this->page_header_toolbar_btn['export_cart'] = array(
                'href' => self::$currentIndex.'&test=export&token='.$this->token,
                'desc' => $this->l('Export carts', null, null, false),
                'icon' => 'process-icon-export'
            );
        }


        parent::initPageHeaderToolbar();
    }
	
	public function renderKpis()
    {
        $time = time();
        $kpis = array();

        /* The data generation is located in AdminStatsControllerCore */
        $helper = new HelperKpi();
        $helper->id = 'box-conversion-rate';
        $helper->icon = 'icon-sort-by-attributes-alt';
        //$helper->chart = true;
        $helper->color = 'color1';
        $helper->title = $this->l('Conversion Rate', null, null, false);
        $helper->subtitle = $this->l('30 days', null, null, false);
        if (ConfigurationKPI::get('CONVERSION_RATE') !== false) {
            $helper->value = ConfigurationKPI::get('CONVERSION_RATE');
        }
        if (ConfigurationKPI::get('CONVERSION_RATE_CHART') !== false) {
            $helper->data = ConfigurationKPI::get('CONVERSION_RATE_CHART');
        }
        $helper->source = $this->context->link->getAdminLink('AdminStats').'&ajax=1&action=getKpi&kpi=conversion_rate';
        $helper->refresh = (bool)(ConfigurationKPI::get('CONVERSION_RATE_EXPIRE') < $time);
        $kpis[] = $helper->generate();

        $helper = new HelperKpi();
        $helper->id = 'box-carts';
        $helper->icon = 'icon-shopping-cart';
        $helper->color = 'color2';
        $helper->title = $this->l('Abandoned Carts', null, null, false);
        $date_from = date(Context::getContext()->language->date_format_lite, strtotime('-2 day'));
        $date_to = date(Context::getContext()->language->date_format_lite, strtotime('-1 day'));
        $helper->subtitle = sprintf($this->l('From %s to %s', null, null, false), $date_from, $date_to);
        $helper->href = $this->context->link->getAdminLink('AdminCarts').'&action=filterOnlyAbandonedCarts';
        if (ConfigurationKPI::get('ABANDONED_CARTS') !== false) {
            $helper->value = ConfigurationKPI::get('ABANDONED_CARTS');
        }
        $helper->source = $this->context->link->getAdminLink('AdminStats').'&ajax=1&action=getKpi&kpi=abandoned_cart';
        $helper->refresh = (bool)(ConfigurationKPI::get('ABANDONED_CARTS_EXPIRE') < $time);
        $kpis[] = $helper->generate();

        $helper = new HelperKpi();
        $helper->id = 'box-average-order';
        $helper->icon = 'icon-money';
        $helper->color = 'color3';
        $helper->title = $this->l('Average Order Value', null, null, false);
        $helper->subtitle = $this->l('30 days', null, null, false);
        if (ConfigurationKPI::get('AVG_ORDER_VALUE') !== false) {
            $helper->value = sprintf($this->l('%s tax excl.'), ConfigurationKPI::get('AVG_ORDER_VALUE'));
        }
        if (ConfigurationKPI::get('AVG_ORDER_VALUE_EXPIRE') < $time) {
            $helper->source = $this->context->link->getAdminLink('AdminStats').'&ajax=1&action=getKpi&kpi=average_order_value';
        }
        $kpis[] = $helper->generate();

        $helper = new HelperKpi();
        $helper->id = 'box-net-profit-visitor';
        $helper->icon = 'icon-user';
        $helper->color = 'color4';
        $helper->title = $this->l('Net Profit per Visitor', null, null, false);
        $helper->subtitle = $this->l('30 days', null, null, false);
        if (ConfigurationKPI::get('NETPROFIT_VISITOR') !== false) {
            $helper->value = ConfigurationKPI::get('NETPROFIT_VISITOR');
        }
        $helper->source = $this->context->link->getAdminLink('AdminStats').'&ajax=1&action=getKpi&kpi=netprofit_visitor';
        $helper->refresh = (bool)(ConfigurationKPI::get('NETPROFIT_VISITOR_EXPIRE') < $time);
        $kpis[] = $helper->generate();

        $helper = new HelperKpiRow();
        $helper->kpis = $kpis;
		
		
			if (Tools::getValue('test') == 'export')
		{
			
			$this->exportExcel();
		
		}
		
		//更改列表生成的 导出链接为正确的 
		$this->toolbar_btn['export']['href']= self::$currentIndex.'&test=export&token='.$this->token;
		/* var_dump($this->toolbar_btn);
		exit; */
        return $helper->generate();
    }
	
	
	/* 购物车数据导出 */
	
	public function exportExcel(){
		
	define('MY_OUTEXCEL',getcwd());	
	$mypath=$_SERVER['DOCUMENT_ROOT'];
	require_once($mypath.'/apitools/outexcel/Classes/PHPExcel.php');
	//include 'Classes/PHPExcel.php';
	require_once($mypath.'/apitools/outexcel/Classes/PHPExcel/Writer/Excel5.php');
	
	$this->cartexcel($this->getrenderList(),'export_cart_items_'.time());
			echo "<pre>";
			var_dump($this->renderListxx());
			echo "</pre>";
			exit;
	/* echo self::$currentIndex; */
	
	Tools::redirectAdmin(self::$currentIndex.'&conf=4&token='.$this->token);
		
		// exit;
		 
	}
	
	function   cartexcel($res,$name)
	{
		$objPHPExcel = new PHPExcel();
		//设置当前的sheet
		$objPHPExcel->setActiveSheetIndex(0);
		//设置sheet的name
		$objPHPExcel->getActiveSheet()->setTitle('购物车统计');
		//设置单元格的值

		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id_cart');//xx 默认字段 Website
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'date_add');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'creditBalance');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'coupon');//xx 默认字段 3
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'id_order');//xx 默认字段 3
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'email'); //xx 默认字段 空
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'firstname');//xx 默认字段 空
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'lastname');
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'sku');
		$objPHPExcel->getActiveSheet()->setCellValue('J1', 'product_name');//xx 默认字段 空
		$objPHPExcel->getActiveSheet()->setCellValue('K1', 'quantity');	
		$i = 2 ;
		foreach ($res as $a) {
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $a['id_cart']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $a['date_add']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $a['creditBalance']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $a['coupon']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $a['id_order']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $a['email']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $a['firstname']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $a['lastname']);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $a['reference']);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $a['name']);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, $a['quantity']);
			
			$i++;
		} 
		
		
		$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
		header("Content-Type:application/force-download");
		header("Content-Type:application/vnd.ms-execl");
		header("Content-Type:application/octet-stream");
		header("Content-Type:application/download");;
		header("Content-Disposition:attachment;filename='".$name.".xls");
		header("Content-Transfer-Encoding:binary");
		$objWriter->save('php://output');
	
	}
	//获取当前要导出的数据
	  public function getrenderList()
    {
        if (!($this->fields_list && is_array($this->fields_list))) {
            return false;
        }
        $this->getList($this->context->language->id);

        $helper = new HelperList();

        // Empty list is ok
        if (!is_array($this->_list)) {
            $this->displayWarning($this->l('Bad SQL query', 'Helper').'<br />'.htmlspecialchars($this->_list_error));
            return false;
        }

        $this->setHelperDisplay($helper);
        $helper->tpl_vars = $this->tpl_list_vars;
        $helper->tpl_delete_link_vars = $this->tpl_delete_link_vars;

        // For compatibility reasons, we have to check standard actions in class attributes
        foreach ($this->actions_available as $action) {
            if (!in_array($action, $this->actions) && isset($this->$action) && $this->$action) {
                $this->actions[] = $action;
            }
        }
        $helper->is_cms = $this->is_cms;
        $skip_list = array();

        foreach ($this->_list as $row) {
            if (isset($row['id_order']) && is_numeric($row['id_order'])) {
                $skip_list[] = $row['id_cart'];
            }
        }

        if (array_key_exists('delete', $helper->list_skip_actions)) {
            $helper->list_skip_actions['delete'] = array_merge($helper->list_skip_actions['delete'], (array)$skip_list);
        } else {
            $helper->list_skip_actions['delete'] = (array)$skip_list;
        }

       
        return $this->_list;
    }
	
}