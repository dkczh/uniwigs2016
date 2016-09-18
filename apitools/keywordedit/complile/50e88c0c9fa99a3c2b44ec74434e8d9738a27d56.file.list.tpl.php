<?php /* Smarty version Smarty-3.1.19, created on 2016-07-06 09:43:53
         compiled from "templates\list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21608577c5a8579a453-53824145%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50e88c0c9fa99a3c2b44ec74434e8d9738a27d56' => 
    array (
      0 => 'templates\\list.tpl',
      1 => 1467769431,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21608577c5a8579a453-53824145',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_577c5a8582eb70_46557088',
  'variables' => 
  array (
    'curl' => 0,
    'table_list' => 0,
    'sqldata' => 0,
    'r' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_577c5a8582eb70_46557088')) {function content_577c5a8582eb70_46557088($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'C:\\www\\uniwigsll\\tools\\smarty\\plugins\\modifier.truncate.php';
?><html><head>
    <title>搜索keyword 编辑器</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="Stylesheet" type="text/css" href="templates/css/list.css">
	<script type="text/javascript" src="templates/js/list.js"></script>
</head>

<body>

<h2>搜索keyword 编辑器</h2>



         <input type="text" class="box" id='key_tag' oninput="tagsearch()" placeholder="输入keyword名称" >
         <button  onclick="tagsearch()"  >搜索 </button>





<button type="button" onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['curl']->value;?>
/newcontent.php'"    style="
    float: right;
    height: 40px;
    width: 70px;
    margin-bottom: 10px;
">新建keyword</button>
<div  class = 'tablescroll'>
<table class="bordered">
    <thead>

    <tr>
        <th style="
    width: 50px;
"><input type="checkbox" name="checkme"  onclick="selectall()">全选</th>        
        <th><?php echo $_smarty_tpl->tpl_vars['table_list']->value['id'];?>
</th>
        <th><?php echo $_smarty_tpl->tpl_vars['table_list']->value['keyword'];?>
</th>
		<th><?php echo $_smarty_tpl->tpl_vars['table_list']->value['sku'];?>
</th>
		<th><?php echo $_smarty_tpl->tpl_vars['table_list']->value['pid'];?>
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
	  <td><input type="checkbox" name="checkme"  value='<?php echo $_smarty_tpl->tpl_vars['r']->value['id_word'];?>
'></td> 
      <td  id='tag<?php echo $_smarty_tpl->tpl_vars['r']->value['id_word'];?>
' onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['curl']->value;?>
/content.php?id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_word'];?>
'"><?php echo $_smarty_tpl->tpl_vars['r']->value['id_word'];?>
</td>
      <td  onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['curl']->value;?>
/content.php?id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_word'];?>
'"><?php echo $_smarty_tpl->tpl_vars['r']->value['keyword'];?>
</td>
      <td  onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['curl']->value;?>
/content.php?id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_word'];?>
'"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['r']->value['psku'],40,'');?>
</td>
		<td  onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['curl']->value;?>
/content.php?id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_word'];?>
'"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['r']->value['pid'],40,'');?>
</td>
	  <td style="width: 100px;">
	  <button type="button"  onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['curl']->value;?>
/content.php?id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_word'];?>
'">编辑</button>
	  <button   type="button" onclick="del('<?php echo $_smarty_tpl->tpl_vars['r']->value['id_word'];?>
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
