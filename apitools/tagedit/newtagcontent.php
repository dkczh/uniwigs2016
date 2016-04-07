<?php
//创建新的tag页面
define('PS_API_TAG',getcwd());

require_once(PS_API_TAG.'/../smarty.config.php');


$smarty = new Smarty_Search();


$smarty->display('newtagcontent.tpl');