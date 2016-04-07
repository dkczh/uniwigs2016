<?php

$file = __FILE__; //文件完整路径
$dir =  __DIR__ ;//文件所在完整目录  
define('PS_API_TSMARTY',getcwd());

//echo $file."</br>"; //输出内容D:\www\dkcps16\API\tsmarty\index.php
//echo $dir."</br>";  //输出内容D:\www\dkcps16\API\tsmarty
//echo PS_API_TSMARTY ;

require_once(PS_API_TSMARTY.'/../public/conn.php'); // /../在当前目录 寻找上一目录指定目录 和文件
require_once(PS_API_TSMARTY.'/../../config/settings.inc.php'); // 
require_once(PS_API_TSMARTY.'/../../config/config.inc.php'); // 
require_once(PS_API_TSMARTY.'/../../classes/db/Db.php'); // 

require_once(PS_API_TSMARTY.'/../smarty.config.php');


$smarty = new Smarty_Search();


$smarty->display('newtagcontent.tpl');