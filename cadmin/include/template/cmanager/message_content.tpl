<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<{* TPLSTART 以上内容不需更改，保证该 TPL 页内的标签匹配即可 *}>
<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">客户信息</a>
	<div class="well"  >
    <ul class="nav nav-tabs">
      <li  id="tab1" class="active"><a  onclick="addmessage()"  style=" cursor: pointer;">修改信息</a></li>
	  <li  id="tab2"><a  onclick="addhistoy()"  style=" cursor: pointer;">添加提醒</a></li>
	<!--   <li  id="tab3" ><a  onclick="addremind()"  style=" cursor: pointer;">添加维护</a></li> -->
    </ul>	
	<style type="text/css">
	  #home label{  
		float: left;
		padding-right: 20px;
		padding-top: 5px;
		width: 200px;
	  } 
	</style>
	<{if $ccontent}>
	<div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">
		<{foreach name=sample from=$ccontent item=c}>
          
				<p>
				<label>ID &nbsp;&nbsp <span class="label label-info">不可修改</span></label>
				<input type="text" name="user_id" value="<{$c.id_customer}>" class="input-xlarge" readonly="true">
				</p>
				<p><label>邮箱<span class="label label-info">不可修改</span> </label>
				<input type="text" name="email" value="<{$c.email}>" class="input-xlarge" readonly="true"></p>
				<p><label>名字<span class="label label-info">不可修改</span></label>
				<input type="text" name="firstname" value="<{$c.cname}>" class="input-xlarge" readonly="true" ></p>
				<p><label>手机<span class="label label-info">不可修改</span></label>
				<input type="text" name="mobile" value="<{$c.phone}>" class="input-xlarge" readonly="true"></p>
				<p><label>地址<span class="label label-info">不可修改</span></label>
				<input type="email" name="address1" value="<{$c.address}>" class="input-xlarge"readonly="true" ></p>
				<p><label>生日<span class="label label-info">不可修改</span></label>
				<input type="date" name="birthday" value="<{$c.birthday}>" class="input-xlarge"readonly="true" ></p>
				<p><label>职业</label>
				<input type="text" name="job" value="<{$c.job}>" class="input-xlarge" ></p>
				<p><label>人种</label>
				<input type="text" name="race" value="<{$c.race}>" class="input-xlarge" ></p>
				<p><label>社交账号</label>
				<input type="text" name="account" value="<{$c.account}>" class="input-xlarge" ></p>
				<p><label>客户等级</label>
				<input type="text" name="level" value="<{$c.level}>" class="input-xlarge" ></p>
				
				<p><label>备注</label>
				<textarea name="note" rows="3" class="input-xlarge"><{$c.note}></textarea></p>
				
				<input type="text" name="cmessage" value="" style="display:none"></p>
				
				
				<div class="btn-toolbar">
				<button onclick="postmessage()" class="btn btn-primary"><strong>提交</strong></button>
				<div class="btn-group"></div>
				</div>
			
		<{/foreach}>	
			
        </div>
    </div>
	<{else}>
	<span style="color: red;">客户id不存在 请检测</span>
	<{/if}>
	<div id="addhistory" class="tab2-content"  style="display:none">
				<input type="text" id="remind" name="remind" value="x" class="input-xlarge"style="display: none;">
		
				<label>提醒内容</label>
				<textarea name="rcontent" id="rcontent"  rows="3" class="input-xlarge"></textarea>
				<label>指定日期</label>
				<input type="date"  id="date_end" name="date_end"  class="input-xlarge" >
		
				<div class="btn-toolbar">
				<button  class="btn btn-primary" onclick="postremind()">提交</button>
				<div class="btn-group"></div>
				</div>
			
		
	</div>
	<script type="text/javascript">
	  function postremind(){
		  var remind = $("#remind").val();
		  var rcontent = $("#rcontent").val();
		  var date_end = $("#date_end").val();
		  
		  
		  if(rcontent==''|| date_end ==''){
		   alert('内容和日期不可为空');
		   
		  }else{
			 $.post('',{remind:remind,rcontent:rcontent,date_end:date_end},function(data)
			 {
		  
			
				  if(data==''){
				    alert('插入失败');
				  
				  }else{
					 alert(data);
					 location.reload();
				  }
			  
			  });
		  
		  } 
	  }
	  
	function postmessage(){
	 
		  var level = $("input[name='level']").val();
		  var race = $("input[name='race']").val();
		  var job = $("input[name='job']").val();
		  var account = $("input[name='account']").val();
		  var note = $("textarea[name='note']").val();
		
		  
		  if(level==''&& race ==''&&job =='' && account ==''&& note ==''){
		   alert('请添加内容');
		   
		  }else{
			 $.post('',{cmessage:'xx',level:level,race:race,job:job,account:account,note:note},function(data)
			 {
		  
			
				  if(data==''){
				    alert('插入失败');
				  
				  }else{
					 alert(data);
					 location.reload();
				  }
			  
			  });
		  
		  } 
	  }
	  
	</script>
	
	
	
	
	
	
	<div id="addremind" class="tab3-content"  style="display:none">
	<h1>
	添加维护记录
	</h1>
	</div>
	
	
	
</div>
</div>

<style type="text/css">
  .myform{
      position: fixed;
    left: 10%;
    right: 10%;
    top: 20%;
    z-index: 2;
    background: #f5f5f5;
    width: 1080px;
    font-weight: bold;
    padding: 10px;
  }
</style>

<div class="myform" style="display:none">
<h2> <span id='id_order' style='color:red'></span>  订单详情</h2>

<div id="page-stats" class="block-body collapse in">
	<table class="table table-striped">
			<thead>
			<tr>
				<th>订单id</th>
				<th>金额</th>
				<th>折扣</th>
				<th>折扣金额</th>
				<th>物流费用</th>
				<th>产品</th>
				<th>支付方式</th>
				<th>订单状态</th>
				<th>订单备注</th>
				<th>创建时间</th>
			</tr>
			</thead>
			<tbody  id='order_detail'>
		
				<tr >
				<td>xxx</td>
				<td>xxxx</td>
				<td>xxx</td>
				<td>xxxx</td>
				<td>xxx</td>
				<td  style="width: 200px;">	Claire Remy Human Hair Topper - Color :
				P25001-NB(Natural Black), Density : 
				P25001-130% -70g (Default)</td>
				<td>xxx</td>
				<td>xxxx</td>
				<td>xxx</td>
				<td>xxxx</td>
				
				</tr>
		
		  </tbody>
		</table>
	</div>
  <input class="btn btn-primary" type="button" value="返回" onclick="order_close()" style="
    margin-left:500px;
" />



</div>

<div class="block">
	
	<a href="#page-statsxx" class="block-heading" data-toggle="collapse">购买记录（<{count($orderlist)}>）</a>
	<div id="page-statsxx" class="block-body collapse">
	<table class="table table-striped">
			<thead>
			<tr>
				<th>订单id</th>
				<th>添加日期</th>
		
				
			</tr>
			</thead>
			<tbody>
		
			<{foreach name=sample from=$orderlist item=sample}>
				
				
				<tr>
				<td><a onclick='order_open(<{$sample.id_order}>)' style="cursor: pointer;"><{$sample.id_order}></a></td>
				<td>
				<{$sample.date_add}>
				</td>
		

				
				</tr>
				
			<{/foreach}>
		  </tbody>
		</table>
	</div>
</div>


<div class="block">
	
	<a href="#page-statsxx2" class="block-heading" data-toggle="collapse">提醒记录（<{count($remindlist)}>）</a>
	<div id="page-statsxx2" class="block-body collapse">
	<table class="table table-striped">
			<thead>
			<tr>
				<th>id</th>
				<th>内容</th>
				<th>截止日期</th>
				<th>添加时间</th>
				<th>维护员</th>
				
			</tr>
			</thead>
			<tbody>
		
			<{foreach name=sample from=$remindlist item=sample}>
				
				
				<tr>
				<td><{$sample.id_special}></td>
				<td><{$sample.content}></td>
				<td><{$sample.date_end}></td>
				<td><{$sample.date_add}></td>
				<td><{$sample.actor}></td>
				
				</tr>
				
			<{/foreach}>
		  </tbody>
		</table>
	</div>
</div>



<div class="block">
	
	<a href="#page-statsxx3" class="block-heading" data-toggle="collapse">维护日志（<{count($historylist)}>）</a>
	<div id="page-statsxx3" class="block-body collapse">
	<table class="table table-striped">
			<thead>
			<tr>
				<th>id</th>
				<!-- <th>维护类型</th> -->
				<th>内容</th>
				<th>添加日期</th>
				<th>维护员</th>
				
			</tr>
			</thead>
			<tbody>
		
			<{foreach name=sample from=$historylist item=sample}>
				
				
				<tr>
				
				<td><{$sample.id}></td>
				<td><{$sample.content}></td>
				<td><{$sample.date}></td>
				<td><{$sample.actor}></td>

				
				</tr>
				
			<{/foreach}>
		  </tbody>
		</table>
	</div>
</div>

<{* TPLEND 以下内容不需更改，请保证该 TPL 页内的标签匹配即可 *}>
<{include file="footer.tpl" }>
<script type="text/javascript">
  function  order_open(id_order){
	$('.hideblock').show();
	$('.myform').show();
	$('#id_order').text(id_order);
    $.post('',{id_order:id_order},function(data){
	
	$('#order_detail').html(data);
	});
  }
  function  order_close(){
   $('.hideblock').hide();
   $('.myform').hide();
  }
  
</script>

<script type="text/javascript">
  //tab页面切换
  function addmessage(){
	 $('#myTabContent').show();
     $('#addhistory').hide();
	 $('#addremind').hide();
    $('#tab1').attr('class','active');
	$('#tab2').attr('class','none');
	$('#tab3').attr('class','none');
  }
  
  function addhistoy(){
	$('#myTabContent').hide();
     $('#addhistory').show();
	 $('#addremind').hide();
	 $('#tab2').attr('class','active');
	$('#tab1').attr('class','none');
	$('#tab3').attr('class','none');
  }
  
  function addremind(){
	 $('#myTabContent').hide();
     $('#addhistory').hide();
	 $('#addremind').show();
   $('#tab3').attr('class','active');
	$('#tab1').attr('class','none');
	$('#tab2').attr('class','none');
  }
  
</script>


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


</div>