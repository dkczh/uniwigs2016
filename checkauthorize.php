<?php

//测试Authorize.Net 信用卡支付 
set_time_limit(0);
 header("Content-type: text/html; charset=utf-8"); 
//请求响应地址
$url = 'https://api.authorize.net/xml/v1/request.api';
$now = date('Y-m-d').'T'.date('h:i:s').'Z';
$pre = date('Y-m-d',strtotime('-1 days')).'T'.date('h:i:s').'Z';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_POST, true);


//获取结算 批次列表 
$post_uni ='
{
    "getSettledBatchListRequest": {
        "merchantAuthentication": {
            "name": "977xrNVH",
            "transactionKey": "5t85Q6bv5BASTq8C"
        },
        "includeStatistics": "true",
        "firstSettlementDate": "'.$pre.'",
        "lastSettlementDate": "'.$now.'"
    }
}';




curl_setopt($ch, CURLOPT_POSTFIELDS,$post_uni);
$response = curl_exec($ch);
//对返回结果 进行转换 并过滤掉特殊字符
$res =json_decode(trim($response,chr(239).chr(187).chr(191)),true);

// 或获取一个 batchId  486195037     这个事系统搜索 自动生成一个 批搜索id  
// 可以根据这个id 获取搜索结果的交易详细列表
$batchId =  $res['batchList'][0]['batchId']; 
$post_uni_tid ='
{
    "getTransactionListRequest": {
        "merchantAuthentication": {
            "name": "977xrNVH",
            "transactionKey": "5t85Q6bv5BASTq8C"
        },
        "batchId": "'.$batchId.'"
    }
}';

$t_list =  get_transcation_list($ch,$post_uni_tid);

/* echo '<pre>';
var_dump($t_list);
echo '</pre>';
exit; */


//核对是否存在漏单情况
check($t_list);

curl_close($ch);






function  get_transcation_list($curl,$post){
	
	curl_setopt($curl, CURLOPT_POSTFIELDS,$post);
	$response = curl_exec($curl);
	//对返回结果 进行转换 并过滤掉特殊字符
	$res =json_decode(trim($response,chr(239).chr(187).chr(191)),true);
	return $res ;
	
}

/*      
	["transId"]=>
      string(10) "8441514057"  交易id 
      ["submitTimeUTC"]=>
      string(20) "2016-05-26T20:38:17Z"
      ["submitTimeLocal"]=>
      string(19) "2016-05-26T13:38:17" //创建时间
      ["transactionStatus"]=>
      string(19) "settledSuccessfully"
      ["invoiceNumber"]=>
      string(4) "8736"
      ["firstName"]=>
      string(6) "sydney"  客户名称
      ["lastName"]=>
      string(7) "schmidt"
      ["accountType"]=>
      string(4) "Visa"
      ["accountNumber"]=> 
      string(8) "XXXX0515"
      ["settleAmount"]=>   消费金额
      float(98.9)
      ["marketType"]=>
      string(9) "eCommerce"
      ["product"]=>
      string(16) "Card Not Present" */


function check($res){
	$pdo = new PDO("mysql:host=localhost;dbname=uniwigs2016","root","rootadmin123")or die('数据库连接失败'); 
	foreach ( $res['transactions'] as $a) 
	{	
		//对交易成功的订单进行  invoiceNumber 对应的是本地的购物车id   本地重复验证
		if($a['transactionStatus']=='settledSuccessfully'){
			
			$sql = "select *  from  ps_orders  where  id_cart='".$a['invoiceNumber']."';";
			$res=$pdo->query($sql);
			
			//对查询结果判断 是否生成了 对应的订单了 
			if(count($res->fetchAll())==0){
				$tid = $a['transId'];
				$cart = $a['invoiceNumber'];
				$name = $a['firstName'].'.'.$a['lastName'];
				$amount = $a['settleAmount'];
				$date =str_replace('T','',$a['submitTimeLocal']);
				$paysql="INSERT INTO `px_authorize_remind` 
				(`id_shop_cart`,`id_transaction`,`customer_name` ,`amount`,`date_add`) 
			VALUES ('$cart','$tid','$name','$amount','$date'); ";
			$pdo->query($paysql)or die('authorize 提醒插入失败');

				
				echo "此单已丢失--详情：authorize交易id--$tid 购物车店铺信息--$cart 用户名字--$name 时间--$date <br>";
			}
		}
	}
	
}






