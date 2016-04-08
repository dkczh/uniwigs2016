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
$name = $tagarr[1];
$template = $tagarr[2];
$skus = $tagarr[3];

$catagory = $tagarr[5];

$keyword = $tagarr[6];
$description = $tagarr[7];
$title = $tagarr[8];




if($skus==null){

	if($template==null){
	saveTag($id,$name);
	savePxTag($id,$template,$skus,$catagory,$keyword,$description,$title);
		//$sql = " UPDATE ps_tag SET `name`='$tagarr[1]' where id_tag =$tagarr[0] ";
   echo  '恭喜你修改成功id_tag为：'.$tagarr[0].'的name名字为'.$tagarr[1];
		
	}
	else{
		saveTag($id,$name);
	    savePxTag($id,$template,$skus,$catagory,$keyword,$description,$title);
		echo  '恭喜你 修改成功'.$id.'名字'.$name.'template是'.$template;
	}
	
}
else{
		saveTag($id,$name);
		savePxTag($id,$template,$skus,$catagory,$keyword,$description,$title);
	echo  '恭喜你修改成功id_tag为：'.$id.'的name名字为：'.$name.'template为：'.$template.'skus为：'.$skus.'keyword为：'.$keyword.'description为：'.$description;
}


function  saveTag($id,$name)
{
	$db = Tool::pdo_conn(DB_PDO,DB_USER,DB_PASSWD);  
	$sql = " UPDATE ps_tag SET `name`='$name' where id_tag =$id ";
	$db->query($sql)or die('表ps_tag跟新失败');
}

function savePxTag($id,$template,$skus,$catagory,$keyword,$description,$title)
{
	$db = Tool::pdo_conn(DB_PDO,DB_USER,DB_PASSWD); 
	$sql = " UPDATE px_tag_extra SET `template`='$template' , `skus`='$skus' ,`catagory`='$catagory' ,`keyword`='$keyword' ,`description`='$description',`title`='$title' where id_tag =$id ";
	$db->query($sql)or die('表px_tag_extra 更新失败');
}


