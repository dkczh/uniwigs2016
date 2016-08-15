<?php
/*
* AUTHOR  DKC 
*
* 自定义 函数 tool 
* 这是一个工具类 所有的自定义函数都存放在此类中
*/
//require_once('config.php');
header("Content-Type: text/html; charset=UTF-8") ;


class  Tool 
{
	
	//包装 pdo 连接
	public static function pdo_conn($dsn,$user,$pwd)
	{
		
		try {  
	        $db = new PDO($dsn, $user, $pwd,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES'utf8';"));  
	       
	    } catch (Exception $e) {  
	        echo 'Fail to connect to database!\n';  
	        echo $e->getMessage();  
	    }
		
		return $db;
	}
	
	//获取查询结果 并存放为 关联数组
	public static function getall($db,$sql)
	{
		
			 $result = $db->query($sql);
			 $res =$result->fetchAll(); //存成关联数组

			 return  $res;
	}
	
	//获取查询的总记录条数
	public static function getsqlnum($sql,$db)
	{

    
	$res =$db->query($sql);//返回影响了多少行数	
    $num = $res->rowCount(); //获取总的记录条数

    return $num ;

    }
	
	//获取单条数据的 某个字段的值
	public static function getsingle($db,$sql,$field)
	{	
	
	$res =self::getall($db,$sql);//返回影响了多少行数	
    
	foreach($res as $a )
		{
		return $a["$field"] ;
		}
    }
	
	//清空 表结构 id也清空
	public static function cleantable($db,$table)
	{

    
	$clean ="truncate table $table";
	$db->exec($clean);
	
    }
	
	
	
	
}

// :: 类的静态方法和变量调用方法
/* Tool::eat(); */
// 非静态的 则需要实例化 进行调用

/* $mytool = new Tool();
$mytool->eat(); */