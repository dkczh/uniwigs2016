<?php
/*
* AUTHOR  DKC 
*
* 1.3color 属性对应图片迁移  1.6
* 
* 
*/
define('APITOOL_CUR',getcwd());
require_once(APITOOL_CUR.'/../checklogin.php');


set_time_limit(0);

$filedir = APITOOL_CUR.'/color_big/';

$filenames = scandir($filedir);
$dsn = 'mysql:host=localhost;dbname=uniwigs2016test';
$user= 'root';
$pwd = 'root';

$db2 = pdo_conn($dsn,$user,$pwd) ;

echo '<br>';
foreach ($filenames as $a) {
	$a = str_replace('.jpg', '', $a);
	if ($a=='.' or $a=='..') {
		
	}else
	{	
		echo checkexist($db2,$a);
		flush();
	
	}
	

}


//拷贝文件 函数
function copyimg($oldimg,$newimg)
{

	$res = copy($oldimg, $newimg);	
	if ($res==true) {
	echo "<span >".$newimg."文件复制成功".'</span>';
	echo '<br>';
	}else{
	echo "<span style ='color:red'>".$oldimg."复制失败".'</span>';	
	echo '<br>';
	}

}

//创建正确目录函数

function getdir($num)
{
	$arr = str_split($num) ;
	$str= '';
	foreach ($arr as $a) {
		$str.= $a.'/';
	}
	return $str ;
}

function checkexist($db,$name)
{
	$sql = "SELECT  id_attribute,name  from ps_attribute_lang where name = '$name';";
	$res = $db->query($sql);;//返回影响了多少行数
	$num = $res->rowCount();
	if ($num>0) {
		foreach ($res as $a) {
			$oldimg = APITOOL_CUR.'/color_big/'.$a['name'].'.jpg';
			$newimg = "co/".$a['id_attribute'].".jpg";
			copyimg($oldimg,$newimg);
			return "<span>".$a['name'].'ID为:'.$a['id_attribute']."</span>".'</br><hr>';

		}
		
	}else
	{
		return "<span style='color:red;font-weight: bold;''>".$name."图片无法迁移</span>".'</br><hr>';
	}
}

