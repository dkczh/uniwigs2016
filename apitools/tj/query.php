<?php
/*
* AUTHOR  DKC 
*
* phpexcel 测试
* 注意  excel 生成前 不可以有 echo 函数 输出 否则 出错
*/
header("Content-type: text/html; charset=utf-8"); 


if(isset($_POST['id'])&&isset($_POST['begin'])&&isset($_POST['end'])&&isset($_POST['sqlname'])&&isset($_POST['childcategory'])){


	
	$dsn = 'mysql:host=localhost;dbname=uniwigs2016'; 
    $user = 'root';  
    $pwd = 'rootadmin123';
	$db =pdo_conn($dsn,$user,$pwd)or die();
	
	switch ($_POST['id']) {
		case '1':
			//查询最佳产品销售  某时间段 销售最多的产品排行
			if($_POST['sqlname']=='-1'){
				//全部销售查询
				q_product($db,$_POST['begin'],$_POST['end']);
				
			}else{
				//指定产品类别查询
				
				q_product_child($db,$_POST['begin'],$_POST['end'],$_POST['sqlname'],$_POST['childcategory']);
			
			}
			
			break;
		case '2':
			//查询某个时间段   产品数量按时段 销售数量统计
			q_times($db,$_POST['begin'],$_POST['end']);
			break;
		case '3':
			//查询某个时间段 购买产品最多的用户
			q_customer($db,$_POST['begin'],$_POST['end'],$_POST['sqlname']);
			break;
		case '4':
			//国家销售的统计
			q_country($db,$_POST['begin'],$_POST['end']);
			break;
		case '5':
			q_state($db,$_POST['begin'],$_POST['end']);
			break;
		default:
			echo '结果为空';
			break;
	}
	
	//echo $_POST['id'].'查询成功'.$_POST['begin'].'---'.$_POST['end'];
	
}






function q_product($db,$begin,$end){
	$sql = "SELECT
	od.product_id,
	od.product_name as name ,
	pp.reference as skus,
	COUNT(od.product_id) AS num,
	'$begin' AS begintime,
	'$end' AS endtime
FROM
	ps_order_detail od
LEFT JOIN ps_orders o ON od.id_order = o.id_order
LEFT JOIN ps_product pp on pp.id_product=od.product_id 
WHERE
	o.date_add BETWEEN '$begin'
AND '$end'
GROUP BY od.product_id
ORDER BY num desc 
limit 50
";


	$res = getall($db,$sql);

	$str = " <thead>
    <tr>
        <th>id</th>
		<th>name</th>
        <th>Skus</th>
		<th>sales</th>	
		<th>begin_date</th>
		<th>end_date</th>
		<th>action</th>	
    </tr>
    </thead> <tbody id='tablelist'>";

    $i= 1;

	foreach ($res as $a) {
		
		$name= $a['name'];
		$skus = $a['skus'];
		$pid = $a['product_id'];
		$num = $a['num'];
		$str.="<tr >
		<td id='tag312' >".$i."</td>
		<td style='width: 200px;'>".$name."</td>
		<td >".$skus."</td>
		<td style='width: 100px;color: red;'>".$num."</td>
		<td>".$begin."</td>
		<td>".$end."</td>
		<td style='width: 100px;'>
	  <a  target='_blank' href='product.php?id=$pid&begin=$begin&end=$end&skus=$skus'>查看</a>
	  </td></tr> ";
	  $i++;
	}

	$str.='</tbody>';

	echo $str;
}



function q_product_child($db,$begin,$end,$cate,$childcategory){
	
	if($childcategory=='-1'){
	$sql = "SELECT
	od.product_id,
	od.product_name as name ,
	pp.reference as skus,
	COUNT(od.product_id) AS num,
	'$begin' AS begintime,
	'$end' AS endtime
FROM
	ps_order_detail od
LEFT JOIN ps_orders o ON od.id_order = o.id_order
LEFT JOIN ps_product pp on pp.id_product=od.product_id 
WHERE
	o.date_add BETWEEN '$begin'
AND '$end'
and pp.id_category_default =$cate
GROUP BY od.product_id
ORDER BY num desc 
limit 50
";
}else{
	$sql = "SELECT
	od.product_id,
	od.product_name as name ,
	pp.reference as skus,
	COUNT(od.product_id) AS num,
	'$begin' AS begintime,
	'$end' AS endtime
FROM
	ps_order_detail od
LEFT JOIN ps_orders o ON od.id_order = o.id_order
LEFT JOIN ps_product pp on pp.id_product=od.product_id 
LEFT JOIN ps_category_product cp on cp.id_product =pp.id_product 
WHERE
	o.date_add BETWEEN '$begin'
AND '$end'
and pp.id_category_default =$cate   and  cp.id_category = $childcategory
GROUP BY od.product_id
ORDER BY num desc 
limit 50
";	
	
	
}

	$res = getall($db,$sql);

	$str = " <thead>
    <tr>
        <th>id</th>
		<th>name</th>
        <th>Skus</th>
		<th>sales</th>	
		<th>begin_date</th>
		<th>end_date</th>
		<th>action</th>	
    </tr>
    </thead> <tbody id='tablelist'>";

    $i= 1;

	foreach ($res as $a) {
		
		$name= $a['name'];
		$skus = $a['skus'];
		$pid = $a['product_id'];
		$num = $a['num'];
		$str.="<tr >
		<td id='tag312' >".$i."</td>
		<td style='width: 200px;'>".$name."</td>
		<td >".$skus."</td>
		<td style='width: 100px;color: red;'>".$num."</td>
		<td>".$begin."</td>
		<td>".$end."</td>
		<td style='width: 100px;'>
	  <a  target='_blank' href='product.php?id=$pid&begin=$begin&end=$end&skus=$skus'>查看</a>
	  </td></tr> ";
	  $i++;
	}

	$str.='</tbody>';

	echo $str;
}







function q_times($db,$begin,$end){
	$sql = "SELECT
     COUNT(id_order) as num,
  CASE
    WHEN hour(a.date_add)>=0 and hour(a.date_add)<1 THEN '00:00-01:00'
		WHEN hour(a.date_add)>=1 and hour(a.date_add)<2 THEN '01:00-02:00'
		WHEN hour(a.date_add)>=2 and hour(a.date_add)<3 THEN '02:00-03:00'
		WHEN hour(a.date_add)>=3 and hour(a.date_add)<4 THEN '03:00-04:00'
		WHEN hour(a.date_add)>=4 and hour(a.date_add)<5 THEN '04:00-05:00'
		WHEN hour(a.date_add)>=5 and hour(a.date_add)<6 THEN '05:00-06:00'
		WHEN hour(a.date_add)>=6 and hour(a.date_add)<7 THEN '06:00-07:00'
		WHEN hour(a.date_add)>=7 and hour(a.date_add)<8 THEN '07:00-08:00'
		WHEN hour(a.date_add)>=8 and hour(a.date_add)<9 THEN '08:00-09:00'
		WHEN hour(a.date_add)>=9 and hour(a.date_add)<10 THEN '09:00-10:00'
		WHEN hour(a.date_add)>=10 and hour(a.date_add)<11 THEN '10:00-11:00'
		WHEN hour(a.date_add)>=11 and hour(a.date_add)<12 THEN '11:00-12:00'
		WHEN hour(a.date_add)>=12 and hour(a.date_add)<13 THEN '12:00-13:00'
		WHEN hour(a.date_add)>=13 and hour(a.date_add)<14 THEN '13:00-14:00'
		WHEN hour(a.date_add)>=14 and hour(a.date_add)<15 THEN '14:00-15:00'
		WHEN hour(a.date_add)>=15 and hour(a.date_add)<16 THEN '15:00-16:00'
		WHEN hour(a.date_add)>=16 and hour(a.date_add)<17 THEN '16:00-17:00'
		WHEN hour(a.date_add)>=17 and hour(a.date_add)<18 THEN '17:00-18:00'
		WHEN hour(a.date_add)>=18 and hour(a.date_add)<19 THEN '18:00-19:00'
		WHEN hour(a.date_add)>=19 and hour(a.date_add)<20 THEN '19:00-20:00'
		WHEN hour(a.date_add)>=20 and hour(a.date_add)<21 THEN '20:00-21:00'
		WHEN hour(a.date_add)>=21 and hour(a.date_add)<22 THEN '21:00-22:00'
		WHEN hour(a.date_add)>=22 and hour(a.date_add)<23 THEN '22:00-23:00'
		WHEN hour(a.date_add)>=23 and hour(a.date_add)<24 THEN '23:00-24:00'
    ELSE 'unknown'
    END AS `time`
FROM
    ps_orders a
WHERE a.date_add between '".$begin."' and '".$end."'   
GROUP BY time
order by num desc 

";


 // echo '<pre>'.$sql.'</pre>' ;
	// exit; 
	$res = getall($db,$sql);

	$str = " <thead>
    <tr>
         
        <th>id</th>
		<th>sales</th>	
		<th>time</th>
		<th>begin_date</th>
		<th>end_date</th>
		
  
    </tr>
    </thead> <tbody id='tablelist'>";

    $i= 1;

	foreach ($res as $a) {
		
		$time= $a['time'];
		
		$num = $a['num'];
		$str.="<tr >
		<td id='tag312' >".$i."</td>
		<td style='width: 100px;color: red;'>".$num."</td>
		
		<td >".$time."</td>
		<td>".$begin."</td>
		<td>".$end."</td>
	  </tr> ";
	  $i++;
	}

	$str.='</tbody>';

	echo $str;
}

function q_customer($db,$begin,$end,$sqlname){
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
GROUP BY
	id_customer
ORDER BY
	num desc 
limit 200

";
	
	$res = getall($db,$sql);

	$str = " <thead>
    <tr>
         
        <th>id</th>
		<th>num</th>
		<th>name</th>	
		<th>email</th>	
		<th>总金额</th>			
		<th>begin_date</th>

		<th>end_date</th>
		<th>action</th>
  
    </tr>
    </thead> <tbody id='tablelist'>";

    $i= 1;

	foreach ($res as $a) {
		
		
		$name = $a['name'];
		$email= $a['email'];
		$cid=$a['id_customer']; 
		
		$total=$a['total'];
		$num = $a['num'];
		$str.="<tr >
		<td id='tag312' >".$i."</td>
		<td style='width: 100px;color: red;'>".$num."</td>
		<td >".$name."</td>
		<td >".$email."</td>
			
			<th>".(int)$total."</th>	
		<td>".$begin."</td>
		<td>".$end."</td>
	  <td style='width: 100px;'>
	  <a  target='_blank' href='customer.php?id=".$cid."&begin=".$begin."&end=".$end."&email=".$email."'>查看</a>
	  
	  </td>
	  </tr> ";
	  $i++;
	}

	$str.='</tbody>';

	echo $str;
}




function q_country($db,$begin,$end){
	$sql = "SELECT
	COUNT(od.id_order) AS num,
	cl.`name`
FROM
	ps_orders od
LEFT JOIN  ps_order_detail  pod on pod.id_order=od.id_order
LEFT JOIN  ps_address pa  on pa.id_customer = od.id_customer
LEFT JOIN ps_country_lang cl on cl.id_country = pa.id_country
WHERE
	od.date_add BETWEEN '$begin' AND '$end'
and 
pod.product_name != 'extra_cost'
GROUP BY
cl.`name` 
ORDER BY
	num DESC";
	
	$res = getall($db,$sql);

	$str = " <thead>
    <tr>
         
        <th>id</th>
		<th>num</th>
		<th>country</th>			
		<th>begin_date</th>
		<th>end_date</th>
		
  
    </tr>
    </thead> <tbody id='tablelist'>";

    $i= 1;

	foreach ($res as $a) {
		
		
		$country = $a['name'];
		
		$num = $a['num'];
		$str.="<tr >
		<td id='tag312' >".$i."</td>
		<td style='width: 100px;color: red;'>".$num."</td>
		<td >".$country."</td>
		<td>".$begin."</td>
		<td>".$end."</td>
	  </tr> ";
	  $i++;
	}

	$str.='</tbody>';

	echo $str;
}


function q_state($db,$begin,$end){
	$sql = "SELECT
	COUNT(od.id_order) AS num,
	ps.`name` as state,
  cl.`name`as country 
FROM
	ps_orders od
LEFT JOIN  ps_order_detail  pod on pod.id_order=od.id_order
LEFT JOIN  ps_address pa  on pa.id_customer = od.id_customer
LEFT JOIN ps_country_lang  cl on cl.id_country=pa.id_country
LEFT JOIN ps_state ps on  ps.id_state = pa.id_state
WHERE
	od.date_add BETWEEN '$begin' AND '$end' 
and 
pod.product_name != 'extra_cost' and  cl.name= 'United States'
GROUP BY
ps.id_state 
ORDER BY
	num DESC";
	
	
	/* echo '<pre>'.$sql.'</pre>';
	exit; */
	$res = getall($db,$sql);

	$str = " <thead>
    <tr>
         
        <th>id</th>
		<th>num</th>
		<th>state</th>	
		<th>country</th>			
		<th>begin_date</th>
		<th>end_date</th>
		
  
    </tr>
    </thead> <tbody id='tablelist'>";

    $i= 1;

	foreach ($res as $a) {
		
		
		$country = $a['country'];
		$state = $a['state'];
		$num = $a['num'];
		$str.="<tr >
		<td id='tag312' >".$i."</td>
		<td style='width: 100px;color: red;'>".$num."</td>
		<td >".$state."</td>
		<td >".$country."</td>
		<td>".$begin."</td>
		<td>".$end."</td>
	  </tr> ";
	  $i++;
	}

	$str.='</tbody>';

	echo $str;
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