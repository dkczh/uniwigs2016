


function mydesinger(){

	var xmlhttp; 
	var begintime = document.getElementById("begintime").value;
	var endtime = document.getElementById("endtime").value;

	if(endtime==''||begintime ==''){
		
		alert('请选择日期');
		return;
	}
	//alert(begintime+endtime);
	


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
    // alert('test');
     document.getElementById('myresult').innerHTML=xmlhttp.responseText; 
  
      
      }  else{
        
       // document.getElementById('result').innerHTML="<span style='color:red;font-weight: bold;''>响应错误,请联系管理员</span>"; 
      /*window.location.href="/module/loyalty/default?process=transformpoints";*/ 
      }
     } 

    xmlhttp.open("GET","/mydesinger.php?begin="+begintime+"&end="+endtime,true); 
    xmlhttp.send(); 
  
}
	