<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<{* TPLSTART 以上内容不需更改，保证该 TPL 页内的标签匹配即可 *}>
<style type="text/css">
  #myTabContent label {    float: left; width: 200px;}
  
  .btn-primary.disabled, .btn-primary[disabled] {
    color: #1b1818;
    background-color: #b0b4bb;
}

input{ font-weight: bold; }
#worker{    width: 120px;}
#state{width: 70px;}
</style>


<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">
	ID:(<span style="color:red;font-size:20px"  id = "id_porder"><{$id_porder}></span>)
	任务详情--已分配<span style="color:red;font-size:20px"  >(<{$num_use}>/<{$number}>)</a>
	<div id="page-stats" class="block-body collapse in">

		<div id="myTabContent" class="tab-content">
			  <div class="tab-pane active in" id="home">
					<table class="table table-striped" style="font-size: 15px;">
						<thead>
						<tr>
							<th>生产单ID</th>
							<th>订单id</th>
							<th>类别</th>
							<th>可分配数量</th>
							<th>已分配数量</th>
							<th>状态</th>
							<th>添加日期</th>
						</tr>
						</thead>
						<tbody id="cresult">
					
						<{foreach name=sample from=$ccontent item=c}>
							<tr>
							<td><{$c.id_porder}> </td>
							<td ><{$c.id_order}></td>
							<td><{$c.category}></td>
							<td id="number"><{$c.number}></td>
							<td id="num_use"><{$c.num_use}></td>
							<td><{$c.state}></td>
							<td><{$c.date_add}></td>
							</tr>
						<{/foreach}> 

						</tbody>
					</table>
					<table class="table table-striped" style="font-size: 15px;">
						<thead>
						<tr>
							<th>员工</th>
							<th>数量</th>
							<th>产品</th>
							<th>状态</th>
							<th>备注</th>
							<th>截止日期</th>
							<th>操作</th>
						</tr>
						</thead>
						<tbody id="myworker">
					
							<{if $num_use < $number }>
							<tr>
							<td><select id="worker" >
								<{foreach name=sample from=$worker item=c}>
								<option value="<{$c.user_id}>" ><{$c.real_name}></option>
								<{/foreach}> 
								</select> </td>
							<td><input id="num" type="text" value=""  style="width:20px" ></td>
							<td><input id="ccontent" type="text" value=""  style="width:100px" ></td>
							<td><select id="state" >
								<option value="一般" selected="selected">一般</option>
								<option value="加急">加急</option>
								<option value="特急">特急</option>

								</select> </td>
							<td><input id="note"   type="text" value="" style="width:120px" ></td>
							<td><input id="date"   type="date" value="" ></td>
							<td><button onclick="add()" class="btn btn-primary">分配</button></td>
							</tr>
							<{else}>
							<tr>
							<td><select id="worker" >
								<{foreach name=sample from=$worker item=c}>
								<option value="<{$c.user_id}>" ><{$c.real_name}></option>
								<{/foreach}> 
								</select> </td>
							<td><input id="num" type="text" value="分配完毕"  style="width:20px" readonly="true" ></td>
							<td><input id="ccontent" type="text" value="分配完毕"  style="width:100px" readonly="true" ></td>
							<td><select id="state" >
								<option value="一般" selected="selected">一般</option>
								<option value="加急">加急</option>
								<option value="特急">特急</option>

								</select> </td>
							<td><input id="note"   type="text" value="分配完毕" style="width:120px" readonly="true" ></td>
							<td><input id="date"   type="date" value="分配完毕"  readonly="true" ></td>
							<td><button onclick="add()" class="btn btn-primary" disabled="disabled">分配</button></td>
							</tr>
							<{/if}>
							
							


						</tbody>
					</table>				
				
			  </div>
		</div>

	
	
	</div>
</div>




<div class="block">
	<a href="#page-stats2" class="block-heading" data-toggle="collapse">员工分配记录</a>
	
	
	<div id="page-stats2" class="block-body collapse in">
	
	<div class="btn-toolbar">

	
	<{if $chistory}>
	<div id="page-stats" class="block-body collapse in">

				<div>
				<table class="table table-striped" style="font-size: 15px;">
					<thead>
					<tr>
						<th>ID</th>
						<th>内容</th>
						<th>操作人</th>
						<th>日期</th>
					</tr>
					</thead>
					<tbody id="cresult">
				
					<{foreach name=sample from=$chistory item=c}>
						<tr>
						<td><{$c.id_porder_log}></td>
						<td><{$c.content}></td>
						<td><{$c.actor}></td>
						<td><{$c.date_add}></td>
						</tr>
					<{/foreach}> 

				  </tbody>
				</table>
	</div>
    </div>
	<{else}>
	<h3 style="font-size: 14px">记录为空</h3>
	<{/if}>
	
	
	</div>
	
	</div>
</div>









<script type="text/javascript">

//添加时间
function add(){
	

	
		var id_porder =  $("#id_porder").text();
		var worker =  $("#worker").val();
		
		var ccontent =  $("#ccontent").val();
		var state =  $("#state").val();
		var note =  $("#note").val();
		var date =  $("#date").val();
		var num =  $("#num").val();
		var number =  $("#number").text();
		var num_use =  $("#num_use").text();
		
		if(eval(Number(num_use)+Number(num))  > Number(number) ){
		 alert('超出分配数量');
		}else{
			if(num=='' || ccontent=='' ||note=='' || date==''){
			
				alert('内容不可为空');
			}else{
				
				$.post("/cadmin/cpWorker/content.php",{action:'task',id_porder:id_porder,worker:worker,
				ccontent:ccontent,state:state,note:note,date:date,num:num},function(result){
					
					alert(result);
					if(result=='success'){
					location.reload();
					}
				  
				});
			
			}
				
		}
			
	

} 





</script>




<{* TPLEND 以下内容不需更改，请保证该 TPL 页内的标签匹配即可 *}>
<{include file="footer.tpl" }>
