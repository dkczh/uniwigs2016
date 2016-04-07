<?php


define('PS_API_TAG',getcwd());

require_once(PS_API_TAG.'/../tool.php');
require_once(PS_API_TAG.'/../config.php');

require_once(PS_API_TAG.'/../smarty.config.php');

$id=$_GET['id'];
$db = Tool::pdo_conn(DB_PDO,DB_USER,DB_PASSWD);  
$sql = " SELECT SQL_CALC_FOUND_ROWS * from px_product_addition  WHERE id =$id ";

//获取 product 基本属性 结果集
$results = Tool::getall($db,$sql);


$smarty = new Smarty_Search();

$smarty->assign('id',$id);
$smarty->assign('sqldata',$results);

$smarty->display('content.tpl');

