<?php


define('PS_API_TAG',getcwd());
require_once(PS_API_TAG.'/../tool.php');
require_once(PS_API_TAG.'/../config.php');

require_once(PS_API_TAG.'/../smarty.config.php');

$taginfo =$_GET['id'];

$tagarr = json_decode($taginfo);


$name = $tagarr[0];
$template = $tagarr[1];
$skus = $tagarr[2];
$product = $tagarr[3];
$catagory = $tagarr[4];
$keyword =  $tagarr[5];
$description=$tagarr[6];
$title=$tagarr[7];

//$product = '100312';

addTag($name,$skus,$template,$catagory,$keyword,$description,$title);




function  addTag($name,$skus,$template,$catagory,$keyword,$description,$title)
{

	$db = Tool::pdo_conn(DB_PDO,DB_USER,DB_PASSWD);  
	
	$checksql = "select name from ps_tag where  name = '$name'";
	$checknum = Tool::getsqlnum($checksql,$db);
	
	if($checknum==0){
	
	$sql = " insert ps_tag (id_lang,name) values(1,'$name');";
	$db->exec($sql)or die('表ps_tag插入失败');
 
  $num = getlastid($db);
	$pxsql = " insert px_tag_extra (id_tag,template,skus,catagory,keyword,description,title) values( $num,'$template','$skus','$catagory','$keyword','$description','$title');";
	$db->exec($pxsql)or die('表px_tag_extra 插入失败'); 

	echo  "ps_tag, px_tag_extra 更新成功";
 	$psql = " insert ps_product_tag (id_tag,id_product,id_lang) values($num,'40258',1);";
	$db->exec($psql)or die('表ps_product_tag插入失败');
  

	}else
	{
		
	echo  "warning:tag-name 已经存在请更改名称";	
	}


}




function  getlastid($db)
{
	
	$sql = " select id_tag from ps_tag ORDER BY id_tag desc  limit 0,1";
	$result = Tool::getall($db,$sql);

	foreach($result as $arr){
	$num = $arr['id_tag'];

	}
	return $num ;

}





