<?php /* Smarty version Smarty-3.1.15, created on 2016-08-22 17:14:41
         compiled from "C:\www\uniwigsll\cadmin\include\template\cremind\time.tpl" */ ?>
<?php /*%%SmartyHeaderCode:189495796cf1d1c8114-55185989%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53c52689714b368c43b16be950102c45b2bb4792' => 
    array (
      0 => 'C:\\www\\uniwigsll\\cadmin\\include\\template\\cremind\\time.tpl',
      1 => 1470045132,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '189495796cf1d1c8114-55185989',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5796cf1d1ef217_33628786',
  'variables' => 
  array (
    'out_time_remind' => 0,
    'sample' => 0,
    'timeremind' => 0,
    'samples' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5796cf1d1ef217_33628786')) {function content_5796cf1d1ef217_33628786($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="block">
	<a href="#page-stats—out" class="block-heading" data-toggle="collapse">超期列表（<?php echo count($_smarty_tpl->tpl_vars['out_time_remind']->value);?>
）</a>
	<div id="page-stats—out" class="block-body collapse in">
	<table class="table table-striped">
			<thead>
			<tr>
				<th>CustomerId</th>
				<th>Email</th>
				<th>维护周期</th>
				<th>最后维护时间</th>
				<th>截止日期</th>
				<th>超期天数</th>
				<th>action</th>
			</tr>
			</thead>
			<tbody>
			<?php  $_smarty_tpl->tpl_vars['sample'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sample']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['out_time_remind']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
				<?php echo $_smarty_tpl->tpl_vars['sample']->value['time'];?>
-days
				</td>
				<td>
				<?php echo $_smarty_tpl->tpl_vars['sample']->value['cdate'];?>

				</td>
				<td>
				<?php echo $_smarty_tpl->tpl_vars['sample']->value['aldate'];?>

				</td>
				<td style="color:red">
				<?php echo $_smarty_tpl->tpl_vars['sample']->value['mdate'];?>

				</td>
				<td>	
				<button  class="btn btn-primary" onclick="timeadd(<?php echo $_smarty_tpl->tpl_vars['sample']->value['id_customer'];?>
,'<?php echo $_smarty_tpl->tpl_vars['sample']->value['email'];?>
')" 
				type="button">add</button>
				</td>
				</tr>
			<?php } ?>
		  </tbody>
		</table>
	</div>
</div>


<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">已维护列表（<?php echo count($_smarty_tpl->tpl_vars['timeremind']->value);?>
）</a>
	<div id="page-stats" class="block-body collapse in">
	<table class="table table-striped">
			<thead>
			<tr>
				<th>CustomerId</th>
				<th>Email</th>
				<th>维护周期</th>
				<th>最后维护时间</th>
				<th>截止日期</th>
				<th>剩余天数</th>
				<th>action</th>
			</tr>
			</thead>
			<tbody>
			<?php  $_smarty_tpl->tpl_vars['sample'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sample']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['timeremind']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
				<?php echo $_smarty_tpl->tpl_vars['sample']->value['time'];?>
-days
				</td>
				<td>
				<?php echo $_smarty_tpl->tpl_vars['sample']->value['cdate'];?>

				</td>
				<td>
				<?php echo $_smarty_tpl->tpl_vars['sample']->value['aldate'];?>

				</td>
				<td style="color:red">
				<?php echo $_smarty_tpl->tpl_vars['sample']->value['mdate'];?>

				</td>
				<td>	
				<button  class="btn btn-primary" onclick="timeadd(<?php echo $_smarty_tpl->tpl_vars['sample']->value['id_customer'];?>
,'<?php echo $_smarty_tpl->tpl_vars['sample']->value['email'];?>
')" 
				type="button">add</button>
				</td>
				</tr>
			<?php } ?>
		  </tbody>
		</table>
	</div>
</div>

<style type="text/css">
  .myform{
    position: fixed;
    left: 40%;
    right: 40%;
    top: 20%;
    z-index: 2;
    background: #f5f5f5;
    width: 220px;
    font-weight: bold;
    padding: 10px;
  }
</style>

<div class="myform" style="display:none">
<form action="" method="get">
  <p>客户id: <input type="text"  id='id_customer' name="id_customer" readonly="true" /></p>
  <p>email: <input type="text"  id='email' name="email" readonly="true" /></p>
  <p>维护内容:<textarea  id='content' name="content" rows="3" ></textarea></p>
  
 <!--  <input class="btn btn-primary"   onclick="submit()" type="button" value="Submit" /> -->
  <input class="btn btn-primary"   type="submit" value="Submit" />
  <input class="btn btn-primary" type="button" value="cancel" onclick="timeclose()" style="
    margin-left: 70px;
" />
</form>


</div>
<!-- 
<script type="text/javascript">
  function submit(){
  var id_customer= $('#id_customer').val();
  var content = $('#content').val();
  $.post('',{id_customer:id_customer,content:content});

  location.reload();
  }
</script> -->

<div class="block">
	<a href="#page-stats-2" class="block-heading" data-toggle="collapse">未维护列表（<?php echo count($_smarty_tpl->tpl_vars['samples']->value);?>
）</a>
	<div id="page-stats-2" class="block-body collapse">
	<table class="table table-striped">
			<thead>
			<tr>
				<th>CustomerId</th>
				<th>Email</th>
				<th>action</th>
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
				<button  class="btn btn-primary" onclick="timeadd(<?php echo $_smarty_tpl->tpl_vars['sample']->value['id_customer'];?>
,'<?php echo $_smarty_tpl->tpl_vars['sample']->value['email'];?>
')" 
				type="button">add</button>
				</td>
				</tr>
			<?php } ?>
		  </tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
  function  timeadd(id_customer,email){
	$('.hideblock').show();
   $('.myform').show();
   $('#id_customer').val(id_customer);
    $('#email').val(email);
  }
  function  timeclose(){
   $('.hideblock').hide();
   $('.myform').hide();
  }
  
</script>

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<style type="text/css">
  .hideblock{
    width: 100%;
    height: 100%;
    background: rgba(130, 86, 86, 0.52);
    position: fixed;
    top: 0%;
    z-index: 1;
  
  }
</style>
<div class="hideblock" style="
  display
  :none
">


</div><?php }} ?>
