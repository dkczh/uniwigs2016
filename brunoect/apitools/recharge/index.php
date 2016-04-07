
<?php
header("Content-type: text/html; charset=utf-8");            //页面标准化
define('PS_API_NOW',getcwd());

require_once(PS_API_NOW.'/../checklogin.php'); // 

//gbno1@163.com
?>
<html>
<body>
<style type="text/css">
td{ padding: 4px}
</style>
<div style="
    margin-left: 500px;
	margin-top: 100px;
">

<div >
  <p>积分：<input type="text" id="points"name="fname" />*<span style="
    color: red;
"> 输入积分数量</span></p>
  <p>用户：<input type="text"id="uid" name="lname" />*<span style="
    color: red;
"> 输入用户email</span></p>
  <p>备注：<input type="text"id="acomment" name="acomment"  style="
    height: 100px;
" />*<span style="
    color: red;
"> 充值操作备注</span></p>

<button  value="充值" name="充值" onclick="recharge()" style="
    margin-left: 150px;
">充值</button>

</div>
<div id= 'result'>等待充值</div>
</div>



<div style="
    margin-left: 500px;
	margin-top: 100px;
">

<div >
  <p>用户邮箱：<input type="text" id="semail"name="fname" />*<span style="
    color: red;
"> 请输入用户邮箱</span></p>


<button  value="查询" name="查询" onclick="search()" style="
    margin-left: 150px;
">查询</button>

</div>
<div id= 'search'>历史记录</div>
</div>

</body>
</html>


<script>

function mytest()
{	
var id = document.getElementById("uid").value;
	var points = document.getElementById("points").value;
	var acomment = document.getElementById("acomment").value;
	
	if(id==''||points ==''){
		
		alert('请输入用户email和要充值的积分');
		exit;
	}
	
}



function recharge(){
    var xmlhttp; 
	var id = document.getElementById("uid").value;
	var points = document.getElementById("points").value;
	var acomment = document.getElementById("acomment").value;
	if(id==''||points ==''){
		
		alert('请输入用户email和要充值的积分');
		return;
	}
	if(id!=''&&points !=''){
		
		if (window.confirm("确认为用户email地址为："+id+"的用户充值："+points+"积分")) {
			
			} else {
			return;
			}
	}
	

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
     
     document.getElementById('result').innerHTML="<span style='color:red;font-weight: bold;''>"+xmlhttp.responseText+"</span>"; 
      
      
      }  else{
         
       /*  document.getElementById(ps_tag).innerHTML="<span style='color:rgb(221, 6, 221)''>"+ps_tag+'表更新中......'+"</span>";  */
      }
     } 

     
    xmlhttp.open("GET","recharge.php?id="+id+"&points="+points+"&acomment="+acomment,true); 
    xmlhttp.send(); 
}


function search(){
    var xmlhttp; 
	var id = document.getElementById("semail").value;

	if(id==''){
		
		alert('请输入用户email');
		return;
	}

	

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
     
    document.getElementById('search').innerHTML=xmlhttp.responseText; 
       //alert(xmlhttp.responseText);
      
      }  else{
         //alert('网络连接失败');
       /*  document.getElementById(ps_tag).innerHTML="<span style='color:rgb(221, 6, 221)''>"+ps_tag+'表更新中......'+"</span>";  */
      }
     } 

     
    xmlhttp.open("GET","history.php?id="+id,true); 
    xmlhttp.send(); 
}




</script>

