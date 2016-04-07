<?php
/*
* AUTHOR  DKC 
*
* ps_attribute  功能二次 开发
*

*/
 header("Content-Type: text/html; charset=UTF-8") ;

define('PS_API_RECHARGE',getcwd());
require_once(PS_API_RECHARGE.'/../tool.php'); // 

	if(isset($_GET['id']) && isset($_GET['points']) && isset($_GET['acomment'])){
		if($_GET['acomment']==''){
		recharge($_GET['id'],$_GET['points'],'正常充值无操作备注');
		}else{
			
		recharge($_GET['id'],$_GET['points'],$_GET['acomment']);	
		}
		
	}else{
		
		echo '充值失败 ，请检查用户地址 和积分数量';
	}
	
	
	
	function recharge($id,$points,$acomment){
	$dsn = 'mysql:host=localhost;dbname=uniwigs2016'; 
    $user = 'root';  
    $pwd = 'rootadmin123';
    //$pwd = '';  

    $db = Tool::pdo_conn($dsn,$user,$pwd)or die('数据库连接失败');  
		
	$sql = "SELECT id_customer FROM `ps_customer` WHERE email= '$id';";   
	$res =Tool::getall($db,$sql);
	
	
	if($res){
		
		
		foreach ($res as $id_customer) 
		{		
				$customer=$id_customer[0];
			$sql1="INSERT INTO `ps_loyalty` (`id_loyalty_state`, 
					`id_customer`, 
					`id_order`, 
					`id_cart_rule`, 
					`points`,
					`remark`,	
					`date_add`, 
					`date_upd`)
				 VALUES ('2', 
						'$customer', 
						'100000000', 
						'0', 
						'$points', 
						'present',
						now(), 
						now())
				";
				
			$checksql="SELECT * from px_customer_point  where id_customer =".$customer;//检查此用户是否存在积分
			$res = $db->query($checksql);
			//获取结果为不存在 则为假  
			if($res->fetchColumn()){
				//用户积分存在 则执行更新语句
				$updsql = 'update px_customer_point set points = points+'.$points.'  where id_customer='.$customer;
			$db->exec($updsql)or die('px_customer_point 积分更新失败');
			
				$insertsqlhistroy="INSERT INTO px_customer_point_history 
				(id_customer, points,action,acomment,date) 
				VALUES ($customer,$points,'+','$acomment',now())";
				
				
				$db->exec($insertsqlhistroy)or die('px_customer_point_history 积分操作记录插入失败');
				
				
			}else{
				$insertsql = 'INSERT INTO px_customer_point (id_customer, points) VALUES ('.$customer.','.$points.')';
				$db->exec($insertsql)or die('px_customer_point用户积分插入失败');
				
				$insertsqlhistroy="INSERT INTO px_customer_point_history 
				(id_customer, points,action,acomment,date) 
				VALUES ($customer,$points,'+','$acomment',now())";
				$db->exec($insertsqlhistroy)or die('px_customer_point_history 积分操作记录插入失败');
			}
	
			$db->exec($sql1)or die('ps_loyalty积分插入失败');
			
			$numsql ="SELECT id_loyalty FROM `ps_loyalty` ORDER BY id_loyalty desc  limit 1";
			$num =Tool::getall($db,$numsql);
			
			if($num){
				
				foreach ($num as $n) 
					{	
					$id_loyalty = $n[0];
					
					
					$sql2="INSERT INTO `ps_loyalty_history` (`id_loyalty`, `id_loyalty_state`, `points`, `date_add`)
							VALUES ($id_loyalty, 1,$points, NOW()) ";	
					$sql3="INSERT INTO `ps_loyalty_history` (`id_loyalty`, `id_loyalty_state`, `points`, `date_add`)
							VALUES ($id_loyalty, 2,$points, NOW())";	
					$db->exec($sql2)or die('ps_loyalty_history积分插入失败');	
					$db->exec($sql3)or die('ps_loyalty_history积分插入失败');	
					echo "充值成功";
					}
				
			}else{
				
				echo '充值失败';
			}
			
		
	
		}
	
	}else{
		
		echo '用户不存在,请检查用户email地址是否正确';
		exit;
		
	}




	
		
		
	}

		

	
	
	
	
	
	
	
	
	
