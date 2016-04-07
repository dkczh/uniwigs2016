<?php /* Smarty version Smarty-3.1.19, created on 2015-11-27 09:43:29
         compiled from "templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:35155656ce08cd7e50-92976622%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ac846e967896031ac5bb1c443dccaaff6420907' => 
    array (
      0 => 'templates\\index.tpl',
      1 => 1448588605,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '35155656ce08cd7e50-92976622',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5656ce08db6916_88143115',
  'variables' => 
  array (
    'app_name' => 0,
    'name' => 0,
    'table_list' => 0,
    'sqldata' => 0,
    'r' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5656ce08db6916_88143115')) {function content_5656ce08db6916_88143115($_smarty_tpl) {?>

<?php echo $_smarty_tpl->tpl_vars['app_name']->value;?>



<p>这是来自己index.php 分配的变量（<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
） </p>


<table style="
    width: 80%;
    margin: 0 auto;      
    border: solid 1px gray;
">

<tr>
<td><input type="checkbox" name="checkme"  onclick="checkDelBoxes(this.form, 'tagBox[]', this.checked)"></td>
<td><?php echo $_smarty_tpl->tpl_vars['table_list']->value['id'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['table_list']->value['language'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['table_list']->value['name'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['table_list']->value['products'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['table_list']->value['template'];?>
</td>
<td>操作</td>
</tr>
<hr>

<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sqldata']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value) {
$_smarty_tpl->tpl_vars['r']->_loop = true;
?> 

<tr>
<td><input type="checkbox" name="checkme"  onclick="checkDelBoxes(this.form, 'tagBox[]', this.checked)"></td>
<td><?php echo $_smarty_tpl->tpl_vars['r']->value['id_tag'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['r']->value['lang'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['r']->value['name'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['r']->value['products'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['r']->value['template'];?>
</td>

<td>
<button type="button" onclick='location.reload()'>edit</button>
<button type="button" onclick='alert('删除')'>del</button>
</td>
</tr>

<?php } ?>


</table><?php }} ?>
