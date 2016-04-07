<?php

if(isset($_GET['id'])&&isset($_GET['url'])){


	$file = $_SERVER['DOCUMENT_ROOT'].$_GET['url']; 
	if(file_exists($file)){
		if (!unlink($file))
		  {
		  echo ("Error deleting $file");
		  }
		else
		  {
		  echo ("Deleted $file");
		  }
	}else{
		echo '文件不存在';
	}
}

