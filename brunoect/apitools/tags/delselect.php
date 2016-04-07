<?php

$file = __FILE__; //文件完整路径
$dir =  __DIR__ ;//文件所在完整目录  
define('PS_API_TSMARTY',getcwd());

require_once(PS_API_TSMARTY.'/../../config/settings.inc.php'); // 
require_once(PS_API_TSMARTY.'/../../config/config.inc.php'); // 
require_once(PS_API_TSMARTY.'/../../classes/db/Db.php'); // 


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
$db = Db::getInstance();	
	//删除表方式一  分开 删除
/* $del1 = "delete from px_tag_extra where id_tag = $a";
$del2 = "delete from ps_tag where id_tag =$a";
$del3 = "delete from ps_product_tag where id_tag = $a";


$db->ExecuteS($del1)or die("删除失败请检测表是否存在");
$db->ExecuteS($del2)or die("删除失败请检测表是否存在");
$db->ExecuteS($del3)or die("删除失败请检测表是否存在"); */
/* $sqlcount = "DELETE a.*, b.* ,c.*   FROM ps_tag  a,px_tag_extra b,ps_product_tag c  WHERE 
 a.id_tag =b.id_tag and  c.id_tag=a.id_tag and  a.id_tag = $id";
 $num=$db->ExecuteS($sqlcount)or die("删除失败请检测表是否存在"); 
  */
 
//简化的联表删除语句
$del = "DELETE a.*, b.* ,c.*   FROM ps_tag  a,px_tag_extra b,ps_product_tag c  WHERE 
 a.id_tag =b.id_tag and  c.id_tag=a.id_tag and  a.id_tag = $id";
 $db->ExecuteS($del)or die("删除失败请检测表是否存在"); 
 
 $num = $db->getRow($db); //有些tag 不存在产品 所以要加判断
 if($num == 0){
	$del2 = "DELETE a.*, b.*  FROM ps_tag  a,px_tag_extra b  WHERE 
 a.id_tag =b.id_tag  and  a.id_tag = $id"; 
  $db->ExecuteS($del2)or die("删除失败请检测表是否存在"); 
  echo  '删除成功';

  }
//echo  '你已经成功删除id为'.$id.'的标签';
}