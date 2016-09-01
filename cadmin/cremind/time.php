<?php
require ('../include/init.inc.php');
$method = $user_id = $page_no = '';
extract ( $_GET, EXTR_IF_EXISTS );

if(isset($_GET['id_customer'])&&isset($_GET['email'])&&isset($_GET['content'])){
	$user_info = UserSession::getSessionInfo ();
	//echo $user_info['user_name'];//获取管理员名称
	//$.post('',{id_customer:'111',email:'xxxx',content:'xxx'}) js请求代码
	Cremind::insertcTimeHistory($_GET['id_customer'],$_GET['content'],$user_info['user_name']);
/*  	echo '已维护';
	exit;  */
	
	$_GET['email']=null;
	header("Location: http://www.uniwigs.com/cadmin/cremind/time.php"); 
exit;
}





$cremind = Cremind::getAllTimeRemind();//未维护客户
$timeremind= Cremind::getcTimeRemind();//已维护客户 包含超期的 和未超期的
$out_time_remind=Cremind::getcOutTimeRemind();//超期维护


Template::assign('samples', $cremind);
Template::assign('timeremind', $timeremind);
Template::assign('out_time_remind', $out_time_remind);
Template::assign('radio_types', $radio_types);
Template::display('cremind/time.tpl');
