<?php /* Smarty version Smarty-3.1.19, created on 2016-04-08 09:49:20
         compiled from "templates\newtagcontent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:406457070d901e7481-89344022%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2592f508b7875b1261d5a90c08dd2e6d4ff7f71' => 
    array (
      0 => 'templates\\newtagcontent.tpl',
      1 => 1460080134,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '406457070d901e7481-89344022',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_57070d90212419_50002043',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57070d90212419_50002043')) {function content_57070d90212419_50002043($_smarty_tpl) {?>﻿<html><head>
    <title>新建tag页面</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="Stylesheet" type="text/css" href="templates/tagcontent.css">
	<script type="text/javascript" src="templates/newtagcontent.js"></script>
	<script type="text/javascript" src="templates/jquery.js"></script>
</head>

<body class="ps_back-office page-sidebar admintags" style="">

 <center><h1>新建tag页面</h1></center>


 


<div id="main">
<div id="content" class="bootstrap">
<div class="row"  style=" width: 980px; margin: 0 auto;">
	<div class="col-lg-12">
	
	<form id="tag_form" class="defaultForm form-horizontal AdminTags" action='' method="post" enctype="multipart/form-data" novalidate="">
			<input type="hidden" name="id_tag" id="id_tag" value="384">
			<input type="hidden" name="submitAddtag" value="1">
			<div class="panel" id="fieldset_0">
		<div class="panel-heading">
				<i class="icon-tag"></i>Tag
		</div>
		<!-- form-wrapper -->
	
		<div class="form-wrapper">
			<div class="form-group">
				<label class="control-label col-lg-3 required">Name</label>
				<div class="col-lg-9 ">
				<input type="text" name="name" id="name" value="" class="" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3 required">Keyword</label>
				<div class="col-lg-9 ">
				<input type="text" name="keyword" id="keyword" value="" class="" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3 required">Description</label>
				<div class="col-lg-9 ">
				<input type="text" name="description" id="description" value="" class="" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3 required">Language</label>
				<div class="col-lg-9 ">
				<select name="id_lang" class=" fixed-width-xl" id="id_lang">
				<option value="1" selected="selected">English (English)</option>
				</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3 required">Catagory</label>
				<div class="col-lg-9 ">
				<select name="id_lang" class=" fixed-width-xl"  id="id_catagory">
				<option value="Default" selected = "selected">Default</option>
				<option value="Synthetic Wigs"  >Synthetic Wigs</option>
				<option value="Human Hair Wigs" >Human Hair Wigs</option>
				<option value="Hair Extensions"  >Hair Extensions</option>
				<option value="Hair Pieces">Hair Pieces</option>
				</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3">Template</label>
				<div class="col-lg-9 ">
				<input type="text" name="template" id="template"  >
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3">SKUs</label>
				<div class="col-lg-9 ">
				<textarea name="skus" id="skus" class=" textarea-autosize" 
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
	<a href="/apitools/tagedit/tagedit.php" class="btn btn-default" style="
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
