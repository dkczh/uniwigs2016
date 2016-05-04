<html lang="en"><head>
	<meta charset="UTF-8">
	<title>订单提醒</title>
	
<script type="text/javascript" src="public/dateselect/laydate.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<link type="text/css" rel="stylesheet" href="public/dateselect/laydate.css">
<link type="text/css" rel="stylesheet" href="public/dateselect/laydate(1).css" id="LayDateSkin">
<style>
*{ margin:0; padding:0;list-style: none;}
body {font:12px/1.5 Tahoma;}
#outer {width:1060px;margin:10px auto;}
#tab {overflow:hidden;zoom:1;border-top: 1px solid #ccc;}
#tab li {
float: left;
background: -webkit-gradient(linear,left top,left bottom, from(#fefefe), to(#ededed));
padding: 5px 0;
width: 150px;
text-align: center;
margin-left: -1px;
position: relative;
cursor: pointer;}
#tab li.current {
border-bottom: none;
background: #fff;
border-right: 1px solid #ACA2A2;
border-left: 1px solid #ACA2A2;}
#content {border:1px solid #ccc;border-top-width:0;}
#content ul {line-height:25px;display:none;	margin:0 30px;padding:10px 0;}
th,td{
	
	border-right: solid #ccc 1px;
	border-bottom: solid #ccc 1px;
	padding:5px
}

.bordered{
	
  border: solid #ccc 1px;  -moz-border-radius: 6px;      -webkit-box-shadow: 0 1px 1px #ccc;  -moz-box-shadow: 0 1px 1px #ccc;    
    font-size: 1.3em;
    width: 900px;
	border-spacing: 0px;
}
tr{text-align: center;}
</style>

</head>

<body style="">

<center style="
    margin-top: 20px;
">  <h1>订单提醒</h1> 
</center>

<div id="outer">
    <ul id="tab">
    
		
    </ul>
    <div id="content">
        <ul style="display: block;padding-top: 20px;
}">

		<center ><h2 style="
    color: red;
">超期订单</h2></center>
		 </li>
		 <hr style="height:1px;border:none;border-top:1px dashed #0066CC;margin-bottom: 10px;
margin-top: 10px;
}" />
		 <li>
		 		<li id="customerexcel" style="
    text-align: right;
    font-weight: bold;
    font-size: 14px;
    margin-right: 100px;
    margin-bottom: 20px;
"></li>
<table class="bordered" id='list_content_99'>


    <thead>
    <tr>
        <th>订单id</th>
		<th>产品skus</th>	
		<th>备货截止日期</th>
        <th>当前日期</th>
		<th>超期时间</th>
    </tr>
    </thead>
	
	 

    <tbody id="tablelist">
	 
	<tr >
	<td id="tag312" >xxxxxxxxxxxx</td>
	<td style="width: 200px;" >xxx</td>
	<td>xxxx-xx-xx</td>
	<td>xxxx-xx-xx</td>
	<td style="width: 100px;">
	</td> </tr>  
		 


		
</tbody>



</table>
	
		 </li>
        </ul>
		
    </div>
	
</div>



<div id="outer">
    <ul id="tab">
    
		
    </ul>
    <div id="content">
        <ul style="display: block;padding-top: 20px;
}">

		<center ><h3 style="
     color: #1411DA;
">定制单提醒（离发货还剩下3天）</h3></center>
		 </li>
		 <hr style="height:1px;border:none;border-top:1px dashed #0066CC;margin-bottom: 10px;
margin-top: 10px;
}" />
		 <li>
		 		<li id="customerexcel" style="
    text-align: right;
    font-weight: bold;
    font-size: 14px;
    margin-right: 100px;
    margin-bottom: 20px;
"></li>
<table class="bordered" id='list_content_3'>


    <thead>
    <tr>
        <th>订单id</th>
		<th>产品skus</th>	
		<th>备货截止日期</th>
        <th>当前日期</th>
		<th>备用1</th>
    </tr>
    </thead>
	
	 

    <tbody id="tablelist">
	 
	<tr >
	<td id="tag312" >xxxxxxxxxxxx</td>
	<td style="width: 200px;" >xxx</td>
	<td>xxxx-xx-xx</td>
	<td>xxxx-xx-xx</td>
	<td style="width: 100px;">
	</td> </tr>  
		 


		
</tbody>



</table>
	
		 </li>
        </ul>
		
    </div>
	
</div>



<div id="outer">
    <ul id="tab">
    
		
    </ul>
    <div id="content">
        <ul style="display: block;padding-top: 20px;
}">

		<center ><h3 style="
    color: #1411DA;
">定制单提醒（离发货还剩下7天）</h3></center>
		 </li>
		 <hr style="height:1px;border:none;border-top:1px dashed #0066CC;margin-bottom: 10px;
margin-top: 10px;
}" />
		 <li>
		 		<li id="customerexcel" style="
    text-align: right;
    font-weight: bold;
    font-size: 14px;
    margin-right: 100px;
    margin-bottom: 20px;
"></li>
<table class="bordered" id='list_content_7'>


    <thead>
    <tr>
         <th>订单id</th>
		<th>产品skus</th>	
		<th>备货截止日期</th>
        <th>当前日期</th>
		<th>备用1</th>
    </tr>
    </thead>
	
	 

    <tbody id="tablelist">
	 
	<tr >
	<td id="tag312" >xxxxxxxxxxxx</td>
	<td style="width: 200px;" >xxx</td>
	<td>xxxx-xx-xx</td>
	<td>xxxx-xx-xx</td>
	<td style="width: 100px;">
	</td> </tr>  
		 


		
</tbody>



</table>
	
		 </li>
        </ul>
		
    </div>
	
</div>


<div id="outer">
    <ul id="tab">
    
		
    </ul>
    <div id="content">
        <ul style="display: block;padding-top: 20px;
}">

		<center ><h3 style="
    color: #1411DA;
">定制单提醒（离发货还剩下10天）</h3></center>
		 </li>
		 <hr style="height:1px;border:none;border-top:1px dashed #0066CC;margin-bottom: 10px;
margin-top: 10px;
}" />
		 <li>
		 		<li id="customerexcel" style="
    text-align: right;
    font-weight: bold;
    font-size: 14px;
    margin-right: 100px;
    margin-bottom: 20px;
"></li>
<table class="bordered" id='list_content_10'>


    <thead>
    <tr>
         <th>订单id</th>
		<th>产品skus</th>	
		<th>备货截止日期</th>
        <th>当前日期</th>
		<th>备用1</th>
    </tr>
    </thead>
	
	 

    <tbody id="tablelist">
	 
	<tr >
	<td id="tag312" >xxxxxxxxxxxx</td>
	<td style="width: 200px;" >xxx</td>
	<td>xxxx-xx-xx</td>
	<td>xxxx-xx-xx</td>
	<td style="width: 100px;">
	</td> </tr>  
		 


		
</tbody>



</table>
	
		 </li>
        </ul>
		
    </div>
	
</div>
<div id="outer">
    <ul id="tab">
    
		
    </ul>
    <div id="content">
        <ul style="display: block;padding-top: 20px;
}">

		<center ><h3 style="
    color: #1411DA;
">非定制单提醒（2天内未发货的）</h3></center>
		 </li>
		 <hr style="height:1px;border:none;border-top:1px dashed #0066CC;margin-bottom: 10px;
margin-top: 10px;
}" />
		 <li>
		 		<li id="customerexcel" style="
    text-align: right;
    font-weight: bold;
    font-size: 14px;
    margin-right: 100px;
    margin-bottom: 20px;
"></li>
<table class="bordered" id='list_content'>


    <thead>
    <tr>
        <th>订单id</th>
		<th>客户id</th>	
		<th>添加日期</th>
        <th>当前日期</th>
		<th>备用1</th>
    </tr>
    </thead>
	
	 

    <tbody id="tablelist">
	 
	<tr >
	<td id="tag312" >1</td>
	<td style="width: 200px;" >xxx</td>
	<td>xxxx-xx-xx</td>
	<td>xxxx-xx-xx</td>
	<td style="width: 100px;">
	</td> </tr>  
		 


		
</tbody>



</table>
	
		 </li>
        </ul>

       <!--  <ul style="display:none ;">
         等待后续开发.......
       </ul> -->
		
    </div>
	
</div>
<script>
query(99);//"超期订单"


query(1); //"非定制单查询"

query(3); //"定制单查询3天"

query(7); //"定制单查询3天"

query(10);//"定制单查询3天"

function query(id){
	$.post("query.php",{id:id},function(result){
		
		if(id==1){
		 $('#list_content').html(result); 
		 }
		if(id==3){
		 $('#list_content_3').html(result); 
		 }
		if(id==7){
		 $('#list_content_7').html(result); 
		 }
		if(id==10){
		 $('#list_content_10').html(result); 
		 }
		if(id==99){
		 $('#list_content_99').html(result); 
		 }
	});

}




	

function out_customer_excel(id)
{
 	
   switch(id)
	{
	case 1:
	  window.open('product.php?id='+id);
	  break;
	case 2:
	  
	  var cata = document.getElementById("category").value;
	  var buy =  document.getElementById("customer_buy").value;
	  var d_begin=  document.getElementById("d_begin").value;
	  var d_end = document.getElementById("d_end").value;
	 
	  window.open('product.php?id='+id+'&cata='+cata+'&buy='+buy+'&d_begin='+d_begin+'&d_end='+d_end);
	  break;
	case 3:
	  window.open('product.php?id='+id);
	  break;
	case 4:
	  window.open('product.php?id='+id+'&b_date=');
	  break;
	default:

	  break;
	}
   
}

</script>



</body></html>