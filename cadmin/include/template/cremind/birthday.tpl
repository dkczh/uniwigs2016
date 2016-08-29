<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<{* TPLSTART 以上内容不需更改，保证该 TPL 页内的标签匹配即可 *}>

<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">老客户生日列表(<span style="color:red">
	<{count($samples)}></span>)----<span style="color:red">
	10天内老客户生日提醒</span>   当前时间 <span style="color:red"><{$smarty.now|date_format:'%Y-%m-%d'}> </span></a>
	<div id="page-stats" class="block-body collapse in">
	<table class="table table-striped">
			<thead>
			<tr>
				<th>CustomerId</th>
				<th>Email</th>
				<th>生日</th>
				<th>剩余时间</th>
			 	<th>标记维护</th> 
				
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
				<td><{$sample.cbirth}></td>
				
				<{if  $sample.num == 0 }>
						<td style="font-weight: bold;    color: red;"><{$sample.num}></td>
				<{else}>
					<td><{$sample.num}></td>
				<{/if}>
				

				
				<td><button  class="btn btn-primary" onclick="birthdayok(<{$sample.id_customer}>)" type="button">确定</button></td>
				
				</tr>
				
				
				
			<{/foreach}>
		  </tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
function   birthdayok(id_customer){
$.post('/cadmin/cremind/birthday.php',{a:id_customer});
location.reload();

}
</script>

<div class="block">
	<a href="#page-statsxx" class="block-heading" data-toggle="collapse">超期无效列表(<span style="color:red">
	<{count($couttime)}></span>)----<span style="color:red">
	10天内老客户生日提醒</span>   当前时间 <span style="color:red"><{$smarty.now|date_format:'%Y-%m-%d'}> </span></a>
	<div id="page-statsxx" class="block-body collapse">
	<table class="table table-striped">
			<thead>
			<tr>
				<th>CustomerId</th>
				<th>Email</th>
				<th>生日</th>
				<th>超期天数</th>
			 	<!-- <th>标记维护</th>  -->
				
			</tr>
			</thead>
			<tbody>
			<{foreach name=outtime from=$couttime item=outtime}>
				
				
				<tr>
				<td><{$outtime.id_customer}></td>
				<td>
				<a href="/cadmin/cmanager/message.php?cid=<{$outtime.id_customer}>" target="_blank">
				<{$outtime.email}>
				</a>
				</td>
				<td><{$outtime.cbirth}></td>
				<td><{$outtime.num}></td>
				
				

				
				<!-- <td><button  class="btn btn-primary" type="button">确定</button></td> -->
				
				</tr>
				
				
				
			<{/foreach}>
		  </tbody>
		</table>
	</div>
</div>
<{* TPLEND 以下内容不需更改，请保证该 TPL 页内的标签匹配即可 *}>
<{include file="footer.tpl" }>
