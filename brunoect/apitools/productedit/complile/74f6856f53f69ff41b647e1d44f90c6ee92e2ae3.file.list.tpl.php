<?php /* Smarty version Smarty-3.1.19, created on 2016-02-22 17:04:48
         compiled from "templates/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:201529986756cacf30cbaca8-86935776%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '74f6856f53f69ff41b647e1d44f90c6ee92e2ae3' => 
    array (
      0 => 'templates/list.tpl',
      1 => 1452908617,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '201529986756cacf30cbaca8-86935776',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'curl' => 0,
    'table_list' => 0,
    'sqldata' => 0,
    'r' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_56cacf30d65b97_12838298',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56cacf30d65b97_12838298')) {function content_56cacf30d65b97_12838298($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/www/web/uniwigs/public_html/tools/smarty/plugins/modifier.truncate.php';
?><html><head>
    <title>产品prducts （video custom）编辑器</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="Stylesheet" type="text/css" href="templates/css/list.css">
	<script type="text/javascript" src="templates/js/list.js"></script>
</head>

<body>

<h2>产品prducts （video custom）编辑器</h2>



         <input type="text" class="box" id='key_tag' oninput="tagsearch()" placeholder="输入skus名称" >
         <button  onclick="tagsearch()"  >搜索 </button>





<button type="button" onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['curl']->value;?>
/newcontent.php'"    style="
    float: right;
    height: 40px;
    width: 70px;
    margin-bottom: 10px;
">新建product</button>
<div  class = 'tablescroll'>
<table class="bordered">
    <thead>

    <tr>
        <th style="
    width: 50px;
"><input type="checkbox" name="checkme"  onclick="selectall()">全选</th>        
        <th><?php echo $_smarty_tpl->tpl_vars['table_list']->value['id'];?>
</th>
        <th><?php echo $_smarty_tpl->tpl_vars['table_list']->value['skus'];?>
</th>
		<th><?php echo $_smarty_tpl->tpl_vars['table_list']->value['video'];?>
</th>
		<th><?php echo $_smarty_tpl->tpl_vars['table_list']->value['custom'];?>
</th>
		
		
		<th>action</th>
    </tr>
    </thead>
    <tbody id= 'tablelist'>
	
	<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sqldata']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value) {
$_smarty_tpl->tpl_vars['r']->_loop = true;
?> 
	<tr>
	  <td><input type="checkbox" name="checkme"  value='<?php echo $_smarty_tpl->tpl_vars['r']->value['id'];?>
'></td> 
      <td  id='tag<?php echo $_smarty_tpl->tpl_vars['r']->value['id'];?>
' onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['curl']->value;?>
/content.php?id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id'];?>
'"><?php echo $_smarty_tpl->tpl_vars['r']->value['id'];?>
</td>
      <td  onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['curl']->value;?>
/content.php?id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id'];?>
'"><?php echo $_smarty_tpl->tpl_vars['r']->value['skus'];?>
</td>
      <td  onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['curl']->value;?>
/content.php?id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id'];?>
'"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['r']->value['video'],40,'');?>
</td>
	  <td  onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['curl']->value;?>
/content.php?id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id'];?>
'" ><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['r']->value['custom'],40,'');?>
</td>
	  <td style="width: 100px;">
	  <button type="button"  onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['curl']->value;?>
/content.php?id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id'];?>
'">编辑</button>
	  <button   type="button" onclick="del('<?php echo $_smarty_tpl->tpl_vars['r']->value['id'];?>
')">删除</button>
	  </td>
		
    </tr>  
	<?php } ?>	
</tbody>



</table>


</div>
<button type="button" onclick="delcheckbox()">删除</button>
<button type="button" onclick="lastpage()">首页</button>
<button type="button" onclick="prepage()">上一页</button>
<button type="button" onclick="nextpage()">下一页</button>
<button type="button" onclick="firstpage()">尾页</button>
<!-- <button type="button" onclick="prepage()">test</button> -->
<br>

 <span style="float: left;">Page 
 <b id='prenum'><?php echo $_smarty_tpl->tpl_vars['page']->value['cpage'];?>
</b> /  <b id='lastnum'><?php echo $_smarty_tpl->tpl_vars['page']->value['allpage'];?>
</b>	<!-- 	| Display -->
					<!-- 	<select name="pagination">
						<option value="20">20</option>
						<option value="50">50</option>
						<option value="100">100</option>
						<option value="300" selected="selected">300</option>
						</select> -->
						/ <?php echo $_smarty_tpl->tpl_vars['page']->value['row'];?>
result(s)
					</span>   



</body></html><?php }} ?>
