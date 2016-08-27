<?php
require ('../include/init.inc.php');
$method = $user_id = $page_no = '';
extract ( $_GET, EXTR_IF_EXISTS );



//确定 当前某客户的维护记录
if(isset($_POST['a'])){
	
	$user_info = UserSession::getSessionInfo ();
	Cremind::insertBirthdayHistory($_POST['a'],$user_info['user_name']);
	exit;

}



$cremind = Cremind::getBirsthdayRemind('10');
$couttime= Cremind::getBirsthdayRemind('10',true);
$radio_types=array(0=>"Male",1=>"Female");

Template::assign('samples', $cremind);
Template::assign('couttime', $couttime);
Template::assign('radio_types', $radio_types);
Template::display('cremind/birthday.tpl');
