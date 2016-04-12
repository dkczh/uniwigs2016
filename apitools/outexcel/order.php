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
 

    $db = pdo_conn($dsn,$user,$pwd);  

   if (isset($_GET['id'])&&isset($_GET['o_begin'])&&isset($_GET['o_end'])) {
	   
	    switch ($_GET['id']) {
  	case '1':
  		out_item_order($db,$_GET['o_end'],$_GET['o_begin']);
  		break;
  	case '2':
		out_finance_order($db,$_GET['o_end'],$_GET['o_begin']);
  		
  		break;
	case '3':
		out_fm_order($db,$_GET['o_end'],$_GET['o_begin']);
		break;
	case '4':
		out_customer_order($db,$_GET['o_end'],$_GET['o_begin']);
		break;
  	default:
  		# code...
  		break;
  }
	
	exit;

   }else{

   
   	echo '无任何信息可以导出';
	exit;
   }
  

    //导出所有的 订单条目
	function out_item_order($db,$o_end,$o_begin)
	  {

		$sql = "SELECT od.id_order,c.`id_customer`,c.`email`,c.firstname,c.lastname,
concat(pd.address1,pd.address2) as address,
pd.`phone`,pd.`phone_mobile`,
od.`product_reference`,'pc' AS danwei,'USD' AS order_currency
				,od.`product_quantity`,od.`product_price`,((od.product_price-od.reduction_amount)*od.`product_quantity`) AS item_total,
				o.date_add as date
				FROM `ps_order_detail` od
				LEFT JOIN ps_orders o ON od.`id_order`=o.id_order
				LEFT JOIN `ps_currency` cu ON o.id_currency=cu.id_currency
				LEFT JOIN ps_customer  c on o.id_customer=c.id_customer
				LEFT JOIN  ps_address pd  on pd.id_address=o.id_address_delivery
				WHERE o.total_paid_real>=0
				AND o.date_add<'$o_end'
				AND o.id_order IN (
				SELECT distinct id_order FROM `ps_order_history` WHERE id_order_state=2 AND `date_add`<
				'$o_end' AND `date_add`>='$o_begin'
				)
				order by o.id_order" ;
		
		$res = getall($db,$sql);
		$name = 'item_order';
		// 执行productexcel 函数 前面 不允许有任何 echo 输出
		$excefiled = array('date','id_order','product_reference','danwei','order_currency','product_quantity','product_price','item_total');
		out_excel($res,$name,$excefiled);

	  }
	  
	  //导出付款用户 订单
	 function out_customer_order($db,$o_end,$o_begin){
		 
		$sql = "SELECT c.`id_customer`,c.`email`,c.firstname,c.lastname,concat(a.address1,a.address2) as address,concat(a.firstname,a.lastname) as recipient,col.`name` AS country,st.`name` AS state,a.`city`,a.`postcode`,a.`phone`,a.`phone_mobile`
		,o.date_add as date
				FROM ps_orders o
				LEFT JOIN ps_customer c ON o.id_customer=c.`id_customer`
				LEFT JOIN ps_address a ON o.`id_address_delivery`=a.`id_address`
				LEFT JOIN ps_country co ON co.`id_country`=a.`id_country`
				LEFT JOIN ps_country_lang col ON col.`id_lang`=1 AND col.`id_country`=co.`id_country`
				LEFT JOIN ps_state st ON st.`id_state`=a.`id_state`
				WHERE o.total_paid_real>=0
				AND o.date_add<'$o_end'
				AND o.id_order IN (
				SELECT distinct id_order FROM `ps_order_history` WHERE id_order_state=2 AND 
				`date_add`<'$o_end' AND `date_add`>='$o_begin'
				)
				order by o.id_order" ;
		
		$res = getall($db,$sql);
		$name = 'customer_order';
		// 执行productexcel 函数 前面 不允许有任何 echo 输出
		$excefiled = array('date','id_customer','firstname','lastname','email','address','recipient','country','state','city','postcode','phone','phone_mobile');

	//cutomer_orderexcel($res,$name);
		out_excel($res,$name,$excefiled);
	 }
	 
	 
	 
	 
	
	//导出福萌信息
	function out_fm_order($db,$o_end,$o_begin)
	  {

		$sql = "SELECT 'Website' AS order_origin,o.id_order,o.id_customer,(
				  SELECT id_order_state FROM `ps_order_history` oh ORDER BY DATE_ADD DESC LIMIT 1
				) AS order_status,'' AS order_ywy,'' AS order_bz,o.date_add
				,(select oh1.`date_add` from `ps_order_history` oh1 where oh1.id_order_state=2 and oh1.id_order=o.id_order order by oh1.`date_add` desc limit 1) AS order_pay_time
				,'' AS order_fhqx
				,(select oh2.`date_add` from `ps_order_history` oh2 where oh2.id_order_state=4 and oh2.id_order=o.id_order order by oh2.`date_add` desc limit 1 ) AS order_deliver_time
				,cr.name AS order_carrier, cr.name AS order_carrier_real, o.shipping_number, o.payment, pcr.code AS coupon,cu.iso_code AS order_currency
				,o.total_products,o.total_shipping,0 AS 'order_sxf',o.total_discounts,o.total_paid,o.total_paid_real,6 AS order_hl,0 AS order_jhje
				FROM `ps_orders` o
				LEFT JOIN ps_customer c ON o.id_customer=c.id_customer
				LEFT JOIN `ps_carrier` cr ON o.id_carrier=cr.id_carrier
				
				LEFT JOIN `ps_currency` cu ON o.id_currency=cu.id_currency
				LEFT JOIN ps_order_cart_rule por on  por.id_order=o.id_order
				LEFT JOIN ps_cart_rule pcr on pcr.id_cart_rule=por.id_cart_rule
				WHERE o.total_paid_real>=0
				AND o.date_add<'$o_end'
				AND o.id_order IN (
				SELECT distinct id_order FROM `ps_order_history` WHERE id_order_state=2 AND `date_add`<'$o_end'
				)
				AND o.id_order IN (
				SELECT distinct id_order FROM `ps_order_history` WHERE id_order_state=2 AND `date_add`<'$o_end' and `date_add`>='$o_begin'
				)
				group by o.id_order
				order by o.id_order" ;
	/* 	echo $sql ;
		exit; */
		$res = getall($db,$sql);
		$name = 'fm_order';
		// 执行productexcel 函数 前面 不允许有任何 echo 输出
		fm_orderexcel($res,$name);

	  }
	
	
	  //导出支付大于0的财务 订单信息
	function out_finance_order($db,$o_end,$o_begin)
	  {

		$sql = "SELECT o.id_order,o.date_add AS order_time,'' AS coupon,o.total_products,o.total_shipping,o.total_discounts,o.total_paid_real,o.payment,
				o.shipping_number,oss.state_name AS order_state,c.id_customer,c.email,concat(a.address1,a.address2) as address,a.`phone`,a.`phone_mobile`,c.firstname,c.lastname,gl. NAME AS customer_group
				FROM ps_orders o
				LEFT JOIN ps_customer c ON c.id_customer = o.id_customer
				LEFT JOIN ps_address a ON o.`id_address_delivery`=a.`id_address`
				LEFT JOIN ps_group_lang gl ON gl.id_group = c.id_default_group
				
				AND gl.id_lang = 1
				LEFT JOIN (SELECT os.* FROM(SELECT a.id_order,b.`name` AS state_name FROM	`ps_order_history` a
							LEFT JOIN `ps_order_state_lang` b ON a.`id_order_state` = b.`id_order_state` AND b.`id_lang` = 1
							WHERE	a.date_add >= '$o_begin' ORDER BY	a.id_order_history DESC
						) os
					GROUP BY
						os.id_order
				) oss ON o.id_order = oss.id_order
				WHERE 1 AND o.`date_add` >= '$o_begin' AND o.`date_add` < '$o_end'
				AND o.total_paid_real > 0 
				ORDER BY o.date_add" ;
		
		$res = getall($db,$sql);
		$name = 'finance_order';
		// 执行productexcel 函数 前面 不允许有任何 echo 输出
		//finance_orderexcel($res,$name);
		$excefiled = array('id_order','order_time','coupon','total_products','total_shipping','total_discounts','total_paid_real',
		'payment','shipping_number','order_state','id_customer','address','phone','phone_mobile','email','firstname','lastname','customer_group');
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