<?php
//paypal漏单检测  通过 linux 脚本执行   每天执行 一次 检测前一天交易是否正常
//
ignore_user_abort(true); 
set_time_limit(0);
header("Content-type: text/html; charset=utf-8"); 
$post=  array(
	'VERSION'=>'204',
	'USER'=>'uniwigspay_api1.gmail.com',
	'PWD'=>'DL545J6SCEND5GXU',
	'SIGNATURE'=>'Ak8nY2cO2GAZ7VakCkrAci-Yj3IzA6vxrzp2g1ZBS7NhTaYuJ8wfphws',
	'BUTTONSOURCE'=>'PrestashopUS_Cart',
	
);
//格式化时间 
$n_date = date('Y-m-d').'T'.date('h:i:s').'Z';
$p_date = date('Y-m-d',strtotime("-1 days")).'T'.date('h:i:s').'Z';


//获取指定日期 和筛选条件的 交易列表  默认查询一天内的交易状态
$param_transcation_list=array(
	'METHOD'=>'TransactionSearch',
	'STARTDATE'=>"$p_date",
	'TransactionClass' => 'all', //现指定交易类型
	'Status'=> 'success', //再指定交易类型中的 状态 
	//'STATUS '=>'Pending', //暂时不起作用 需要和TransactionClass 一起使用
	//'EMAIL'=>'vhaught123@aol.com',//根据买家email 搜索 
	'ENDDATE'=>"$n_date"
	
);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api-3t.paypal.com/nvp'); //请求地址
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);// 请求模式 post 
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($post)."&".http_build_query($param_transcation_list));

$response = curl_exec($ch);
//echo $response;
$myArray='';
parse_str($response,$myArray);

/*echo '<pre>';
var_dump($myArray);
echo '</pre>';
*/
curl_close($ch);
checkpaypal($myArray,$post);
//检测最近一小时内的 交易 是否存在漏单
function  checkpaypal($t_arr,$post){
	$pdo = new PDO("mysql:host=localhost;dbname=uniwigs2016","root","rootadmin123")or die('数据库连接失败'); 
	
	foreach ($t_arr as $key => $value) {

		if(strpos($key, 'TRANSACTIONID')){
			$sql = "select *  from  ps_paypal_usa_transaction  where  id_transaction='$value';";
			$res=$pdo->query($sql);
			if(count($res->fetchAll())==0){
			
			$t_detail=getPaypalDetail($value,$post);
			if(isset($t_detail['CUSTOM'])){
				$cart =$t_detail['CUSTOM'] ;
				$cart =str_replace(':','\:', $cart);
				}
			else{
				$cart = '0000:0';
			}
			
				$email = $t_detail['EMAIL'];
		

			if(isset($t_detail['AMT']))
				$amount = $t_detail['AMT'];
			else
				$amount  = '0';

			if(isset($t_detail['FEEAMT']))
				$fee = $t_detail['FEEAMT'];
			else
				$fee  = '0';


			if(isset($t_detail['ORDERTIME'])){
				$date_add = str_replace('T',' ', $t_detail['ORDERTIME']);
				$date_add = str_replace('Z','',$date_add);
			}
			else{
				$date_add = '0000-00-00 00:00:00';
			}

			
			if($cart!='0000:0'&&$email!='uniwigspay@gmail.com'){
				
			$paysql="INSERT INTO `px_paypal_remind` (`id_shop_cart`,`id_transaction`,`email` ,`amount`, `fee`, `date_add`) 
			VALUES ('$cart','$value','$email','$amount','$fee','$date_add'); ";
			$pdo->query($paysql)or die('paypal 提醒插入失败');

			echo "此单已丢失--详情：paypal交易id--$value 购物车店铺信息--$cart 用户email--$email<br>";
				}
			}
		

				//echo $key.'--'.$value.'<br>';
		}
	

	}
	
}


function   getPaypalDetail($tid,$post){

	
	//获取指定 订单id的 详情
	$param_transcation_detail=array(
		'METHOD'=>'GetTransactionDetails',
		'TRANSACTIONID'=>"$tid"//订单id
		
	);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://api-3t.paypal.com/nvp'); //请求地址
	curl_setopt($ch, CURLOPT_VERBOSE, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);// 请求模式 post 
	curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($post)."&".http_build_query($param_transcation_detail));

	$response = curl_exec($ch);
	//echo $response;
	$myArray='';
	parse_str($response,$myArray);
	curl_close($ch);
	return  $myArray;
}