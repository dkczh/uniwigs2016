<?php
require ('../include/init.inc.php');
$method = $user_id = $page_no = '';
extract ( $_GET, EXTR_IF_EXISTS );
//生产单 列表页


if(isset($_POST['updateorder'])){
	
 echo "<script language=JavaScript> location.replace(location.href);</script>";
 exit;	
	
}



	
$orderlist = Cppurchase::getCporderPurchaseList();

Template::assign('orderlist', $orderlist);
Template::display('cppurchase/cppurchase_list.tpl');
