<?php
/*
* AUTHOR  DKC 
*
* phpexcel 测试
* 注意  excel 生成前 不可以有 echo 函数 输出 否则 出错
*/

header("Content-type: text/html; charset=utf-8"); 

if(isset($_GET['id'])&&isset($_GET['begin'])&&isset($_GET['end'])){
	
	$dsn = 'mysql:host=localhost;dbname=uniwigs2016'; 

	
    $user = 'root';  
    $pwd = 'rootadmin123';
	$db =pdo_conn($dsn,$user,$pwd)or die();
	echo  '<style type="text/css">td {
    border: 1px solid;
	padding-left: 10px;
padding-right: 10px;
}
th {
    border: 1px solid;
    padding-left: 10px;
    padding-right: 10px;
}</style>';
echo "<center><h1>".$_GET['skus']."</h1>";
//."<a  target='_blank' href='excel.php?id=".$_GET['id']."&begin=".$_GET['begin']."&end=".$_GET['end']."'>导出excel</a></center> ";
	
	q_product($db,$_GET['id'],$_GET['begin'],$_GET['end']);

}





function q_product($db,$id,$begin,$end){
	//详情一
	$sql = "SELECT
	od.product_id,
	od.product_reference AS skus,
	od.product_name AS attr,
	count(product_attribute_id) AS sales,
  '$begin' as begin_date,
  '$end' as  end_date
FROM
	ps_order_detail od
LEFT JOIN ps_orders o ON od.id_order = o.id_order
WHERE
	product_id = $id
AND o.date_add BETWEEN '$begin'
AND '$end'
GROUP BY
	product_attribute_id
";
		
	//详情二	
/* 		$sql= "SELECT
	od.product_id,
  o.id_order,
	od.product_reference AS skus,
	od.product_name AS attr,
	od.product_quantity as sales ,
  '$begin' as begin_date,
  '$end' as  end_date
FROM
	ps_order_detail od
LEFT JOIN ps_orders o ON od.id_order = o.id_order
WHERE
	product_id = $id
AND o.date_add BETWEEN '$begin'
AND '$end'
"; */
		
		
	//详情3
	
	/* $sql = "SELECT
	od.product_id,
  o.id_order,
	od.product_reference AS skus,
	 GROUP_CONCAT( CONCAT(o.id_order,'----',od.product_name,'<br><span style=\'color:red\'>',od.product_quantity,'</span>') SEPARATOR '<br>')    AS attr ,
	 sum(od.product_quantity) as sales ,
 '$begin' as begin_date,
  '$end' as  end_date
FROM
	ps_order_detail od
LEFT JOIN ps_orders o ON od.id_order = o.id_order
WHERE
	product_id = $id
AND o.date_add BETWEEN '$begin'
AND '$end'
GROUP BY  od.product_attribute_id"; */
	/* echo '<pre>'.$sql.'</pre>' ;
	exit; */
	
	$res = getall($db,$sql);
		
	$str = " <table class='bordered' id='list_content' style='
    width: 1280px;
    /* border: 1px solid rgb(213, 204, 204);*/
    margin: 0 auto;
    margin-top: 50px;
'><thead>
    <tr>
        <th>id</th>
		<th>products_id</th>
        <th>Skus</th>
		<th>sales</th>	
		<th>attr</th>
		<th>begin_date</th>
		<th>end_date</th>
	   
    </tr>
    </thead> <tbody id='tablelist' style='
    text-align: center;
'>";

    $i= 1;

	foreach ($res as $a) {
		
		$attr= $a['attr'];
		$skus = $a['skus'];
		$poid= $a['product_id'];
		$num = $a['sales'];
		$str.="<tr >
		<td id='tag312' >".$i."</td>
		<td >".$poid."</td>
		<td >".$skus."</td>
		<td style='width: 100px;color: red;' >".$num."</td>
		
	<td style='width: 500px;'>".$attr."</td>
		<td>".$begin."</td>
		<td>".$end."</td>
	 </tr> ";
	  $i++;
	}

	$str.='</tbody></table>';

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