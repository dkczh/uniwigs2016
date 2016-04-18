<?php
/*
* AUTHOR  DKC 
*
* phpexcel 测试
* 注意  excel 生成前 不可以有 echo 函数 输出 否则 出错
*/
header('Content-type: text/html; charset=utf-8'); 
$dsn = 'mysql:host=localhost;dbname=uniwigs2016'; 
$user = 'root';  
$pwd = 'rootadmin123';

$db =pdo_conn($dsn,$user,$pwd)or die();


/* echo outhtml('104','Synthetic Wigs',$db);
exit; */
if(isset($_POST['category']))
{	
	switch($_POST['category']){
		case '101':
		echo outhtml('101','Synthetic Wigs',$db);
		break;
		case '102':
		echo outhtml('102','Human Hair Wigs',$db);
		break;
		case '103':
		echo outhtml('103','Hair Extensions',$db);
		break;
		case '104':
		echo outhtml('104','Hair Pieces',$db);
		break;
		case '105':
		echo outhtml('105','Care Products',$db);
		break;
		default:
		echo '';
		break;
		
	}

	
}


function outhtml($cate,$name,$db){
	
	$sql = "select c.id_category as id  ,cl.`name`,'$name' as parent from ps_category  c 
LEFT JOIN  ps_category_lang cl on   c.id_category=cl.id_category
where id_parent =$cate 
GROUP BY c.id_category";
/* echo $sql ;
exit; */
	$res=getall($db,$sql);
	if($res){
		$str='';
		foreach($res as $a){
		$cid = $a['id'];
		$name = $a['name'];
		$str.="<option value='$cid'>$name</option>";
		}
		
	}else{
		
		$str='';
	}
	return $str;
}




function pdo_conn($dsn,$user,$pwd)
	{
		
		try {  
	        $db = new PDO($dsn, $user, $pwd);  
	       
	    } catch (Exception $e) {  
	        echo 'Fail to connect to database!\n';  
	        echo $e->getMessage();  
	    }
		
		return $db;
}
	
function getall($db,$sql)
{
		
			 $result = $db->query($sql);
			 $res =$result->fetchAll(); //存成关联数组

			 return  $res;
}