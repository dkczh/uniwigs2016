<?php 
define('PS_API_TSMARTY',getcwd());

require_once(PS_API_TSMARTY.'/../checklogin.php'); // 

?>


<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
</head>	
<body>

<div class="mytable" style="
    width: 800px;
    height: 400px;
    margin: 0px auto;
    background: gainsboro;
    padding: 10px;
    overflow: auto;
border: 1px solid #000000;
">

<div id="ps_tag">1.6--ps_tag</div>
<div id="ps_product_tag">1.6--ps_product_tag</div>
<div id="ps_customer_group">1.6--ps_customer_group</div>
<div id="ps_customer">1.6--ps_customer</div>
<div id="ps_group">1.6--ps_group</div>
<div id="ps_group_lang">1.6--ps_group_lang</div>

<div id="ps_address">1.6--ps_address</div>
<div id="ps_message">1.6--ps_message</div>
<div id="ps_message_readed">1.6--ps_message_readed</div>
<div id="ps_carrier_group">1.6--ps_carrier_group</div>
<div id="ps_carrier_zone">1.6--ps_carrier_zone</div>
<div id="ps_carrier_lang">1.6--ps_carrier_lang</div>
<div id="ps_carrier_shop">1.6--ps_carrier_shop</div>
<div id="ps_carrier">1.6--ps_carrier</div>
<div id="ps_carrier_tax_rules_group_shop">1.6--ps_carrier_tax_rules_group_shop</div>
<div id="ps_cart_product">1.6--ps_cart_product</div>
<div id="ps_order_history">1.6--ps_order_history</div>
<div id="ps_order_state_lang">1.6--ps_order_state_lang</div>
<div id="ps_order_state">1.6--ps_order_state</div>
<div id="ps_order_detail">1.6--ps_order_detail</div>
<div id="ps_orders">1.6--ps_orders</div>
<div id="ps_wishlist_product">1.6--ps_wishlist_product</div>
<div id="ps_wishlist">1.6--ps_wishlist</div>
<div id="ps_product_sale">1.6--ps_product_sale</div>
<div id="ps_product_lang">1.6--ps_product_lang</div>

<!-- 产品组合 attribute更新  begin  -->
<div id="ps_product_attribute">1.6--ps_product_attribute</div>
<div id="ps_product_attribute_shop">1.6--ps_product_attribute_shop</div>

<div id="ps_product_attribute_combination">1.6--ps_product_attribute_combination</div>

<div id="ps_product_attribute_image">1.6--ps_product_attribute_image</div>
<!-- 产品组合 attribute更新  end -->

<div id="ps_feature_product">1.6--ps_feature_product</div>
<div id="ps_product">1.6--ps_product</div>
<div id="ps_product_shop">1.6--ps_product_shop</div>
<div id="ps_category_lang">1.6--ps_category_lang</div>
<div id="ps_category_shop">1.6--ps_category_shop</div>
<div id="ps_category_group">1.6--ps_category_group</div>
<div id="ps_category">1.6--ps_category</div>
<div id="ps_stock_available">1.6--ps_stock_available</div>

<hr>
<div id="ps_attribute">1.6--ps_attribute</div>
<div id="ps_attribute_lang">1.6--ps_attribute_lang</div>
<div id="ps_attribute_shop">1.6--ps_attribute_shop</div>

<div id="ps_attribute_group">1.6--ps_attribute_group</div>
<div id="ps_attribute_group_lang">1.6--ps_attribute_group_lang</div>
<div id="ps_attribute_group_shop">1.6--ps_attribute_group_shop</div>

<div id="ps_attribute_impact">1.6--ps_attribute_impact</div>

<hr>
<!-- 产品图片 image更新  begin -->
<div id="ps_image">1.6--ps_image</div>
<div id="ps_image_lang">1.6--ps_image_lang</div>
<div id="ps_image_shop">1.6--ps_image_shop</div>

<!-- 产品图片 image更新  end -->
</div>


</div>

<div class="footer" style="
    width: 800px;  height: 50px;  margin: 0px auto;    padding: 10px;
    text-align: right;  };
">
<button onclick="updatetable()">更新</button>
</div>
<script>
  var xmlhttp; 

function  updatetable()
{
//update_ajax(1,'ps_tag');

//update_ajax(2,'ps_product_tag');

/*update_ajax(3,'ps_customer_group');

update_ajax(4,'ps_customer');
update_ajax(5,'ps_group');
update_ajax(6,'ps_group_lang');
update_ajax(7,'ps_attribute_lang');
update_ajax(8,'ps_attribute_impact');
update_ajax(9,'ps_attribute_group_lang');
update_ajax(10,'ps_attribute_group');

update_ajax(12,'ps_address');
update_ajax(13,'ps_message');
update_ajax(14,'ps_message_readed');
update_ajax(15,'ps_carrier_group');
update_ajax(16,'ps_carrier_zone');
update_ajax(17,'ps_carrier_lang');
update_ajax(18,'ps_carrier_shop');
update_ajax(19,'ps_carrier');
update_ajax(20,'ps_carrier_tax_rules_group_shop');
update_ajax(21,'ps_cart_product');
update_ajax(22,'ps_order_history');
update_ajax(23,'ps_order_state_lang');
update_ajax(24,'ps_order_state');
update_ajax(25,'ps_order_detail');
update_ajax(26,'ps_orders');
update_ajax(27,'ps_wishlist_product');
update_ajax(28,'ps_wishlist');

update_ajax(29,'ps_product_sale');
update_ajax(30,'ps_product_lang');


update_ajax(34,'ps_category_product');

update_ajax(35,'ps_feature_product');

update_ajax(37,'ps_product');
update_ajax(39,'ps_category_lang');

update_ajax(40,'ps_category_shop');
update_ajax(41,'ps_category_group');
update_ajax(42,'ps_category');
update_ajax(33,'ps_product_attribute');
 update_ajax(36,'ps_product_attribute_shop');
update_ajax(32,'ps_product_attribute_combination');
update_ajax(31,'ps_product_attribute_image');


*/
 


//update_ajax(38,'ps_product_shop');

//update_ajax(43,'ps_stock_available');
//update_ajax(44,'ps_attribute_shop');
//update_ajax(45,'ps_attribute_group_shop');

//update_ajax(11,'ps_attribute');

update_ajax(46,'ps_image');

update_ajax(47,'ps_image_lang');

update_ajax(48,'ps_image_shop');

}



function update_ajax(id,ps_tag){
    var xmlhttp; 

    if (window.XMLHttpRequest) 
     {// code for IE7+, Firefox, Chrome, Opera, Safari 
     xmlhttp=new XMLHttpRequest(); 
     } 
    else
     {// code for IE6, IE5 
     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
     } 
     
     
    xmlhttp.onreadystatechange=function() 
     { 
     if (xmlhttp.readyState==4 && xmlhttp.status==200) 
      { 
     
     document.getElementById(ps_tag).innerHTML="<span style='color:red;font-weight: bold;''>"+xmlhttp.responseText+"</span>"; 
      
      
      }  else{
         
        document.getElementById(ps_tag).innerHTML="<span style='color:rgb(221, 6, 221)''>"+ps_tag+'表更新中......'+"</span>"; 
      }
     } 

     
    xmlhttp.open("GET","sql.php?id="+id,true); 
    xmlhttp.send(); 
}





</script>
</body>
</html>