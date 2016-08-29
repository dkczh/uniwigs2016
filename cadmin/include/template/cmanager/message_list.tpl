<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<{* TPLSTART 以上内容不需更改，保证该 TPL 页内的标签匹配即可 *}>
<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">客户列表(total:<{$total}>)</a>
	<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
	
	<div style="float:left;margin-right:5px ;margin-left:20px">
		
		<input type="text" name="keywords" value="<{$_GET.menu_name}>" placeholder="输入客户email" > 
		<input type="hidden" name="search" value="1" >
	</div>
	<div class="btn-toolbar" style="padding-bottom:0px;margin-bottom:0px">
		<button type="submit" class="btn btn-primary">搜索</button>
	</div>
	<div style="clear:both;"></div>
</form>
	<div id="page-stats" class="block-body collapse in">
	<table class="table table-striped">
			<thead>
			<tr>
				<th>客户ID</th>
				<th>客户名</th>
				<th>Email</th>
				<th>注册时间</th>
			</tr>
			</thead>
			<tbody>
			<{foreach name=sample from=$clist item=sample}>
				<tr>
				<td><{$sample.id_customer}></td>
				<td><{$sample.cname}></td>
				<td>
				<a href="/cadmin/cmanager/message.php?cid=<{$sample.id_customer}>" target="_blank">
				<{$sample.email}>
				</a>
				</td>
				<td>
				<{$sample.date_add}>
				
				</td>
				
				</tr>
			<{/foreach}>
		  </tbody>
		</table>
		
		<div class="pagination">
		<ul>
		<{if $npage!=1}>
		<li><a href="http://www.uni.com/cadmin/cmanager/message.php?page=1">首页</a><li>
		<{/if}>
		<li><a href="http://www.uni.com/cadmin/cmanager/message.php?page=<{$prepage}>">上一页</a></li>
		<li><a><{$npage}>/<{$totalpage}></a></li>
		<li><a href="http://www.uni.com/cadmin/cmanager/message.php?page=<{$nextpage}>"><span>下一页</span></a></li>
		<li><a href="http://www.uni.com/cadmin/cmanager/message.php?page=<{$totalpage}>"><span>末页</span></a></li>
		
		<li><a>共<{$total}>条</a></li>
		</ul></div>
	</div>
</div>
<{* TPLEND 以下内容不需更改，请保证该 TPL 页内的标签匹配即可 *}>
<{include file="footer.tpl" }>
