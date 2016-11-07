<?php
require ('../include/init.inc.php');
$method = $user_id = $page_no = '';
extract ( $_GET, EXTR_IF_EXISTS );
//生产单 列表页


if(isset($_POST['fcategory'])){
	

	exit;	
	
}



	
$orderlist = Cporder::getCporderList();

Template::assign('orderlist', $orderlist);
Template::display('cporder/cporder_list.tpl');
