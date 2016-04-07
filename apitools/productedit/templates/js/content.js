var xmlhttp; 



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
	var  skus = document.getElementById('skus').value;
	var  video = document.getElementById('video').value;
	var  custom = document.getElementById('custom').value;

	var tag=new Array(); 
	tag[0] = id;
	tag[1] = skus;
	tag[2] = video;
	tag[3] = custom;


	var tagjson =JSON.stringify(tag); 

	return  tagjson;


}











