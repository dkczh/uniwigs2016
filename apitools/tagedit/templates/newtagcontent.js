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
xmlhttp.open("GET","addtag.php?id="+taginfo,true); 
xmlhttp.send(); 
	
}


/*将一个tagcontent中的 tag  的 id, name，template,skus,products并json化 
  */
function getinfo(){


var  name = document.getElementById('name').value;

if(name==''){

  alert('请输入tag的名称');
  exit;
}
var  template = document.getElementById('template').value;
var  keyword = document.getElementById('keyword').value;
var  description = document.getElementById('description').value;
var  skus = document.getElementById('skus').value;
var  catagory = document.getElementById('id_catagory').value; //定位id


var tag=new Array(); 

tag[0] = name;
tag[1] = template;
tag[2] = skus;
tag[5] = keyword;
tag[6] = description;
tag[4] = catagory;

tag[3] = getAllItemValuesByString(); //获取当前 所有 tags 产品组合

var tagjson =JSON.stringify(tag); 

return  tagjson;



	
}


/*获取产品搜索结果 
  */
function getproduct(){
var xmlhttp; 
var  product = document.getElementById('beginid').value+',';
product+= document.getElementById('endid').value+',';
product+= document.getElementById('keyword').value;







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
	//alert(xmlhttp.responseText);
 document.getElementById('checkbox2').innerHTML=xmlhttp.responseText;

  
  }  else{
	 
	//document.getElementById('select_right').innerHTML='数据加载......'
  }
 } 
xmlhttp.open("GET","search.php?id="+product,true); 
xmlhttp.send(); 

	
}


function test(){
	
 alert(getAllItemValuesByString());
}











/* 获取select中的所有item，并且组装所有的值为一个字符串，值与值之间用逗号隔开
 @param objSelectId 目标select组件id
 @return select中所有item的值，值与值之间用逗号隔开
 */
function getAllItemValuesByString() {
   var idsstr = "";
$(document).ready(function(){
   
  
    $("#checkbox1 input[name=products]").each(function(){ //遍历table里的全部checkbox
        idsstr += $(this).val() + "-"; //获取所有checkbox的值
   
    });
  /*  if(idsstr.length > 0) //如果获取到
        idsstr = idsstr.substring(0, idsstr.length - 1); //把最后一个逗号去掉截取字符串*/
   
  

});

return idsstr;
}