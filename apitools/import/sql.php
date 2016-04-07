<?php
/*
* AUTHOR  DKC 
*
* ps_attribute  功能二次 开发
* 所有表结果 全部 asc 排序
* 所有更新记录全部存放在  log 目录下面 各表对应各名称文件
*/
	set_time_limit (0);


	$id = $_GET['id'];

	// BBBBBBBB 
	//define('PX_NEWDB', 'prestashop-run');
	//define('PX_NEWDB', 'dev_uniwigs_pshop1.3_online_2015.07.07');
	

	define('PX_NEWDB', 'uniwigs2016test');
	define('PX_OLDDB', 'ps1.3');


	define('PX_SHOP', 3); //产品shop 多少个 设置为3  商店有2个
	define('PX_DEFAULT_SHOP', 1); //某些表需要制定默认店铺 id 
	
	//$newdb = 'prestashop16';   //以 ps16为基准 对比1.3之间的不同
	//$olddb = 'ps1.3';

	header('Content-Type: text/html; charset=utf-8'); //网页编码
	$dsn = 'mysql:host=localhost;dbname='.PX_OLDDB;  
	$dsn2 = 'mysql:host=localhost;dbname='.PX_NEWDB; 
	
    $user = 'root';  
    $pwd = 'root';
    //$pwd = '';  

    $db = pdo_conn($dsn,$user,$pwd);  
    /*	echo getsqlnum('ps_customer',$db);
    exit();*/
	$db2 =pdo_conn($dsn2,$user,$pwd);  

	
	switch ($id) {
		case 1:
			 update_tag($db,$db2);
			break;
		case 2:
			update_product_tag($db,$db2);
			break;
		case 3:
			update_customer_group($db,$db2);
			break;
		case 4:
			update_customer($db,$db2);
			break;
		case 5:
			update_group($db,$db2);
			break;
		case 6:
			update_tabel($db,$db2,'ps_group_lang');
			break;
		case 7:
			update_tabel($db,$db2,'ps_attribute_lang');	
			break;
		case 8:
			update_tabel($db,$db2,'ps_attribute_impact');
			break;	
		case 9:
			update_tabel($db,$db2,'ps_attribute_group_lang');
			break;
		case 10:	
			update_attribute_group($db,$db2);
			break;
		case 11:
			update_attribute($db,$db2);
			break;
		case 12:
			update_address($db,$db2);
			break;
		case 13:
			update_tabel($db,$db2,'ps_message');
			break;
		case 14:
			update_tabel($db,$db2,'ps_message_readed');
			break;
		case 15:
			update_tabel($db,$db2,'ps_carrier_group');
			break;
		case 16:
			update_tabel($db,$db2,'ps_carrier_zone');
			break;
		case 17:
			update_carrier_lang($db,$db2);
			break;
		case 18:
			update_carrier_shop($db,$db2);
			break;	
		case 19:
			update_carrier($db,$db2);
			break;
		case 20:
			update_carrier_tax_rules_group_shop($db,$db2);
			break;
		case 21:
			update_cart_product($db,$db2);
			break;
		case 22:
			update_tabel($db,$db2,'ps_order_history');
			break;
		case 23:
			update_tabel($db,$db2,'ps_order_state_lang');
			break;
		case '24':
			update_order_state($db,$db2);
			break;
		case '25':
			update_order_detail($db,$db2);
			break;
		case '26':
			update_orders($db,$db2);
			break;
		case '27':
			update_tabel($db,$db2,'ps_wishlist_product');
			break;
		case '28':
			update_wishlist($db,$db2);
			break;
		case '29':
			update_tabel($db,$db2,'ps_product_sale');
			break;
		case '30':
			update_product_lang($db,$db2);
			break;
		case '31':
			update_tabel($db,$db2,'ps_product_attribute_image');
			break;
		case '32':
			update_tabel($db,$db2,'ps_product_attribute_combination');
			break;
		case '33':
			update_product_attribute($db,$db2);
			break;
		case '34':
			update_tabel($db,$db2,'ps_category_product');
			break;
		case '35':
			update_tabel($db,$db2,'ps_feature_product');
			break;
		case '36':
			update_product_attribute_shop($db,$db2);
			break;
		case '37':
			update_product($db,$db2);
			break;
		case '38':
			update_product_shop($db,$db2);
			break;
		case '39':
			update_category_lang($db,$db2);
			break;
		case '40':
			update_category_shop($db,$db2);
			break;
		case '41':
			update_tabel($db,$db2,'ps_category_group');
			break;
		case '42':
			update_category($db,$db2);
			break;
		case '43':
			update_stock_available($db,$db2);
			break;
		case '44':
			update_attribute_shop($db,$db2);
			break;
		case '45':
			update_attribute_group_shop($db,$db2);
			break;
		case '46':
			update_image($db,$db2);
			break;
		case '47':
			update_tabel($db,$db2,'ps_image_lang');
			break;
		case '48':
			update_image_shop($db,$db2);
			break;
		default:
			
			break;
	}
	
	
  
/*-------------------tag编辑功能相关表更新 begin---------------------------------*/
	//讲1.3  ps_tag 字段迁移到 1.6 对应的  ps_tag和 px_tag_extra 两张表中 skus 
	// skus 字段说明  不存在于1.3版本中	
	function update_tag($db,$db2){


	 $sql = "SELECT * FROM ps_tag  order by id_tag asc  ";   
	      	$res =getall($db,$sql);
			$i =1;
			foreach ($res as $row)
			{  
		       
			 	$id_tag = $row['id_tag'];
			 	$name =$row['name'];
			 	$id_lang=$row['id_lang'];

			 	$template=$row['template'];
				//$skus=$row['skus'];	

			 	$meta_title=$row['meta_title'];
			 	$meta_keywords=$row['meta_keywords'];	
				$meta_description=$row['meta_description'];
				
				$link_rewrite=$row['link_rewrite'];	
					
				$description=$row['description'];	
				$product_type=$row['product_type'];	
				
				
			 	//判断是更新 还是插入
			 	if(checkupdate($db2,'ps_tag','id_tag',$id_tag)){

				$update = "UPDATE ps_tag SET name = '$name',  id_lang= $id_lang where id_tag =$id_tag";
				$db2->exec($update);//返回影响了多少行数

			 	}else{

			 	$insert = "insert into ps_tag (id_tag,id_lang,name) values ($id_tag,1,'$name')";
				$db2->exec($insert);//返回影响了多少行数	
			 	}

				if(checkupdate($db2,'px_tag_extra','id_tag',$id_tag)){

				$update = "UPDATE px_tag_extra SET 
				template = '$template',  
				meta_title='$meta_title',
				meta_keywords='$meta_keywords',
				meta_description='$meta_description',
				link_rewrite='$link_rewrite',
				description='$description',
				product_type='$product_type'	
				where id_tag =$id_tag";


				$db2->exec($update);//返回影响了多少行数
				// echo $update;
				// exit;
			 	}else{

			 	$insert = "insert into px_tag_extra
			 	(id_tag,template,meta_title,meta_keywords,meta_description,link_rewrite,
			 	description,product_type) values 
			 	($id_tag,'$template','$meta_title','$meta_keywords','$meta_description','$link_rewrite','$description','$product_type')";
				$db2->exec($insert);//返回影响了多少行数	
			 	}

				 outlog($id_tag,'ps_tag','id_tag');
				 $i++;
				outbuffer();
	    	}

		echo "1.6版本ps_tag和px_tag_extra更新完毕";
	}



	//1.6 ps_product_tag 不存在主键 每次更新 要清空表 再全部插入 
	function update_product_tag($db,$db2)
	{	
		$clean ="truncate table ps_product_tag";
		$db2->exec($clean);

	 	$sql = "SELECT * FROM  ps_product_tag  order by id_tag asc ";   
		$res =getall($db,$sql);
		$i =1;

		foreach ($res as $row) 
		{
			$id_product = $row['id_product'];
			$id_tag = $row['id_tag'];
			$insert = "insert into ps_product_tag
			 	(id_tag,id_product,id_lang) values 
			 	($id_tag,$id_product,1)";

			$db2->exec($insert);

			 //echo "1.6版本ps_product_tag已经更新到了第".$i."条";
				// outlog($id_tag);
				 $i++;
			outbuffer();

		}
		 echo "1.6版本ps_product_tag更新完毕";

	}


/*-------------------tag编辑功能相关表更新 end---------------------------------*/


/*-------coustomer 用户功能相关表更新 begin---------------------------------*/

	

	//1.6 ps_customer_group 不存在主键 每次更新 要清空表 再全部插入 
	function update_customer_group($db,$db2)
	{	
		$clean ="truncate table ps_customer_group";
		$db2->exec($clean);

	 	$sql = "SELECT * FROM  ps_customer_group  order by id_customer asc  ";   
		$res =getall($db,$sql);
		$i =1;

		foreach ($res as $row) 
		{
			$id_customer = $row['id_customer'];
			$id_group = $row['id_group'];

			$cheeck =checkupdate($db2,'ps_customer_group','id_customer',$id_customer);
			// if ($cheeck) {
			// 	$update = "UPDATE ps_customer_group SET 
			// 	id_group = '$id_group' 	
			// 	where id_customer =$id_customer";

			// 	$db2->exec($update);//返回影响了多少行数

			// }

				$insert = "insert into ps_customer_group
			 	(id_customer,id_group) values 
			 	($id_customer,$id_group)";
				$db2->exec($insert);	

			outlogno($id_customer,'ps_customer_group','id_customer');

			$i++;
			outbuffer();

		}

		 echo "1.6版本ps_customer_group更新完毕";

	}

	//1.6 ps_customer 为保证数据的完整性 每次更新 要清空表 再全部插入 
	function update_customer($db,$db2)
	{		
		$clean ="truncate table ps_customer";
		$db2->exec($clean);

	 	$sql = "SELECT * FROM  ps_customer order by id_customer asc  ";   
		$res =getall($db,$sql);
		$i =1;

		foreach ($res as $row) 
		{
			$id_customer = $row['id_customer'];
			$id_shop     = 1;
			$id_shop_grounp = 1;
			$id_gender = $row['id_gender'];
			$id_default_group = $row['id_default_group'];
			$id_lang =1;
			$firstname = $row['firstname'];
			$lastname = $row['lastname'];
			$email = $row['email'];	
			$passwd = $row['passwd'];
			$last_passwd_gen = $row['last_passwd_gen'];
			$birthday = $row['birthday'];
			$newsletter = $row['newsletter'];
			$ip_registration_newsletter = $row['ip_registration_newsletter'];
			$newsletter_date_add = $row['newsletter_date_add'];
			$active = $row['active'];
			$optin = $row['optin'];
			$secure_key = $row['secure_key'];
			$active = $row['active'];
			$deleted = $row['deleted'];
			$date_add = $row['date_add'];
			$date_upd = $row['date_upd'];	
		

			$insert = "insert into ps_customer
			 	(id_customer,
				id_shop,
				id_shop_group,
				id_gender,
				id_default_group,
				id_lang,
				firstname,
				lastname,
				email,
				passwd,
				last_passwd_gen,
				birthday,
				newsletter,
				ip_registration_newsletter,
				newsletter_date_add,
				optin,
				secure_key,
				active,
				deleted,
				date_add,
				date_upd) 
			 values 
			 	($id_customer,
			 	$id_shop,
			 	$id_shop_grounp,
			 	$id_gender,
			 	$id_default_group,
				$id_lang,
				'$firstname',
				'$lastname',
				'$email',
				'$passwd',
				'$last_passwd_gen',
				'$birthday',
				$newsletter,
				'$ip_registration_newsletter',
				'$newsletter_date_add',
				$optin,
				'$secure_key',
				$active,
			 	$deleted,
			 	'$date_add',
			 	'$date_upd')";

				/*echo $insert;
				exit();*/

				$db2->exec($insert);	
				


			outlog($id_customer,'ps_customer','id_customer');
			 unset($row);


			$i++;
			outbuffer();

		}


		 echo "1.6版本ps_customer_group更新完毕";

	}


	//1.6 ps_group 和 ps_grounp_lang 每次更新 要清空表 再全部插入 
	function update_group($db,$db2)
	{	
		$clean ="truncate table ps_group";
		$db2->exec($clean);

	 	$sql = "SELECT * FROM  ps_group  order by id_group asc ";   
		$res =getall($db,$sql);
		$i =1;

		foreach ($res as $row) 
		{
			$id_group = $row['id_group'];
			$reduction = $row['reduction'];
			$price_display_method = $row['price_display_method'];
			$date_add = $row['date_add'];
			$date_upd = $row['date_upd'];
			
			$insert = "insert into ps_group
			 	(id_group,reduction,price_display_method,date_add,date_upd) values 
			 	($id_group,$reduction,$price_display_method,'$date_add','$date_upd')";

			
			$db2->exec($insert);

			 
				 $i++;
			outbuffer();

		}
		 echo "1.6版本ps_group更新完毕";

	}

	



/*-------------------coustomer 用户功能相关表更新 end--------------------*/


/*--------attribute 产品组合更新 begin-----*/
	function update_attribute($db,$db2)
	{
		$clean ="truncate table ps_attribute";
	
		$db2->exec($clean);
	
		
		
		$sql ="select id_attribute_group  from  ps_attribute  GROUP BY id_attribute_group";
		
		$res =getall($db,$sql);
		
		
		foreach ($res as $a) 
		{	
			
			$id_attribute_group = $a['id_attribute_group'];
			$i =0; 
			$sql2 = "SELECT * FROM  ps_attribute where id_attribute_group = $id_attribute_group order by id_attribute asc ";   
			$res2 =getall($db,$sql2);
				foreach ($res2 as $row) 
				{
					$id_attribute = $row['id_attribute'];
					$id_attribute_group = $row['id_attribute_group'];
					$color = $row['color'];
					
					$insert = "insert into ps_attribute
						(id_attribute,id_attribute_group,color,position) values 
						($id_attribute,$id_attribute_group,'$color',$i)";
					
					$db2->exec($insert);
					
					$i++;
						 
					outbuffer();
				}
			
		
		}
		
	




		echo "1.6版本 ps_attribute 更新完毕";
	}


	function update_attribute_shop($db,$db2)
	{
		
		$clean ="truncate table ps_attribute_shop";
		$db2->exec($clean);
		
		for ($i=1; $i <PX_SHOP ; $i++) { 
			$sql="insert into "."`".PX_NEWDB."`".".ps_attribute_shop (`id_attribute`,
		`id_shop`)   select `id_attribute`,
		  $i

		from `".PX_OLDDB."`.ps_attribute ";
		//更新对应表
		
		$db2->exec($sql)or die('ps_attribute_shop 更新失败');
		}
		
		
		


		echo "1.6版本 ps_attribute_shop 更新完毕";
	}

	function update_attribute_group_shop($db,$db2)
	{
		
		$clean ="truncate table ps_attribute_group_shop";
		$db2->exec($clean);
		
		for ($i=1; $i <PX_SHOP ; $i++) { 
			$sql="insert into "."`".PX_NEWDB."`".".ps_attribute_group_shop (`id_attribute_group`,
		`id_shop`)   select `id_attribute_group`,
		  $i

		from `".PX_OLDDB."`.ps_attribute_group ";
		//更新对应表
		
		$db2->exec($sql)or die('ps_attribute_group_shop 更新失败');
		}
		
		
		


		echo "1.6版本 ps_attribute_group_shop 更新完毕";
	}



	function update_attribute_group($db,$db2)
	{
		$clean ="truncate table ps_attribute_group";
	
		$db2->exec($clean);
	
		
		$sql = "SELECT * FROM  ps_attribute_group  order by id_attribute_group asc ";   
		$res =getall($db,$sql);
		$i =0;
		foreach ($res as $row) 
		{
			$id_attribute_group = $row['id_attribute_group'];
			$is_color_group = $row['is_color_group'];
			$position =$i;
			
			$insert = "insert into ps_attribute_group
			 	(id_attribute_group,is_color_group,position) values 
			 	($id_attribute_group,$is_color_group,$position)";
		
			
			$db2->exec($insert);
			

			 
				 $i++;

			outbuffer();

		}

		echo "1.6版本 ps_attribute_group 更新完毕";
	}

/*--------attribute 产品组合更新 end-----*/

/*--------address 地址更新 begin-----*/
	function update_address($db,$db2)
		{	
			//初始化 ps1.6 数据库的表
			$clean ="truncate table ps_address";
			$db2->exec($clean);

			$sql="insert into "."`".PX_NEWDB."`".".ps_address (`id_address`,`id_country`,
			`id_state`,`id_customer`,`id_manufacturer`,`id_supplier`,`alias`,`company`,`lastname`,`address1`,`address2`,`postcode`,`city`,`other`,`phone`,`phone_mobile`,`date_add`,`date_upd`,`active`,`deleted`) select 
			`id_address`,`id_country`,
			`id_state`,`id_customer`,`id_manufacturer`,`id_supplier`,`alias`,`company`,`lastname`,`address1`,`address2`,`postcode`,`city`,`other`,`phone`,`phone_mobile`,`date_add`,`date_upd`,`active`,`deleted`
			 from  `".PX_OLDDB."`.ps_address";

			//更新对应表
			$db2->exec($sql)or die('ps_address 更新失败');
			
			echo "1.6版本 ps_address更新完毕";

		}


/*--------address 地址更新 end-----*/

/*--------carrier 运输更新 begin-----*/


function update_carrier_lang($db,$db2)
	{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_carrier_lang";
		$db2->exec($clean);	

		$lang = "select id_lang from ps_lang";
		$res =getall($db2,$lang);	
		foreach ($res as $a) {
			$lang = $a['id_lang'];

		//更新对应表
		$sql="insert into "."`".PX_NEWDB."`".".ps_carrier_lang (`id_carrier`,`id_shop`,`id_lang`,`delay`)  select  `id_carrier`,1,$lang,`delay`  from `".PX_OLDDB."`.ps_carrier_lang";

		//checksql($sql);
		$db2->exec($sql)or die('ps_carrier_lang 更新失败');
		}

		 echo "1.6版本 ps_carrier_lang 更新完毕";

	}

	function update_carrier_shop($db,$db2)
	{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_carrier_shop";
		$db2->exec($clean);
		
		for ($i=1; $i <PX_SHOP ; $i++) { 
			$sql="insert into "."`".PX_NEWDB."`".".ps_carrier_shop (`id_carrier`,`id_shop`)   select  `id_carrier`,$i  from `".PX_OLDDB."`.ps_carrier";
		//更新对应表
		$db2->exec($sql)or die('ps_carrier_shop 更新失败');
		}
		
		
		 echo "1.6版本 ps_carrier_shop 更新完毕";

	}
		function update_carrier($db,$db2)
	{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_carrier";
		$db2->exec($clean);
		
		$sql="insert into "."`".PX_NEWDB."`".".ps_carrier (`id_carrier`,`id_reference`,`name`,`url`,`active`,`deleted`,`shipping_handling`,`range_behavior`,`is_module`)   select  `id_carrier`,`id_carrier`,`name`,`url`,`active`,`deleted`,`shipping_handling`,`range_behavior`,`is_module`  from `".PX_OLDDB."`.ps_carrier";
		//更新对应表
		$db2->exec($sql)or die('ps_carrier 更新失败');
		
		 echo "1.6版本 ps_carrier 更新完毕";

	}
	
		function update_carrier_tax_rules_group_shop($db,$db2)
	{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_carrier_tax_rules_group_shop";
		$db2->exec($clean);
		
		$sql="insert into "."`".PX_NEWDB."`".".ps_carrier_tax_rules_group_shop (`id_carrier`,`id_tax_rules_group`,`id_shop`)   select  `id_carrier`,0,1  from `".PX_OLDDB."`.ps_carrier";
		//更新对应表
		$db2->exec($sql)or die('ps_carrier_tax_rules_group_shop 更新失败');
		
		 echo "1.6版本 ps_carrier_tax_rules_group_shop 更新完毕";

	}

/*--------carrier 运输更新 end-----*/

/*--------cart 购物车更新 begin-----*/

	function update_cart_product($db,$db2)
	{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_cart_product";
		$db2->exec($clean);
		$cleanonly ="
		delete from ps_cart_product where id_cart 
		not in 
		( select * from (select max(id_cart) from ps_cart_product group by id_cart having count(id_cart)>1) b );";
		$sql="insert into "."`".PX_NEWDB."`".".ps_cart_product (`id_cart`,`id_product`,`id_address_delivery`,`id_shop`,`id_product_attribute`,`quantity`,`date_add`)   select  `id_cart`,`id_product`,0,1,`id_product_attribute`,`quantity`,`date_add`  from `".PX_OLDDB."`.ps_cart_product GROUP BY id_cart";
		//更新对应表
		//$db->exec($cleanonly);
		$db2->exec($sql)or die('ps_cart_product 更新失败');
		
		 echo "1.6版本 ps_cart_product 更新完毕";

	}
/*--------cart 购物车更新 end-----*/

/*--------order 订单更新 begin-----*/
	function update_order_state($db,$db2)
	{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_order_state";
		$db2->exec($clean);
		
		$sql="insert into "."`".PX_NEWDB."`".".ps_order_state (`id_order_state`,`invoice`,`send_email`,`color`,`unremovable`,`hidden`,`logable`,`delivery`)   select  `id_order_state`,`invoice`,`send_email`,`color`,`unremovable`,`hidden` ,`logable`,`delivery` from `".PX_OLDDB."`.ps_order_state ";
		//更新对应表
		
		$db2->exec($sql)or die('ps_order_state 更新失败');
		
		 echo "1.6版本 ps_order_state 更新完毕";

	}

	function update_order_detail($db,$db2)
	{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_order_detail";
		$db2->exec($clean);
		
		$sql="insert into "."`".PX_NEWDB."`".".ps_order_detail (`id_order_detail`,`id_order`,`id_shop`,`product_id`,`product_attribute_id`,`product_name`,`product_quantity`,`product_quantity_in_stock`,`product_quantity_refunded`,`product_quantity_return`,`product_quantity_reinjected`,`product_price`,`reduction_percent`,`reduction_amount`,`product_quantity_discount`,`product_ean13`,`product_reference`,`product_supplier_reference`,`product_weight`,`tax_name`,`tax_rate`,`ecotax`,`discount_quantity_applied`,`download_hash`,`download_nb`,`download_deadline`,`total_price_tax_incl`,`total_price_tax_excl`,`unit_price_tax_incl`,`unit_price_tax_excl`,`original_product_price`)  
		 select  `id_order_detail`,`id_order`,1,`product_id`,`product_attribute_id`,`product_name` ,`product_quantity`,`product_quantity_in_stock`,`product_quantity_refunded`,`product_quantity_return`,`product_quantity_reinjected`,`product_price`,`reduction_percent`,`reduction_amount`,`product_quantity_discount`,`product_ean13`,`product_reference`,`product_supplier_reference`,`product_weight`,`tax_name`,`tax_rate`,`ecotax`,`discount_quantity_applied`,`download_hash`,`download_nb`,`download_deadline`,`product_price`,`product_price`,`product_price`,`product_price`,`product_price` 
		from `".PX_OLDDB."`.ps_order_detail ";
		//更新对应表
		
		$db2->exec($sql)or die('ps_order_detail 更新失败');
		
		 echo "1.6版本 ps_order_detail 更新完毕";

	}

	function update_orders($db,$db2)
	{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_orders";
		$db2->exec($clean);
		
		$sql="insert into "."`".PX_NEWDB."`".".ps_orders 
		(`id_order`,
		`id_carrier`,
		`id_lang`,
		`id_customer`,
		`id_cart`,
		`id_currency`,
		`id_address_delivery`,
		`id_address_invoice`,
		`secure_key`,
		`payment`,
		`module`,
		`recyclable`,
		`gift`,
		`gift_message`,
		`shipping_number`,
		`total_discounts`,
		`total_discounts_tax_incl`,
		`total_discounts_tax_excl`,
		`total_paid`,
		`total_paid_tax_incl`,
		`total_paid_tax_excl`,
		`total_paid_real`,
		`total_products`,
		`total_products_wt`,
		`total_shipping`,
		`total_shipping_tax_incl`,
		`total_shipping_tax_excl`,
		`total_wrapping`,
		`total_wrapping_tax_incl`,
		`total_wrapping_tax_excl`,
		`invoice_number`,
		`delivery_number`,
		`invoice_date`,
		`delivery_date`,
		`valid`,
		`date_add`,
		`date_upd`)  
		 select  
		 	`id_order`,
		 	`id_carrier`,
		 	`id_lang`,
		 	`id_customer`,
		 	`id_cart`,
		 	`id_currency` ,
		 	`id_address_delivery`,
		 	`id_address_invoice`,
		 	`secure_key`,
		 	`payment`,
		 	`module`,
		 	`recyclable`,
		 	`gift`,
		 	`gift_message`,
		 	`shipping_number`,
		 	`total_discounts`,
		 	`total_discounts`,
		 	`total_discounts`,
		 	`total_paid`,
		 	`total_paid`,
		 	`total_paid`,
		 	`total_paid_real`,
		 	`total_products`,
		 	`total_products_wt`,
		 	`total_shipping`,
		 	`total_shipping`,
		 	`total_shipping`,
		 	`total_wrapping`,
		 	`total_wrapping`,
		 	`total_wrapping`,
		 	`invoice_number`,
		 	`delivery_number`,
		 	`invoice_date`,
		 	`delivery_date`,
		 	`valid`,
		 	`date_add`,
		 	`date_upd`
		  from `".PX_OLDDB."`.ps_orders ";
		//更新对应表
		
		$db2->exec($sql)or die('ps_orders更新失败');
		
		 echo "1.6版本 ps_orders 更新完毕";

	}




/*--------order 订单更新 end-----*/

/*--------wishlist 愿望清单更新 begin-----*/

	function update_wishlist($db,$db2)
	{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_wishlist";
		$db2->exec($clean);
		
		$sql="insert into "."`".PX_NEWDB."`".".ps_wishlist (`id_wishlist`,`id_customer`,`token`,`name`,`counter`,`date_add`,`date_upd`)   select  `id_wishlist`,`id_customer`,`token`,`name`,`counter`,`date_add` ,`date_upd` from `".PX_OLDDB."`.ps_wishlist ";
		//更新对应表
		
		$db2->exec($sql)or die('ps_wishlist 更新失败');
		
		 echo "1.6版本 ps_wishlist 更新完毕";

	}


/*--------wishlist 愿望清单更新 end-----*/


/*--------product 产品更新 begin-----*/
	function update_product_lang($db,$db2)
	{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_product_lang";
		$db2->exec($clean);
		
		
		for ($i=1; $i <PX_SHOP ; $i++) { 
			$sql="insert into "."`".PX_NEWDB."`".".ps_product_lang (`id_product`,`id_shop`,`id_lang`,`description`,`description_short`,`link_rewrite`,`meta_description`,`meta_keywords`,`meta_title`,`name`,`available_now`,`available_later`)   select  `id_product`,$i,`id_lang`,`description`,`description_short`,`link_rewrite`,`meta_description` ,`meta_keywords`,`meta_title`,`name`,`available_now`,`available_later`  from `".PX_OLDDB."`.ps_product_lang ";
		//更新对应表
		
		$db2->exec($sql)or die('ps_product_lang 更新失败');
		}
		
		


		 echo "1.6版本 ps_product_lang 更新完毕";

	}

	function update_product_attribute($db,$db2)
	{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_product_attribute";
		$db2->exec($clean);
		

		
		//此表 迁移 需要先将 产品的 默认 default on为1 的组合迁移过去 再迁移其他的
		$sql="insert ignore into "."`".PX_NEWDB."`".".ps_product_attribute (
		`id_product_attribute`,
		`id_product`,
		`reference`,
		`supplier_reference`,
		`location`,
		`ean13`,
		`wholesale_price`,
		`price`,
		`ecotax`,
		`quantity`,
		`weight`,
		`default_on`
		)   select  `id_product_attribute`,`id_product`,`reference`,`supplier_reference`,`location`,`ean13`,`wholesale_price`,`price`,`ecotax`,`quantity`,`weight`,`default_on`  from `".PX_OLDDB."`.ps_product_attribute  where default_on =1";
		//更新 产品的 默认组合之外的其他组合 过去  并将 default_on 设置为 默认  null 
			$sql2="insert ignore into "."`".PX_NEWDB."`".".ps_product_attribute (
		`id_product_attribute`,
		`id_product`,
		`reference`,
		`supplier_reference`,
		`location`,
		`ean13`,
		`wholesale_price`,
		`price`,
		`ecotax`,
		`quantity`,
		`weight`
		
		)   select  `id_product_attribute`,`id_product`,`reference`,`supplier_reference`,`location`,`ean13`,`wholesale_price`,`price`,`ecotax`,`quantity`,`weight` from `".PX_OLDDB."`.ps_product_attribute  where default_on =0";
		
		//checksql($sql2);

		$db2->exec($sql)or die('ps_product_attribute 默认组合 更新失败');
		
		$db2->exec($sql2)or die('ps_product_attribute 非默认组合 更新失败');





		 echo "1.6版本 ps_product_attribute 更新完毕";

	}


	function update_product_attribute_shop($db,$db2)
		{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_product_attribute_shop";
		$db2->exec($clean);
		//此表 存在 unique 索引 所以插入前 先去掉索引 插入完毕后 再加上索引
		//直接使用 insert ignore into 语句 便可以忽略这个 unique 索引的约束
		
		for ($i=1; $i <PX_SHOP; $i++) { 
			$sql="insert ignore into "."`".PX_NEWDB."`".".ps_product_attribute_shop (
		`id_product_attribute`,`id_shop`,`id_product`,`wholesale_price`,`price`,`ecotax`,
		`weight`,`default_on`)   select  `id_product_attribute`,$i,`id_product`,`wholesale_price`,`price`,`ecotax`,`weight`,`default_on`  from `".PX_OLDDB."`.ps_product_attribute   where default_on =1 ";
		$sql2="insert ignore into "."`".PX_NEWDB."`".".ps_product_attribute_shop (
		`id_product_attribute`,`id_shop`,`id_product`,`wholesale_price`,`price`,`ecotax`,
		`weight`)   select  `id_product_attribute`,$i,`id_product`,`wholesale_price`,`price`,`ecotax`,`weight`  from `".PX_OLDDB."`.ps_product_attribute   where default_on =0 ";


		//checksql($sql);
		$db2->exec($sql)or die('ps_product_attribute_shop 默认组合 更新失败');
		$db2->exec($sql2)or die('ps_product_attribute_shop 非默认组合 更新失败');
		}
				
	
		//更新对应表
		
		

		
		
		 echo "1.6版本 ps_product_attribute_shop 更新完毕";

	}

	function update_product($db,$db2)
	{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_product";
		$db2->exec($clean);
		//此表 存在 unique 索引 所以插入前 先去掉索引 插入完毕后 再加上索引
		//直接使用 insert ignore into 语句 便可以忽略这个 unique 索引的约束
		
		$sql="insert ignore into "."`".PX_NEWDB."`".".ps_product (
		`id_product`,
		`id_supplier`,
		`id_manufacturer`,
		`id_tax_rules_group`,
		`id_category_default`,
		`on_sale`,
		`quantity`,
		`price`,
		`wholesale_price`,
		`reference`,
		`supplier_reference`,
		`location`,
		`weight`,
		`out_of_stock`,
		`quantity_discount`,
		`customizable`,
		`uploadable_files`,
		`text_fields`,
		`active`,
		`indexed`,
		`date_add`,
		`date_upd`)   
		select  
		`id_product`,
		`id_supplier`,
		`id_manufacturer`,
		0,
		3,
		`on_sale`,
		0,
		`price`,
		`wholesale_price`,
		`reference`,
		`supplier_reference`,
		`location`,
		`weight`,
		`out_of_stock`,
		`quantity_discount`,
		`customizable`,
		`uploadable_files`,
		`text_fields`,
		`active`,
		`indexed`,
		`date_add`,
		`date_upd`  
		from `".PX_OLDDB."`.ps_product ";
		//更新对应表
		
		

		$db2->exec($sql)or die('ps_product 更新失败');
		
		 echo "1.6版本 ps_product 更新完毕";

	}
	function update_product_shop($db,$db2)
	{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_product_shop";
		$db2->exec($clean);
		//此表 存在 unique 索引 所以插入前 先去掉索引 插入完毕后 再加上索引
		//直接使用 insert ignore into 语句 便可以忽略这个 unique 索引的约束
		//id_category_default id_shop 默认为1  id_tax_rules_group 后期需要全部迁移 当前为测试

		
		for($i=1;$i<3;$i++){
		$sql="insert ignore into "."`".PX_NEWDB."`".".ps_product_shop (
		`id_product`,
		`id_shop`,
		`id_category_default`,
		`id_tax_rules_group`,
		`price`,
		`wholesale_price`,
		`unity`,
		`active`,
		`indexed`,
		`cache_default_attribute`,
		`date_add`,
		`date_upd`)  
		 select  
		`id_product`,$i, 3, 0, `price`,`wholesale_price`,'', `active`, 1, 0, `date_add`, `date_upd`  
		from `".PX_OLDDB."`.ps_product ";
		//更新对应表
		
		//checksql($sql);

		$db2->exec($sql)or die('ps_product_shop 更新失败');
		}



		
		 echo "1.6版本 ps_product_shop 更新完毕";

	}

/*--------product 产品更新 end-----*/
	function update_category_lang($db,$db2)
	{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_category_lang";
		$db2->exec($clean);

		
		for($i=1;$i<PX_SHOP;$i++){
		$sql="insert ignore into "."`".PX_NEWDB."`".".ps_category_lang (
		`id_category`,
		`id_lang`,
		`id_shop`,
		`name`,
		`description`,
		`link_rewrite`,
		`meta_title`,
		`meta_keywords`,
		`meta_description`
		)  
		 select  
		`id_category`,`id_lang`,$i,`name`,`description`,`link_rewrite`,`meta_title`,`meta_keywords`,`meta_description` 
		from `".PX_OLDDB."`.ps_category_lang ";
		//更新对应表
		$db2->exec($sql)or die('ps_category_lang 更新失败');
		}

		 echo "1.6版本 ps_category_lang 更新完毕";

	}

	function update_category_shop($db,$db2)
	{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_category_shop";
		$db2->exec($clean);

		for($i=1;$i<PX_SHOP;$i++){
		$sql="insert ignore into "."`".PX_NEWDB."`".".ps_category_shop (
		`id_category`,
		`id_shop`
		)  
		 select  
		`id_category`,$i
		from `".PX_OLDDB."`.ps_category ";
		//更新对应表
		$db2->exec($sql)or die('ps_category_shop 更新失败');
		}

		 echo "1.6版本 ps_category_shop 更新完毕";

	}
	function update_stock_available($db,$db2)
	{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_stock_available";
		$db2->exec($clean);

		for($i=1;$i<PX_SHOP;$i++){
		$sql="insert ignore into "."`".PX_NEWDB."`".".ps_stock_available (
		`id_product`,
		`id_shop`,
		`id_product_attribute`,
		`id_shop_group`,
		`quantity`

		)  
		 select  
		`id_product`,$i,
		`id_product_attribute`,
		0,
		999

		from `".PX_OLDDB."`.ps_product_attribute ";
		//更新对应表
		$db2->exec($sql)or die('ps_stock_available 更新失败');
		}
		$sqlnum ='select id_product,count(id_product_attribute) as num  FROM ps_product_attribute GROUP BY id_product';
		$res =getall($db,$sqlnum);

		for($i=1;$i<PX_SHOP;$i++){
			foreach ($res as $a) {
				$id_product = $a['id_product'];
				$num = $a['num'];
				$num = 999*$num;
				$insert = "insert into ps_stock_available
				 	(id_product,id_shop,id_product_attribute,id_shop_group,quantity) values 
				 	($id_product,$i,0,0,$num)";
				$db2->exec($insert)or die('ps_stock_available   基本组合0更新失败');;//返回影响了多少行数	

			}
			
		}

	
	


		 echo "1.6版本 ps_stock_available 更新完毕";

	}
	

	function update_category($db,$db2)
	{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_category";
		$db2->exec($clean);

		
		$sql="insert ignore into "."`".PX_NEWDB."`".".ps_category (
		`id_category`,
		`id_shop_default`,
		`id_parent`,
		`level_depth`,
		`active`,
		`date_add`,
		`date_upd`
		)  
		 select  
		`id_category`,
		".PX_DEFAULT_SHOP.",
		`id_parent`,
		`level_depth`,
		`active`,
		`date_add`,
		`date_upd`
		from `".PX_OLDDB."`.ps_category ";

		//checksql($sql);
		//更新对应表

	
 		
		
		 $db2->exec($sql)or die('ps_category 更新失败');

		 echo "1.6版本 ps_category 更新完毕";

	}


/*--------category 产品分类更新 begin-----*/






/*--------category 产品分类更新 end-----*/


/*--------image 产品图片更新 begin-----*/
function update_image($db,$db2)
		{	
		//初始化 ps1.6 数据库的表
		$clean ="truncate table ps_image";
		$db2->exec($clean);
		//此表 存在 unique 索引 所以插入前 先去掉索引 插入完毕后 再加上索引
		//直接使用 insert ignore into 语句 便可以忽略这个 unique 索引的约束
		
		
			$sql="insert  into "."`".PX_NEWDB."`".".ps_image (
		`id_image`,`id_product`,`position`,`cover`)   select  `id_image`,`id_product`,`position`,1  from `".PX_OLDDB."`.ps_image   where cover =1 ";

		$sql2="insert  into "."`".PX_NEWDB."`".".ps_image (
		`id_image`,`id_product`,`position`,`cover`)   select  `id_image`,`id_product`,`position`,null  from `".PX_OLDDB."`.ps_image   where cover =0 ";


		//checksql($sql);
		$db2->exec($sql)or die('ps_image 默认图片 更新失败');
		$db2->exec($sql2)or die('ps_image 非默认图片 更新失败');
		
		
		 echo "1.6版本 ps_image 更新完毕";

	}

	function update_image_shop($db,$db2)
	{
		
		$clean ="truncate table ps_image_shop";
		$db2->exec($clean);
		
		for ($i=1; $i <PX_SHOP ; $i++) { 
			
		$sql="insert  into "."`".PX_NEWDB."`".".ps_image_shop (
		`id_image`,`id_product`,`id_shop`,`cover`)   select  `id_image`,`id_product`,$i,1  from `".PX_OLDDB."`.ps_image   where cover =1 ";

		$sql2="insert  into "."`".PX_NEWDB."`".".ps_image_shop (
		`id_image`,`id_product`,`id_shop`,`cover`)   select  `id_image`,`id_product`,$i,null  from `".PX_OLDDB."`.ps_image   where cover =0 ";


		//checksql($sql);
		$db2->exec($sql)or die('ps_image_shop 默认图片 更新失败');
		$db2->exec($sql2)or die('ps_image_shop 非默认图片 更新失败');

		}
		
		
		


		echo "1.6版本 ps_image_shop 更新完毕";
	}




/*--------image 产品图片更新 end-----*/





//1.6 1.3 表结构一致更新函数 ps_group 
	function update_tabel($db,$db2,$table)
	{	

		
		$sql="insert ignore into "."`".PX_NEWDB."`".".$table   select  * from `".PX_OLDDB."`.$table";
		
		//初始化 ps1.6 数据库的表
		$clean ="truncate table $table";
		//checksql($sql);
		$db2->exec($clean);
		//更新对应表
		$db2->exec($sql)or die("$table 更新失败");
		
		 echo "1.6版本 $table 更新完毕";

	}


	//检测sql语句 是否正确
	function checksql($sql){
		echo $sql;
			 	exit;
	}
	//获取当前表所有的字段
	function getallfield(){
		$str = "show columns from $table";
		$sqlfield= '';
		$res =getall($db,$str);

		foreach ($res as $a) {
			$sqlfield.=" `".$a['Field'].'`,';


		}

		$sqlfield = getlaststr($sqlfield);//去掉最后一个逗号

		return $sqlfield;
	}

	//包装 pdo 连接
	function pdo_conn($dsn,$user,$pwd){
		
		try {  
	        $db = new PDO($dsn, $user, $pwd);  
	       
	    } catch (Exception $e) {  
	        echo 'Fail to connect to database!\n';  
	        echo $e->getMessage();  
	    }
		
		return $db;
	}

	//获取查询结果 并存放为 关联数组
	function getall($db,$sql){
		
			 $result = $db->query($sql);
			 $res =$result->fetchAll(); //存成关联数组

			 return  $res;
	}

	//缓冲输出 
	function outbuffer(){
		
		ob_flush();
		flush();
		//usleep(1000);
	}


	//检测表是否需要更新
	function checkupdate($db,$table,$field,$id_tag){
		
		 $strSql = "select * from $table  where $field = $id_tag ";
		$reslut = $db->query($strSql);//返回影响了多少行数据
		$num =$reslut->rowCount();
		if($num==1){
		return true;
		}else{
		return false;
		}
	}




	//记录输出日志

	function outlog($i,$filename,$tablefiled){


		// $myfile = fopen("testfile$i.txt", "w");  创建文件

		/*$myfile = fopen("log/$filename.txt", "w") or die("Unable to open file!");
		$txt = "已经更新".$filename."表字段".$tablefiled."为:".$i."\n";
		fwrite($myfile, $txt); */
	}
	// outlogno
	function outlogno($i,$filename,$tablefiled){


		// $myfile = fopen("testfile$i.txt", "w");  创建文件

	/*	$myfile = fopen("log/$filename.txt", "w") or die("Unable to open file!");
		$txt = "此表键值不唯一已经更新".$filename."表字段".$tablefiled."为:".$i."\n";
		fwrite($myfile, $txt); */
	}

	//获取 ps1.6 表的更新语句  仅个人使用 《----已经废弃-----》
	function getupdatesql($db,$table,$id){
			
		$sql="SHOW COLUMNS FROM $table";
		$res =getall($db,$sql);
		$str = '';
		foreach ($res as $a) {
			if ($id==$a['Field']) 
			{}
			$field = $a['Field'];
			$str.="$field = '".'$'.$field."',";
		}
	 	 $str = substr($str,0,(strlen($str)-1));//去掉最后一个逗号

	 	 $update = "UPDATE px_tag_extra_x SET ".$str." where id_tag =".'$'.$id;
		return $update ;
		
	}

	//获取数据表 记录条数
	function getsqlnum($table,$db){

    $sql = "SELECT * FROM  $table "; 
	$res =$db->query($sql);//返回影响了多少行数	
    $num = $res->rowCount(); //获取总的记录条数

    return $num ;

    }

    //去除字符串最后一个字符 用来去除拼接数组最后多的一个字符串
	function getlaststr($str){

    $str = substr($str,0,(strlen($str)-1));//去掉最后一个逗号

    return $str ;

    }