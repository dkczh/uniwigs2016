﻿var xmlhttp; 



function savetag(){
var  tagid = document.getElementById('tagid').innerHTML;

var taginfo = getinfo();
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
  //document.getElementById("groupName").innerHTML=xmlhttp.responseText; 
  alert(xmlhttp.responseText);
 document.getElementById('savetag').innerHTML='保存';
  //document.getElementById('prenum').innerHTML=prenum; //设定当前正确的页码数
  //window.location.reload();
  
  }  else{
	  
	document.getElementById('savetag').innerHTML='...';
  }
 } 
xmlhttp.open("GET","save.php?id="+taginfo,true); 
xmlhttp.send(); 
	
}


function getinfo()
{

	var  id = document.getElementById('tagid').innerHTML;
	var  keyword = document.getElementById('keyword').value;
	var  sku = document.getElementById('sku').value;


	var tag=new Array(); 
	tag[0] = id;
	tag[1] = keyword;
	tag[2] = sku;


	var tagjson =JSON.stringify(tag); 

	return  tagjson;


}











