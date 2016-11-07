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
	用户ID:(<span style="color:red;font-size:20px"  id = "worker_id"><{$worker_id}></span>)
	用户名<span style="color:red;font-size:20px"  ><{$workername}></a>
	注：(排序初始默认为时间排序)
	<div id="page-stats" class="block-body collapse in">

		<div id="myTabContent" class="tab-content">
			  <div class="tab-pane active in" id="home">
					<table class="table table-striped" style="font-size: 15px;">
						<thead>
						<tr>
							<th>任务id</th>
							<th>生产单id</th>
							<th>产品</th>
							<th>数量</th>
							<th>状态</th>
							<th>备注</th>
							<th>预计日期</th>
							<th>实际日期</th>
							<th><span>排序</span></th>
							<th>是否完成</th>
							<th>验收级别</th>
							<th>添加日期</th>
							<th>操作</th>
						</tr>
						</thead>
						<tbody id="cresult">
					
						<{foreach name=sample from=$ctask item=c}>
							<tr>
							
							<td><{$c.id_worker_order}> </td>
							<td><{$c.id_porder}> </td>
							<td ><{$c.content}></td>
							<td><{$c.num}></td>
							<td ><{$c.state}></td>
							<td ><{$c.note}></td>
							<td><{$c.date}></td>
							<td><{$c.real_date}></td>
							<td><{$c.position}> </td>
							<{if $c.worker_state==0 }>
							<td style="color:red">未完成</td>
							<td style="color:red">未验收</td>
							<td><{$c.date_add}> </td>
						<!-- 	<td><button onclick="add(<{$c.id_worker_order}>,<{$c.id_porder}>)" class="btn btn-primary">OK </button></td> -->
							
							<td><button onclick="myopen(<{$c.id_worker_order}>,<{$c.id_porder}>)" class="btn btn-primary">OK </button></td>
							<{else}>
							<td style="color:green">已完成</td>
							<td style="color:red">级别-<{$c.worker_level}></td>
							<td><{$c.date_add}> </td>
							<td><button  class="btn btn-primary" disabled="disabled">OK </button></td>
							<{/if}>
							
							
							</tr>
						<{/foreach}> 

						</tbody>
					</table>
					
				
			  </div>
		</div>

	
	
	</div>
</div>

<div class="block">
	<a href="#page-stats2" class="block-heading" data-toggle="collapse">员工操作记录</a>
	
	
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
						<td style="color:red"> <{$c.content}></td>
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

//添加完成
function add(id_worker_order,id_porder){
	worker_id =$('#worker_id').text();
	worker_level=$('#worker_level').val();
    $.post("/cadmin/cpWorker/content.php",{action:'updtask',worker:worker_id,id_worker_order:id_worker_order,id_porder:id_porder,worker_level:worker_level},function(result){
			
			console.log(result);
			if(result=='success'){
			location.reload();
			}
     });	

} 





</script>




					<footer>
                        <hr>
						<p>QQ:554301430</p>
                    </footer>
				</div>
			</div>
		</div>
    <script src="<{$smarty.const.ADMIN_URL}>/assets/lib/bootstrap/js/bootstrap.js"></script>

<!-- 捷径的提示 -->

		<script type="text/javascript">	
			alertDismiss("alert-success", 3);
			alertDismiss("alert-info", 10);

			listenShortCut("icon-plus");
			listenShortCut("icon-minus");

			doSidebar();
		</script>

<script type="text/javascript">	

function myopen(iwd,ipd){

$('#myopen').show();
$('#myopenback').show();

$('#mbt').attr('onclick','add('+iwd+','+ipd+')');
}

function myclose(){
$('#myopen').hide();
$('#myopenback').hide();


}

</script>
		

<!-- 弹出框 底部--> 
<div  id='myopen' style="
    position: absolute;
    z-index: 1001;
      width: 260px;
    height: 120px;
    margin-top: -10px;
    background: white;
    top: 200px;
    left: 40%;
    right: 40%;
	display:none;
	text-align: center;
">
<p style="
    font-weight: bold;
    color: red;
    padding-top: 5px;
">验收级别</p>
<p>
<select id="worker_level"> 
<option value ="A">A</option>
<option value ="B">B</option>
<option value ="C">C</option>
</select>
</p>
<p style="
    width: 100px;
    float: left;
">
<button id="mbt" onclick="add(<{$c.id_worker_order}>,<{$c.id_porder}>)" class="btn btn-primary">OK </button>
</p>
<p>
<button onclick="myclose()" class="btn btn-primary">取消</button>
</p>

</div>

<!-- 弹出框 底部--> 
<div  id='myopenback'  style="
    position: absolute;
    z-index: 100;
    width: 100%;
    height: 1000px;
    margin-top: -10px;
    background: rgba(0, 0, 0, 0.2);
    top: 10px;
	display:none
"></div>
	</body>
</html>
