<?php /* Smarty version Smarty-3.1.19, created on 2016-02-22 17:33:51
         compiled from "templates/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:178770081656cad5ff3c6995-32356364%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c92cfd967da00f224d19e8ee5e73f373564d547' => 
    array (
      0 => 'templates/content.tpl',
      1 => 1452908616,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178770081656cad5ff3c6995-32356364',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id' => 0,
    'sqldata' => 0,
    'r' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_56cad5ff3fc359_78880813',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56cad5ff3fc359_78880813')) {function content_56cad5ff3fc359_78880813($_smarty_tpl) {?><html><head>
    <title>product 详细页面</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="Stylesheet" type="text/css" href="templates/css/content.css">
	<script type="text/javascript" src="templates/js/content.js"></script>
	<script type="text/javascript" src="templates/js/jquery.js"></script>
		
</head>

<body class="ps_back-office page-sidebar admintags" style="">

 <center><h1>product 详细页面</h1></center>


  <center><p>你当前打开的是 id为<span id='tagid'><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
 </span> 的product编辑页面 <p></center>




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
		<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sqldata']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value) {
$_smarty_tpl->tpl_vars['r']->_loop = true;
?> 
		<div class="form-wrapper">
			<div class="form-group">
				<label class="control-label col-lg-3 required">Skus</label>
				<div class="col-lg-9 ">
				<input type="text" name="skus" id="skus" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['skus'];?>
" class="" required="required">
				</div>
			</div>
				<div class="form-group">
				<label class="control-label col-lg-3">Video</label>
				<div class="col-lg-9 ">
				<input type="text" name="video" id="video" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['video'];?>
" class="" required="required">
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-lg-3">Custom</label>
				<div class="col-lg-9 ">
				<input type="text" name="custom" id="custom" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['custom'];?>
" class="" required="required">
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
	
<hr style="
    width: 980px;
    margin: 0px auto;
    margin-top: 20px;
    margin-bottom: 20px;
">


</body></html><?php }} ?>
