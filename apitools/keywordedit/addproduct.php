<?php


define('PS_API_TAG',getcwd());
require_once(PS_API_TAG.'/../tool.php');
require_once(PS_API_TAG.'/../config.php');

require_once(PS_API_TAG.'/../smarty.config.php');

$taginfo =$_GET['id'];

$tagarr = json_decode($taginfo);


$keyword = $tagarr[0];
$sku = $tagarr[1];



addTag($keyword,$sku);




function  addTag($keyword,$sku)
{


	$db = Tool::pdo_conn(DB_PDO,DB_USER,DB_PASSWD);  
	
	$checksql = "select * from px_keyword where  keyword = '$keyword'";

	$checknum = Tool::getsqlnum($checksql,$db);

	
	
	if($checknum==null){

		$num =getlastid($db)+1;
		$pxsql = " insert into  px_keyword (id_word,keyword,psku) values($num,'$keyword','$sku');";

		$db->exec($pxsql)or die('px_keyword 插入失败'); 
		
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
			$db->exec($updatepid)or die('px_keyword 更新产品id失败'); 
		}else{
			$pidsql= "select  id_product   from  ps_product where  reference = '$sku' ";
		   
		   
			$res= Tool::getall($db,$pidsql);
			$pid ='';
			foreach($res as $a )
				{
					 $pid= $a["id_product"] ;
				}
			$updatepid= "update px_keyword set  pid ='$pid' where  keyword = '$keyword' ";
			$db->exec($updatepid)or die('px_keyword 更新产品id失败'); 
			
			
			
		}
		
		
		
		
		echo  " px_keyword 更新成功";
	}else
	{
		
		echo  "warning:keyword 已经存在请更改名称";	
	}


}




function  getlastid($db)
{
	
	$sql = " select id_word from px_keyword  ORDER BY id_word desc  limit 0,1";
	$result = Tool::getall($db,$sql);
	
	if($result){
	foreach($result as $arr){
	$num = $arr['id_word'];

	}
	return $num ;
	}else{
	return 0;
	
	}
}





