var xmlhttp; 


//打开当前选中tag的编辑页面




//下一页展示  默认 0-50条
function savetag(){




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
 document.getElementById('savetag').innerHTML='提交';
  //document.getElementById('prenum').innerHTML=prenum; //设定当前正确的页码数
  //window.location.reload();
  
  }  else{
	  
	document.getElementById('savetag').innerHTML='...';
  }
 } 
xmlhttp.open("GET","addproduct.php?id="+taginfo,true); 
xmlhttp.send(); 
	
}


/*将一个tagcontent中的 tag  的 id, name，template,skus,products并json化 
  */
function getinfo(){

var  skus = document.getElementById('skus').value;
var  video = document.getElementById('video').value;
var  custom = document.getElementById('custom').value;

if(skus==''){

  alert("请输入skus");
  exit;
}



var tag=new Array(); 

tag[0] = skus;
tag[1] = video;
tag[2] = custom;


var tagjson =JSON.stringify(tag); 

return  tagjson;



	
}


function checknull(str){
if(str==''){

  alert("请输入"+str+"的名称");
  exit;
}

}









