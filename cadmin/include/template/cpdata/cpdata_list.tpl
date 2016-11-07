<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<{* TPLSTART 以上内容不需更改，保证该 TPL 页内的标签匹配即可 *}>
<style type="text/css">
  td:hover{color:red}
  td{color:#161617}
  
</style>
<div class="block">
	<div >
	<a href="#page-stats" class="block-heading" data-toggle="collapse">未交货统计</a>
	</div>
	<div id="page-stats" class="block-body collapse ">

	<div>
		<table class="table table-striped">
			<thead>
			<tr>
				<th>生产类型</th>
				<th>下单数量</th>
				
			</tr>
			</thead>
			<tbody id="cresult">
		
			<{foreach name=sample from=$nodelivery item=sample}>
				<tr>
				<td><{$sample.category}></td>
				<td><{$sample.num}></td>
				
				</tr>
			<{/foreach}> 
	
			
			 
		  </tbody>
		</table>
	</div>
	
	
	</div>
</div>



<div class="block">
	<div >
	<a href="#page-stats1" class="block-heading" data-toggle="collapse">下单统计</a>
	</div>
	<div id="page-stats1" class="block-body collapse ">

	<div>
		<table class="table table-striped">
			<thead>
			<tr>
				<th>生产类型</th>
				<th>下单数量</th>
				
			</tr>
			</thead>
			<tbody id="cresult">
		
			<{foreach name=sample from=$order item=sample}>
				<tr>
				<td><{$sample.category}></td>
				<td><{$sample.num}></td>
				
				</tr>
			<{/foreach}> 
	
			
			 
		  </tbody>
		</table>
	</div>
	
	
	</div>
</div>


<div class="block">
	<div >
	<a href="#page-stats2" class="block-heading" data-toggle="collapse">交货统计</a>
	</div>
	<div id="page-stats2" class="block-body collapse ">

	<div>
		<table class="table table-striped">
			<thead>
			<tr>
				<th>产品类型</th>
				<th>交货数量</th>
			</tr>
			</thead>
			<tbody id="cresult">
		
			<{foreach name=sample from=$delivery item=sample}>
				<tr>
				<td><{$sample.category}></td>
				<td><{$sample.num}></td>
				
				</tr>
			<{/foreach}> 
	
			
			 
		  </tbody>
		</table>
	</div>
	
	
	</div>
</div>




<div class="block">
	<div >
	<a href="#page-stats3" class="block-heading" data-toggle="collapse">工人统计</a>
	</div>
	<div id="page-stats3" class="block-body collapse ">

	<div>
		<table class="table table-striped">
			<thead>
			<tr>
				<th>工人名称</th>
				<th>交货详情</th>
			
			</tr>
			</thead>
			<tbody id="cresult">
		
			<{foreach name=sample from=$worker item=sample}>
				<tr>
				<td><{$sample.real_name}></td>
				<td><{$sample.detail}></td>
				
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



</script>




<{* TPLEND 以下内容不需更改，请保证该 TPL 页内的标签匹配即可 *}>
<{include file="footer.tpl" }>
