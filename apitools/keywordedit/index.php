<?php

$file = __FILE__; //文件完整路径
$dir =  __DIR__ ;//文件所在完整目录  
define('PS_API_TAG',getcwd());

//echo $file."</br>"; //输出内容D:\www\dkcps16\API\tsmarty\index.php
//echo $dir."</br>";  //输出内容D:\www\dkcps16\API\tsmarty
//echo PS_API_TSMARTY ;

require_once(PS_API_TAG.'/../smarty.config.php');
require_once(PS_API_TAG.'/../tool.php');
require_once(PS_API_TAG.'/../config.php');


define('KEYWORD_CURL', '/apitools/keywordedit');


$sql = 'SELECT SQL_CALC_FOUND_ROWS * from px_keyword LIMIT 0,10';

$sqlrow = ' SELECT SQL_CALC_FOUND_ROWS id_word from px_keyword ';


$db = Tool::pdo_conn(DB_PDO,DB_USER,DB_PASSWD);  

$results =Tool::getall($db,$sql);

$num =Tool::getsqlnum($sqlrow,$db); //获取查询总的记录条数


$allnum = $num/10; //获取总的页码数  求除
if(!is_int($allnum))
{
	$allnum = (int)$allnum+1; //设定总的页吗数
}
//设定表头信息
$table_list = array(
	'id'=>'ID',
	'keyword'=>'keyword',
	'sku'=>'sku',
	'pid'=>'pid'
	);
$page = array(
	'cpage'=>1,
	'allpage'=>$allnum,
	'row'=>$num,
	);

$smarty = new Smarty_Search();

$smarty->assign('table_list',$table_list);
$smarty->assign('sqldata',$results);
$smarty->assign('page',$page);
$smarty->assign('curl',KEYWORD_CURL);
$smarty->display('list.tpl');




	
	
	
	
