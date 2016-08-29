<?php /* Smarty version Smarty-3.1.15, created on 2016-08-23 16:14:52
         compiled from "C:\www\uniwigsll\cadmin\include\template\cfilter\cfilter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2804157982b0f62eff5-46573741%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c6c5a181f57cdb1b3f21cd80792cb4d70005bfc' => 
    array (
      0 => 'C:\\www\\uniwigsll\\cadmin\\include\\template\\cfilter\\cfilter.tpl',
      1 => 1471940089,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2804157982b0f62eff5-46573741',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_57982b0f65de01_10358337',
  'variables' => 
  array (
    'cstate' => 0,
    'c' => 0,
    'out_time_remind' => 0,
    'sample' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57982b0f65de01_10358337')) {function content_57982b0f65de01_10358337($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">筛选条件</a>
	<div id="page-stats" class="block-body collapse in">
	<div style=" padding-top: 20px;">  
		<span>一级分类：</span>
		<select class="selectpicker" id="fcategory">
		 	<option value="-1">All Categories</option>
			<option value="102">Human Hair Wigs</option>
			<option value="101">Synthetic Wigs</option>
			<option value="103">Hair Extensions</option>
			<option value="104">Hair Pieces</option>
			<option value="105">Care Products</option>
		</select>
		<span>二级分类：</span>
		<select class="selectpicker" id="Scategory">
			<option value="-1">All ChildCategories</option>
		</select>
		<span>购买次数：</span>
		<input type="text" id="cnum" name="cnum" value="1" class="input-xlarge" style="width: 206px; margin-right: 4px;">
		
		<br>
		<span>订单金额：</span>
		<input type="text" id="camount"  name="camount" value="0" class="input-xlarge" style="width: 206px; margin-right: 4px;">
		<span>国家地域：</span>
		<select class="selectpicker" name="cstate" id="cstate">
			<option value="-1">All state</option>
			<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cstate']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
			<?php echo $_smarty_tpl->tpl_vars['c']->value['state'];?>

			<?php } ?>	
		</select>
		
		
	
		
		<button class="btn btn-primary" onclick="query()" type="button"  style="float: right;" >查询</button>
	</div>
	
	<div>
		<table class="table table-striped">
			<thead>
			<tr>
				<th>CustomerId</th>
				<th>Email</th>
				<th>订单总金额</th>
				<th>购买次数</th>
				<th>地域</th>
			</tr>
			</thead>
			<tbody id="cresult">
			<!-- 	
			<?php  $_smarty_tpl->tpl_vars['sample'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sample']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['out_time_remind']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sample']->key => $_smarty_tpl->tpl_vars['sample']->value) {
$_smarty_tpl->tpl_vars['sample']->_loop = true;
?>
				<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['sample']->value['id_customer'];?>
</td>
				</tr>
			<?php } ?> 
			-->
			  <tr>
			  <td>xxxxxxxx</td>
			  <td>xxxx@qq.com</td>
			  <td>xxxx</td>
			  <td>xxxx</td>
			  <td>xxxx</td>
			  
			  </tr>
			 
		  </tbody>
		</table>
	</div>
	
	
	</div>
</div>

<script type="text/javascript">


function query(){
	 $('#cresult').html('查询中...'); 
	var fcategory = $('#fcategory').val();
	var Scategory =  $('#Scategory').val();
	var cnum =  $('#cnum').val();
	var camount=  $('#camount').val();
	var cstate = $('#cstate').val();
	if(cnum<=0 || camount<=0){
		alert('请核对购买次数和总金额');
	
	}else{
		$.post("",{fcategory:fcategory,Scategory:Scategory,cnum:cnum,camount:camount,cstate:cstate},function(result){
			
			 $('#cresult').html(result); 
		  
		});
	}
	
	

} 


//select 二级联动
$('#fcategory').click(function(){ 
  cate = $("#fcategory").find("option:selected").val();
  if(cate!='-1'){
  $.post("/category.php",{category:cate},function(result)
	{
	
    $("#Scategory").html(result);
	$("#Scategory").prepend('<option value="-1">All ChildCategories</option>');
	});
   }else{
	$("#Scategory").empty(); 
	
	   $("#Scategory").html('<option value="-1">All ChildCategories</option>');
   }
  
  
});

</script>





<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
