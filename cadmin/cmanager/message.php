<?php
require ('../include/init.inc.php');
$method = $user_id = $page_no = '';
extract ( $_GET, EXTR_IF_EXISTS );

$user_info = UserSession::getSessionInfo ();
	

if(isset($_POST['id_order']))
{	//获取订单详情
	$orderdetail = Cmanage::getCustomerOrderDetail($_POST['id_order']);
	$str= '';
	foreach($orderdetail as $a ){
	$str.='<tr>';	
	 $str.='<td>'.$a['id_order'].'</td>';
	$str.='<td>'.$a['total_paid'].'</td>';
	$str.='<td>'.$a['code'].'</td>';
	$str.='<td>'.$a['total_discounts'].'</td>';
	$str.='<td>'.$a['total_shipping'].'</td>';

	$str.='<td style="width: 180px;">'.$a['product_name'].'</td>';
	$str.='<td style="width: 70px;">'.$a['payment'].'</td>';
	
	$str.='<td>'.$a['name'].'</td>';
	
	$str.='<td>暂无备注</td>';
	$str.='<td>'.$a['date_add'].'</td>';
	$str.='</tr>';	
	}
	
	//echo '订单详情';
	echo $str;
	exit;
	
}








if(isset($_POST['remind']))
{	
	//插入提醒事件
	Cmanage::insertCustomerRemind($_GET['cid'],$_POST['rcontent'],$_POST['date_end'],$user_info['user_name']);
	echo "插入成功";
	exit;
	
}


if(isset($_POST['cmessage']))
{	//($id_customer,$level,$race,$job,$account,$note) 
	//插入客户信息
	Cmanage::insertCustomerMessage($_GET['cid'],$_POST['level'],$_POST['race'],$_POST['job'],$_POST['account'],$_POST['note'],$user_info['user_name'],$_POST['facebook'],$_POST['twitter'],$_POST['pinterest'],$_POST['google']) ;
	echo "插入成功";
	exit;
	
}




//------显示客户列表------//
if(isset($_GET['page'])or !isset($_GET['cid'])){
$total = Cmanage::getCustomerListNum();

$totalpage = $total/50;
if(is_int($totalpage )){
	
	$totalpage=(int)$totalpage;
	
}else{
	
	$totalpage=(int)$totalpage +1;
	
}
if(isset($_GET['page'])){
	$clist= Cmanage::getCustomerList($_GET['page']);

	$npage = $_GET['page'] ;


}else{
	
	$clist= Cmanage::getCustomerList();
	$npage=1;

}
if($npage>$totalpage){
	
	$npage=$totalpage;
}

if($npage<=0){
	
	$npage=1;
}
$nextpage = $npage+1;
$prepage = $npage-1;

if($nextpage>$totalpage){
	
	$nextpage=$totalpage;
	
}

if($prepage<=0){
	
	$prepage=1;
	
}

if(isset($_GET['search'])&&isset($_GET['keywords'])){
	$keyword= $_GET['keywords'];
	//echo  $keywords;
	$clist=Cmanage::getCustomerByKeyword($keyword);
	
	Template::assign('total', 1);
	Template::assign('clist',$clist);
	Template::assign('npage', 1);
	Template::assign('nextpage', 1);
	Template::assign('prepage', 1);
	Template::assign('totalpage', 1);
	Template::display('cmanager/message_list.tpl');
	
}else{
	
	Template::assign('total', $total);
	Template::assign('clist', $clist);
	Template::assign('npage', $npage);
	Template::assign('nextpage', $nextpage);
	Template::assign('prepage', $prepage);
	Template::assign('totalpage', $totalpage);
	Template::display('cmanager/message_list.tpl');	
	
	
}




}
//-------显示客户信息--------//
else{

	if(isset($_GET['cid'])){
	
		
		
		$orderlist	  = Cmanage::getCustomerOrderList($_GET['cid']);
		$remindlist   = Cmanage::getCustomerRemindList($_GET['cid']);
		$historylist  = Cmanage::getCustomerHistoryList($_GET['cid']);
		
		$ccontent= Cmanage::getCustomerContent($_GET['cid']);	
				
		Template::assign('orderlist', $orderlist);	
		Template::assign('remindlist', $remindlist);	
		Template::assign('historylist', $historylist);
		
		Template::assign('ccontent', $ccontent);	
		Template::display('cmanager/message_content.tpl');	
			
		
	}
	

	
}
