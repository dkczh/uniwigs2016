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

	if(isset($_GET['id'])){
	search($_GET['id']);
	}else{
		
		echo '页面错误';
	}
	
	
	
	function search($id){
	$dsn = 'mysql:host=localhost;dbname=uniwigs2016'; 
    $user = 'root';  
    $pwd = 'rootadmin123';
    //$pwd = '';  

    $db = Tool::pdo_conn($dsn,$user,$pwd)or die('数据库连接失败');  
	$checkcustomer = "select * from ps_customer where email = '$id';";   
	$checkres =Tool::getall($db,$checkcustomer);
	
	if(!$checkres){
		
		echo '用户不存在';
	}
	else{
		$sql = "select 
				b.email as customer,
				CONCAT(action,points) as points,
				acomment as adminaction ,
				ccomment,
				a.date  
				from px_customer_point_history a
				LEFT JOIN ps_customer  b on  a.id_customer=b.id_customer 

				where b.email = '$id';";   
				
		
		
		
		$res =Tool::getall($db,$sql);
		$pointssql="select points from px_customer_point  a
					LEFT JOIN ps_customer b on a.id_customer=b.id_customer 

					where b.email='$id'";
		$npoints = Tool::getsingle($db,$pointssql,'points');
		$str="<p>用户$id ： 当前积分为：<span style='color:red;font-weight: bold;''>$npoints</span></p>";
		$str.='<table>
		<thead>
		<tr>
		<td style="border: 1px solid;">用户</td>
		<td style="border: 1px solid;">积分动作</td>
		<td style="border: 1px solid;">管理员操作</td>
		<td style="border: 1px solid;">客户操作</td>
		<td style="border: 1px solid;">操作时间</td>
		</tr>
		</thead>
		
		<tbody>';

		
		if($res){
			
			
			foreach ($res as $a) 
			{		
				
				$str.='	<tr style="text-align: center;"><td style="border: 1px solid;">'.$a['customer'].'</td>';
				$str.='<td style="border: 1px solid;">'.$a['points'].'</td>';
				
				$str.='<td style="border: 1px solid;">'.$a['adminaction'].'</td>';
				$str.='<td style="border: 1px solid;">'.$a['ccomment'].'</td>';
				$str.='<td style="border: 1px solid;">'.$a['date'].'</td></tr>';
			}
			$str.='</tbody></table>';
			echo $str;
		}else{
			
			echo $str.'</tbody></table><p>当前用户历史记录为空</p>';
		
			
		}
			
		
		
		
	}
	
		
	
		
	}

		

	
	
	
	
	
	
	
	
	
