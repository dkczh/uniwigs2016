<?php
define('PS_API_TAG',getcwd());
require_once(PS_API_TAG.'/../tool.php');
require_once(PS_API_TAG.'/../config.php');
if(isset($_GET['id'])){
	
	$str =$_GET['id'] ;
	
	$arr = explode(",",$str);
	$all = '';
	for($i=0;$i<(count($arr)-1);$i++){
		
		
		delsql($arr[$i]);
	//	$all.='第'.$i.'个：'.$arr[$i];
		
	}
//echo $arr[0]."数组长度为".count($arr);
//echo '成功删除：'.$all;
}else{
	
	
	echo '参数错误';
}



function  delsql($id){
	$db = Tool::pdo_conn(DB_PDO,DB_USER,DB_PASSWD);  
	 
	//简化的联表删除语句

	$del = "DELETE  FROM px_keyword  WHERE  id = $id";
	 
	$db->query($del)or die("删除失败请检测表是否存在"); 
	echo "删除成功";
}