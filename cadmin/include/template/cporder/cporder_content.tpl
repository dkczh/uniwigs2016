<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<{* TPLSTART 以上内容不需更改，保证该 TPL 页内的标签匹配即可 *}>
<style type="text/css">
  #myTabContent label {    float: left; width: 200px;}
</style>


<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">生产单详情</a>
	<div id="page-stats" class="block-body collapse in">
	<{if $ccontent}>
	<div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">
		<{foreach name=sample from=$ccontent item=c}>
				<br>
				<p>
				<label>生产单ID &nbsp;&nbsp </label>
				<input type="text" name="id_porder" value="<{$c.id_porder}>" class="input-xlarge" readonly="true">
				</p>
				<p><label>uniwigs订单ID </label>
				<input type="text" name="id_order" value="<{$c.id_order}>" class="input-xlarge" readonly="true"></p>
				<p><label>生产类别</label>
				<input type="text" name="category" value="<{$c.category}>" class="input-xlarge" readonly="true" ></p>
				<p><label>生产数量</label>
				<input type="text" name="number" value="<{$c.number}>" class="input-xlarge" readonly="true"></p>
				<p><label>预计截止日期</label>
				<input type="date" name="pre_date" value="<{$c.pre_date}>" class="input-xlarge"readonly="true" ></p>
				<p><label>实际截止日期</label>
				<input type="date" name="real_date" value="<{$c.real_date}>" class="input-xlarge"readonly="true" ></p>
				<p><label>生产单状态</label>
				<input type="text" name="state" value="<{$c.state}>" class="input-xlarge" >
				<span>一般 -- 加急--特急</span>
				</p>
				<p><label>备注</label>
				<input type="text" name="note" value="<{$c.note}>" class="input-xlarge" ></p>
				<p><label>添加时间</label>
				<input type="datetime" name="date_add" value="<{$c.date_add}>" class="input-xlarge" readonly="true"></p>
				<p><label>更新时间</label>
				<input type="datetime" name="date_upd" value="<{$c.date_upd}>" class="input-xlarge" readonly="true"></p>

				<div class="btn-toolbar">
				<button onclick="update()" class="btn btn-primary"><strong>提交</strong></button>
				<div class="btn-group"></div>
				</div>
			
		<{/foreach}>	
			
        </div>
    </div>
	<{/if}>
	
	
	</div>
</div>




<div class="block">
	<a href="#page-stats2" class="block-heading" data-toggle="collapse">交货详情 
	(<span style="color:red ;font-size: 15px;"><{$cdeliveryNum}>/<{$corderNum}></span>)</a>
	
	
	<div id="page-stats2" class="block-body collapse">
	
	<div class="btn-toolbar">
	<label>数量:</label><input type="text" name="dnumber" value="" class="input-xlarge" >
	<span>交货数量</span>
	<label>备注:</label><input type="text" name="dnote" value="" class="input-xlarge" >
	<span>交货备注</span>
	<button onclick="adddelivery()" class="btn btn-primary" style="
    margin-left: 10px;
    margin-top: -8px;
"><strong>添加交货记录</strong></button>
	<div class="btn-group"></div>
	<{if $cdelivery}>
	<div id="page-stats" class="block-body collapse in">

				<div>
				<table class="table table-striped" style="font-size: 15px;">
					<thead>
					<tr>
						<th>交货ID</th>
						<th>生产单ID</th>
						<th>交货数量</th>
						<th>备注</th>
						<th>交货日期</th>
					</tr>
					</thead>
					<tbody id="cresult">
				
					<{foreach name=sample from=$cdelivery item=c}>
						<tr>
						<td><{$c.id_porder_delivery}></td>
						<td><{$c.id_porder}></td>
						<td><{$c.number}></td>
						<td><{$c.note}></td>
						<td><{$c.date_add}></td>
						</tr>
					<{/foreach}> 

				  </tbody>
				</table>
</div>
       </div>
    </div>
	<{/if}>
	</div>
	
	</div>
</div>




<div class="block">
	<a href="#page-stats3" class="block-heading" data-toggle="collapse">采购记录 </a>
	
	
	<div id="page-stats3" class="block-body collapse">
	
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


function update(){
	
	var id_porder = $("input[name='id_porder']").val();
	var state =  $("input[name='state']").val();
	var note=  $("input[name='note']").val();

	$.post("/cadmin/cpOrder/content.php",{id_porder:id_porder,updateorder:'updateorder',state:state,note:note},function(result){
		alert(result);
		location.reload();
	  
	});
	
	
	

} 

function adddelivery(){

	var id_porder = $("input[name='id_porder']").val();
	var note =  $("input[name='dnote']").val();
	var number =  $("input[name='dnumber']").val();
	if(note==''||number=='' ){
		alert('内容不可为空');

	}else{
		$.post("/cadmin/cpOrder/content.php",{id_porder:id_porder,adddelivery:'adddelivery',note:note,number:number},function(result){
		
		alert(result);
		location.reload();
		});
	}
	


}


</script>




<{* TPLEND 以下内容不需更改，请保证该 TPL 页内的标签匹配即可 *}>
<{include file="footer.tpl" }>
