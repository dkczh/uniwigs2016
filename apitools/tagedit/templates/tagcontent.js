var xmlhttp; 


//打开当前选中tag的编辑页面

function uploadimg(){

var  tagid = document.getElementById('tagid').innerHTML;
var arr= document.getElementById('imgfile').value;
alert(arr[0]);
exit;
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

    alert(xmlhttp.responseText);
    location.reload() ;
 //document.getElementById('imgshow').innerHTML=xmlhttp.responseText;

  
  }  else{
    

  }
 } 
xmlhttp.open("GET","uploadimg.php?id="+tagid,true); 
xmlhttp.send(); 
  
}



function delimg(url){
var  tagid = document.getElementById('tagid').innerHTML;

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

    alert(xmlhttp.responseText);
    location.reload() ;
 //document.getElementById('imgshow').innerHTML=xmlhttp.responseText;

  
  }  else{
    
  document.getElementById('imgshow').innerHTML='...';
  }
 } 
xmlhttp.open("GET","delimg.php?id="+tagid+"&url="+url,true); 
xmlhttp.send(); 
  
}



//下一页展示  默认 0-50条
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
xmlhttp.open("GET","savetag.php?id="+taginfo,true); 
xmlhttp.send(); 
	
}


/*将一个tagcontent中的 tag  的 id, name，template,skus,products并json化 
  */
function getinfo(){

var  tagid = document.getElementById('tagid').innerHTML;
var  name = document.getElementById('name').value;
var  template = document.getElementById('template').value;
var  skus = document.getElementById('skus').value;
var  keyword = document.getElementById('keyword').value;
var  description = document.getElementById('description').value;

var catagory = document.getElementById('id_catagory').value; //定位id



var tag=new Array(); 
tag[0] = tagid;
tag[1] = name;
tag[2] = template;
tag[3] = skus;
tag[5] = catagory ;
tag[6] = keyword;
tag[7] = description ;


tag[4] = getAllItemValuesByString(); //获取当前 所有 tags 产品组合

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



/*function test(){
var str = document.getElementById('import').value;
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
  //alert(xmlhttp.responseText);
 document.getElementById('checkbox2').innerHTML=xmlhttp.responseText;

  
  }  else{
   
  document.getElementById('select_right').innerHTML='数据导入中......'
  }
 } 
xmlhttp.open("GET","import.php?id="+str,true); 
xmlhttp.send(); 




}*/
function test(){
/*    var reader = new FileReader();
    var str = '';
   
    reader.onload = function() 
    {
      str  = this.result
      str=str.split('|'); //字符分割 

     alert(str[0]);
    }
    var f = document.getElementById("import").files[0];
    reader.readAsText(f);*/
 // alert(str);

var obj = document.getElementById('bigimg');

   if (obj.style.display=="block"){
                obj.style.display="none";
              
  

            } else {
                obj.style.display="block";
               
            }


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