<?php
/*
* 加载smarty 基本库
*/
define('_PS_TOOL_DIR_',getcwd());

define('_PS_SMARTY_DIR_', _PS_TOOL_DIR_.'/../../tools/smarty/');
// load Smarty library
require_once(_PS_SMARTY_DIR_.'Smarty.class.php');




class Smarty_Search extends Smarty {

 function Smarty_Search() {
 
 		// Class Constructor. These automatically get set with each new instance.
 //类构造函数.创建实例的时候自动配置
		parent::__construct();  
		

		$this->template_dir = 'templates/';  //制定模板存放目录
		$this->compile_dir = 'complile/'; // 编译文件存放位置
		$this->config_dir = 'config/';
		$this->cache_dir = 'cache/'; 
		
		$this->caching = false;//是否开启缓存
		$this->assign('app_name','Guest Book');
 }
}