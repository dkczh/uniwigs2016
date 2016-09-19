<?php
define('PS_API_TAG',getcwd());
require_once(PS_API_TAG.'/../tool.php');
require_once(PS_API_TAG.'/../config.php');


if(isset($_GET['id'])){
	
	$a =$_GET['id'] ;
	delsql($a);
	
}else{
	
	
	echo '参数错误';
}



function  delsql($id){
$db = Tool::pdo_conn(DB_PDO,DB_USER,DB_PASSWD);  
 
//简化的联表删除语句

$del = "DELETE  FROM px_keyword  WHERE  id_word = $id";
 
 $db->query($del)or die("删除失败请检测表是否存在"); 
echo "删除成功";
}