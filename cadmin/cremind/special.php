<?php
require ('../include/init.inc.php');
$method = $user_id = $page_no = '';
extract ( $_GET, EXTR_IF_EXISTS );

$cremind = Cremind::getSpecialRemind();//获取所有未超期的 特殊事件


Template::assign('samples', $cremind);
Template::display('cremind/special.tpl');
