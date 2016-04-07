<?php

$file = __FILE__; //文件完整路径
$dir =  __DIR__ ;//文件所在完整目录  
define('PS_API_TAG',getcwd());
require_once(PS_API_TAG.'/../tool.php');
require_once(PS_API_TAG.'/../config.php');



if(isset($_GET['id'])){
	
	$a =$_GET['id'] ;
	
	
	
	result( $a);
	
//echo $str;
}else{
	
	
	echo '参数错误';
}


function  result($id){

$db = Tool::pdo_conn(DB_PDO,DB_USER,DB_PASSWD);  
$curl = PRODUCT_CURL;
//echo $id ;
 //联合查询 表结构
$sql = " select  *  from  px_product_addition where skus like '%".$id."%'";

 $num =  Tool::getsqlnum($sql,$db);
 if($num>0){
 $result = Tool::getall($db,$sql);
 $str = '' ; //设定返回的结果集
 
 foreach($result as $a){
	//$str.=$a['id_tag'];
	 $id = (int)$a['id'];
	 $skus  = $a['skus'];
	 $video =substr($a['video'],0,27); 
	 $custom =substr($a['custom'],0,27);
	 


$str.=<<<EOT
	<tr>
	  <td><input type="checkbox" name="checkme"  value='$id'></td> 
      <td  id='$id' onclick="document.location = '$curl/tcontent.php?id=$id'">$id</td>
      <td  onclick="document.location = '$curl/content.php?id=$id'">$skus</td>
      <td  onclick="document.location = '$curl/content.php?id=$id'">$video</td>
	  <td  onclick="document.location = '$curl/content.php?id=$id'">$custom</td>
	  <td style="width: 100px;">
	  <button type="button"  onclick="document.location = '$curl/content.php?id=$id'">编辑</button>
	  <button   type="button" onclick="del('$id')">删除</button>
	  </td>
		
    </tr> 
EOT;
			
	  
	 
	}
	
//echo   '查询成功'.$id;

echo $str;
}
else{
	
	echo '查询结果为空';
}



}

