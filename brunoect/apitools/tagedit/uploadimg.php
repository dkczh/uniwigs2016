<?php

 $uploadfile; // 图片的名字
  if(isset($_POST['uploadpic']))
	 if($_POST['uploadpic']=='上传')
	 { 		
		  $dest_folder = $_SERVER['DOCUMENT_ROOT']."/img/tag/".$_POST['tagid'].'/';
		  $arr=array();   
		  $count=0; 
		  
		  if(!file_exists($dest_folder))
		  { 
		   mkdir($dest_folder,777); // 创建文件夹，并给予最高权限
		   chmod($dest_folder, 0777);
		  }
	  
			$tp = array("image/gif","image/pjpeg","image/jpeg","image/png"); 
			//检查上传文件是否在允许上传的类型 
		 
	  
		  foreach ($_FILES["uploads"]["error"] as $key => $error)
		   { 
		  
				 if(!in_array($_FILES["uploads"]["type"][$key],$tp)) 
				{ 
					echo "<script language='javascript'>"; 
					echo "alert(\"文件类型错误!\");";
					echo "</script>"; 	
					exit; 
				} 
		
			   if ($error == UPLOAD_ERR_OK) 
			   { 
				$tmp_name = $_FILES["uploads"]["tmp_name"][$key];    
				$a=explode(".",$_FILES["uploads"]["name"][$key]);  //截取文件名跟后缀
			   // $prename = substr($a[0],10);   //如果你到底的图片名称不是你所要的你可以用截取字符得到
			//上传文件名
				$prename = $a[0];
				//根据时间戳 自动生成文件名
			   $name = date("YmdHis").mt_rand(100,999).".".$a[1];  // 文件的重命名 （日期+随机数+后缀）
				$uploadfile = $dest_folder.$prename; 				// 文件的路径
				move_uploaded_file($tmp_name, $uploadfile);
				$arr[$count]=$uploadfile;  
			
				
		
			   }
			} 
		echo "文件上传成功";	
		echo "<script type='text/javascript'> parent.location.reload() ;</script>";
	} 