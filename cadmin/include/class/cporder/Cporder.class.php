<?php
if (!defined('ACCESS')) {exit('Access denied.');}

class Cporder extends CporderBase
{
	
	
	
	/*
	 *fun:获取生产单 列表
	 *
	*/
	public static function getCporderList() {
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT  * FROM osapa_orders ";
	
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();	
	}
	
	/*
	 *fun:获取生产单详情
	 *@var  id_porder  生产单id 唯一
	*/
	public static function getCporderContent($id_porder) {
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT  * FROM osapa_orders  where id_porder= $id_porder ";
	
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();	
	}
	/*
	 *fun:获取生产单交货记录
	 *@var  id_porder  生产单id 唯一
	*/
	public static function getCporderDelivery($id_porder) {
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);
		$sql = "SELECT  * FROM osapa_order_delivery  where id_porder= $id_porder ";
	
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();	
	}
	
	/*
	 *fun:获取生产单交货总数量
	 *@var  id_porder  生产单id 唯一
	*/
	public static function getCporderDeliveryNum($id_porder) {
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT  sum(number)as num FROM osapa_order_delivery  where id_porder= $id_porder ";
	
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list[0]['num'];
		}
		return array();	
	}
	
	
	/*
	 *fun:添加交货记录
	 *@var  id_porder  生产单id 唯一
	*/
	public static function addCporderDelivery($id_porder,$num,$note,$actor) {
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "INSERT INTO `osapa_order_delivery` 
				( `id_porder`, `number`, `note`, `actor`,`date_add`) 
				VALUES ( '$id_porder', '$num','$note',$actor, now());";
		$history = "INSERT INTO `osapa_order_history` 
				( `id_porder`, `action_type`, `content`, `actor`, `date_add`) 
				VALUES ( '$id_porder', '添加', '添加交货记录:数量($num)备注($note)', '$actor', now());";
	
		$db->query($sql);
		$db->query($history);
	}
	
	/*
	 *fun:添加生产单
	 *@var  id_porder  生产单id 唯一
	*/
	public static function addCporder($id_order,$category,$number,$pre_date,$state,$note,$actor) {
		
		
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "INSERT INTO `osapa_orders` ( `id_order`, `category`, `number`, `pre_date`, `real_date`, 
					`state`, `note`, `date_add`, `date_upd`) VALUES 
					('$id_order', '$category', '$number', '$pre_date', '$pre_date', 
					'$state', '$note', 
					now(), 
					now());";
		$db->query($sql);
		
	
		
		$lastid = "select id_porder  from osapa_orders where id_order = '$id_order' ";
		$res =$db->query($lastid)->fetchAll();

		
		$id_porder= $res[0]['id_porder'];
		
		
			$psql = "INSERT INTO `osapa_order_purchase` (`id_porder`,`stock_begin`,
	`stock_end`,`cap_begin`,`cap_end`,`dye_begin`,`dye_end`,`hand_begin`,`hand_end`,
	`pin_begin`,`pin_end`,`clean_begin`,`clean_end`,`extra_time`,`note`,`date_add`,
	`date_upd`
)VALUES(
		'$id_porder','0000-00-00','0000-00-00','0000-00-00','0000-00-00','0000-00-00','0000-00-00',
		'0000-00-00','0000-00-00','0000-00-00','0000-00-00','0000-00-00',
		'0000-00-00','','',now(),now()
	);

";
		$db->query($psql);
		$history = "INSERT INTO `osapa_order_history` 
				( `id_porder`, `action_type`, `content`, `actor`, `date_add`) 
				VALUES ( '$id_porder', '添加', '添加生产单记录:订单($id_order)类别($category)数量($number)截止日期($pre_date)状态($state)备注($note)', '$actor', now());";
		
		
		
		$db->query($history);
	}
	/*
	 *fun:检测订单是否已分配生产单
	 *@var  id_porder  生产单id 唯一
	*/
	
	public static function checkCporder($id_order) {
		
		
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "select id_porder  from osapa_orders where id_order = $id_order";
		$res= $db->query($sql)->fetchAll();
		
	    return '';
	}
	
	
	/*
	 *fun:更新生产单
	 *@var  id_porder  生产单id 唯一
	*/
	public static function updateCporder($id_porder,$state,$note,$actor) {
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "update osapa_orders set state='$state' ,note='$note',date_upd=now()  where id_porder=$id_porder";
		$history = "INSERT INTO `osapa_order_history` 
				( `id_porder`, `action_type`, `content`, `actor`, `date_add`) 
				VALUES ( '$id_porder', '更新', '更新生产单记录:状态($state)备注($note)', '$actor', now());";
	
		$db->query($sql);
		$db->query($history);
	}
	
	
	/*
	 *fun:获取生产单操作记录
	 *@var  id_porder  生产单id 唯一
	*/
	public static function getCporderHistory($id_porder) {
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT  * FROM osapa_order_history  where id_porder= $id_porder ";
	
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();	
	}
	
	
	/*
	 *fun:获取生产单操作记录
	 *@var  id_porder  生产单id 唯一
	 *@var  
	*/
	
	public static function getHistoy($id_porder){
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT * from  osapa_order_history where  id_porder=$id_porder ";
	
		$list = $db->query($sql)->fetchAll();

		if ($list) {
			return $list;
		}
		return array();	
	}


	
}
