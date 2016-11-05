<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<{* TPLSTART 以上内容不需更改，保证该 TPL 页内的标签匹配即可 *}>
<style type="text/css">
  #myTabContent label {    float: left; width: 200px;}
</style>


<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">创建生产单</a>
	<div id="page-stats" class="block-body collapse in">

	<div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">

				<br>
				<p><label>uniwigs订单ID </label>
				<input type="text" name="id_order" value="" class="input-xlarge" ></p>
				<p><label>生产类别</label>
				<input type="text" name="category" value="" class="input-xlarge"  >
				<span>人发头套--人发配件--化纤头套</span></p>
				<p><label>生产数量</label>
				<input type="text" name="number" value="" class="input-xlarge" ></p>
				<p><label>预计截止日期</label>
				<input type="date" name="pre_date" value="" class="input-xlarge" ></p>
				<p><label>生产单状态</label>
				<input type="text" name="state" value="" class="input-xlarge" >
				<span>一般 -- 加急--特急</span>
				</p>
				<p><label>备注</label>
				<input type="text" name="note" value="" class="input-xlarge" ></p>
				<div class="btn-toolbar">
				<button onclick="add()" class="btn btn-primary"><strong>提交</strong></button>
				<div class="btn-group"></div>
				</div>

			
        </div>
    </div>

	
	
	</div>
</div>













<script type="text/javascript">


function add(){
	
	var id_order = $("input[name='id_order']").val();
	var category =  $("input[name='category']").val();
	var number =  $("input[name='number']").val();
	var pre_date =  $("input[name='pre_date']").val();
	var state =  $("input[name='state']").val();
	var note=  $("input[name='note']").val();

	if(id_order==''||category==''||number==''||pre_date==''||state==''||note=='' ){
		alert('内容不可为空');

	}else{

		$.post("/cadmin/cpOrder/content.php",{id_order:id_order,addorder:'addorder',category:category,number:number,pre_date:pre_date,state:state,note:note},function(result){
			
			alert(result);
			if(result=='success'){location.reload();}
		  
		});
	
	}
	

} 



</script>




<{* TPLEND 以下内容不需更改，请保证该 TPL 页内的标签匹配即可 *}>
<{include file="footer.tpl" }>
