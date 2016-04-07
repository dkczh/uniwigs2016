<?php /* Smarty version Smarty-3.1.19, created on 2015-11-30 14:04:03
         compiled from "templates\tagcontent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53485657bcebe70e11-10961860%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f0e4c09e8cdda048d441fecf79fa37d825ef224e' => 
    array (
      0 => 'templates\\tagcontent.tpl',
      1 => 1448863304,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53485657bcebe70e11-10961860',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5657bcebea3aa9_21395643',
  'variables' => 
  array (
    'id' => 0,
    'sqldata' => 0,
    'r' => 0,
    'product' => 0,
    'p' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5657bcebea3aa9_21395643')) {function content_5657bcebea3aa9_21395643($_smarty_tpl) {?><html><head>
    <title>tag编辑器</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="Stylesheet" type="text/css" href="templates/tagcontent.css">
	<script type="text/javascript" src="templates/tagcontent.js"></script>
</head>

<body class="ps_back-office page-sidebar admintags" style="">

 <center><h1>tags 详细页面</h1></center>


  <center><p>你当前打开的是 id为<span id='tagid'><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
 </span> 的tag编辑页面 <p></center>




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
		<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sqldata']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value) {
$_smarty_tpl->tpl_vars['r']->_loop = true;
?> 
		<div class="form-wrapper">
			<div class="form-group">
				<label class="control-label col-lg-3 required">Name</label>
				<div class="col-lg-9 ">
				<input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['name'];?>
" class="" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3 required">Language</label>
				<div class="col-lg-9 ">
				<select name="id_lang" class=" fixed-width-xl" id="id_lang">
				<option value="<?php echo $_smarty_tpl->tpl_vars['r']->value['lang'];?>
"><?php echo $_smarty_tpl->tpl_vars['r']->value['lang'];?>
</option>
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
				style="overflow: hidden; word-wrap: break-word; resize: none; height: 180px;"><?php echo $_smarty_tpl->tpl_vars['r']->value['skus'];?>
</textarea>
				</div>
			</div>
		</div>
		<?php } ?>

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
											<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
?> 
										<option value="<?php echo $_smarty_tpl->tpl_vars['p']->value['id_product'];?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value['name'];?>
</option>
											<?php } ?>
										
										
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
	 保存
	</button>
	
	
	
	</div>
	
<!-- <button id="test" onclick="test()" style="
    margin: 0 auto;
    margin-left: 500px;
    width: 100px;
    height: 50px;
">
	 test
	</button>
	 -->

</body></html><?php }} ?>
