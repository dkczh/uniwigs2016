<?php /* Smarty version Smarty-3.1.19, created on 2015-11-30 14:11:20
         compiled from "templates\newtagcontent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5049565be7669b4b24-21000265%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c03190cf388108f9bd47615d56a89f91da8d3a4' => 
    array (
      0 => 'templates\\newtagcontent.tpl',
      1 => 1448863875,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5049565be7669b4b24-21000265',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_565be7669ef4b5_12760251',
  'variables' => 
  array (
    'r' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565be7669ef4b5_12760251')) {function content_565be7669ef4b5_12760251($_smarty_tpl) {?><html><head>
    <title>新建tag页面</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="Stylesheet" type="text/css" href="templates/tagcontent.css">
	<script type="text/javascript" src="templates/newtagcontent.js"></script>
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
				<label class="control-label col-lg-3 required">Language</label>
				<div class="col-lg-9 ">
				<select name="id_lang" class=" fixed-width-xl" id="id_lang">
				<option value="1" selected="selected">English (English)</option>
				</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3">Template</label>
				<div class="col-lg-9 ">
				<input type="text" name="template" id="template" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['template'];?>
" class="" required="required">
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



	<div   style="width: 980px;margin: 0px auto; margin-bottom: 20px;"> products</div>


		
	<div   style="width: 980px;margin: 0px auto;margin-top: 50px;">
			
			<div  style="width: 750px; float: left;">
				<select multiple="" id="select_left"  style="
    width: 750px;
">
										
										
										
				</select>
				<button   onclick="removeoption()">
					 Remove
				</button>
			</div>

	</div>
	<div style="width: 480px;margin-left: 180px;margin-top: 150px;">
	
	<select multiple="" id="select_right"  style="width: 750px;">
	</select>
			<button   onclick="addoption()">
					 Add
				</button>
	</div>





<div class="foot" style="
    margin: 0px auto;
    width: 960px;
	margin-top: 150px;
">
	<button style="  height: 40px;  
    margin-left: 50px;
    width: 60px;  font-size: 18px;
">
	<a href="http://localhost/api1/tags/index.php" class="btn btn-default" style="
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
	 提交
	</button>
	
	
	
	</div>
	
 <button id="test" onclick="test()" style="
    margin: 0 auto;
    margin-left: 500px;
    width: 100px;
    height: 50px;
">
	 test
	</button>
	

</body></html><?php }} ?>
