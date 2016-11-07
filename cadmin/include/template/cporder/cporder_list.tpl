<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<{* TPLSTART 以上内容不需更改，保证该 TPL 页内的标签匹配即可 *}>
<div class="block">
	<div >
	<a href="#page-stats" class="block-heading" data-toggle="collapse">生产单列表页</a>
	<a class="btn btn-primary" target="_blank" href="/cadmin/cpOrder/content.php?add=new" type="button"  style="float: right;    margin-top: -35px;
    margin-right:95px;" >新建</a>
	</div>
	<div id="page-stats" class="block-body collapse in">

	<div>
		<table class="table table-striped">
			<thead>
			<tr>
				<th>id</th>
				<th>uniwigs订单id</th>
				<th>生产类型</th>
				<th>状态</th>
				<th>数量</th>
				<th>更新日期</th>
				<th>操作</th>
			</tr>
			</thead>
			<tbody id="cresult">
		
			<{foreach name=sample from=$orderlist item=sample}>
				<tr>
				<td><{$sample.id_porder}></td>
				<td><{$sample.id_order}></td>
				<td><{$sample.category}></td>
				<td><{$sample.state}></td>
				<td><{$sample.number}></td>
				<td><{$sample.date_upd}></td>
				<td><a class="btn btn-primary" target="_blank" href="/cadmin/cpOrder/content.php?action=view&id_porder=<{$sample.id_porder}>" type="button">查看</a></td>
				</tr>
			<{/foreach}> 
	
			
			 
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




<{* TPLEND 以下内容不需更改，请保证该 TPL 页内的标签匹配即可 *}>
<{include file="footer.tpl" }>
