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
</style>


<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">
	ID:(<span style="color:red;font-size:20px"  id = "id_porder"><{$id_porder}></span>)
	采购详情</a>
	<div id="page-stats" class="block-body collapse in">

	<div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">
		  <{if $ccontent }>
		  <{foreach name=sample from=$ccontent item=c}>
				<br>
				<p>
				<label>备料</label>
					<input type="text"  <{if $c.stock>0 or $c.stock_begin>0  }> 
					<{if $c.stock_begin>0 }> 
					value="耗时(<{$c.stock}>)天-已结束" style="color: green;" <{else}> value="已耗时(<{$c.stock}>)天"     style="color: red;"<{/if}>
					
					<{else}> value="未采购" style="color: red;"<{/if}>   class="input-xlarge" readonly="true">
					<button onclick="add('stock_begin')" class="btn btn-primary" <{if $c.stock_begin>0}> disabled="disabled"  <{/if}>   >开始</button><{if $c.stock_begin>0}> <{$c.stock_begin}> <{/if}> 
					<button onclick="add('stock_end')" class="btn btn-primary" <{if $c.stock_begin==0 or $c.stock_end >0 }> disabled="disabled"  <{/if}> >结束</button><{if $c.stock_end>0}> <{$c.stock_end}> <{/if}> 
				</p>
				
				<p><label>网帽 </label>
					<input type="text"  <{if $c.cap>0 or $c.cap_begin>0 }>
						<{if $c.cap_end>0 }> 
					value="耗时(<{$c.cap}>)天-已结束" style="color: green;" <{else}> value="已耗时(<{$c.cap}>)天"     style="color: red;"<{/if}>
					<{else}> value="未采购" style="color: red;"<{/if}>  class="input-xlarge" readonly="true">
					<button onclick="add('cap_begin')" class="btn btn-primary" <{if $c.cap_begin>0}> disabled="disabled"  <{/if}> >开始</button><{if $c.cap_begin>0}> <{$c.cap_begin}> <{/if}> 
					<button onclick="add('cap_end')" class="btn btn-primary" <{if $c.cap_end>0}> disabled="disabled"  <{/if}> >结束</button><{if $c.cap_end>0}> <{$c.cap_end}> <{/if}> 
				</p>
				
				<p><label>染色</label>
					<input type="text"   <{if $c.dye>0 or $c.dye_begin>0 }> 
						<{if $c.dye_end>0 }> 
					value="耗时(<{$c.dye}>)天-已结束" style="color: green;" <{else}> value="已耗时(<{$c.dye}>)天"     style="color: red;"<{/if}>
					<{else}> value="未采购" style="color: red;"<{/if}>  class="input-xlarge" readonly="true">
					<button onclick="add('dye_begin')" class="btn btn-primary" <{if $c.dye_begin>0}> disabled="disabled"  <{/if}> >开始</button><{if $c.dye_begin>0}> <{$c.dye_begin}> <{/if}> 
					<button onclick="add('dye_end')" class="btn btn-primary" <{if $c.dye_end>0}> disabled="disabled"  <{/if}> >结束</button><{if $c.dye_end>0}> <{$c.dye_end}> <{/if}> 
				</p>

				<p><label>手勾发料</label>
					<input type="text" <{if $c.hand_begin>0 }>  
					value="<{$c.hand_begin }>  " style="color: green;"
					<{else}>
					value="未指定时间" style="color: red;"
					<{/if}> class="input-xlarge" readonly="true">
					<button onclick="add('hand_begin')" class="btn btn-primary" <{if $c.hand_begin>0}> disabled="disabled"  <{/if}> ><strong>发料</strong></button>
				</p>
			
				<p><label>手勾收料</label>
					<input type="text" <{if $c.hand_end>0 }>  
					value="<{$c.hand_end }>  " style="color: green;"
					<{else}>
					value="未指定时间" style="color: red;"
					<{/if}>class="input-xlarge" readonly="true">
					<button onclick="add('hand_end')" class="btn btn-primary" <{if $c.hand_end>0}> disabled="disabled"  <{/if}> ><strong>收料</strong></button>
				</p>
				
				<p><label>高针</label>
					<input type="text"  <{if $c.pin>0 or $c.pin_begin>0 }>
						<{if $c.pin_end>0 }> 
					value="耗时(<{$c.pin}>)天-已结束" style="color: green;" <{else}> value="已耗时(<{$c.pin}>)天"     style="color: red;"<{/if}>
					<{else}> value="未采购" style="color: red;"<{/if}>  class="input-xlarge" readonly="true">
					<button onclick="add('pin_begin')" class="btn btn-primary" <{if $c.pin_begin>0}> disabled="disabled"  <{/if}> >开始</button><{if $c.pin_begin>0}> <{$c.pin_begin}> <{/if}> 
					<button onclick="add('pin_end')" class="btn btn-primary" <{if $c.pin_end>0}> disabled="disabled"  <{/if}> >结束</button><{if $c.pin_end>0}> <{$c.pin_end}> <{/if}> 
				</p>
				
				<p><label>整形时间</label>	
					<input type="text"   <{if $c.clean>0 or $c.clean_begin>0  }>
						<{if $c.clean_end>0 }> 
					value="耗时(<{$c.clean}>)天-已结束" style="color: green;" <{else}> value="已耗时(<{$c.clean}>)天"     style="color: red;"<{/if}>
					<{else}> value="未采购" style="color: red;"<{/if}>  class="input-xlarge" readonly="true">
					<button onclick="add('clean_begin')" class="btn btn-primary" <{if $c.clean_begin>0}> disabled="disabled"  <{/if}> >开始</button><{if $c.clean_begin>0}> <{$c.clean_begin}> <{/if}> 
					<button onclick="add('clean_end')" class="btn btn-primary" <{if $c.clean_end>0}> disabled="disabled"  <{/if}> >结束</button><{if $c.clean_end>0}> <{$c.clean_end}> <{/if}> 
				</p>
				
				<p><label>额外时间</label>	
					<input type="text"  value="未指定时间"  class="input-xlarge" readonly="true">
					<span >添加额外时间 必须写明备注</span>
				</p>
				
				<p> <label>备注</label>	
					<input type="text" id="note"   <{if $c.note==''}>value=""
					<{else}>
					value="<{$c.note}>"  readonly="true"
					<{/if}>   class="input-xlarge" >
					<button onclick="addnote()" class="btn btn-primary" <{if $c.extra_time>0}> disabled="disabled"  <{/if}> >添加</button></p>
				
			<{/foreach}> 
		<{/if}>
			
        </div>
    </div>

	
	
	</div>
</div>




<div class="block">
	<a href="#page-stats2" class="block-heading" data-toggle="collapse">采购记录 </a>
	
	
	<div id="page-stats2" class="block-body collapse">
	
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
function add(name){
	

	
		var id_porder =  $("#id_porder").text();

		$.post("/cadmin/cpPurchase/content.php",{action:'purchase',name:name,id_porder:id_porder},function(result){
			
			alert(result);
			if(result=='success'){
			location.reload();
			}
		  
		});
	

} 

function addnote(){
	
	var id_porder =  $("#id_porder").text();
	var note =  $("#note").val();
	if(note!=''){
		$.post("/cadmin/cpPurchase/content.php",{action:'purchase',name:'extra_time',id_porder:id_porder},function(result){
				});
		$.post("/cadmin/cpPurchase/content.php",{action:'purchase',name:'note',note:note,id_porder:id_porder},function(result){
			
			alert(result);
			if(result=='success'){
			location.reload();
			}
		  
		});
	}else{
	alert('备注不可为空');
	}
	
	

} 

function adddelivery(){

	var id_porder = $("input[name='id_porder']").val();
	var note =  $("#id_porder").val();
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
