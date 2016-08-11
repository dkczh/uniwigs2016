<?php
//马帮订单查询接口 
header("Content-Type: text/html; charset=UTF-8") ;
include($_SERVER['DOCUMENT_ROOT'].'/config/config.inc.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/init.php'); 
ignore_user_abort(true); 
set_time_limit(0);
 
if(isset($_POST['id_cart'])){
	del($_POST['id_cart']);
	echo '清除'.$_POST['id_cart'].'成功';	


	
	
}
 
//清除当前购物车积分
function  del($id_cart){
$sql = "delete from  px_cart_point where id_cart = '$id_cart' ";
$res=	Db::getInstance()->Execute($sql);
return  $res;	
}
 


