<?php

$file = __FILE__; //文件完整路径
$dir =  __DIR__ ;//文件所在完整目录  
define('PS_API_TSMARTY',getcwd());


require_once(PS_API_TSMARTY.'/../public/conn.php'); // /../在当前目录 寻找上一目录指定目录 和文件
require_once(PS_API_TSMARTY.'/../../config/settings.inc.php'); // 
require_once(PS_API_TSMARTY.'/../../config/config.inc.php'); // 
require_once(PS_API_TSMARTY.'/../../classes/db/Db.php'); // 

require_once(PS_API_TSMARTY.'/../smarty.config.php');

$taginfo =$_GET['id'];

$tagarr = json_decode($taginfo);

$id =$tagarr[0];
$name = $tagarr[1];
$template = $tagarr[2];
$skus = $tagarr[3];
$product = $tagarr[4];







if($skus==null){

	if($template==null){
	saveTag($id,$name);
		//$sql = " UPDATE ps_tag SET `name`='$tagarr[1]' where id_tag =$tagarr[0] ";
   echo  '恭喜你修改成功id_tag为：'.$tagarr[0].'的name名字为'.$tagarr[1];
		
	}
	else{
		saveTag($id,$name);
		savePxTag($id,$template,$skus);
		echo  '恭喜你 修改成功'.$id.'名字'.$name.'template是'.$template;
	}
	
}
else{
		saveTag($id,$name);
		savePxTag($id,$template,$skus);
	echo  '恭喜你修改成功id_tag为：'.$id.'的name名字为：'.$name.'template为：'.$template.'skus为：'.$skus;
}



if($product==0){
	$arr = explode("-", $product); 
	cleanTag($id,$arr);
	echo  'tag相关产品数据更新成功';
}
else{
	$arr = explode("-", $product);  
	saveProductTag($id,$arr);
	
	echo  'tag相关产品数据更新成功';
}




function  saveTag($id,$name)
{
	$db = Db::getInstance();
$sql = " UPDATE ps_tag SET `name`='$name' where id_tag =$id ";
$db->ExecuteS($sql)or die('表ps_tag跟新失败');
}

function savePxTag($id,$template,$skus)
{
$db = Db::getInstance();
$sql = " UPDATE px_tag_extra SET `template`='$template' , `skus`='$skus'  where id_tag =$id ";
$db->ExecuteS($sql)or die('表px_tag_extra 更新失败');
}

function saveProductTag($id,$arr)
{
//$arr =array(100045,100312,100318);
$db = Db::getInstance();
$del = " delete from ps_product_tag where id_tag=$id ";
$db->ExecuteS($del)or die('ps_product_tag 初始化失败');
for($i=0;$i<count($arr)-1;$i++){
$db = Db::getInstance();


$insert = " insert ps_product_tag (id_product,id_tag,id_lang) values('$arr[$i]',$id,1); ";
$db->ExecuteS($insert)or die('ps_product_tag插入失败');


//echo '插入成功'.$arr[$i];
//echo $insert;
//echo  'tag相关产品数据更新成功';
}

}

function cleanTag($id,$arr)
{
//$arr =array(100045,100312,100318);
$db = Db::getInstance();
$del = " delete from ps_product_tag where id_tag=$id ";
$db->ExecuteS($del)or die('ps_product_tag 更新失败');


}