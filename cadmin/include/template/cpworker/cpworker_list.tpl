<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<{* TPLSTART 以上内容不需更改，保证该 TPL 页内的标签匹配即可 *}>
<div class="block">
	<div >
	<a href="#page-stats" class="block-heading" data-toggle="collapse">任务列表页</a>
	</div>
	<div id="page-stats" class="block-body collapse in">

	<div>
		<table class="table table-striped">
			<thead>
			<tr>
				<th>id</th>
				<th>生产类型</th>
				<th>状态</th>
				<th>数量</th>
				<th>添加日期</th>
				<th>更新日期</th>
				<th>采购状态</th>
				<th>管理分配</th>
			</tr>
			</thead>
			<tbody id="cresult">
		
			<{foreach name=sample from=$orderlist item=sample}>
				<tr>
				<td><{$sample.id_porder}></td>
				<td><{$sample.category}></td>
				<td><{$sample.state}></td>
				<td><{$sample.number}></td>
				<td><{$sample.date_add}></td>
				<td><{$sample.date_upd}></td>
				<{if $sample.id_worker_order}>
				<td style="color:green; ">已分配（<{$sample.num_use}>/<{$sample.number}>）</td>
				<{else}>
				<td style="color:red ;    font-weight: bold;">未分配</td>
				<{/if}>
				<td><a class="btn btn-primary" target="_blank" href="/cadmin/cpWorker/content.php?action=view&id_porder=<{$sample.id_porder}>" type="button">详情</a></td>
				</tr>
			<{/foreach}> 
	
			
			 
		  </tbody>
		</table>
	</div>
	
	
	</div>
</div>



<div class="block">
	<div >
	<a href="#page-stats2" class="block-heading" data-toggle="collapse">工人列表</a>
	</div>
	<div id="page-stats2" class="block-body collapse">

	<div>
		<table class="table table-striped">
			<thead>
			<tr>
				<th>user_id</th>
				<th>账号</th>
				<th>员工姓名</th>
				<th>最后登录</th>
				<th>状态</th>
				<th>管理任务</th>
			</tr>
			</thead>
			<tbody id="cresult">
		
			<{foreach name=sample from=$workerlist item=sample}>
				<tr>
				<td><{$sample.user_id}></td>
				<td><{$sample.user_name}></td>
				<td><{$sample.real_name}></td>
				<td><{$sample.login_time}></td>
				<{if $sample.id_worker_order}>
				<td style="color:green; ">存在任务</td>
				<{else}>
				<td style="color:red ;    font-weight: bold;">无任务</td>
				<{/if}>
				<td><a class="btn btn-primary" target="_blank" href="/cadmin/cpWorker/content.php?action=viewworker&user_id=<{$sample.user_id}>" type="button">查看</a></td>
				</tr>
			<{/foreach}> 
	
			
			 
		  </tbody>
		</table>
	</div>
	
	
	</div>
</div>

<{* TPLEND 以下内容不需更改，请保证该 TPL 页内的标签匹配即可 *}>
<{include file="footer.tpl" }>
