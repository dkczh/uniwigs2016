<?php /* Smarty version Smarty-3.1.19, created on 2016-07-06 10:15:34
         compiled from "templates\newcontent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13473577c689b8db950-27756986%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '153abb17ce402e0a57959ca8790b6e835dfc28f0' => 
    array (
      0 => 'templates\\newcontent.tpl',
      1 => 1467771093,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13473577c689b8db950-27756986',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_577c689b912462_40283274',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_577c689b912462_40283274')) {function content_577c689b912462_40283274($_smarty_tpl) {?>﻿<html><head>
    <title>新建keyword</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="Stylesheet" type="text/css" href="templates/css/content.css">
	<script type="text/javascript" src="templates/js/newcontent.js"></script
	<script type="text/javascript" src="templates/js/jquery.js"></script>
</head>

<body class="ps_back-office page-sidebar admintags" style="">

 <center><h1>新建keyword</h1></center>


 


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
				<label class="control-label col-lg-3 required">Keyword</label>
				<div class="col-lg-9 ">
				<input type="text" name="keyword" id="keyword" value="" class="" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3">Skus</label>
				<div class="col-lg-9 ">
				<input type="text" name="sku" id="sku"  >
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
	<a href="/apitools/keywordedit/index.php" class="btn btn-default" style="
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
