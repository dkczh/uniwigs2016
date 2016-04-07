<?php /* Smarty version Smarty-3.1.19, created on 2016-03-01 11:23:48
         compiled from "templates/newcontent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:207572706856d50b44d479a1-09582649%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6ee5391f490abc322c11cf6d2bd74a59d2dc3884' => 
    array (
      0 => 'templates/newcontent.tpl',
      1 => 1452908616,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '207572706856d50b44d479a1-09582649',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_56d50b44d69153_53421889',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d50b44d69153_53421889')) {function content_56d50b44d69153_53421889($_smarty_tpl) {?>﻿<html><head>
    <title>新建产品（视频和定制）页面</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="Stylesheet" type="text/css" href="templates/css/content.css">
	<script type="text/javascript" src="templates/js/newcontent.js"></script
	<script type="text/javascript" src="templates/js/jquery.js"></script>
</head>

<body class="ps_back-office page-sidebar admintags" style="">

 <center><h1>新建产品（视频和定制）页面</h1></center>


 


<div id="main">
<div id="content" class="bootstrap">
<div class="row"  style=" width: 980px; margin: 0 auto;">
	<div class="col-lg-12">
	
	<form id="tag_form" class="defaultForm form-horizontal AdminTags" action='' method="post" enctype="multipart/form-data" novalidate="">
			<input type="hidden" name="id_tag" id="id_tag" value="384">
			<input type="hidden" name="submitAddtag" value="1">
			<div class="panel" id="fieldset_0">
		<div class="panel-heading">
				<i class="icon-tag"></i>Product
		</div>
		<!-- form-wrapper -->
	
		<div class="form-wrapper">
			<div class="form-group">
				<label class="control-label col-lg-3 required">Skus</label>
				<div class="col-lg-9 ">
				<input type="text" name="skus" id="skus" value="" class="" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3">video</label>
				<div class="col-lg-9 ">
				<input type="text" name="video" id="video"  >
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3">custom</label>
				<div class="col-lg-9 ">
				<textarea name="custom" id="custom" class=" textarea-autosize" 
				style="overflow: hidden; word-wrap: break-word; resize: none; height: 180px;"></textarea>
				</div>
			</div>
		</div>
		

		<!-- /.form-wrapper -->						

											


	<div >

	
	</div>
</div>
</form>

</div>


</div>
</div>
</div>



<div class="foot" style="
    margin: 0px auto;
    width: 960px;
	
    margin-top: 460px;
">

</div>



<div class="foot" style="
    margin: 0px auto;
    width: 960px;
	margin-top: 10px;
">
	<button style="  height: 40px;  
    margin-left: 50px;
    width: 60px;  font-size: 18px;
">
	<a href="/apitools/productedit/index.php" class="btn btn-default" style="
    text-decoration: none;
    color: rgb(63, 57, 57);
"> 
	<i class="process-icon-save">
	</i>取消</a>
	</button>
	
	
<button id='savetag' onclick="savetag()" style="
    margin-left: 700px;
    height: 40px;
    width: 60px;
    font-size: 18px;
">
	 保存
	</button>
</div>
	

                                                                                                                                                                                  "></div>


	

	

</body></html><?php }} ?>
