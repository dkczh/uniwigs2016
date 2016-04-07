<?php


define('PS_API_TAG',getcwd());
require_once(PS_API_TAG.'/../tool.php');
require_once(PS_API_TAG.'/../config.php');

require_once(PS_API_TAG.'/../smarty.config.php');

$taginfo =$_GET['id'];

$tagarr = json_decode($taginfo);


$skus = $tagarr[0];
$video = $tagarr[1];
$custom = $tagarr[2];



addTag($skus,$video,$custom);




function  addTag($skus,$video,$custom)
{

	$db = Tool::pdo_conn(DB_PDO,DB_USER,DB_PASSWD);  
	
	$checksql = "select skus from px_product_addition where  skus = '$skus'";

	$checknum = Tool::getsqlnum($checksql,$db);
	
	
	
	if($checknum==null){
		$num =getlastid($db)+1;
		$pxsql = " insert px_product_addition (id,skus,video,custom) values($num,'$skus','$video','$custom');";
		$db->exec($pxsql)or die('px_product_addition 插入失败'); 

		echo  " px_product_addition 更新成功";
	}else
	{
		
		echo  "warning:skus 已经存在请更改名称";	
	}


}




function  getlastid($db)
{
	
	$sql = " select id from px_product_addition  ORDER BY id desc  limit 0,1";
	$result = Tool::getall($db,$sql);
	
	if($result){
	foreach($result as $arr){
	$num = $arr['id'];

	}
	return $num ;
	}else{
	return 0;
	
	}
}





