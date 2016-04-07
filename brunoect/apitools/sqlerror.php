<?php
/*
* AUTHOR  DKC 
*
* ps_attribute  功能二次 开发
* 所有表结果 全部 asc 排序
* 所有更新记录全部存放在  log 目录下面 各表对应各名称文件
*/


/* Provoke an error -- bogus SQL syntax */
/* 	$dsn = 'mysql:host=localhost;dbname=uniwigs2016'; 
    $user = 'root';  
    $pwd = 'root';  

	$db = new PDO("mysql:host=localhost;dbname=uniwigs2016test","root","root"); 
	//$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); // 必须设定这个 参数 否则下面的参数不会起作用
$stmt = $db->prepare('select * from mysql');
if (!$stmt) {
    echo "\nPDO::errorInfo():\n";
    print_r($db->errorInfo());
	$arr = $db->errorInfo();
	  echo '<pre>';
	echo $arr[2];
	  echo '</pre>';
} */




$dbms='mysql';
$dbname='uniwigs2016test';
$user='root';
$pwd='root';
$host='localhost';
$dsn="$dbms:host=$host;dbname=$dbname";

  $pdo=new PDO($dsn,$user,$pwd);
  $query="select myname from ps_employee";  // SQL语句
  $result=$pdo->query($query);         

getError($result,$pdo);

function  getError($boolean,$db){
	
	if (!$boolean) {
    //echo "\nPDO::errorInfo():\n";
	//print_r($db->errorInfo());
	
	header("Content-type: text/html; charset=utf-8");   
	
	$arr = $db->errorInfo();
	echo '<pre  style="
    width: 400px;
    height: auto;
    background: aliceblue;
    padding: 10px;
    overflow: hidden;
    white-space: normal;
	">';
	echo '<span style="
    color: red;
    font-weight: bold;
    font-size: 15px;
	">SQL ERROR</span>';
	echo '<hr style="
    background-color: blue;
    height: 1px;
    border: none;
	">';
	echo "<span style='color:blue' >SQL错误码 </span>  ：<span style='color:red' >".$arr[0].'</span><br>';
	echo "<span style='color:blue' >SQL状态码</span>   ：<span style='color:red' >".$arr[1]."</span><br>";
	echo "<span style='color:blue' >SQL错误详情</span> ：<span style='color:red' >".$arr[2]."</span><br>";
	echo '</pre>';
	}
}
