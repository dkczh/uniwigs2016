<?php
/*
* AUTHOR  DKC 
*
*   导出客户  订单相关报表
* 
*/
define('PS_API_OUTEXCEL',getcwd());
require_once(PS_API_OUTEXCEL.'/../tool.php');
require_once('Classes/PHPExcel.php');
//include 'Classes/PHPExcel.php';
require_once('Classes/PHPExcel/Writer/Excel5.php');



	set_time_limit (0);
	


	header('Content-Type: text/html; charset=utf-8'); //网页编码
	$dsn = 'mysql:host=localhost;dbname=uniwigs2016';

	
    $user = 'root';  
    $pwd = 'rootadmin123';
    $saleday = 10;//指定销售天数
    $stockday =  10; //指定判断库存天数  

    $db = pdo_conn($dsn,$user,$pwd);  

   if (isset($_GET['id'])) {
   	$id = $_GET['id'] ;

   }else{

   	$id = 0;
   	echo '无任何信息可以导出';
   }
  
  switch ($id) {
  	case '1':
  		out_all_customer($db);
  		break;
  	case '2':
		out_cata_customer($db);
  		
  		break;
	case '3':
		out_tag_customer($db);
		break;
	case '4':
		out_notag_customer($db);
		break;
  	default:
  		# code...
  		break;
  }


    //导出所有的 客户信息
	function out_all_customer($db)
	  {

		$sql = "select id_customer,firstname,lastname, email from  ps_customer " ;
		
		$res = getall($db,$sql);
		$name = 'all_customer';
		// 执行productexcel 函数 前面 不允许有任何 echo 输出
		productexcel($res,$name);

	  }
	
	//导出购买 tag为lace-closure 的产品中的所有 客户信息
	function out_tag_customer($db)
	  {

		$sql = "SELECT f.id_customer,f.firstname,f.lastname,f.email from ps_customer f RIGHT JOIN 
		(SELECT id_customer from ps_orders d RIGHT JOIN 
		(select id_order from ps_order_detail  a RIGHT JOIN  (select id_product from  ps_product where reference in(
		".getTagProduct($db).")) as b on a.product_id = b.id_product WHERE a.product_id != 0 ORDER by id_order) as c 
		on c.id_order = d.id_order ORDER BY id_customer) as e  on e.id_customer=f.id_customer 
		WHERE f.id_customer is NOT null  
		GROUP BY f.email
		" ;
		
		$res = getall($db,$sql);
		$name = 'tag(Lace Closure)_customer';
		// 执行productexcel 函数 前面 不允许有任何 echo 输出
		productexcel($res,$name);

	 }
	 
	//导出 购买 顶级分类下 无lace_closure产品的 其他产品的 客户信息
	
	function out_notag_customer($db)
	{
		$sql="select e.id_customer,e.firstname,e.lastname,e.email from ps_category_product a 
			RIGHT  JOIN 
			(select id_product from  ps_product where reference 
			not in(".getTagProduct($db).")) b on a.id_product = b.id_product
			LEFT JOIN ps_order_detail c on c.product_id = a.id_product
			LEFT JOIN ps_orders d on d.id_order = c.id_order
			LEFT JOIN ps_customer e on e.id_customer= d.id_customer
			WHERE (a.id_category = 104)
			and (d.id_customer is not null) 
			GROUP BY d.id_customer";
		/* echo $sql;
		exit; */
		//and (d.date_add between '".$d_begin."' AND '".$d_end."')
		$res = getall($db,$sql);
		$name = 'top hair pieces(without lace-closure))_customer';
		// 执行productexcel 函数 前面 不允许有任何 echo 输出
		productexcel($res,$name);
		
	}
	 
	//组合 tag 产品的skus 查询语句
	function getTagProduct($db)
	{
		$sql = "SELECT a.id_tag ,a.`name`,b.skus from ps_tag a LEFT JOIN px_tag_extra b 
		on a.id_tag=b.id_tag WHERE a.`name` ='Lace Closure'" ;
		
		$res = getall($db,$sql);
		$str = '';
		foreach($res as $a )
		{
			$arr = explode(',',$a['skus']);
			foreach($arr as $s){
				
				$str.="'".$s."'".",";
			}

		}
		$str=substr($str,0,-1);
		return $str;
	}
	
	
	//导出指定时间段 客户信息
	function out_date_customer($db)
	  {

		$sql = "select id_customer,firstname,lastname, email from  ps_customer WHERE date_add  between '2012-08-06' and '2012-08-30'  " ;
		$res = getall($db,$sql);
		
		// 执行productexcel 函数 前面 不允许有任何 echo 输出
		productexcel($res);

	  }
		
	//导出 制定时间段 购买某类产品的 客户信息
	function out_cata_customer($db){
		
		$sql=getCatagoryProducts($db,$_GET['cata'],$_GET['buy'],$_GET['d_begin'],$_GET['d_end']);
		$res = getall($db,$sql);
		$name = 'catagory_customer';
		// 执行productexcel 函数 前面 不允许有任何 echo 输出
		productexcel($res,$name);
		
	}
	
	//获取类产品
	function  getCatagoryProducts($db,$catagory,$buy,$d_begin,$d_end)
	{	
		if($catagory!='-1'){
			$sql = "SELECT * from ps_category where id_parent = ".$catagory ;
			$num = Tool::getsqlnum($sql,$db);
				//if($num == 0){
			if(true){
				switch($buy)
				{
				case 1:
				//购买过指定类产品的客户
					$sql = "select d.id_customer,d.firstname,d.lastname,d.email from ps_category_product a 
						LEFT JOIN ps_order_detail b on  a.id_product=b.product_id 
						LEFT JOIN ps_orders c on b.id_order = c.id_order
						LEFT JOIN ps_customer d on d.id_customer = c.id_customer
						WHERE (a.id_category =".$catagory.") 
						and (b.id_order is not null) 
						and ( c.date_add BETWEEN '".$d_begin."' AND '".$d_end."')
						and (d.id_customer is not null )";
					break;
				//未购买过制定类产品的客户
				case 2:
					$sql = 'select b.id_customer ,b.firstname,b.lastname,b.email from ps_customer b where not exists (select id_customer from ps_orders
where  id_customer = b.id_customer);';
					$sql2= "select id_customer from ps_customer WHERE id_customer not in
							(select d.id_customer from ps_category_product a 
							LEFT JOIN ps_order_detail b on  a.id_product=b.product_id 
							LEFT JOIN ps_orders c on b.id_order = c.id_order
							LEFT JOIN ps_customer d on d.id_customer = c.id_customer
							WHERE (a.id_category =102 ) 
							and (b.id_order is not null) 
							and ( c.date_add between '2012-07-24' and '2015-07-24')
							and (d.id_customer is not null )) 
							";
					
					break;
				case 3:
				//有购买意向的用户
					$sql ="SELECT e.id_customer,e.firstname,e.lastname,e.email from ps_category_product a 
							LEFT JOIN  ps_category b on a.id_category =b.id_category 
							LEFT JOIN ps_cart_product c on  c.id_product= a.id_product
							LEFT JOIN ps_cart d on c.id_cart = d.id_cart
							LEFT JOIN ps_customer e on e.id_customer=d.id_customer
							where (id_parent= ".$catagory." or b.id_category=".$catagory." ) 
							and (c.id_cart is not null) 
							and (c.date_add between '".$d_begin."' AND '".$d_end."')
							and (d.id_customer is not  null)";
					break;
				
				case 4:
				//未有购买意向的用户
				$sql = 'select b.id_customer ,b.firstname,b.lastname,b.email from ps_customer b where not exists (select id_customer from ps_cart
where  id_customer = b.id_customer);';
					break;
				default:
				
					break;
				
				}
				
				return $sql;
			}else{
				echo '当前存在子类';
			}
		}else
		{
		//已购买用户 sql 
			switch($buy)
			{
				case 1:
				//所有购买过产品的用户 
				$sql ="SELECT b.id_customer ,b.firstname,b.lastname,b.email from ps_customer b right JOIN (select id_customer,date_add from ps_orders GROUP BY id_customer) as a on a.id_customer=b.id_customer
WHERE (b.id_customer is not NULL) and (a.date_add BETWEEN '".$d_begin."' AND '".$d_end."')";	
				break;
				case 2:
				//所有未购买过产品的用户
				$sql = 'select b.id_customer ,b.firstname,b.lastname,b.email from ps_customer b where not exists (select id_customer from ps_orders
where  id_customer = b.id_customer);';
					break;
				case 3:
				//所有购物车的 用户
				$sql = "SELECT a.id_customer,a.firstname,a.lastname,a.email from ps_customer a RIGHT   JOIN ps_cart b on a.id_customer=b.id_customer

 WHERE (b.date_add
 between '".$d_begin."' AND '".$d_end."') and (a.id_customer is not null)";
				
					break;
				case 4:
				//未加入购物车的用户
					$sql = 'select b.id_customer ,b.firstname,b.lastname,b.email from ps_customer b where not exists (select id_customer from ps_cart
where  id_customer = b.id_customer);';
					//加日期判断的sql 语句
					$sqldate = "select b.id_customer ,b.firstname,b.lastname,b.email from ps_customer b where not exists (select id_customer from ps_cart
where  id_customer = b.id_customer) and (b.date_add between '2012-08-06'  and '2013-07-03' )";

					break;
				default:
				
					break;
			}
		
		  return $sql;
		
		}
		
		
	}
	
	


	//包装 pdo 连接
	function pdo_conn($dsn,$user,$pwd){
		
		try {  
	        $db = new PDO($dsn, $user, $pwd);  
	       
	    } catch (Exception $e) {  
	        echo 'Fail to connect to database!\n';  
	        echo $e->getMessage();  
	    }
		
		return $db;
	}

	//获取查询结果 并存放为 关联数组
	function getall($db,$sql){
		
			 $result = $db->query($sql);
			 $res =$result->fetchAll(); //存成关联数组

			 return  $res;
	}


	//获取当前产品 库存量  

	function getquantity($db,$id_product_attribute)
	{
		$sql =    "select quantity,id_product_attribute  from  ps_stock_available where id_product_attribute = $id_product_attribute";
		$res = getall($db,$sql) ;
		if ($res>0) {
			foreach ($variable as $a) {
			return  $a['quantity'];
				}

		}
		
	}


	//获取数据表 记录条数
	function getsqlnum($table,$db){

    $sql = "SELECT * FROM  $table "; 
	$res =$db->query($sql);//返回影响了多少行数	
    $num = $res->rowCount(); //获取总的记录条数

    return $num ;

    }

    //去除字符串最后一个字符 用来去除拼接数组最后多的一个字符串
	function getlaststr($str){

    $str = substr($str,0,(strlen($str)-1));//去掉最后一个逗号

    return $str ;

    }
	
	
	function   productexcel($res,$name)
	{
		$objPHPExcel = new PHPExcel();
		//设置当前的sheet
		$objPHPExcel->setActiveSheetIndex(0);
		//设置sheet的name
		$objPHPExcel->getActiveSheet()->setTitle('产品');
		//设置单元格的值

		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id_customer');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'firstname');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'lastname');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'email');
		$i = 2 ;
		foreach ($res as $a) {
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $a['id_customer']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $a['firstname']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $a['lastname']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $a['email']);
			$i++;
		} 
		
		
		$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
		header("Content-Type:application/force-download");
		header("Content-Type:application/vnd.ms-execl");
		header("Content-Type:application/octet-stream");
		header("Content-Type:application/download");;
		header("Content-Disposition:attachment;filename='".$name.".xls");
		header("Content-Transfer-Encoding:binary");
		$objWriter->save('php://output');
		
		
		
	}