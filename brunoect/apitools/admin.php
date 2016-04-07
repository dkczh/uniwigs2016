
<?php
/*
* AUTHOR  DKC 
*
* apitool  所有功能模块 管理页面
* 
* 
*/


require_once('checklogin.php');


?>


<html >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>后台管理界面</title>
	<link rel="stylesheet" type="text/css" href="admin/style.css"> 
</head>

<body>

	<div id="page-wrap">

		<h1>后台管理界面</h1>
		<p></p>
		
		
		
		<div id="organic-tabs">
					
    		<ul id="explore-nav">
                <li id="ex-featured"><a rel="featured" href="#" class="current">插件列表</a></li>
          
            </ul>
    		
    		<div id="all-list-wrap">
    		
    			<ul id="featured">
    				<li><a href="/apitool/import/index.php">1.3数据迁移1.6工具</a></li>
    				<li><a href="/apitool/tags/index.htm">tag管理工具</a></li>
    				<li><a href="#">......</a></li>
    				<li><a href="#">......</a></li>
    				<li><a href="#">......</a></li>
    				<li><a href="#">......</a></li>
    				<li><a href="#">......</a></li>
    			</ul>
        	
    		 </div> 
		 
		 </div> 
	
	</div>
	

</body>
</html>


