<?php /* Smarty version Smarty-3.1.15, created on 2016-07-26 11:03:08
         compiled from "C:\www\uniwigsll\cadmin\include\template\cmanager\message.tpl" */ ?>
<?php /*%%SmartyHeaderCode:140035796d2ec5a37e3-38698091%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b15f9659c2180a5ac3c833b256c0eefcfc50a840' => 
    array (
      0 => 'C:\\www\\uniwigsll\\cadmin\\include\\template\\cmanager\\message.tpl',
      1 => 1469502142,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '140035796d2ec5a37e3-38698091',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'samples' => 0,
    'sample' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5796d2ec5ce771_00208610',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5796d2ec5ce771_00208610')) {function content_5796d2ec5ce771_00208610($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">客户信息</a>
	<div id="page-stats" class="block-body collapse in">
	<table class="table table-striped">
			<thead>
			<tr>
				<th>CustomerId</th>
				<th>Email</th>
			</tr>
			</thead>
			<tbody>
			<?php  $_smarty_tpl->tpl_vars['sample'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sample']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['samples']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sample']->key => $_smarty_tpl->tpl_vars['sample']->value) {
$_smarty_tpl->tpl_vars['sample']->_loop = true;
?>
				<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['sample']->value['sample_id'];?>
</td>
				<td>
				<a href="/cadmin/cmanager/message.php?cid=<?php echo $_smarty_tpl->tpl_vars['sample']->value['sample_id'];?>
" target="_blank">
				<?php echo $_smarty_tpl->tpl_vars['sample']->value['sample_content'];?>

				</a>
				</td>
				</tr>
			<?php } ?>
		  </tbody>
		</table>
	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
