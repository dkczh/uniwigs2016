<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<{* TPLSTART 以上内容不需更改，保证该 TPL 页内的标签匹配即可 *}>
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
			<{foreach name=sample from=$cstate item=c}>
			<{$c.state}>
			<{/foreach}>	
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
			<{foreach name=sample from=$out_time_remind item=sample}>
				<tr>
				<td><{$sample.id_customer}></td>
				</tr>
			<{/foreach}> 
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




<{* TPLEND 以下内容不需更改，请保证该 TPL 页内的标签匹配即可 *}>
<{include file="footer.tpl" }>
