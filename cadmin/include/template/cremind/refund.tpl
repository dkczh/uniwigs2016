<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<{* TPLSTART 以上内容不需更改，保证该 TPL 页内的标签匹配即可 *}>
<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">退货提醒(<{count($crefund)}>)</a>
	<div id="page-stats" class="block-body collapse ">
	<table class="table table-striped">
			<thead>
			<tr>
				<th>CustomerId</th>
				<th>Email</th>
				<th>订单id</th>
				<th>超期天数</th>
				<th>action</th>
			</tr>
			</thead>
			<tbody>
			<{foreach name=sample from=$crefund item=sample}>
				<tr>
				<td><{$sample.id_customer}></td>
				<td>
				<a href="/cadmin/cmanager/message.php?cid=<{$sample.id_customer}>" target="_blank">
				<{$sample.email}>
				</a>
				</td>
				<td>
				<{$sample.id_order}>
				</td>
				<td style="color:red">
				<{$sample.mdate}>days
				</td>
				<td>	
				<button  class="btn btn-primary" onclick="refundadd(<{$sample.id_customer}>,'<{$sample.email}>')" 
				type="button">add</button>
				</td>
				</tr>
			<{/foreach}>
		  </tbody>
		</table>
	</div>
</div>


<div class="block">
	<a href="#page-statsx" class="block-heading" data-toggle="collapse">换货提醒(<{count($cexchange)}>)</a>
	<div id="page-statsx" class="block-body collapse">
		<table class="table table-striped">
			<thead>
			<tr>
				<th>CustomerId</th>
				<th>Email</th>
				<th>订单id</th>
				<th>超期天数</th>
				<th>action</th>
			</tr>
			</thead>
			<tbody>
			<{foreach name=sample from=$cexchange item=sample}>
				<tr>
				<td><{$sample.id_customer}></td>
				<td>
				<a href="/cadmin/cmanager/message.php?cid=<{$sample.id_customer}>" target="_blank">
				<{$sample.email}>
				</a>
				</td>
				<td>
				<{$sample.id_order}>
				</td>
				<td style="color:red">
				<{$sample.mdate}>days
				</td>
				<td>	
				<button  class="btn btn-primary" onclick="refundadd(<{$sample.id_customer}>,'<{$sample.email}>')" 
				type="button">add</button>
				</td>
				</tr>
			<{/foreach}>
		  </tbody>
		</table>
	</div>
</div>
<style type="text/css">
  .myform{
    position: fixed;
    left: 40%;
    right: 40%;
    top: 20%;
    z-index: 2;
    background: #f5f5f5;
    width: 220px;
    font-weight: bold;
    padding: 10px;
  }
</style>
<div class="myform" style="display:none">
<form action="" method="get">
  <p>客户id: <input type="text"  id='id_customer' name="id_customer" readonly="true" /></p>
  <p>email: <input type="text"  id='email' name="email" readonly="true" /></p>
  <p>维护内容:<textarea  id='content' name="content" rows="3" ></textarea></p>
  
 <!--  <input class="btn btn-primary"   onclick="submit()" type="button" value="Submit" /> -->
  <input class="btn btn-primary"   type="submit" value="Submit" />
  <input class="btn btn-primary" type="button" value="cancel" onclick="timeclose()" style="
    margin-left: 70px;
" />
</form>


</div>
<script type="text/javascript">
  function  refundadd(id_customer,email){
	$('.hideblock').show();
   $('.myform').show();
   $('#id_customer').val(id_customer);
    $('#email').val(email);
  }
  function  timeclose(){
   $('.hideblock').hide();
   $('.myform').hide();
  }
  
</script>

<{* TPLEND 以下内容不需更改，请保证该 TPL 页内的标签匹配即可 *}>
<{include file="footer.tpl" }>
<style type="text/css">
  .hideblock{
    width: 100%;
    height: 100%;
    background: rgba(130, 86, 86, 0.52);
    position: fixed;
    top: 0%;
    z-index: 1;
  
  }
</style>
<div class="hideblock" style="
  display
  :none
">