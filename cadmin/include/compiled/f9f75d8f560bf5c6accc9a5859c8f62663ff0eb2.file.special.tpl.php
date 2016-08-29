<?php /* Smarty version Smarty-3.1.15, created on 2016-08-22 17:32:22
         compiled from "C:\www\uniwigsll\cadmin\include\template\cremind\special.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21755796cf1b9f9656-67989727%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f9f75d8f560bf5c6accc9a5859c8f62663ff0eb2' => 
    array (
      0 => 'C:\\www\\uniwigsll\\cadmin\\include\\template\\cremind\\special.tpl',
      1 => 1471858340,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21755796cf1b9f9656-67989727',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5796cf1ba245e3_41746122',
  'variables' => 
  array (
    'samples' => 0,
    'sample' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5796cf1ba245e3_41746122')) {function content_5796cf1ba245e3_41746122($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">特殊事件客户列表</a>
	<div id="page-stats" class="block-body collapse in">
	<table class="table table-striped">
			<thead>
			<tr>
				<th>CustomerId</th>
				<th>Email</th>
				<th>事件内容</th>
				<th>截止日期</th>
				<th>剩余天数</th>
			</tr>
			</thead>
			<tbody>
			<?php  $_smarty_tpl->tpl_vars['sample'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sample']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['samples']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sample']->key => $_smarty_tpl->tpl_vars['sample']->value) {
$_smarty_tpl->tpl_vars['sample']->_loop = true;
?>
				<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['sample']->value['id_customer'];?>
</td>
				<td>
				<a href="/cadmin/cmanager/message.php?cid=<?php echo $_smarty_tpl->tpl_vars['sample']->value['id_customer'];?>
" target="_blank">
				<?php echo $_smarty_tpl->tpl_vars['sample']->value['email'];?>

				</a>
				</td>
				<td>
				<?php echo $_smarty_tpl->tpl_vars['sample']->value['content'];?>

				</td>
				<td>
				<?php echo $_smarty_tpl->tpl_vars['sample']->value['date_end'];?>

				</td>
				<td style="color:red">
				<?php echo $_smarty_tpl->tpl_vars['sample']->value['mdate'];?>

				</td>
			
				</tr>
			<?php } ?>
		  </tbody>
		</table>
	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
