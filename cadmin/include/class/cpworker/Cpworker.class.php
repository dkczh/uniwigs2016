<?php
if (!defined('ACCESS')) {exit('Access denied.');}

class Cpworker extends CpworkerBase
{
	
	
	
	/*
	 *fun:获取任务单 列表
	 *
	*/
	public static function getCporderWorkerList() {
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT  a.id_porder,a.category,a.number,a.state,a.number,a.num_use,b.id_worker_order,a.date_add,a.date_upd FROM osapa_orders a 
LEFT JOIN osapa_orders_worker b on a.id_porder=b.id_porder group by a.id_porder ";
	
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();	
	}
	
	/*
	 *fun:获取工人列表
	 *
	*/
	public static function getCporderWorker() {
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT a.*,c.id_worker_order,c.note from osa_user a
						LEFT JOIN osa_user_group b on a.user_group=b.group_id 
						LEFT JOIN osapa_orders_worker c on a.user_id=c.worker_id
						where  b.group_name='worker' GROUP BY a.user_id";
	
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
	public static function getCporderContent($id_porder) {
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT * from osapa_orders where id_porder=$id_porder ";

		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();	
	}
	/*
	 *fun:添加员工分配记录
	*/
	public static function addCporderTask($id_porder,$worker,$num,$ccontent,$state,$note,$date,$actor,$workername ) {
		
	
		$db = self::__instance();
	
		$sql = "INSERT INTO `osapa_orders_worker` (`id_porder`,`worker_id`,`num`,`state`,`content`,`note`,`date`,`date_add`,
	`date_upd`)VALUES(
		'$id_porder',
		'$worker',
		'$num',
		'$state',
		'$ccontent',
		'$note',
		'$date',
		now(),
		now()
			);

		";
	    /* echo $sql;
		exit; */
		$db->query($sql);
		
		$sql2 = "update osapa_orders set num_use=num_use+$num,date_upd =now()  where id_porder= $id_porder ";    
		$db->query($sql2);
		
		
		
		$history = "INSERT INTO `osapa_order_history` 
				( `id_porder`, `action_type`, `content`, `actor`, `date_add`) 
				VALUES ( '$id_porder', '添加', '添加任务分配记录:工人id($worker)名字($workername)数量($num)产品($ccontent)日期($date)备注($note)', '$actor', now());";
	
		$db->query($history);
		
		$history2 = "INSERT INTO `osapa_order_history` 
				( `id_porder`, `action_type`, `content`, `actor`, `date_add`) 
				VALUES ( '$id_porder', '更新', '更新生产单分配数量记录:工人id($worker)名字($workername)数量($num)产品($ccontent)', '$actor', now());";
	
		$db->query($history2);

	}
	
	/*
	 *fun:获取分配操作记录
	 *@var  id_porder  生产单id 唯一
	 *@var  
	*/
	
	public static function getTaskHistoy($id_porder){
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT * from  osapa_order_history where  id_porder=$id_porder and  content like '%任务分配%' ";
	
		$list = $db->query($sql)->fetchAll();

		if ($list) {
			return $list;
		}
		return array();	
	}
	
	
	/*
	 *fun:获取工人名字
	 *@var  id_porder  生产单id 唯一
	 *@var  
	*/
	
	public static function getWorkerName($worker){
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT * from  osa_user where  user_id= $worker ";

		$list = $db->query($sql)->fetchAll();

		if ($list) {
			return $list[0]['real_name'];
		}
		return array();	
	}
	
	/*
	 *fun:获取工人任务详情
	 *@var  worker_id  员工id
	 *@var  
	*/
	
	public static function getWorkerTask($worker_id){
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT a.*,b.real_name from osapa_orders_worker  a 
LEFT JOIN osa_user b on a.worker_id=b.user_id 
where a.worker_id= $worker_id 
ORDER by  a.position  desc ,a.worker_state asc,a.date_add asc ";

		$list = $db->query($sql)->fetchAll();

		if ($list) {
			return $list;
		}
		return array();	
	}
	
	/*
	 *fun:更新员工任务状态
	 *@var  id_worker_order  员工任务id
	 * 
	*/
	
	public static function updWorkerTask($id_worker_order,$id_porder,$worker_level,$workername,$workerid,$actor){
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "update  osapa_orders_worker  set worker_state=1,worker_level='$worker_level',real_date=now(),date_upd=now() where  id_worker_order = $id_worker_order  ";
	
		$db->query($sql);
		
		
		$history = "INSERT INTO `osapa_order_history` 
				( `id_porder`, `action_type`, `content`, `actor`, `date_add`) 
				VALUES ( '$id_porder', '更新', '更新任务状态记录:任务id($id_worker_order)员工id($workerid)名字($workername)验收级别($worker_level)任务状态(1)', '$actor', now());";
	
		$db->query($history);
	
	}
	
	
		
	/*
	 *fun:获取员工操作记录
	 *@var  id_porder  生产单id 唯一
	 *@var  
	*/
	
	public static function getWokerHistoy($workerid){
		
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT * from  osapa_order_history where   content like '%员工id($workerid)%' ";

		$list = $db->query($sql)->fetchAll();

		if ($list) {
			return $list;
		}
		return array();	
	}
	
	
}
