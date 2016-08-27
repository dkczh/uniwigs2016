<?php
require ('../include/init.inc.php');
$method = $user_id = $page_no = '';
extract ( $_GET, EXTR_IF_EXISTS );

$user_info = UserSession::getSessionInfo ();



if(isset($_GET['id_customer'])&&isset($_GET['email'])&&isset($_GET['content'])){
	//echo $user_info['user_name'];//获取管理员名称
	//$.post('',{id_customer:'111',email:'xxxx',content:'xxx'}) js请求代码
	Cremind::insertcRefundHistory($_GET['id_customer'],$_GET['content'],$user_info['user_name']);
/*  	echo '已维护';
	exit;  */
	
	$_GET['email']=null;
	header("Location: http://www.uni.com/cadmin/cremind/refund.php"); 
exit;
}

$crefund = Cremind::getRefundRemind();
$cexchange = Cremind::getexchangeRemind();



Template::assign('crefund', $crefund);
Template::assign('cexchange', $cexchange);
Template::display('cremind/refund.tpl');
