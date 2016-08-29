<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<{* TPLSTART 以上内容不需更改，保证该 TPL 页内的标签匹配即可 *}>
<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">特殊事件客户列表</a>
	<div id="page-stats" class="block-body collapse in">
	<table class="table table-striped">
			<thead>
			<tr>
				<th>CustomerId</th>
				<th>Email</th>
				<th>事件内容</th>
				<th>截止日期</th>
				<th>剩余天数</th>
			</tr>
			</thead>
			<tbody>
			<{foreach name=sample from=$samples item=sample}>
				<tr>
				<td><{$sample.id_customer}></td>
				<td>
				<a href="/cadmin/cmanager/message.php?cid=<{$sample.id_customer}>" target="_blank">
				<{$sample.email}>
				</a>
				</td>
				<td>
				<{$sample.content}>
				</td>
				<td>
				<{$sample.date_end}>
				</td>
				<td style="color:red">
				<{$sample.mdate}>
				</td>
			
				</tr>
			<{/foreach}>
		  </tbody>
		</table>
	</div>
</div>
<{* TPLEND 以下内容不需更改，请保证该 TPL 页内的标签匹配即可 *}>
<{include file="footer.tpl" }>
