<?php
if (!defined('ACCESS')) {exit('Access denied.');}

class Cmanage extends CmanageBase
{
	

	public static function getCustomerList($page=null) {
		
		$db = self::__instance();
		
		if($page){
		$sql = "SELECT
					*
				FROM
					(
						SELECT
							a.id_customer,
							a.email,
							a.date_add,
							concat(a.firstname, '.', a.lastname) AS cname,
							count(b.id_order) AS allnum
						FROM
							ps_customer a
						LEFT JOIN ps_orders b ON b.id_customer = a.id_customer
						AND b.valid = 1
						AND b.current_state = 4
						LEFT JOIN osa_history c ON a.id_customer = c.id_customer
						GROUP BY
							a.id_customer
					) mya
				WHERE
					allnum >= 2
				ORDER BY
					allnum DESC  ".(($page-1)*50).",50 ";
		}else{
			
		$sql = "SELECT
					*
				FROM
					(
						SELECT
							a.id_customer,
							a.email,
							a.date_add,
							concat(a.firstname, '.', a.lastname) AS cname,
							count(b.id_order) AS allnum
						FROM
							ps_customer a
						LEFT JOIN ps_orders b ON b.id_customer = a.id_customer
						AND b.valid = 1
						AND b.current_state = 4
						LEFT JOIN osa_history c ON a.id_customer = c.id_customer
						GROUP BY
							a.id_customer
					) mya
				WHERE
					allnum >= 2
				ORDER BY
					allnum DESC  limit 0,50 ";	
		}
		
		
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
	
	public static function getCustomerListNum() {
		
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "select count(*) as num  from (SELECT
					*
				FROM
					(
						SELECT
							a.id_customer,
							a.email,
							a.date_add,
							concat(a.firstname, '.', a.lastname) AS cname,
							count(b.id_order) AS allnum
						FROM
							ps_customer a
						LEFT JOIN ps_orders b ON b.id_customer = a.id_customer
						AND b.valid = 1
						AND b.current_state = 4
						LEFT JOIN osa_history c ON a.id_customer = c.id_customer
						GROUP BY
							a.id_customer
					) mya
				WHERE
					allnum >= 2
				ORDER BY
					allnum DESC ) myb ";
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list[0]['num'];
		}
		return array();		
	}
	
	public static function getCustomerByKeyword($keyword) {
		
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "select id_customer,email,date_add,concat(firstname,'.',lastname) as 
		cname from  ps_customer where email=  '".$keyword."' ";
		$list = $db->query($sql)->fetchAll();
	
		if ($list) {
			return $list;
		}
		return array();		
	}
	
	
	public static function getCustomerContent($id_customer) {
		
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT
				  a.id_customer,
				  a.email,
				  CONCAT(b.firstname,'.',b.lastname) as cname ,
				  CONCAT(b.address1,'.',b.address2) as address,
				  IF(b.phone='' or b.phone_mobile='' , IF(b.phone='',b.phone_mobile,b.phone), 
						CONCAT(b.phone,'||',b.phone_mobile)) as phone ,
				  a.birthday,
				  c.level,c.race,c.job,c.account,c.note,c.facebook,c.twitter,c.pinterest,c.google

				FROM
					ps_customer a 
				LEFT JOIN  ps_address  b on a.id_customer=b.id_customer
				LEFT JOIN  osa_customer_extra c  on a.id_customer=c.id_customer
				WHERE
					a.id_customer = $id_customer

				GROUP BY a.id_customer  ";
	
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
	
	
	
	public static function getCustomerOrderList($id_customer) {
		
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "select id_order,date_add   from ps_orders  where id_customer=$id_customer  ";
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
	
	
	
	public static function getCustomerOrderDetail($id_order) {
		
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT
					a.id_order,
					a.total_paid,
					a.total_shipping,
					e.`code`,
					a.total_discounts,
					a.payment,
					c.product_name,
					b.`name`,
				  a.date_add
				FROM
					ps_orders a
				LEFT JOIN ps_order_state_lang b on a.current_state=b.id_order_state and b.id_lang= 1
				LEFT JOIN  ps_order_detail  c on a.id_order = c.id_order
				LEFT JOIN  ps_cart_cart_rule  d  on  a.id_order = d.id_cart
				LEFT JOIN  ps_cart_rule  e  on  d.id_cart_rule=e.id_cart_rule

				where a.id_order =$id_order  ";
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
	
	public static function getCustomerRemindList($id_customer) {
		
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "select *   from osa_customer_special  where id_customer=$id_customer  ";
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
	
	public static function getCustomerHistoryList($id_customer) {
		
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "select *   from osa_history  where id_customer=$id_customer  ";
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
	
	
	
	public static function insertCustomerRemind($id_customer,$content,$date_end,$actor) {
		
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "INSERT INTO `osa_customer_special` (`id_customer`,`content`,`date_end`,
					`date_add`,`actor`)
				VALUES
					('$id_customer','$content','$date_end',now(),'$actor');";
		$sqlhistory = "INSERT INTO `osa_history` (`id_customer`,`action_type`,`content`,`actor`,`date`)
			VALUES
				('$id_customer','special','增加一条提醒事件','$actor',now());";
		$list = $db->query($sql);
		$list = $db->query($sqlhistory);
		if ($list) {
			return $list;
		}
		return array();		
	}
	
	
	
	public static function insertCustomerMessage($id_customer,$level,$race,$job,$account,$note,$actor,
	$facebook,$twitter,$pinterest,$google) 
	{
		//更新客户的额外信息
		// c.level,c.race,c.job,c.account,c.note
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);
		$sqlquery ="select id_customer from   osa_customer_extra where id_customer = $id_customer";
		
		$num = $db->query($sqlquery)->fetchAll();
	    if($num){
			$sql = "update  osa_customer_extra 
					set `level` = '$level',race='$race' ,job= '$job', account='$account',  note='$note', facebook='$facebook',  twitter='$twitter',  pinterest='$pinterest',  google='$google', date_upd=now()
					where  id_customer= $id_customer
					";
			$sqlhistory = "INSERT INTO `osa_history` (`id_customer`,`action_type`,`content`,`actor`,`date`)
				VALUES
					('$id_customer','message','插入level: ($level),race：($race),facebook($facebook),twitter($twitter),pinterest($pinterest),google($google),note: ($note)','$actor',now());";
			$list = $db->query($sql)or die('插入记录出错<br>'.$sql);
			$list = $db->query($sqlhistory) or die('插入日志出错<br>'.$sqlhistory);			
			
		}else{
			
			$sql = "insert  into  osa_customer_extra 
			(`id_customer`,`level`,`race`,`job`,`account`,`note`,`facebook`,`twitter`,`pinterest`,`google`,`date_add`,`date_upd`)
			value ('$id_customer','$level','$race','$job','$account','$note','$facebook','$twitter','$pinterest','$google',now(),now())";
				
			$sqlhistory = "INSERT INTO `osa_history` (`id_customer`,`action_type`,`content`,`actor`,`date`)
				VALUES
					('$id_customer','message','插入level: ($level),race：($race),facebook($facebook),twitter($twitter),pinterest($pinterest),google($google),note: ($note)','$actor',now());";
			$list = $db->query($sql)or die('插入记录出错<br>'.$sql);
			$list = $db->query($sqlhistory) or die('插入日志出错<br>'.$sqlhistory);
			
		}

	
		if ($list) {
			return $list;
		}
		return array();		
	}
}
