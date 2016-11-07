<?php
require ('../include/init.inc.php');
$method = $user_id = $page_no = '';
extract ( $_GET, EXTR_IF_EXISTS );

$user_info = UserSession::getSessionInfo ();
$actor =$user_info['user_name'];

//查看生产单详情
if(isset($_GET['id_porder']) &&isset($_GET['action']) ){


	$ccontent = Cporder::getCporderContent($_GET['id_porder']);
    $cdelivery = Cporder::getCporderDelivery($_GET['id_porder']);
	$cdeliveryNum = Cporder::getCporderDeliveryNum($_GET['id_porder']);
	$chistory = Cporder::getHistoy($_GET['id_porder']);
/* 	echo '<pre>';
	var_dump((int)$cdeliveryNum);
	echo '</pre>';
	exit; 
	 */
	
	Template::assign('ccontent', $ccontent);
	Template::assign('cdelivery', $cdelivery);
	Template::assign('chistory', $chistory);
	Template::assign('cdeliveryNum', (int)$cdeliveryNum);
	Template::assign('corderNum', (int)$ccontent[0]['number']);
	Template::display('cporder/cporder_content.tpl');

	exit;
}




//创建生产单页面
if(isset($_GET['add'])){

	Template::display('cporder/cporder_add.tpl');
	
	exit;	
	
}
//添加生产单
if(isset($_POST['addorder'])){

	if(Cporder::checkCporder($_POST['id_order'])){
	/* 	echo '<pre>';
		var_dump(Cporder::checkCporder($_POST['id_order']));
		echo '</pre>';
		 */
		
		echo "订单".$_POST['id_order']."已存在生产单无法创建";
		exit;
	}
	Cporder::addCporder($_POST['id_order'],$_POST['category'],$_POST['number'],$_POST['pre_date'],$_POST['state'],$_POST['note'],$actor);
	echo 'success';
	exit;	
	
}


//更新生产单
if(isset($_POST['updateorder'])&&isset($_POST['id_porder']) ){

	
	Cporder::updateCporder($_POST['id_porder'],$_POST['state'],$_POST['note'],$actor);
	echo '更新成功';
	exit;	
	
}


//增加交货记录
if(isset($_POST['adddelivery'])&&isset($_POST['id_porder'])){

	
	Cporder::addCporderDelivery($_POST['id_porder'],$_POST['number'],$_POST['note'],$actor);
	echo '添加成功';
	exit;	
	
}




