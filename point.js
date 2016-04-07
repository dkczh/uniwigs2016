


function transform(){

	var xmlhttp; 
	var id = document.getElementById("cuid").innerHTML;
	var points = document.getElementById("points").value;
	var allpoints=document.getElementById("allpoints").innerHTML;
	if(id==''||points ==''){
		
		alert('请输入要转换的积分');
		return;
	}
	//js 对比大小 需要转换为 整数值
	if(parseInt(allpoints)<parseInt(points)){
		
		alert('请不要超过总积分');
		return;
	}
	if(0>parseInt(points)){
		
		alert('请输入大于0的积分');
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
    // alert('test');
     /*document.getElementById('result').innerHTML="<span style='color:red;font-weight: bold;''>"+xmlhttp.responseText+"</span>"; */
    window.location.href="/module/loyalty/default?process=transformpoints"; 
      
      }  else{
        
       // document.getElementById('result').innerHTML="<span style='color:red;font-weight: bold;''>响应错误,请联系管理员</span>"; 
      /*window.location.href="/module/loyalty/default?process=transformpoints";*/ 
      }
     } 

    xmlhttp.open("GET","/myloyaltyTransfrom.php?id="+id+"&points="+points,true); 
    xmlhttp.send(); 
  
}
	