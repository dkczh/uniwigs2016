<?php
require ('../include/init.inc.php');
$method = $user_id = $page_no = '';
extract ( $_GET, EXTR_IF_EXISTS );

$user_info = UserSession::getSessionInfo ();
$actor =$user_info['user_name'];

//查看生产单详情
if(isset($_GET['id_porder']) &&isset($_GET['action']) ){


	$ccontent = Cppurchase::getCporderPurchase($_GET['id_porder']);
	
	$chistory = Cppurchase::getPurchaseHistoy($_GET['id_porder']);
	
/* 	echo '<pre>';
	var_dump($ccontent);
	echo '</pre>';
	exit;  */
	
	
	Template::assign('ccontent', $ccontent);
	Template::assign('id_porder',$_GET['id_porder']);
	Template::assign('chistory',$chistory);

	Template::display('cppurchase/cppurchase_content.tpl');

	exit;
}



//更新采购记录
if(isset($_POST['action'])){
	
	if($_POST['name']=='note'){
		
		Cppurchase::addCpPurchasenote($_POST['id_porder'],$_POST['note'],$actor );
		echo 'success';
	}
	else{
		
		Cppurchase::addCporderPurchase($_POST['id_porder'],$_POST['name'],$actor);
	
		echo 'success';
	}
	exit;
}






