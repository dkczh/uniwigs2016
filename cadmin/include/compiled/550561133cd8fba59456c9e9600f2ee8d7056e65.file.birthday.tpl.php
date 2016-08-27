<?php /* Smarty version Smarty-3.1.15, created on 2016-07-29 15:55:05
         compiled from "C:\www\uniwigsll\cadmin\include\template\cremind\birthday.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28655796c91105aa76-55435921%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '550561133cd8fba59456c9e9600f2ee8d7056e65' => 
    array (
      0 => 'C:\\www\\uniwigsll\\cadmin\\include\\template\\cremind\\birthday.tpl',
      1 => 1469778894,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28655796c91105aa76-55435921',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5796c911081b70_05284839',
  'variables' => 
  array (
    'samples' => 0,
    'sample' => 0,
    'couttime' => 0,
    'outtime' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5796c911081b70_05284839')) {function content_5796c911081b70_05284839($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\www\\uniwigsll\\cadmin\\include\\config/../../include/lib/Smarty/plugins\\modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">老客户生日列表(<span style="color:red">
	<?php echo count($_smarty_tpl->tpl_vars['samples']->value);?>
</span>)----<span style="color:red">
	10天内老客户生日提醒</span>   当前时间 <span style="color:red"><?php echo smarty_modifier_date_format(time(),'%Y-%m-%d');?>
 </span></a>
	<div id="page-stats" class="block-body collapse in">
	<table class="table table-striped">
			<thead>
			<tr>
				<th>CustomerId</th>
				<th>Email</th>
				<th>生日</th>
				<th>剩余时间</th>
			 	<th>标记维护</th> 
				
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
				<td><?php echo $_smarty_tpl->tpl_vars['sample']->value['cbirth'];?>
</td>
				
				<?php if ($_smarty_tpl->tpl_vars['sample']->value['num']==0) {?>
						<td style="font-weight: bold;    color: red;"><?php echo $_smarty_tpl->tpl_vars['sample']->value['num'];?>
</td>
				<?php } else { ?>
					<td><?php echo $_smarty_tpl->tpl_vars['sample']->value['num'];?>
</td>
				<?php }?>
				

				
				<td><button  class="btn btn-primary" onclick="birthdayok(<?php echo $_smarty_tpl->tpl_vars['sample']->value['id_customer'];?>
)" type="button">确定</button></td>
				
				</tr>
				
				
				
			<?php } ?>
		  </tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
function   birthdayok(id_customer){
$.post('/cadmin/cremind/birthday.php',{a:id_customer});
location.reload();

}
</script>

<div class="block">
	<a href="#page-statsxx" class="block-heading" data-toggle="collapse">超期无效列表(<span style="color:red">
	<?php echo count($_smarty_tpl->tpl_vars['couttime']->value);?>
</span>)----<span style="color:red">
	10天内老客户生日提醒</span>   当前时间 <span style="color:red"><?php echo smarty_modifier_date_format(time(),'%Y-%m-%d');?>
 </span></a>
	<div id="page-statsxx" class="block-body collapse">
	<table class="table table-striped">
			<thead>
			<tr>
				<th>CustomerId</th>
				<th>Email</th>
				<th>生日</th>
				<th>超期天数</th>
			 	<!-- <th>标记维护</th>  -->
				
			</tr>
			</thead>
			<tbody>
			<?php  $_smarty_tpl->tpl_vars['outtime'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['outtime']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['couttime']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['outtime']->key => $_smarty_tpl->tpl_vars['outtime']->value) {
$_smarty_tpl->tpl_vars['outtime']->_loop = true;
?>
				
				
				<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['outtime']->value['id_customer'];?>
</td>
				<td>
				<a href="/cadmin/cmanager/message.php?cid=<?php echo $_smarty_tpl->tpl_vars['outtime']->value['id_customer'];?>
" target="_blank">
				<?php echo $_smarty_tpl->tpl_vars['outtime']->value['email'];?>

				</a>
				</td>
				<td><?php echo $_smarty_tpl->tpl_vars['outtime']->value['cbirth'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['outtime']->value['num'];?>
</td>
				
				

				
				<!-- <td><button  class="btn btn-primary" type="button">确定</button></td> -->
				
				</tr>
				
				
				
			<?php } ?>
		  </tbody>
		</table>
	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
