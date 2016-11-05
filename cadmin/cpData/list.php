<?php
require ('../include/init.inc.php');
$method = $user_id = $page_no = '';
extract ( $_GET, EXTR_IF_EXISTS );
//生产单 列表页


if(isset($_POST['updateorder'])){
	
 echo "<script language=JavaScript> location.replace(location.href);</script>";
 exit;	
	
}



	
$nodelivery = Cpdata::getDataNoDelivery();
$order = Cpdata::getDataOrder();
$delivery = Cpdata::getDataDelivery();
$worker = Cpdata::getDataWorker();

Template::assign(array(
            'nodelivery' => $nodelivery,
            'order' => $order,
			'delivery' => $delivery,
			'worker' => $worker

        )); 
Template::assign('orderlist', $orderlist); 
Template::assign('orderlist', $orderlist); 
Template::assign('orderlist', $orderlist); 
Template::display('cpdata/cpdata_list.tpl');
