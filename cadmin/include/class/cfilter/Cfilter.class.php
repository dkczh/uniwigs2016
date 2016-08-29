<?php
if (!defined('ACCESS')) {exit('Access denied.');}

class Cfilter extends CfilterBase
{
	
	public static function getcState() {
		//获取美国所有的州
	
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "SELECT  CONCAT('<option value=\"',id_state,'\">',NAME,'</option>') AS state
				FROM
					ps_state
				WHERE
					id_country = 21";
	
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
	
	public static function getcQuery($fcategory,$scategory,$cnum,$camount,$cstate) {
		//筛选查询
		$db = self::__instance();
	/* 	echo $fcategory.'<br>';
		echo $scategory.'<br>';
		echo $cnum.'<br>';
		echo $camount.'<br>';
		echo $cstate.'<br>';
		exit; */
		if($fcategory=='-1'&&$scategory=='-1'){
			//所有类下产品
			$sql = "
				SELECT * from (
				SELECT *,count(mya.id_order) cnum ,sum(mya.total_paid) camount  from (
				SELECT
				  c.id_order,
				  c.total_paid,
				  d.id_customer,
				  d.email,
				  e.id_state,
				  f.name
				FROM
					ps_category_product a
				LEFT JOIN ps_order_detail b ON a.id_product = b.product_id
				LEFT JOIN ps_orders c ON b.id_order = c.id_order
				LEFT JOIN ps_customer d ON c.id_customer = d.id_customer
				LEFT JOIN ps_address e on d.id_customer=e.id_customer 
				LEFT JOIN ps_state f on e.id_state=f.id_state
				WHERE
				b.id_order IS NOT NULL
				and e.id_state  in (SELECT id_state from  ps_state  where id_country = 21)
				GROUP BY
					c.id_order
				)mya 

				GROUP BY  mya.id_customer
				) myb  
				where myb.cnum =$cnum and myb.camount>=$camount  ";	
		}elseif($scategory=='-1' && $fcategory!='-1'){
			//指定某个大类下的产品
			$sql = "
				SELECT * from (
				SELECT *,count(mya.id_order) cnum ,sum(mya.total_paid) camount  from (
				SELECT
				  c.id_order,
				  c.total_paid,
				  d.id_customer,
				  d.email,
				  e.id_state,
				  f.name
				FROM
					ps_category_product a
				LEFT JOIN ps_order_detail b ON a.id_product = b.product_id
				LEFT JOIN ps_orders c ON b.id_order = c.id_order
				LEFT JOIN ps_customer d ON c.id_customer = d.id_customer
				LEFT JOIN ps_address e on d.id_customer=e.id_customer 
				LEFT JOIN ps_state f on e.id_state=f.id_state
				WHERE
					a.id_category = $fcategory
				AND b.id_order IS NOT NULL
				and e.id_state  in (SELECT id_state from  ps_state  where id_country = 21)
				GROUP BY
					c.id_order
				)mya 

				GROUP BY  mya.id_customer
				) myb  
				where myb.cnum =$cnum and myb.camount>=$camount  ";	
			
	
		}else{
			$sql = "
				SELECT * from (
				SELECT *,count(mya.id_order) cnum ,sum(mya.total_paid) camount  from (
				SELECT
				  c.id_order,
				  c.total_paid,
				  d.id_customer,
				  d.email,
				  e.id_state,
				  f.name
				FROM
					ps_category_product a
				LEFT JOIN ps_order_detail b ON a.id_product = b.product_id
				LEFT JOIN ps_orders c ON b.id_order = c.id_order
				LEFT JOIN ps_customer d ON c.id_customer = d.id_customer
				LEFT JOIN ps_address e on d.id_customer=e.id_customer 
				LEFT JOIN ps_state f on e.id_state=f.id_state
				WHERE
					a.id_category = $scategory
				AND b.id_order IS NOT NULL
				and e.id_state  in (SELECT id_state from  ps_state  where id_country = 21)
				GROUP BY
					c.id_order
				)mya 

				GROUP BY  mya.id_customer
				) myb  
				where myb.cnum =$cnum and myb.camount>=$camount  ";				
			
		}
		
		if($cstate != '-1'){
				$sql.="and myb.id_state =$cstate";
		}
		
		$sql.="  order by myb.camount desc  limit 0,100";
	/* 	echo $sql;
		exit; */
	
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list;
		}
		return array();		
	}
	

	public static function getCustomerListNum() {
		
		$db = self::__instance();
		// $db = self::__instance(SAMPLE_DB_ID);

		$sql = "select count(*) as num  from ps_customer   ";
		$list = $db->query($sql)->fetchAll();
		if ($list) {
			return $list[0]['num'];
		}
		return array();		
	}
	
	
	

	

	
}
