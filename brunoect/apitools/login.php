<!DOCTYPE html>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>后台登陆</title>
<link rel="stylesheet" href="./login/style.css" media="screen" type="text/css">
</head>

<body>

<div class="container"> 
 
  <form id="contact" action="" method="post" style=" margin-top: 40%;">
    <h3> 后台管理登陆界面 </h3>
     <fieldset>
      <input placeholder="Your email" type="text" tabindex="1" name="email"  required="" autofocus="">
    </fieldset>
    <fieldset>
      <input placeholder="Your password" type="text" tabindex="1" name="pwdvalue"  required="" autofocus="">
    </fieldset>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">login</button>
    </fieldset>
  
  </form>
</div>

<center style="
    color: red;
"><div id ='tip'>管理员密码唯一</div></center>

<script>
//var v = document.getElementById("tip").innerHTML;

</script>
</body>
</html>

<?php
/*
* AUTHOR  DKC 
*
* apitool  所有 功能 验证登陆 模块
* 验证ps_employee中 passwd 字段
* 
*/
require_once('config.php');

$pwdvalue  = @$_POST['pwdvalue'] ;
$email  = @$_POST['email'] ;
//echo md5(COOKIE_KEY.$pwdvalue);
//echo '<br>';

//echo 'be7e22c1b290d3b88d47ba2469e02dd0';
$value = md5(COOKIE_KEY.$pwdvalue);

checklog($value,$email);




function checklog($value,$email)
{	

	$dsn = DB_PDO;  
	$user = DB_USER;  
	$pwd = DB_PASSWD;
	$db = pdo_conn($dsn,$user,$pwd); 
	$sql ="select passwd from ps_employee where passwd  = '$value' and email = '$email' ";

	$res = $db->query($sql);
	$num = $res->rowCount();

	if ($num>0) {
		
		if(isset($_COOKIE['fail_page'])){
			setcookie('apitool_pwd',$value,time()+3600,"/");
			setcookie('email',$email,time()+3600,"/");
			
			$url =  $_COOKIE['fail_page'];
			header("Location: $url"); 
			
			exit;
		}else{
			
			setcookie('apitool_pwd',$value,time()+3600,"/");
			setcookie('email',$email,time()+3600,"/");
			header("Location: admin.php"); 
			
			exit;	
		}
	}
	else{
		echo "<script>document.getElementById('tip').innerHTML='账号或密码错误';</script>";
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

