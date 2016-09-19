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
$keyword = $tagarr[1];
$sku = $tagarr[2];







if($keyword==null){

echo "所有内容不可为空";

}else{
	savePxProduct($id,$keyword,$sku);
	echo  '恭喜你修改成功id为：'.$id.'的  
keyword为：'.$keyword.'
sku为：'.$sku;
}









function savePxProduct($id,$keyword,$sku)
{
	$db = Tool::pdo_conn(DB_PDO,DB_USER,DB_PASSWD); 
	$sql = " UPDATE px_keyword SET `psku`='$sku' ,`keyword`='$keyword' where id_word =$id ";
	$db->query($sql)or die('px_keyword sku更新失败');
	
	$skuid=  explode(',',$sku); 
		
	$skus= '';
	if(count($skuid)>1){
		foreach($skuid as $a){
			
			$skus.="'".$a."',";
			
		}	

		$skus = rtrim($skus, ",");
		$pidsql= "select GROUP_CONCAT(id_product SEPARATOR ',') as pid   from  ps_product where  reference in ($skus)";
	   
	   
		$res= Tool::getall($db,$pidsql);
		$pid ='';
		foreach($res as $a )
			{
				 $pid= $a["pid"] ;
			}
		$updatepid= "update px_keyword set  pid ='$pid' where  keyword = '$keyword' ";
		echo $updatepid ;
		$db->query($updatepid)or die('px_keyword 更新产品id失败'); 
	}else{
		$pidsql= "select  id_product   from  ps_product where  reference = '$sku' ";
	   
	   
		$res= Tool::getall($db,$pidsql);
		$pid ='';
		foreach($res as $a )
			{
				 $pid= $a["id_product"] ;
			}
		$updatepid= "update px_keyword set  pid ='$pid' where  keyword = '$keyword' ";
		echo $updatepid ;
		$db->query($updatepid)or die('px_keyword 更新产品id失败'); 
		
		
		
	}
	
	
	
	
}


