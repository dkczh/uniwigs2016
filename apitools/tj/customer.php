<?php
/*
* AUTHOR  DKC 
*
* phpexcel 测试
* 注意  excel 生成前 不可以有 echo 函数 输出 否则 出错
*/

header("Content-type: text/html; charset=utf-8"); 

if(isset($_GET['id'])&&isset($_GET['begin'])&&isset($_GET['end'])&&isset($_GET['email'])){
	

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
echo "<center><h1>".$_GET['email']."</h1></center>";
	q_product($db,$_GET['id'],$_GET['begin'],$_GET['end']);

}





function q_product($db,$id,$begin,$end){
	$sql = "SELECT
sum(od.product_quantity) as num ,
	sum((od.product_price-od.reduction_amount-o.total_discounts+o.total_shipping)*od.product_quantity) AS total,
od.product_id,
od.product_name,
od.product_reference as skus,
o.date_add,
c.email 
 from  ps_orders  o  

LEFT JOIN ps_order_detail od on od.id_order = o.id_order 
LEFT JOIN ps_customer  c  on  c.id_customer = o.id_customer 
WHERE  
	o.date_add  BETWEEN '$begin' and   '$end' 
  and c.id_customer = '$id' 
  and od.product_name !='Extra cost' 
GROUP BY
	product_id
ORDER by num desc 

";


/* echo $sql ;
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
		<th>name</th>
        <th>Skus</th>
		<th>sales</th>	
		
		<th>email</th>
		<th>金额</th>
		<th>购买时间</th>
		
	   
    </tr>
    </thead> <tbody id='tablelist' style='
    text-align: center;
'>";

    $i= 1;

	foreach ($res as $a) {
		
		$name= $a['product_name'];
		$skus = $a['skus'];
		$email = $a['email'];
		$num = $a['num'];
		$cdate= $a['date_add'];
		$total= $a['total'];
		$str.="<tr >
		<td id='tag312' >".$i."</td>
		<td style='width: 500px;'>".$name."</td>
		<td >".$skus."</td>
		<td style='width: 100px;color: red;'>".$num."</td>
		<td>".$email."</td>
		<td>".$total."</td>
		<td>".$cdate."</td>
	
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