<?php

$file = __FILE__; //文件完整路径
$dir =  __DIR__ ;//文件所在完整目录  
define('PS_API_TSMARTY',getcwd());

//echo $file."</br>"; //输出内容D:\www\dkcps16\API\tsmarty\index.php
//echo $dir."</br>";  //输出内容D:\www\dkcps16\API\tsmarty
//echo PS_API_TSMARTY ;

require_once(PS_API_TSMARTY.'/../public/conn.php'); // /../在当前目录 寻找上一目录指定目录 和文件
require_once(PS_API_TSMARTY.'/../../config/settings.inc.php'); // 
require_once(PS_API_TSMARTY.'/../../config/config.inc.php'); // 
require_once(PS_API_TSMARTY.'/../../classes/db/Db.php'); // 

require_once(PS_API_TSMARTY.'/../smarty.config.php');


$db = Db::getInstance();
$sql = ' SELECT SQL_CALC_FOUND_ROWS a.* ,l.name as lang ,count(pt.id_product) as products  ,c.template ,c.skus from ps_tag a  LEFT JOIN ps_product_tag  pt on pt.id_tag = a.id_tag LEFT JOIN ps_lang l on l.id_lang =a.id_lang LEFT JOIN px_tag_extra c on c.id_tag =a.id_tag GROUP BY a.name ,a.id_tag ORDER BY a.id_tag DESC LIMIT 0,10 ';

$sqlrow = ' SELECT SQL_CALC_FOUND_ROWS a.* ,l.name as lang ,count(pt.id_product) as products  ,c.template ,c.skus from ps_tag a  LEFT JOIN ps_product_tag  pt on pt.id_tag = a.id_tag LEFT JOIN ps_lang l on l.id_lang =a.id_lang LEFT JOIN px_tag_extra c on c.id_tag =a.id_tag GROUP BY a.name ,a.id_tag ORDER BY a.id_tag DESC  ';


$results = $db->ExecuteS($sql);

$myrow  = $db->ExecuteS($sqlrow);
$num = $db->numRows($myrow ); //获取查询总的记录条数

$allnum = $num/10; //获取总的页码数  求除
if(!is_int($allnum))
{
	$allnum = (int)$allnum+1; //设定总的页吗数
}
//设定表头信息
$table_list = array(
	'id'=>'ID',
	'language'=>'Language',
	'name'=>'Name',
	'products'=>'Products',
	'template'=>'Template'
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

$smarty->display('taglist.tpl');