<?php /* Smarty version Smarty-3.1.19, created on 2015-11-28 09:23:20
         compiled from "templates\taglist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6305657ba08d8d414-11284340%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d402214505dd045bca44f4b914a3e2075c01bc4' => 
    array (
      0 => 'templates\\taglist.tpl',
      1 => 1448673171,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6305657ba08d8d414-11284340',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5657ba08deeeb8_07617503',
  'variables' => 
  array (
    'table_list' => 0,
    'sqldata' => 0,
    'r' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5657ba08deeeb8_07617503')) {function content_5657ba08deeeb8_07617503($_smarty_tpl) {?><html><head>
    <title>tag编辑器</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="Stylesheet" type="text/css" href="templates/taglist.css">
	<script type="text/javascript" src="templates/taglist.js"></script>
</head>

<body>

<h2>tags 编辑器</h2>

<div  class = 'tablescroll'>
<table class="bordered">
    <thead>

    <tr>
        <th><input type="checkbox" name="checkme"  onclick="selectall()"></th>        
        <th><?php echo $_smarty_tpl->tpl_vars['table_list']->value['id'];?>
</th>
        <th><?php echo $_smarty_tpl->tpl_vars['table_list']->value['language'];?>
</th>
		<th><?php echo $_smarty_tpl->tpl_vars['table_list']->value['name'];?>
</th>
		<th><?php echo $_smarty_tpl->tpl_vars['table_list']->value['products'];?>
</th>
		<th><?php echo $_smarty_tpl->tpl_vars['table_list']->value['template'];?>
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
	  <td><input type="checkbox" name="checkme"  value='<?php echo $_smarty_tpl->tpl_vars['r']->value['id_tag'];?>
'></td> 
      <td  id='tag<?php echo $_smarty_tpl->tpl_vars['r']->value['id_tag'];?>
' onclick="document.location = 'http://localhost/api1/tags/tagcontent.php?id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_tag'];?>
'"><?php echo $_smarty_tpl->tpl_vars['r']->value['id_tag'];?>
</td>
	  <td style="width: 200px;" onclick="document.location = 'http://localhost/api1/tags/tagcontent.php?id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_tag'];?>
'"><?php echo $_smarty_tpl->tpl_vars['r']->value['lang'];?>
</td>
      <td  onclick="document.location = 'http://localhost/api1/tags/tagcontent.php?id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_tag'];?>
'"><?php echo $_smarty_tpl->tpl_vars['r']->value['name'];?>
</td>
      <td  onclick="document.location = 'http://localhost/api1/tags/tagcontent.php?id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_tag'];?>
'"><?php echo $_smarty_tpl->tpl_vars['r']->value['products'];?>
</td>
      <td  onclick="document.location = 'http://localhost/api1/tags/tagcontent.php?id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_tag'];?>
'"><?php echo $_smarty_tpl->tpl_vars['r']->value['template'];?>
</td>
	  <td style="width: 100px;">
	  <button type="button"  onclick="document.location = 'http://localhost/api1/tags/tagcontent.php?id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_tag'];?>
'">编辑</button>
	  <button   type="button" onclick="del('<?php echo $_smarty_tpl->tpl_vars['r']->value['id_tag'];?>
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
</b>			| Display
						<select name="pagination"><option value="20">20</option><option value="50">50</option><option value="100">100</option><option value="300" selected="selected">300</option>
						</select>
						/ <?php echo $_smarty_tpl->tpl_vars['page']->value['row'];?>
result(s)
					</span>   



</body></html><?php }} ?>
