<?php
/*
* AUTHOR  DKC 
*
* phpexcel 测试
* 注意  excel 生成前 不可以有 echo 函数 输出 否则 出错
*/
header("Content-type: text/html; charset=utf-8"); 

require_once(dirname(__FILE__).'/../../config/config.inc.php');
	

if(isset($_POST['id'])){

	$user = 'root';  
/* 	$dsn = 'mysql:host=localhost;dbname=uni'; 
	$pwd = 'root'; */
	$dsn = 'mysql:host=localhost;dbname=uniwigs2016'; 
	$pwd = 'rootadmin123';
	
   
  

	$db =pdo_conn($dsn,$user,$pwd)or die();
	 
	switch ($_POST['id']) {
		case '1':
			//正常订单 提醒
				q_order_normal($db);
			break;
		case '3':
			//定制单 提醒 3天
			q_order_remind($db,'3');
			break;
		case '7':
			//定制单 提醒 7天
			q_order_remind($db,'7');
			break;
		case '10':
			//定制单 提醒 10天
			q_order_remind($db,'10');
			break;
		case '99':
			//定制单 提醒 10天
			q_order_remind($db,'99');
			break;
		default:
			echo '结果为空';
			break;
	}
	
	//echo $_POST['id'].'查询成功'.$_POST['begin'].'---'.$_POST['end'];
	
}





//查询正常订单
function q_order_normal($db){
	$id_employee = Context::getContext()->cookie->id_employee;
	// /admin-dev/index.php?controller=AdminOrders&id_order=100023378&vieworder&token=f525d2442348aea2ac09a547ed7bca6e
	$id = Tab::getIdFromClassName('AdminOrders');
	$token = Tools::getAdminToken('AdminOrders'.(int)$id.(int)$id_employee);
	$uri_f = "/admin-dev/index.php?controller=AdminOrders&id_order=";
	$uri_l ="&vieworder&token=".$token;
	$sql = "select id_order,id_customer,   date_format(date_add,'%Y-%m-%d') as date_add ,date_format(date_sub(now(), interval 1 day),'%Y-%m-%d') as nowdate from  ps_orders 

where current_state = 3 and  date_add <date_sub(now(), interval 3 day)
and id_order  not in (select id_order  from  px_order_remind)
";


	$res = getall($db,$sql);

	$str = "<center  style=\"
    margin-top: -85px; color:red
\">总计".count($res)."</center> <thead>
    <tr>
         <th>订单id</th>
		<th>客户id</th>	
		<th>添加日期</th>
        <th>当前日期</th>
		<th>备用1</th>
    </tr>
    </thead> <tbody id='tablelist'>";

    $i= 1;

	foreach ($res as $a) {
		
		$id_order= $a['id_order'];
		$id_customer = $a['id_customer'];
		$date_add = $a['date_add'];
		$nowdate = $a['nowdate'];
		$uri = $uri_f.$id_order.$uri_l;
		$str.="<tr >
		
		<td id='tag312' ><a href=\"$uri\" target=\"_blank\">$id_order</a></td>
		<td style='width: 200px;'>".$id_customer."</td>
		<td >".$date_add."</td>
		<td style='width: 100px;color: red;'>".$nowdate."</td>
		<td style='width: 100px;'>
	 
	  </td></tr> ";
	  $i++;
	}

	$str.='</tbody>';

	echo $str;
}


//查询定制单订单
function q_order_remind($db,$id){
	if($id=='10'){
	$sql = "SELECT
	*,
	date_format(date_sub(now(), interval 1 day), '%Y-%m-%d') AS nowdate,
	TIMESTAMPDIFF(DAY,date_format(date_sub(now(), interval 1 day), '%Y-%m-%d'),date)  as rdate
FROM
	px_order_remind
WHERE
	date_format(date_sub(now(), interval 1 day), '%Y-%m-%d') BETWEEN DATE_SUB(date, INTERVAL 10 DAY)
AND DATE_SUB(date, INTERVAL 8 DAY)
";}
if($id=='7'){
	$sql = "SELECT
	*,
	date_format(date_sub(now(), interval 1 day), '%Y-%m-%d') AS nowdate,
	TIMESTAMPDIFF(DAY,date_format(date_sub(now(), interval 1 day), '%Y-%m-%d'),date)  as rdate
FROM
	px_order_remind
WHERE
	date_format(date_sub(now(), interval 1 day), '%Y-%m-%d') BETWEEN DATE_SUB(date, INTERVAL 7 DAY)
AND DATE_SUB(date, INTERVAL 4 DAY)
";}
if($id=='3'){
	$sql = "SELECT
	*,
	date_format(date_sub(now(), interval 1 day), '%Y-%m-%d') AS nowdate,
	TIMESTAMPDIFF(DAY,date_format(date_sub(now(), interval 1 day), '%Y-%m-%d'),date)  as rdate
FROM
	px_order_remind
WHERE
	date_format(date_sub(now(), interval 1 day), '%Y-%m-%d') BETWEEN DATE_SUB(date, INTERVAL 3 DAY)
AND DATE_SUB(date, INTERVAL 0 DAY)
";}
if($id=='99'){
	$sql = "SELECT
	od.*,
	date_format(date_sub(now(), interval 1 day), '%Y-%m-%d') AS nowdate,
	TIMESTAMPDIFF(DAY,od.date,date_format(date_sub(now(), interval 1 day), '%Y-%m-%d'))  as rdate
FROM
	px_order_remind od
LEFT JOIN  ps_orders o on o.id_order=od.id_order
WHERE
	date_format(date_sub(now(), interval 1 day), '%Y-%m-%d')>od.date
and  o.current_state not in (4,6) 
";}
	$res = getall($db,$sql);
	
if($id=='99'){
	$str = "<center  style=\"
    margin-top: -85px; color:red
\">总计".count($res)."</center><thead >
    <tr style=\"
  background-color: rgba(31, 251, 8, 0.54);
\">
        <th>订单id</th>
		<th>产品skus</th>	
		<th>备货截止日期</th>
		<th>生成单号</th>
		<th>状态</th>
        <th>当前日期</th>
		<th>超期天数</th>
    </tr>
    </thead> <tbody id='tablelist'>";

	
}else{
	
	$str = "<center  style=\"
    margin-top: -85px; color:red
\">总计".count($res)."</center><thead>
    <tr>
        <th>订单id</th>
		<th>产品skus</th>	
		<th>备货截止日期</th>
		<th>生成单号</th>
		<th>状态</th>
        <th>当前日期</th>
		<th>剩余天数</th>
    </tr>
    </thead> <tbody id='tablelist'>";

}

    $i= 1;
	$id_employee = Context::getContext()->cookie->id_employee;
	// /admin-dev/index.php?controller=AdminOrders&id_order=100023378&vieworder&token=f525d2442348aea2ac09a547ed7bca6e
	$id_tab = Tab::getIdFromClassName('AdminOrders');
	$token = Tools::getAdminToken('AdminOrders'.(int)$id_tab.(int)$id_employee);
	$uri_f = "/admin-dev/index.php?controller=AdminOrders&id_order=";
	$uri_l ="&vieworder&token=".$token;
	foreach ($res as $a) {
		
		$id_order= $a['id_order'];
		$skus = $a['skus'];
		$date = $a['date'];
		$nowdate = $a['nowdate'];
		$num = $a['manufacture'];
		$status = $a['status'];
		$rdate = $a['rdate'];
		$uri = $uri_f.$id_order.$uri_l;
		$str.="<tr >
		<td id='tag312' ><a href=\"$uri\" target=\"_blank\">$id_order</a></td>
		<td style='width: 200px;'>".$skus."</td>
		<td style='width: 100px;color: red;'>".$date."</td>
		<td >".$num."</td>
		<td >".$status."</td>
		<td >".$nowdate."</td>
		<td style='width: 100px;color: red;'>
	".$rdate."
	  </td></tr> ";
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
		//解决pdo 中文读取乱码问题
		$db->query('set names utf8;');
		return $db;
}
	
function getall($db,$sql)
	{
		
			 $result = $db->query($sql);
			 $res =$result->fetchAll(); //存成关联数组

			 return  $res;
	}