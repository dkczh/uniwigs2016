<?php /* Smarty version Smarty-3.1.15, created on 2016-07-28 16:38:09
         compiled from "C:\www\uniwigsll\cadmin\include\template\panel\menu_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:62675799c471e13548-25008455%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9503a00fd269555db25ae736b3623fb4a1a419d0' => 
    array (
      0 => 'C:\\www\\uniwigsll\\cadmin\\include\\template\\panel\\menu_add.tpl',
      1 => 1458323676,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '62675799c471e13548-25008455',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    '_POST' => 0,
    'module_options_list' => 0,
    'father_menu_options_list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5799c471e4dec0_39838170',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5799c471e4dec0_39838170')) {function content_5799c471e4dec0_39838170($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'C:\\www\\uniwigsll\\cadmin\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

    
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">请填写功能资料</a></li>
    </ul>	
	
	<div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">

           <form id="tab" method="post" action="">
				<label>名称</label>
				<input type="text" name="menu_name" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['menu_name'];?>
" class="input-xlarge" required="true" autofocus="true">
				<label>链接 <span class="label label-important">不可重复，以/开头的相对路径或者http网址</span></label>
				<input type="text" name="menu_url" value="<?php echo $_smarty_tpl->tpl_vars['_POST']->value['menu_url'];?>
" class="input-xlarge" placeholder="/panel/"  required="true" >
				<label>所属模块</label>
				<?php echo smarty_function_html_options(array('name'=>'module_id','id'=>"DropDownTimezone",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['module_options_list']->value,'selected'=>0),$_smarty_tpl);?>

				<label>是否左侧菜单栏显示</label>
				<select name="is_show" class="input-xlarge" >
					<option value="1" selected >是</option>
					<option value="0">否</option>
				</select>
				
				<label>所属菜单</label>
				 <?php echo smarty_function_html_options(array('name'=>'father_menu','id'=>"DropDownTimezone",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['father_menu_options_list']->value,'selected'=>0),$_smarty_tpl);?>

				
				
				<label>是否允许快捷菜单 <span class="label label-important">修改/ 删除类链接不允许</span></label>
				<select name="shortcut_allowed" class="input-xlarge" >
					<option value="1" selected>是</option>
					<option value="0">否</option>
				</select>				
				<label>描述</label>
				<textarea name="menu_desc" rows="3" class="input-xlarge"><?php echo $_smarty_tpl->tpl_vars['_POST']->value['module_desc'];?>
</textarea>
				<div class="btn-toolbar">
					<button type="submit" class="btn btn-primary"><strong>提交</strong></button>
				</div>
			</form>
        </div>
    </div>
</div>
<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
