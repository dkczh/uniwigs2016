<?php
if (!defined('ACCESS')) {exit('Access denied.');}

class Cremind extends CremindBase
{
	

	public static function getBirsthdayRemind($day=null,$outtime=false) {
		
		$db = self::__instance();
		
		$tsql = 'SELECT
					id_customer,email ,birthday,
				right(birthday,5)  cbirth,
				right(DATE_ADD(CURDATE(), INTERVAL 7 DAY),5) nday
				FROM
					ps_customer
				WHERE
					right(birthday,5)  = right(DATE_ADD(CURDATE(), INTERVAL '.$day.' DAY),5)';
		//获取7天内 当前所有有效的 生日 老客户
		$sql = "select * from 
(
SELECT
				a.id_customer,a.email ,a.birthday,
			right(a.birthday,5)  cbirth,
      right(CURDATE(),5)  nday,
			right(DATE_ADD(CURDATE(), INTERVAL $day  DAY),5) lday,
			datediff(CONCAT(left(CURDATE(),4),'-',right(a.birthday,5)),CURDATE()) as num,
			count(b.id_order) as allnum
			FROM
				ps_customer  a
			LEFT JOIN ps_orders  b  on  b.id_customer=a.id_customer 
			and b.valid=1
			and b.current_state=4
			LEFT JOIN osa_history c  on a.id_customer= c.id_customer 
			WHERE
			right(a.birthday,5)   BETWEEN    right(CURDATE(),5) and   right(DATE_ADD(CURDATE(), INTERVAL $day  DAY),5) 
			and  a.birthday != '0000-00-00' 
			and c.action_type is null 
GROUP BY a.id_customer 
ORDER by  cbirth  
) mya 
where allnum >=2
";		

	//获取超期无效老客户生日提醒
	if($outtime){
		
		$sql="select * from 
				(
				SELECT
								a.id_customer,a.email ,a.birthday,
							right(a.birthday,5)  cbirth,
					  right(CURDATE(),5)  nday,
							datediff(CURDATE(),CONCAT(left(CURDATE(),4),'-',right(a.birthday,5))) as num,
							count(b.id_order) as allnum
							FROM
								ps_customer  a
							LEFT JOIN ps_orders  b  on  b.id_customer=a.id_customer 
							and b.valid=1
							and b.current_state=4
							LEFT JOIN osa_history c  on a.id_customer= c.id_customer 
							WHERE
							right(birthday,5)  <   right(CURDATE(),5) 
							and  a.birthday != '0000-00-00' 
							and c.action_type is null 
				GROUP BY a.id_customer 
				ORDER by  cbirth  
				) mya 
				where allnum >=2
				order by num asc

				;";
		
		
	}
		
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
	
	
	
	public static function insertBirthdayHistory($id_customer,$user_name) {

		$db = self::__instance();
		
		$sql = "INSERT INTO `osa_history` (
							`id_customer`,
							`action_type`,
							`content`,
							`actor`,
							`date`
						)
						VALUES
							(
								'$id_customer',
								'birthday',
								'xxx',
								'$user_name',
								now()
							);

						";
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
	
	
	
	
	public static function getAllTimeRemind() {
		//获取所有未维护客户
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT * from (
				select mya.*,myb.action_type,
				LEFT(myb.date,10) cdate,
				myc.time,
				DATE_ADD(LEFT(myb.date,10),INTERVAL myc.time day) as aldate,
				LEFT(NOW(),10) ndate,
				DATEDIFF(DATE_ADD(LEFT(myb.date,10),INTERVAL myc.time day),LEFT(NOW(),10)) as mdate


				from 
				(
				SELECT
							a.id_customer,a.email ,
								
							count(b.id_order) as allnum
							FROM
								ps_customer  a
							LEFT JOIN ps_orders  b  on  b.id_customer=a.id_customer and b.valid=1 and b.current_state=4
						

				GROUP BY a.id_customer 

				) mya 
				LEFT JOIN  (SELECT * from  osa_history order by date desc)  myb  on  mya.id_customer=myb.id_customer
				LEFT JOIN  osa_customer_time  myc  on  myc.id_customer= mya.id_customer


				where mya.allnum >2
				group by  mya.id_customer 
				ORDER BY  mya.allnum desc
				)myall where  action_type is  null 
				";
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
	
	public static function getcTimeRemind() {
		//获取所有已维护客户
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT * from (
				select mya.*,myb.action_type,
				LEFT(myb.date,10) cdate,
				myc.time,
				DATE_ADD(LEFT(myb.date,10),INTERVAL myc.time day) as aldate,
				LEFT(NOW(),10) ndate,
				DATEDIFF(DATE_ADD(LEFT(myb.date,10),INTERVAL myc.time day),LEFT(NOW(),10)) as mdate


				from 
				(
				SELECT
							a.id_customer,a.email ,
								
							count(b.id_order) as allnum
							FROM
								ps_customer  a
							LEFT JOIN ps_orders  b  on  b.id_customer=a.id_customer and b.valid=1 and b.current_state=4
						

				GROUP BY a.id_customer 

				) mya 
				LEFT JOIN  (SELECT * from  osa_history order by date desc)  myb  on  mya.id_customer=myb.id_customer
				LEFT JOIN  osa_customer_time  myc  on  myc.id_customer= mya.id_customer


				where mya.allnum >2
				group by  mya.id_customer 
				ORDER BY  mya.allnum desc
				)myall where  action_type is not  null 
				and  mdate >=0
				";
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
	
	
	public static function getcOutTimeRemind() {
		//获取所有超期维护客户
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT * from (
				select mya.*,myb.action_type,
				LEFT(myb.date,10) cdate,
				myc.time,
				DATE_ADD(LEFT(myb.date,10),INTERVAL myc.time day) as aldate,
				LEFT(NOW(),10) ndate,
				DATEDIFF(DATE_ADD(LEFT(myb.date,10),INTERVAL myc.time day),LEFT(NOW(),10)) as mdate


				from 
				(
				SELECT
							a.id_customer,a.email ,
								
							count(b.id_order) as allnum
							FROM
								ps_customer  a
							LEFT JOIN ps_orders  b  on  b.id_customer=a.id_customer and b.valid=1 and b.current_state=4
						

				GROUP BY a.id_customer 

				) mya 
				LEFT JOIN  (SELECT * from  osa_history order by date desc)  myb  on  mya.id_customer=myb.id_customer
				LEFT JOIN  osa_customer_time  myc  on  myc.id_customer= mya.id_customer


				where mya.allnum >2
				group by  mya.id_customer 
				ORDER BY  mya.allnum desc
				)myall where  action_type is not  null 
				and  mdate <0
				";
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
	public static function insertcTimeHistory($id_customer,$content,$user) {
		//增加time 维护记录
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "INSERT INTO `osa_history` (`id_customer`,`action_type`,`content`,`actor`,`date`)
			VALUES
				('$id_customer','time','$content','$user',now());";
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
	
	
	
	
	
	
	public static function getSpecialRemind() {
		//获取所有特殊提醒 未超期的
		$columns = 'id_special,id_customer,content,date_end';
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT
	a.*, o.email,
	LEFT (NOW(), 10) ndate,
	DATEDIFF(
		LEFT (a.date_end, 10),
		LEFT (NOW(), 10)
	) AS mdate
FROM
	osa_customer_special a
LEFT JOIN ps_customer o ON a.id_customer = o.id_customer

ORDER BY  mdate  desc 
";
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
	
	
	public static function getRefundRemind() {
		//获取退货30天未做回访记录
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "
SELECT * from (
SELECT
	a.id_order,
  a.id_customer,
	b.email,
  oh.content,
	LEFT (NOW(), 10) ndate,
  LEFT (a.date_upd,10) ldate,
  DATEDIFF(LEFT (NOW(), 10),LEFT (DATE_ADD(a.date_upd, INTERVAL 30 day),10)) as mdate
FROM
	ps_orders a
LEFT JOIN ps_customer b ON a.id_customer = b.id_customer
LEFT JOIN  osa_history oh  on b.id_customer = oh.id_customer
WHERE
	a.current_state = 7 and oh.content is  null 
) mya 
 where mya.mdate >0  and mya.id_customer in (SELECT myb.id_customer from (
SELECT id_customer ,count(id_order) as num  
from 

ps_orders 

GROUP BY id_customer 
)myb  where myb.num >=2 and myb.id_customer >0
)
";
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
	
	
		public static function getexchangeRemind() {
		//获取换货40天未做回访记录
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT * from (
SELECT
	a.id_order,
  a.id_customer,
	b.email,
  oh.content,
	LEFT (NOW(), 10) ndate,
  LEFT (a.date_upd,10) ldate,
  DATEDIFF(LEFT (NOW(), 10),LEFT (DATE_ADD(a.date_upd, INTERVAL 40 day),10)) as mdate
FROM
	ps_orders a
LEFT JOIN ps_customer b ON a.id_customer = b.id_customer
LEFT JOIN  osa_history oh  on b.id_customer = oh.id_customer
WHERE
	a.current_state = 14 and oh.content is  null 
) mya 
 where mya.mdate >0 and mya.id_customer in (SELECT myb.id_customer from (
SELECT id_customer ,count(id_order) as num  
from 

ps_orders 

GROUP BY id_customer 
)myb  where myb.num >=2 and myb.id_customer >0
)
";
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
	 
	public static function insertcRefundHistory($id_customer,$content,$user) {
		//增加time 维护记录
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "INSERT INTO `osa_history` (`id_customer`,`action_type`,`content`,`actor`,`date`)
			VALUES
				('$id_customer','refund','$content','$user',now());";
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}

	
}
