<?php
/*
* 2007-2014 PrestaShop
*
* 自定义输入积分转换
*
*/

header("Content-Type: text/html;charset=utf-8");
	
if(isset($_GET['id'])&&isset($_GET['points'])){
	
	$id = $_GET['id'];
	$points=$_GET['points'];
	
	if((int)$points<0){
		
		$points=0;
	}
	
	$pdo = new PDO("mysql:host=localhost;dbname=uniwigs2016","root","rootadmin123"); 
	if($pdo -> exec("update px_customer_point set points=points-".$points." ,mark='".$points."'where id_customer =".$id)){ 
	//$url='/module/loyalty/default?process=transformpoints';
	//header("Location: $url"); 
		
	} 
	if($pdo -> exec("INSERT INTO px_customer_point_history 
				(id_customer, points,action,ccomment,date) 
				VALUES ($id,$points,'-','tranform',now())")){ 
	//$url='/module/loyalty/default?process=transformpoints';
	//header("Location: $url"); 
		
	} 
	
}
else{
	
	echo '转换出错';
}