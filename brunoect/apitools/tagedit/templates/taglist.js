var xmlhttp; 
var grounpcheck = '';//控制 组合的 重复添加

//打开当前选中tag的编辑页面

function del(id){
if(confirm("确认删除吗")){
	
 sqldel(id);
}
else{

return;
}
}

function tagsearch()
{
	var tagkeyword = document.getElementById('key_tag').value;
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
	 // alert(xmlhttp.responseText);
	   document.getElementById('tablelist').innerHTML =xmlhttp.responseText;
	  document.getElementById('prenum').innerHTML=prenum; //设定当前正确的页码数
	  //window.location.reload();
	  
	  }  else{
		
		   document.getElementById('tablelist').innerHTML =loadingimg();
		   
		
		}
	 } 
	xmlhttp.open("GET","tagsearch.php?id="+tagkeyword,true); 
	xmlhttp.send(); 

	
	
}
//删除所有选项
function delcheckbox(){
	
var check = document.getElementsByName("checkme");
var len=check.length;
var idAll="";
for(var i=0;i<len;i++){
	if(i>0){
		if(check[i].checked){
			idAll+=check[i].value+",";
		}
	}
}

seclectdel(idAll);
}


//全选  取消全选功能函数
function selectall(){
var check = document.getElementsByName("checkme");
var len=check.length;

	if(check[0].checked == true){
		for(var i=1;i<len;i++){
			if(check[i].checked== false)
				{
					check[i].checked = true;
				}
		}
	}else{
		
		for(var i=1;i<len;i++){
			if(check[i].checked== true)
				{
					check[i].checked = false;
				}
		}
	}

}


//下一页展示  默认 0-50条
function nextpage(){
	
	var prenum = document.getElementById('prenum').innerHTML;
	var lastnum = document.getElementById('lastnum').innerHTML;
//	alert(prenum+'hallo'+lastnum);
	
	if(prenum == lastnum){
		
		prenum =lastnum;
	}else{
		
		prenum= parseInt("1")+parseInt(prenum);
	}
	
	
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
 // alert(xmlhttp.responseText);
   document.getElementById('tablelist').innerHTML =xmlhttp.responseText;
  document.getElementById('prenum').innerHTML=prenum; //设定当前正确的页码数
  //window.location.reload();
  
  }  else{
	
	   document.getElementById('tablelist').innerHTML =loadingimg();
	   
	
	}
 } 
xmlhttp.open("GET","nextpage.php?id="+prenum,true); 
xmlhttp.send(); 

	
}



//上一页展示  默认 0-50条
function prepage(){
	
	var prenum = document.getElementById('prenum').innerHTML;
	var lastnum = document.getElementById('lastnum').innerHTML;
//	alert(prenum+'hallo'+lastnum);
	
	if(prenum == 1){
		
		prenum =prenum;
	}else{
		
		prenum= parseInt(prenum)-parseInt("1");
	}
	
	
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
 // alert(xmlhttp.responseText);
   document.getElementById('tablelist').innerHTML =xmlhttp.responseText;
  document.getElementById('prenum').innerHTML=prenum; //设定当前正确的页码数
  //window.location.reload();
  
  }  else{
	
	   document.getElementById('tablelist').innerHTML =loadingimg();
	   
	
	}
 } 
xmlhttp.open("GET","nextpage.php?id="+prenum,true); 
xmlhttp.send(); 

	
}


//直接跳转到第一页  默认 0-50条
function firstpage(){
var lastnum = document.getElementById('lastnum').innerHTML;
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
 // alert(xmlhttp.responseText);
   document.getElementById('tablelist').innerHTML =xmlhttp.responseText;
  document.getElementById('prenum').innerHTML=lastnum; //设定当前正确的页码数
  //window.location.reload();
  
  }  else{
	
	   document.getElementById('tablelist').innerHTML =loadingimg();
	   
	
	}
 } 
xmlhttp.open("GET","nextpage.php?id="+lastnum,true); 
xmlhttp.send(); 

	
}

//直接跳转最后一页  默认 0-50条
function lastpage(){
		
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
 // alert(xmlhttp.responseText);
   document.getElementById('tablelist').innerHTML =xmlhttp.responseText;
  document.getElementById('prenum').innerHTML=1; //设定当前正确的页码数
  //window.location.reload();
  
  } else{
	
	   document.getElementById('tablelist').innerHTML =loadingimg();
	   
	
	}
 } 
 
 
xmlhttp.open("GET","nextpage.php?id="+1,true); 
xmlhttp.send(); 

	
}


function loadingimg(){
 var tmpl='';
	  tmpl+='<div id="loading" style="height: 358px;margin: 0px auto;">';
	  tmpl+='<img alt="fanyuhe123" class="avatar" src="http://localhost/dkcps16/api1/tags/loading.gif"';
	  tmpl+='style=" margin-top: 120px;margin-left: 400px;position: absolute;"> </div> ';
	 return tmpl;

}


function test(){
	var val = document.getElementById("val").value.split(",");
	var boxes = document.getElementsByName("test");
	for(i=0;i<boxes.length;i++){
		for(j=0;j<val.length;j++){
			if(boxes[i].value == val[j]){
				boxes[i].checked = true;
				break
			}
		}
	}
}

function sqldel(id)
{ 
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
  window.location.reload();
  
  } 
 } 
xmlhttp.open("GET","delsingle.php?id="+id,true); 
xmlhttp.send(); 
//setTimeout("loadXMLDoc()",1000);//递归调用 
} 


function seclectdel(value)
{ 
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
  window.location.reload();
  
  } 
 } 
xmlhttp.open("GET","delselect.php?id="+value,true); 
xmlhttp.send(); 
//setTimeout("loadXMLDoc()",1000);//递归调用 
} 


