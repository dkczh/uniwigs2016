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

$id=$_GET['id'];
$db = Db::getInstance();
$sql = "  SELECT SQL_CALC_FOUND_ROWS a.* ,l.name as lang ,count(pt.id_product) as products  ,c.template ,c.skus from ps_tag a  LEFT JOIN ps_product_tag  pt on pt.id_tag = a.id_tag LEFT JOIN ps_lang l on l.id_lang =a.id_lang LEFT JOIN px_tag_extra c on c.id_tag =a.id_tag   WHERE a.id_tag =$id ";

$products = " select a.id_product,a.id_tag, b.name ,b.id_lang as lang
from ps_product_tag a, ps_product_lang b
Where a.id_product=b.id_product and id_tag= $id and b.id_lang =1";

//获取 tag 基本属性 结果集
$results = $db->ExecuteS($sql);
//获取tag 管理产品结果集
$productsresult = $db->ExecuteS($products);

//var_dump($results);
//echo  $products;
//var_dump($productsresult);


$smarty = new Smarty_Search();

$smarty->assign('id',$id);
$smarty->assign('sqldata',$results);

$smarty->assign('product',$productsresult);


$smarty->display('tagcontent.tpl');