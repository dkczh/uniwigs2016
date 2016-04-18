<html lang="en"><head>
	<meta charset="UTF-8">
	<title>统计</title>
	
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
">  <h1>销售统计</h1> 
<h3 style="
    color: grey;
">(默认7天之内)</h3></center>


<div id="outer">
    <ul id="tab">
    
		
    </ul>
    <div id="content">
        <ul style="display: block;padding-top: 20px;
}">

		 <select name="customer_category" id='category'>
				<option value="1">最佳销售产品</option>
				<option value="2">最佳用户下单时间</option>
				<option value="3">购买产品最多用户</option>
				<option value="4">国家销售统计</option>
				<option value="5">美国区域销售统计</option>

		</select>
		 <label for="meeting">开始：</label><input id="d_begin"  class="laydate-icon" value="<?php  echo  date("Y-m-d",strtotime("-7 day"));    ?>"/>
		<label for="meeting">结束：</label><input id="d_end"  class="laydate-icon"  value=" <?php  echo  date("Y-m-d",time());    ?>"/>
		<select name="customer_category" id='sqlname'>
			
				<option value="-1">All Categories</option>
				<option value="102">Human Hair Wigs</option>
				<option value="101">Synthetic Wigs</option>
				<option value="103">Hair Extensions</option>
				<option value="104">Hair Pieces</option>
				<option value="105">Care Products</option>
			

		</select>
		<select name="customer_childcategory" id='childcategory'>
			<option value="-1">All ChildCategories</option>

		</select>
	
		 <button onclick="query()">查询</button>
		 </li>
		 <hr style="height:1px;border:none;border-top:1px dashed #0066CC;margin-bottom: 10px;
margin-top: 10px;
}" />
		 <li>
		 
<table class="bordered" id='list_content'>


    <thead>
    <tr>
        <th>id</th>
		<th>product_id</th>
        <th>Skus</th>
		<th>sales</th>	
		<th>begin_date</th>
		<th>end_date</th>
		<th>action</th>	
    </tr>
    </thead>
	
	   <thead  style="display:none">
    <tr>
        <th>id</th>
        <th>time</th>
		<th>sales</th>	
		<th>begin_date</th>
		<th>end_date</th>
		<th>action</th>	
    </tr>
    </thead>
	  <thead  style="display:none">
    <tr>
        <th>id</th>
        <th>email</th>
		<th>sales</th>	
		<th>begin_date</th>
		<th>end_date</th>
		<th>action</th>	
    </tr>
    </thead>
	

    <tbody id="tablelist">
	 
	<tr >
	<td id="tag312" >1</td>
	<td style="width: 200px;" >xxx</td>
	<td >xxx</td>
	<td >xxx</td>
	<td>xxxx-xx-xx</td>
	<td>xxxx-xx-xx</td>
	<td style="width: 100px;"><button type="button" onclick="query(13)">查看</button>
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
	var myDate = new Date();
	var d_begin = myDate.getFullYear()+"-"+myDate.getMonth()+"-"+myDate.getDate(); 
    var id = document.getElementById("category").value;


function test(){
var id = document.getElementById("category").value;

	alert(id);
}



function query(){
  
	var id = document.getElementById("category").value;
	var sqlname =  document.getElementById("sqlname").value;
	var childcategory =  document.getElementById("childcategory").value;
	var d_begin=  document.getElementById("d_begin").value;
	var d_end = document.getElementById("d_end").value;

	$.post("query.php",{id:id,sqlname:sqlname,childcategory:childcategory,begin:d_begin,end:d_end},function(result){
		
		 $('#list_content').html(result); 
      
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

//select 二级联动
$('#sqlname').click(function(){ 
  cate = $("#sqlname").find("option:selected").val();
  if(cate!='-1'){
  $.post("category.php",{category:cate},function(result)
	{
	
    $("#childcategory").html(result);
	$("#childcategory").prepend('<option value="-1">All ChildCategories</option>');
	});
   }else{
	$("#childcategory").empty(); 
	
	   $("#childcategory").html('<option value="-1">All ChildCategories</option>');
   }
  
  
});




</script>

<script type="text/javascript">
!function(){
	laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#d_begin'});//绑定元素
}();
!function(){
	laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#d_end'});//绑定元素
}();

!function(){
	laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#o_begin'});//绑定元素
}();
!function(){
	laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#o_end'});//绑定元素
}();






//日期范围限制
var start = {
    elem: '#start',
    format: 'YYYY-MM-DD',
    min: laydate.now(), //设定最小日期为当前日期
    max: '2099-06-16', //最大日期
    istime: true,
    istoday: false,
    choose: function(datas){
         end.min = datas; //开始日选好后，重置结束日的最小日期
         end.start = datas //将结束日的初始值设定为开始日
    }
};

var end = {
    elem: '#end',
    format: 'YYYY-MM-DD',
    min: laydate.now(),
    max: '2099-06-16',
    istime: true,
    istoday: false,
    choose: function(datas){
        start.max = datas; //结束日选好后，充值开始日的最大日期
    }
};
laydate(start);
laydate(end);

//自定义日期格式
laydate({
    elem: '#test1',
    format: 'YYYY年MM月DD日',
    festival: true, //显示节日
    choose: function(datas){ //选择日期完毕的回调
        alert('得到：'+datas);
    }
});

//日期范围限定在昨天到明天
laydate({
    elem: '#hello3',
    min: laydate.now(-1), //-1代表昨天，-2代表前天，以此类推
    max: laydate.now(+1) //+1代表明天，+2代表后天，以此类推
});

/*  var mydate = new Date();

  estr=mydate.getFullYear();
 estr+='-'+((mydate.getMonth()+1)<10 ? "0" +(mydate.getMonth()+1) :(mydate.getMonth()+1));
 estr+='-'+(mydate.getDate()<10 ? "0"+mydate.getDate() : mydate.getDate());
 if(((mydate.getDate()-7)>0){
 bstr=mydate.getFullYear();
 bstr+='-'+((mydate.getMonth()+1)<10 ? "0" +(mydate.getMonth()+1) :(mydate.getMonth()+1));
 bstr+='-'+((mydate.getDate()-7)<10 ? "0"+(mydate.getDate()-7) : (mydate.getDate()-7));
 }else{
	 
	 
 }
 
$('#d_begin').val(estr);

$('#d_end').val(bstr); */

</script>

</body></html>