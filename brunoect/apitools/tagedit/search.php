<?php
define('PS_API_TSMARTY',getcwd());
require_once(PS_API_TSMARTY.'/../../config/settings.inc.php'); // 
require_once(PS_API_TSMARTY.'/../../config/config.inc.php'); // 
require_once(PS_API_TSMARTY.'/../../classes/db/Db.php'); // 

$product=$_GET['id'];



$arr = explode(',', $product);
$startid = $arr['0'] ;
$endid = $arr['1'] ;
$keyword = $arr['2'] ;


if($keyword ==''){

	if($startid =='' or $endid=='' )
	{
		echo "未检索到数据";
	}
	//
	getidproduct($startid,$endid);
}else{
	
	 getkeywordproduct($startid,$endid,$keyword);

}







function  getidproduct($startid,$endid){
$db = Db::getInstance();
$sql = "select id_product,name from ps_product_lang where id_product between $startid and $endid";
$result = $db->ExecuteS($sql);
$str ='';
$num = $db->numRows($result);
	if ($num>0) 
	{
		foreach ($result as $a) 
		{
		
	 		$name  = $a['name'];
	 		$id = $a['id_product'];
			$str.="<div class='search_result_prd_item'>
					<img src='/dkcps16/img/p/$id/$id.jpg'>
					<input type='checkbox' value='$id' name='products'>
	            	<br>$name
	            	</div>";
			
		}
			echo $str;
 	}	



}



function  getkeywordproduct($startid,$endid,$keyword){

$db = Db::getInstance();
$sql="select id_product,name from ps_product_lang where (id_product between $startid and $endid) and (name like '%$keyword%')";
$result = $db->ExecuteS($sql);
$str ='';
$num = $db->numRows($result);
	if ($num>0) 
	{
		foreach ($result as $a) 
		{
		
	 		$name  = $a['name'];
	 		$id = $a['id_product'];
			$str.="<div class='search_result_prd_item'>
					<img src='/img/p/$id/$id.jpg'>
					<input type='checkbox' value='$id' name='products'>
	            	<br>$name
	            	</div>";

						
		
		}
			echo $str;

 	}else
 	{

	echo "未检索到数据";
	}

}