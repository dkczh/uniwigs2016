<html lang="en"><head>
	<meta charset="UTF-8">
	<title>统计报表导出</title>
	
<script type="text/javascript" src="/apitools/public/dateselect/laydate.js"></script>
<link type="text/css" rel="stylesheet" href="/apitools/public/dateselect/laydate.css">
<link type="text/css" rel="stylesheet" href="/apitools/public/dateselect/laydate(1).css" id="LayDateSkin">
<style>
*{ margin:0; padding:0;list-style: none;}
body {font:12px/1.5 Tahoma;}
#outer {width:850px;margin:50px auto;}
#tab {overflow:hidden;zoom:1;border: 1px solid #ccc;}
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
</style>

</head>

<body style="">

<center style="
    margin-top: 20px;
">  <h1>统计报表导出</h1> </center>
<div id="outer">
    <ul id="tab">
        <li class="current">customer 报表导出</li>
        <li class="">orders(fm) 报表导出</li>
        <!-- <li class="">其他</li> -->
		
    </ul>
    <div id="content">
        <ul style="display: block;">
         <li>导出所有客户信息 <button onclick="out_customer_excel(1)">导出</button></li>
		<hr style="height:1px;border:none;border-top:1px dashed #0066CC;margin-bottom: 10px;
margin-top: 10px;
}" />
		 <li>
		 <select name="customer_category" id='category'>
				<option value="-1">All Categories</option>
				<option value="102">Human Hair Wigs</option>
				<option value="101">Synthetic Wigs</option>
				<option value="103">Hair Extensions</option>
				<option value="104">Hair Pieces</option>
				<option value="105">Care Products</option>

			</select>
		 <label for="meeting">开始日期：</label><input id="d_begin"  class="laydate-icon" value="2015-11-01"/>
		<label for="meeting">结束日期：</label><input id="d_end"  class="laydate-icon"  value="2015-12-30"/>
		<select name="ecustomer_flag"id = 'customer_buy'>
				<option value="1">购买用户</option>
				<option value="2">未购买用户</option>
				<option value="3">意向用户</option>
				<option value="4">非意向用户</option>
		</select>
		 <button onclick="out_customer_excel(2)">导出</button>
		 </li>
		 <hr style="height:1px;border:none;border-top:1px dashed #0066CC;margin-bottom: 10px;
margin-top: 10px;
}" />
		 <li><button onclick="out_customer_excel(3)">导出客户信息(tag: lace-closure)</button>
		 &nbsp;&nbsp;&nbsp;&nbsp;; | &nbsp;&nbsp;&nbsp;
		 <button onclick="out_customer_excel(4)">导出客户信息(cat: top hair pieces(without lace-closure))</button>
		 </li>
        </ul>
        <ul style="display: none;">
		
        <label for="meeting">开始日期：</label><input id="o_begin"  class="laydate-icon" value="2015-11-01"/>
		<label for="meeting">结束日期：</label><input id="o_end"  class="laydate-icon"  value="2015-12-30"/>
		 <hr style="height:1px;border:none;border-top:1px dashed #0066CC;margin-bottom: 10px;
margin-top: 10px;
}" />	
		<li>
		 <li><button onclick="out_order_excel(2)">导出财务报表</button>
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
		 <button onclick="out_order_excel(3)">导出孚盟报表</button>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
		 
		 <button onclick="out_order_excel(1)"> 导出 付款订单数据-订单项</button>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
		 
		 <button onclick="out_order_excel(4)"> 导出 付款订单数据-客户</button>
		 
		 
		 </li>
		 
		
		
        </ul>
       <!--  <ul style="display:none ;">
         等待后续开发.......
       </ul> -->
		
    </div>
</div>


<script src="/apitools/public/js/jquery_outexcel.js"></script>
<script>
	$(function(){
		window.onload = function()
		{
			var $li = $('#tab li');
			var $ul = $('#content ul');
						
			$li.mouseover(function(){
				var $this = $(this);
				var $t = $this.index();
				$li.removeClass();
				$this.addClass('current');
				$ul.css('display','none');
				$ul.eq($t).css('display','block');
			})
		}
	});
</script>
<script>
	var myDate = new Date();
	var d_begin = myDate.getFullYear()+"-"+myDate.getMonth()+"-"+myDate.getDate(); 
   

	
	

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
	  window.open('product.php?id='+id);
	  break;
	default:

	  break;
	}
   
}



function out_order_excel(id)
{
 	
	
	
	var o_begin=  document.getElementById("o_begin").value;
	var o_end = document.getElementById("o_end").value;
	
	//alert('订单id'+id+'开始日期：'+o_begin+'结束日期：'+o_end);

	var cata = document.getElementById("category").value;
	var buy =  document.getElementById("customer_buy").value;
	var d_begin=  document.getElementById("d_begin").value;
	var d_end = document.getElementById("d_end").value;
	 
	window.open('order.php?id='+id+'&o_begin='+o_begin+'&o_end='+o_end);

}




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
</script>

</body></html>