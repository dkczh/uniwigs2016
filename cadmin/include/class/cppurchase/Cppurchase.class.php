<?php
if (!defined('ACCESS')) {exit('Access denied.');}

class Cppurchase extends CppurchaseBase
{
	
	
	
	/*
	 *fun:获取采购单 列表
	 *
	*/
	public static function getCporderPurchaseList() {
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT  a.id_porder,a.category,a.number,a.state,b.id_porder_purchase,b.date_add,b.date_upd FROM osapa_orders a 
LEFT JOIN osapa_order_purchase b on a.id_porder=b.id_porder ";
	
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();	
	}
	
	
	/*
	 *fun:获取采购单 详情
	 *
	*/
	public static function getCporderPurchase($id_porder) {
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT * ,IF(stock_end>0,DATEDIFF(stock_end,stock_begin) ,DATEDIFF(now(),stock_begin) )   as stock ,
IF(cap_end>0,DATEDIFF(cap_end,cap_begin) ,DATEDIFF(now(),cap_begin) )   as cap ,
IF(dye_end>0,DATEDIFF(dye_end,dye_begin) ,DATEDIFF(now(),dye_begin) )   as dye ,
IF(pin_end>0,DATEDIFF(pin_end,pin_begin) ,DATEDIFF(now(),pin_begin) )   as pin ,
IF(clean_end>0,DATEDIFF(clean_end,clean_begin) ,DATEDIFF(now(),clean_begin) )   as clean from osapa_order_purchase where id_porder=$id_porder ";

		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();	
	}
	
	/*
	 *fun:添加采购记录
	 *@var  id_porder  生产单id 唯一
	 *@var  name 更新表字段名字
	*/
	public static function addCporderPurchase($id_porder,$name,$actor ) {
		
	
		$db = self::__instance();
	
		$sql = "update osapa_order_purchase set $name=now() ,date_upd =now()  where id_porder= $id_porder ";
	    
		$db->query($sql);
		
		
		$history = "INSERT INTO `osapa_order_history` 
				( `id_porder`, `action_type`, `content`, `actor`, `date_add`) 
				VALUES ( '$id_porder', '添加', '添加采购记录:名称($name)', '$actor', now());";
	
		$db->query($history);

	}
	
	
	/*
	 *fun:添加采购记录
	 *@var  id_porder  生产单id 唯一
	 *@var  name 更新表字段名字
	*/
	public static function addCpPurchasenote($id_porder,$note,$actor ) {
		
	
		$db = self::__instance();
	
		$sql = "update osapa_order_purchase set note='$note',date_upd =now()  where id_porder= $id_porder ";
	/*     echo $sql;
		exit; */
		$db->query($sql);
		
		
		$history = "INSERT INTO `osapa_order_history` 
				( `id_porder`, `action_type`, `content`, `actor`, `date_add`) 
				VALUES ( '$id_porder', '添加', '添加采购记录:名称(note)', '$actor', now());";
	
		$db->query($history);

	}
	/*
	 *fun:获取采购操作记录
	 *@var  id_porder  生产单id 唯一
	 *@var  
	*/
	
	public static function getPurchaseHistoy($id_porder){
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT * from  osapa_order_history where  id_porder=$id_porder and  content like '%采购%' ";
	
		$list = $db->query($sql)->fetchAll();

		if ($list) {
			return $list;
		}
		return array();	
	}
	


	
}
