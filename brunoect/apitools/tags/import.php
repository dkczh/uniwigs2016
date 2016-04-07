<?php
//导入文件处理 


$import =$_GET['id'];


echo file_get_contents("$import");

echo $import;