<?php
require ('../include/init.inc.php');
$method = $user_id = $page_no = '';
extract ( $_GET, EXTR_IF_EXISTS );

if(isset($_POST['id_customer'])&&isset($_POST['content'])){
	$user_info = UserSession::getSessionInfo ();
	//echo $user_info['user_name'];//获取管理员名称
	//$.post('',{id_customer:'111',email:'xxxx',content:'xxx'}) js请求代码
	Cremind::insertcTimeHistory($_POST['id_customer'],$_POST['content'],$user_info['user_name']);
/* 	echo '已维护';
	exit; */
	
}




