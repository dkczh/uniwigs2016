<?php

$file = __FILE__; //文件完整路径
$dir =  __DIR__ ;//文件所在完整目录  
define('PS_API_TAG',getcwd());

require_once(PS_API_TAG.'/../tool.php');
require_once(PS_API_TAG.'/../config.php');

require_once(PS_API_TAG.'/../smarty.config.php');

$taginfo =$_GET['id'];

$tagarr = json_decode($taginfo);

$id =$tagarr[0];
$skus = $tagarr[1];
$video = $tagarr[2];
$custom = $tagarr[3];







if($skus==null){

echo "所有内容不可为空";

}else{
	savePxProduct($id,$skus,$video,$custom);
	echo  '恭喜你修改成功id为：'.$id.'的  
skus为：'.$skus.'
video为：'.$video.'
custom为：'.$custom;
}









function savePxProduct($id,$skus,$video,$custom)
{
	$db = Tool::pdo_conn(DB_PDO,DB_USER,DB_PASSWD); 
	$sql = " UPDATE px_product_addition SET `skus`='$skus' ,`video`='$video',`custom`='$custom' where id =$id ";
	//echo   $sql;
//	exit;
	
	$db->query($sql)or die('px_product_addition 更新失败');
}


