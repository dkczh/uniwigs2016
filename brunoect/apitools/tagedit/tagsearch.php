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
$curl = TAG_CURL;
//echo $id ;
 //联合查询 表结构
$sql = " select  a.id_tag,a.id_lang,a.`name`,b.template,b.skus  from  ps_tag a LEFT JOIN px_tag_extra b on  a.id_tag = b.id_tag 
where a.name like '%".$id."%'";

 $num =  Tool::getsqlnum($sql,$db);
 if($num>0){
 $result = Tool::getall($db,$sql);
 $str = '' ; //设定返回的结果集
 
 foreach($result as $a){
	//$str.=$a['id_tag'];
	 $id_tag = (int)$a['id_tag'];
	 $lang  = $a['id_lang'];
	 $name = $a['name'];
	 $skus =substr($a['skus'],0,27);
	 
	 $template =substr($a['template'],0,12);

$str.=<<<EOT
	<tr>
	  <td><input type="checkbox" name="checkme"  value='$id_tag'></td> 
      <td  id='tag$id_tag' onclick="document.location = '$curl/tagcontent.php?id=$id_tag'">$id_tag</td>
	  <td style="width: 200px;" onclick="document.location = '$curl/tagcontent.php?id=$id_tag'">$lang</td>
      <td  onclick="document.location = '$curl/tagcontent.php?id=$id_tag'">$name</td>
      <td  onclick="document.location = '$curl/tagcontent.php?id=$id_tag'">$template</td>
	  <td  onclick="document.location = '$curl/tagcontent.php?id=$id_tag'">$skus</td>
	  <td style="width: 100px;">
	  <button type="button"  onclick="document.location = '$curl/tagcontent.php?id=$id_tag'">编辑</button>
	  <button   type="button" onclick="del('$id_tag')">删除</button>
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

