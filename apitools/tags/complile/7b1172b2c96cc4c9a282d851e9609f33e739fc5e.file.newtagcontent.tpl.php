<?php /* Smarty version Smarty-3.1.19, created on 2015-12-01 17:55:41
         compiled from "templates\newtagcontent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6631565cfa16d11be0-90907279%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b1172b2c96cc4c9a282d851e9609f33e739fc5e' => 
    array (
      0 => 'templates\\newtagcontent.tpl',
      1 => 1448963730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6631565cfa16d11be0-90907279',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_565cfa16d6f803_85838511',
  'variables' => 
  array (
    'r' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565cfa16d6f803_85838511')) {function content_565cfa16d6f803_85838511($_smarty_tpl) {?>﻿<html><head>
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







<div class="foot" style="
    margin: 0px auto;
    width: 960px;
	
    margin-top: 460px;
">

</div>


<button onclick="test()">测试</button>
<div class = 'showproduct'>

	<div style="
    border-bottom:  solid 1px #e6e6e6;
    padding: 10px;
    font-weight: bold;
font-size: 14px;
">
				Product
		</div>
	<table>
		<tbody>
			<tr>
				<td style="padding-left:6px;">
				<input type="checkbox" id="check_all_l" onclick="$('#checkbox1 input').attr('checked',$('#check_all_l').attr('checked'))" class="noborder" name="checkme"> 全选
				</td>
				<td style="padding-left:20px;">
					起止产品ID: 
					<input type="text" name="beginid" id="beginid"size="8"> - 
					<input type="text" name="endid" id="endid" size="8"><br>
					关键词: 
					<input type="text" name="keyword" id="keyword" value="" size="30"> &nbsp;<input type="button" value="查询" onclick="getproduct();"> &nbsp;  全选 <input type="checkbox" id="check_all" onclick="$('#checkbox2 input').attr('checked',$('#check_all').attr('checked'))">
				
					</td>
			</tr>
			<tr>
				<td>
					<div style="width: 356px; height: 400px; overflow-y:scroll;background: white;" id="checkbox1">  
				<div class="search_result_prd_item">
					<img src="/dkcps16/img/p/100005/100005.jpg">
					<input type="checkbox" value="100005" name="products">
	            	<br>Hedy Synthetic Wig
	            	</div>
		
					 </div>
					<a href="#" id="add" >
					Remove &gt;&gt;
					</a>
				</td>
				<td>
					<div style="width: 550px; height: 400px;margin-left: 10px; overflow-y: scroll;background: white;" id="checkbox2">
						            			            								
					</div>
						<a href="#" id="remove" >
					&lt;&lt; Add
					</a>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<script type="text/javascript">
			$().ready(function() {
				$('#add').click(function() {
					$('#checkbox1 input:checked').each(function(i) {
						$(this).parent().appendTo('#checkbox2');
						$(this).attr("checked", false);
					});
					return false;
				});
				$('#remove').click(function() {
					$('#checkbox2 input:checked').each(function(i) {
						$(this).parent().appendTo('#checkbox1');
						$(this).attr("checked", false);
					});
					return false;
				});
			});
		
		</script>

<div class="foot" style="
    margin: 0px auto;
    width: 960px;
	margin-top: 10px;
">
	<button style="  height: 40px;  
    margin-left: 50px;
    width: 60px;  font-size: 18px;
">
	<a href="http://localhost/dkcps16/api1/tags/index.php" class="btn btn-default" style="
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
                                                                                                                                                                                  "></div>

        <div class = 'showproduct1'>

	
		</div>
	

	

</body></html><?php }} ?>
