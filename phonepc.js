
//uaredirect("http://mtest.wigsdeal.com","http://test.wigsdeal.com");



if(!IsPC()){
	
/* 	var pcurl = window.location.href;
	var iphoneurl= pcurl.replace("www.uniwigs.com","m.uniwigs.com");
	window.location.href=iphoneurl; */

}

function IsPC(){    
     var userAgentInfo = navigator.userAgent;  
     var Agents = new Array("Android", "iPhone", "SymbianOS", "Windows Phone", "iPod");  //判断标志
     var flag = true;    
     for (var v = 0; v < Agents.length; v++) {    
         if (userAgentInfo.indexOf(Agents[v]) > 0) { flag = false; break; }    
     }    
     return flag;    
  }  IsPC();
  
 