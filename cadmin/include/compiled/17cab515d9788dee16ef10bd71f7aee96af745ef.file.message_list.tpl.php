<?php /* Smarty version Smarty-3.1.15, created on 2016-07-27 11:03:22
         compiled from "C:\www\uniwigsll\cadmin\include\template\cmanager\message_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:90085796d421684cb6-33891883%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '17cab515d9788dee16ef10bd71f7aee96af745ef' => 
    array (
      0 => 'C:\\www\\uniwigsll\\cadmin\\include\\template\\cmanager\\message_list.tpl',
      1 => 1469588547,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '90085796d421684cb6-33891883',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5796d4216b7948_76381283',
  'variables' => 
  array (
    'total' => 0,
    '_GET' => 0,
    'clist' => 0,
    'sample' => 0,
    'npage' => 0,
    'prepage' => 0,
    'totalpage' => 0,
    'nextpage' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5796d4216b7948_76381283')) {function content_5796d4216b7948_76381283($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">客户列表(total:<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
)</a>
	<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
	
	<div style="float:left;margin-right:5px ;margin-left:20px">
		
		<input type="text" name="keywords" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['menu_name'];?>
" placeholder="输入客户email" > 
		<input type="hidden" name="search" value="1" >
	</div>
	<div class="btn-toolbar" style="padding-bottom:0px;margin-bottom:0px">
		<button type="submit" class="btn btn-primary">搜索</button>
	</div>
	<div style="clear:both;"></div>
</form>
	<div id="page-stats" class="block-body collapse in">
	<table class="table table-striped">
			<thead>
			<tr>
				<th>客户ID</th>
				<th>客户名</th>
				<th>Email</th>
				<th>注册时间</th>
			</tr>
			</thead>
			<tbody>
			<?php  $_smarty_tpl->tpl_vars['sample'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sample']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['clist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sample']->key => $_smarty_tpl->tpl_vars['sample']->value) {
$_smarty_tpl->tpl_vars['sample']->_loop = true;
?>
				<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['sample']->value['id_customer'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['sample']->value['cname'];?>
</td>
				<td>
				<a href="/cadmin/cmanager/message.php?cid=<?php echo $_smarty_tpl->tpl_vars['sample']->value['id_customer'];?>
" target="_blank">
				<?php echo $_smarty_tpl->tpl_vars['sample']->value['email'];?>

				</a>
				</td>
				<td>
				<?php echo $_smarty_tpl->tpl_vars['sample']->value['date_add'];?>

				
				</td>
				
				</tr>
			<?php } ?>
		  </tbody>
		</table>
		
		<div class="pagination">
		<ul>
		<?php if ($_smarty_tpl->tpl_vars['npage']->value!=1) {?>
		<li><a href="http://www.uni.com/cadmin/cmanager/message.php?page=1">首页</a><li>
		<?php }?>
		<li><a href="http://www.uni.com/cadmin/cmanager/message.php?page=<?php echo $_smarty_tpl->tpl_vars['prepage']->value;?>
">上一页</a></li>
		<li><a><?php echo $_smarty_tpl->tpl_vars['npage']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['totalpage']->value;?>
</a></li>
		<li><a href="http://www.uni.com/cadmin/cmanager/message.php?page=<?php echo $_smarty_tpl->tpl_vars['nextpage']->value;?>
"><span>下一页</span></a></li>
		<li><a href="http://www.uni.com/cadmin/cmanager/message.php?page=<?php echo $_smarty_tpl->tpl_vars['totalpage']->value;?>
"><span>末页</span></a></li>
		
		<li><a>共<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
条</a></li>
		</ul></div>
	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
