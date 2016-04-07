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


$name = $tagarr[0];
$template = $tagarr[1];
$skus = $tagarr[2];
$product = $tagarr[3];
//$product = '100312';

addTag($name,$skus,$template);

if($product == null){
	
	echo "--没有选中产品 不做更新";
}
else{
	$arr = explode("-", $product);  
	$num =getlastid();
	addProductTag($num,$arr);
	echo "相关产品更新成功";
}

exit;









function  addTag($name,$skus,$template)
{

$db = Db::getInstance();
$sql = " insert ps_tag (id_lang,name) values(1,'$name');";
$db->ExecuteS($sql)or die('表ps_tag插入失败');
$lasttag = " select id_tag from ps_tag  ORDER BY id_tag desc  limit 0,1";
$tagresult = $db->ExecuteS($lasttag)or die('表ps_tag插入失败');

$num =getlastid();
$pxsql = " insert px_tag_extra (id_tag,template,skus) values($num,'$template','$skus');";
$db->ExecuteS($pxsql)or die('表px_tag_extra 插入失败'); 

echo  "ps_tag, px_tag_extra 更新成功";
}




function  getlastid()
{
$db = Db::getInstance();
$lasttag = " select id_tag from ps_tag  ORDER BY id_tag desc  limit 0,1";
$tagresult = $db->ExecuteS($lasttag)or die('表ps_tag查询最后id失败');

foreach($tagresult as $arr){
$num = $arr['id_tag'];

}
return $num ;

}




function addProductTag($id,$arr)
{
//$arr =array(100045,100312,100318);
$db = Db::getInstance();
$del = " delete from ps_product_tag where id_tag=$id ";
$db->ExecuteS($del)or die('ps_product_tag 初始化失败');
for($i=0;$i<(count($arr)-1);$i++){
$db = Db::getInstance();


$insert = " insert ps_product_tag (id_product,id_tag,id_lang) values('$arr[$i]',$id,1); ";
$db->ExecuteS($insert)or die('ps_product_tag插入失败');

}

}
