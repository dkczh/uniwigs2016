<?php
/*
* AUTHOR  DKC 
*
* apitool  所有 功能 验证登陆 模块
* 验证ps_employee中id_employee的字段 passwd 字段
* 
*/
header('Content-Type: text/html; charset=utf-8'); 
require_once('config.php');
checkcookie();





function checkcookie(){

	if (!isset($_COOKIE['apitool_pwd'])) {

		echo  '对不起 请登录后操作此页面'.'</br>';
		$url =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		
		//setcookie('fail_page',$url); 子页面 设置cookie 必须要 指定作用域 否则 只对当前目录文件生效 
		setcookie("fail_page", $url, time()+3600, "/");
		echo '<a href="/apitools/login.php" target="_blank" >点击登陆</a>';
		exit;
		
	}else{
		$pwd = $_COOKIE['apitool_pwd'];
		$email = $_COOKIE['email'];
		if(checklog($pwd,$email)){

			//echo '恭喜你登录成功'.'<br>';
			
			
		}else{

			echo '验证失败 点击下面连接请重新登陆 '.'<br>';
			echo '<a href="login.php" target="_blank" >点击登陆</a>';
			exit;
		}


	}

}

function checklog($value,$email)
{	

	$dsn = DB_PDO;  
	$user = DB_USER;  
	$pwd = DB_PASSWD;
	$db = pdo_conn($dsn,$user,$pwd); 
	$sql ="select passwd from ps_employee where passwd  = '$value' and email = '$email'; ";

	$res = $db->query($sql);;//返回影响了多少行数
	$num = $res->rowCount();

	if ($num>0) {

		return true;
	}
	else{
		return false;
	}


}


function pdo_conn($dsn,$user,$pwd){
		
		try {  
	        $db = new PDO($dsn, $user, $pwd);  
	       
	    } catch (Exception $e) {  
	        echo 'Fail to connect to database!\n';  
	        echo $e->getMessage();  
	    }
		
		return $db;
}