<?php
/*
* AUTHOR  DKC 
*
* 1.3图片迁移  1.6
* 
* 
*/
define('APITOOL_CUR',getcwd());
require_once(APITOOL_CUR.'/../checklogin.php');

set_time_limit(0);

$filedir = APITOOL_CUR.'/oldp/';

$filenames = scandir($filedir);

foreach ($filenames as $a) {
	$a = str_replace('.jpg', '', $a);
	$arr = explode('-', $a);
	$num = count($arr);
	//2 是大图    3是小图 其他
	switch ($num) {
		case 2:
			$oldimg = APITOOL_CUR.'/oldp/'.$a.'.jpg';
	/*		$oldimg2 = APITOOL_CUR.'/oldp/'.$a.'-thumbnail.jpg';
			$oldimg3 = APITOOL_CUR.'/oldp/'.$a.'-vnormal.jpg';
			$oldimg4 = APITOOL_CUR.'/oldp/'.$a.'-aside.jpg.jpg';
			$oldimg5 = APITOOL_CUR.'/oldp/'.$a.'-category.jpg';*/
			
		/*	if (!file_exists($oldimg2)) {
				$oldimg2 = $oldimg;
			}
			if (!file_exists($oldimg3)) {
				$oldimg3 = $oldimg;
			}
			if (!file_exists($oldimg4)) {
				$oldimg4 = $oldimg;
			}
			if (!file_exists($oldimg5)) {
				$oldimg5 = $oldimg;
			}*/

			$newimg = "newp/".getdir($arr[1]).$arr[1].".jpg";

			$newdir = "newp/".getdir($arr[1]);
	/*		$newimg2 = "newp/".getdir($arr[1]).$arr[1]."-thickbox_default.jpg";
			$newimg3 = "newp/".getdir($arr[1]).$arr[1]."-cart_default.jpg";
			$newimg4 = "newp/".getdir($arr[1]).$arr[1]."-small_default.jpg";
			$newimg5 = "newp/".getdir($arr[1]).$arr[1]."-large_default.jpg";
			$newimg6 = "newp/".getdir($arr[1]).$arr[1]."-medium_default.jpg";
			$newimg7 = "newp/".getdir($arr[1]).$arr[1]."-home_default.jpg";*/
			
			
			if (!is_dir($newdir)) mkdir($newdir,0777,true);
			//if (!is_dir($newdir)) mkdir($newdir); //普通目录创建 无法创建多级目录
			copyimg($oldimg,$newimg);
		/*	copyimg($oldimg,$newimg2);
			copyimg($oldimg2,$newimg3);
			copyimg($oldimg2,$newimg4);
			copyimg($oldimg3,$newimg5);
			copyimg($oldimg4,$newimg6);
			copyimg($oldimg5,$newimg7);*/
			
		    echo '<hr>';
			break;
		

			
		default:
			# code...
			break;
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