<?php
/*
* 2007-2014 PrestaShop
*
* 自定义输入积分转换
*
*/

header("Content-Type: text/html;charset=utf-8");
	
if(isset($_GET['begin'])&&isset($_GET['end'])){
	
	$begintime = $_GET['begin'];
	$endtime=$_GET['end'];

 
	$pdo = new PDO("mysql:host=localhost;dbname=uniwigs2016","root","rootadmin123")or die('数据库连接失败'); 
	$sql ="SELECT
				o.id_order AS id,
			  group_concat(concat(od.product_reference,'(',od.product_price,')') SEPARATOR '</br>') as skus,
			  od.product_price as price,
				o.total_discounts AS Discount,
				o.total_paid AS payment,
				os.`name` AS STATUS ,
				o.date_add AS paydate,
			  IF((os.`name`='Shipped'),o.date_upd,'no') as delidate
				
			FROM
				ps_orders o 

			LEFT JOIN ps_order_state_lang  os 
			on os.id_order_state=o.current_state and os.id_lang=1
			LEFT JOIN ps_order_detail od
			on od.id_order=o.id_order 
			left join ps_product pp on pp.id_product=od.product_id
			where  
			o.date_add between '$begintime'  and  '$endtime'
			and  pp.id_category_default =40462
			GROUP BY o.id_order
			";
	//echo $sql;
	$res=$pdo->query($sql);
	foreach ($res as $row) {
		
		echo '<tr>';
		echo "<td>".$row['id']."</td>";
		echo "<td>".$row['skus']."</td>";
		echo "<td>".$row['price']."</td>";
		echo "<td>".$row['Discount']."</td>";
		echo "<td>".$row['payment']."</td>";
		echo "<td>".$row['STATUS']."</td>";
		echo "<td>".$row['paydate']."</td>";
		echo "<td>".$row['delidate']."</td>";
		echo '</tr>';
		}
		
}
else{
	
	echo '';
}