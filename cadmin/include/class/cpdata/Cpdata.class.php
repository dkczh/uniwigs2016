<?php
if (!defined('ACCESS')) {exit('Access denied.');}

class Cpdata extends CpdataBase
{
	
	
	
	/*
	 *fun:未交货统计
	 *
	*/
	public static function getDataNoDelivery() {
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT sum(a.num) as num ,b.category from osapa_orders_worker  a
LEFT JOIN osapa_orders b on a.id_porder=b.id_porder
where  a.worker_state=0 and  a.date_upd BETWEEN  '2016-10-01' and  '2016-11-02' 
GROUP BY b.category ";
	
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();	
	}

	/*
	 *fun:下单统计
	 *
	*/
	public static function getDataOrder() {
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "select a.category,sum(number)as num from  osapa_orders a 
where   a.date_add BETWEEN  '2016-01-01' and  '2016-11-02' 
GROUP BY a.category";
	
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();	
	}
	/*
	 *fun:交货统计
	 *
	*/
	public static function getDataDelivery() {
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT sum(a.num)as num ,b.category from osapa_orders_worker  a
LEFT JOIN osapa_orders b on a.id_porder=b.id_porder
where  a.worker_state=1 and  a.date_upd BETWEEN  '2016-10-01' and  '2016-11-02' 
GROUP BY b.category  ";
	
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();	
	}

	/*
	 *fun:工人统计 列表
	 *
	*/
	public static function getDataWorker() {
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT b.real_name,GROUP_CONCAT(CONCAT(worker_level,'级别',':数量',num) SEPARATOR ';') as detail   from osapa_orders_worker   a  
LEFT JOIN osa_user  b  on a.worker_id=b.user_id 
where  a.worker_state=1  and a.date_upd BETWEEN '2016-01-01' and '2016-11-02'
GROUP BY a.worker_id ";
	
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();	
	}	
	
	
	
	
	
	


	
}
