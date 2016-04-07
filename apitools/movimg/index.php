<?php 

define('APITOOL_CUR',getcwd());
require_once(APITOOL_CUR.'/../checklogin.php');
 ?>

<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
</head>	
<body>

<center><h1>图片迁移工具</h1></center>
<div class="mytable" id = 'mycontent' style="
    width: 800px;
    height: 400px;
    margin: 0px auto;
    background: gainsboro;
    padding: 10px;
    overflow: auto;
border: 1px solid #000000;
">




</div>


</div>

<div class="footer" style="
    width: 800px;  height: 50px;  margin: 0px auto;    padding: 10px;
    text-align: right;  };
">
<button onclick="update_ajax(1,'product');">更新产品图片</button>

<button onclick="update_ajax(1,'color');">更新属性color图片</button>

</div>





<script>
var xmlhttp; 



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
     
     document.getElementById('mycontent').innerHTML=xmlhttp.responseText; 
      
      
      }  else{
        // alert('2222');
        document.getElementById('mycontent').innerHTML="<span style='color:rgb(221, 6, 221)''>更新中......</span>"; 
      }
     } 

     
    xmlhttp.open("GET",ps_tag+".php?id="+id,true); 
    xmlhttp.send(); 
}





</script>