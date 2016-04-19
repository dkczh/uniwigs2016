<?php
/*
* AUTHOR  DKC 
*
*   导出客户  订单相关报表
* 
*/
set_time_limit(0) ;
define('PS_API_OUTEXCEL',getcwd());
require_once('tool.php');
require_once('Classes/PHPExcel.php');
//include 'Classes/PHPExcel.php';
require_once('Classes/PHPExcel/Writer/Excel5.php');



	set_time_limit (0);
	


	header('Content-Type: text/html; charset=utf-8'); //网页编码

		$dsn = 'mysql:host=localhost;dbname=uniwigs2016'; 
	
    $user = 'root';  
    $pwd = 'rootadmin123';
 

    $db = pdo_conn($dsn,$user,$pwd);  
	//导出购买产品最多用户
	if(isset($_GET['begin'])&&isset($_GET['end'])&&isset($_GET['cate'])&&isset($_GET['childcategory'])){
	
	out_customer_buy($db,$_GET['begin'],$_GET['end'],$_GET['cate'],$_GET['childcategory']);

	}
    

	/* if(isset($_GET['id'])&&isset($_GET['begin'])&&isset($_GET['end'])&&isset($_GET['sqlname'])){
	
		out_products_attribute($db,$_GET['id'],$_GET['begin'],$_GET['end']);

   } */
   
   
  
   
    //导出所有的 订单条目
	function out_customer_buy($db,$begin,$end,$cate,$childcategory)
	  {
		if($cate == '-1')
	{
		$sql = "SELECT
	c.id_customer,
	c.email,
	CONCAT(c.firstname,' ',c.lastname) as name ,
	sum(od.product_quantity) AS num,
	sum((od.product_price-od.reduction_amount-o.total_discounts+o.total_shipping)*od.product_quantity) AS total
FROM
	ps_customer c
LEFT JOIN ps_orders o ON o.id_customer = c.id_customer
LEFT JOIN ps_order_detail od ON od.id_order = o.id_order
where  o.date_add  between '$begin'  and '$end' 
and od.product_name !='extra_cost' and od.product_name !='uniwigs order balance' 
and c.id_customer !=136854
and o.total_paid !=0
GROUP BY
	id_customer
ORDER BY
	num desc 
";
		
		
	}else{
		
		if($childcategory=='-1'){
			$sql = "SELECT
			c.id_customer,
			c.email,
			CONCAT(c.firstname,' ',c.lastname) as name ,
			sum(od.product_quantity) AS num,
			sum((od.product_price-od.reduction_amount-o.total_discounts+o.total_shipping)*od.product_quantity) AS total
		FROM
			ps_customer c
		LEFT JOIN ps_orders o ON o.id_customer = c.id_customer
		LEFT JOIN ps_order_detail od ON od.id_order = o.id_order
		LEFT JOIN  ps_product  pp on  pp.id_product = od.product_id 
		LEFT JOIN ps_category_product  pcp on pcp.id_product=pp.id_product
		where  o.date_add  between '$begin'  and '$end' 
		and od.product_name !='extra_cost' and od.product_name !='uniwigs order balance' 
		and  pp.id_category_default = $cate
		and c.id_customer !=136854
		and o.total_paid !=0
		GROUP BY
			id_customer
		ORDER BY
			num desc 
		";	
		}
		else{
		$sql = "SELECT
			c.id_customer,
			c.email,
			CONCAT(c.firstname,' ',c.lastname) as name ,
			sum(od.product_quantity) AS num,
			sum((od.product_price-od.reduction_amount-o.total_discounts+o.total_shipping)*od.product_quantity) AS total
		FROM
			ps_customer c
		LEFT JOIN ps_orders o ON o.id_customer = c.id_customer
		LEFT JOIN ps_order_detail od ON od.id_order = o.id_order
		LEFT JOIN  ps_product  pp on  pp.id_product = od.product_id 
		LEFT JOIN ps_category_product  pcp on pcp.id_product=pp.id_product
		where  o.date_add  between '$begin'  and '2016-04-01' 
		and od.product_name !='extra_cost' and od.product_name !='uniwigs order balance' 
		and  pp.id_category_default = $cate and  pcp.id_category= $childcategory
		and c.id_customer !=136854
		and o.total_paid !=0
		GROUP BY
			id_customer
		ORDER BY
			num desc 
		";	
		
		
	
			
		}
		
		
		
	}
	
		
		$res = getall($db,$sql);
		$name = 'customer_buy';
		// 执行productexcel 函数 前面 不允许有任何 echo 输出
		$excefiled = array(
						'id_customer',
						'name',
						'email',
						'num',
						'total');
		out_excel($res,$name,$excefiled);

	  }
  

    //导出所有的 订单条目
	function out_products_attribute($db,$id,$begin,$end)
	  {

		$sql = "select products_model,attr , count(attr) as num ,orders_products_id from       
			(SELECT c.orders_products_id ,b.products_model,GROUP_CONCAT(concat(products_options,'---',products_options_values,'//') SEPARATOR ' ') 
			as attr
		from orders_products_attributes c 
		LEFT JOIN orders_products b on c.orders_products_id= b.orders_products_id
		LEFT JOIN orders d on b.orders_id= d.orders_id  
		where d.date_purchased BETWEEN  '".$begin."' and '".$end."' and   
		b.products_id =".$id."      
		GROUP BY orders_products_id ) a   GROUP BY attr 
		";

		
		$res = getall($db,$sql);
		$name = 'products_attribute';
		// 执行productexcel 函数 前面 不允许有任何 echo 输出
		$excefiled = array('products_model',
						'attr',
						'num',
						'orders_products_id');
		out_excel($res,$name,$excefiled);

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
	
	
	
	
	function   out_excel($res,$na,$excefiled)
	{
		$objPHPExcel = new PHPExcel();
		//设置当前的sheet
		$objPHPExcel->setActiveSheetIndex(0);
		//设置sheet的name
		$objPHPExcel->getActiveSheet()->setTitle('订单条目');
		//设置单元格的字段位
		$excelitem = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T'
		,'U','V','W','X','Y','Z','AA','AB');
		
		$num = 0;
		foreach($excefiled as $name )
		{
			$objPHPExcel->getActiveSheet()->setCellValue($excelitem[$num].'1',$name);
			$num++;
		}
		$i = 2 ;
		$inum= 0;
		foreach ($res as $a) {
			
			foreach($excefiled as $name )
			{	
			
				$objPHPExcel->getActiveSheet()->setCellValue($excelitem[$inum]."$i",$a["$name"]);
				$inum++;
			}
			$inum=0; //偏移量要重新复位
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
		header("Content-Disposition:attachment;filename='".$na.".xls");
		header("Content-Transfer-Encoding:binary");
		$objWriter->save('php://output');
	
	}
	
	
	
	
	
	
	function   fm_orderexcel($res,$name)
	{
		$objPHPExcel = new PHPExcel();
		//设置当前的sheet
		$objPHPExcel->setActiveSheetIndex(0);
		//设置sheet的name
		$objPHPExcel->getActiveSheet()->setTitle('副盟订单');
		//设置单元格的值

		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'order_origin');//xx 默认字段 Website
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'id_order');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'id_customer');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'order_status');//xx 默认字段 3
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'order_ywy'); //xx 默认字段 空
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'order_bz');//xx 默认字段 空
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'date_add');
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'order_pay_time');
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'order_fhqx');//xx 默认字段 空
		$objPHPExcel->getActiveSheet()->setCellValue('J1', 'order_deliver_time');
		$objPHPExcel->getActiveSheet()->setCellValue('K1', 'order_carrier');//运费模板
		$objPHPExcel->getActiveSheet()->setCellValue('L1', 'order_carrier_real');//运费模板 和上面一样的值
		$objPHPExcel->getActiveSheet()->setCellValue('M1', 'shipping_number');//运费单号
		$objPHPExcel->getActiveSheet()->setCellValue('N1', 'payment');//支付方式
		$objPHPExcel->getActiveSheet()->setCellValue('O1', 'coupon');//折扣码  暂时不存在 默认为空
		$objPHPExcel->getActiveSheet()->setCellValue('P1', 'order_currency');//默认为USD
		$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'total_products'); // 产品价格
		$objPHPExcel->getActiveSheet()->setCellValue('R1', 'total_shipping'); // 运费
		$objPHPExcel->getActiveSheet()->setCellValue('S1', 'order_sxf'); // 默认为0
		$objPHPExcel->getActiveSheet()->setCellValue('T1', 'total_discounts'); // 打折价格
		$objPHPExcel->getActiveSheet()->setCellValue('U1', 'total_paid'); // 支付价格
		$objPHPExcel->getActiveSheet()->setCellValue('V1', 'total_paid_real'); // 和上面一样的值
		$objPHPExcel->getActiveSheet()->setCellValue('W1', 'order_hl'); // 默认为6
		$objPHPExcel->getActiveSheet()->setCellValue('X1', 'order_jhje');  // 默认为0

		
		$i = 2 ;
		foreach ($res as $a) {
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $a['order_origin']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $a['id_order']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $a['id_customer']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $a['order_status']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $a['order_ywy']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $a['order_bz']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $a['date_add']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $a['order_pay_time']);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $a['order_fhqx']);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $a['order_deliver_time']);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, $a['order_carrier']);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $a['order_carrier_real']);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, $a['shipping_number']);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, $a['payment']);
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, $a['coupon']);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$i, $a['order_currency']);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$i, $a['total_products']);
			$objPHPExcel->getActiveSheet()->setCellValue('R'.$i, $a['total_shipping']);
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$i, $a['order_sxf']);
			$objPHPExcel->getActiveSheet()->setCellValue('T'.$i, $a['total_discounts']);
			$objPHPExcel->getActiveSheet()->setCellValue('U'.$i, $a['total_paid']);
			$objPHPExcel->getActiveSheet()->setCellValue('V'.$i, $a['total_paid_real']);
			$objPHPExcel->getActiveSheet()->setCellValue('W'.$i, $a['order_hl']);
			$objPHPExcel->getActiveSheet()->setCellValue('X'.$i, $a['order_jhje']);
			
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