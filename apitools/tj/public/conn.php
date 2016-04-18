<?php
/*
* AUTHOR  DKC 
*
* ps_attribute  功能二次 开发
*

*/
header("Content-Type: text/html; charset =UTF-8");
			    	
$conn  =  mysql_connect("localhost",'root','rootadmin123')or die('请检查 数据库 账号密码 或者服务器地址');
$db =mysql_select_db('uniwigs2016')or die('数据库不存在;请检查数据库名称');
