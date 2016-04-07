<html><head>
    <title>tags 详细页面</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="Stylesheet" type="text/css" href="templates/tagcontent.css">
	<script type="text/javascript" src="templates/tagcontent.js"></script>
	<script type="text/javascript" src="templates/jquery.js"></script>
		
</head>

<body class="ps_back-office page-sidebar admintags" style="">

 <center><h1>tags 详细页面</h1></center>


  <center><p>你当前打开的是 id为<span id='tagid'>{$id} </span> 的tag编辑页面 <p></center>




<div id="main">
<div id="content" class="bootstrap">
<div class="row"  style=" width: 980px; margin: 0 auto;">
	<div class="col-lg-12">
	
	<form id="tag_form" class="defaultForm form-horizontal AdminTags" action='' method="post" enctype="multipart/form-data" novalidate="">
			<input type="hidden" name="id_tag" id="id_tag" value="384">
			<input type="hidden" name="submitAddtag" value="1">
			<div class="panel" id="fieldset_0">
		<div class="panel-heading">
				<i class="icon-tag"></i>Tag
		</div>
		<!-- form-wrapper -->
		{foreach $sqldata as $r} 
		<div class="form-wrapper">
			<div class="form-group">
				<label class="control-label col-lg-3 required">Name</label>
				<div class="col-lg-9 ">
				<input type="text" name="name" id="name" value="{$r.name}" class="" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3 required">Language</label>
				<div class="col-lg-9 ">
				<select name="id_lang" class=" fixed-width-xl" id="id_lang">
				<option value="{$r.lang}">{$r.lang}</option>
				</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3">Template</label>
				<div class="col-lg-9 ">
				<input type="text" name="template" id="template" value="{$r.template}" class="" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3">SKUs</label>
				<div class="col-lg-9 ">
				<textarea name="skus" id="skus" class=" textarea-autosize" 
				style="overflow: hidden; word-wrap: break-word; resize: none; height: 180px;">{$r.skus}</textarea>
				</div>
			</div>
		</div>
		{/foreach}

		<!-- /.form-wrapper -->						

											


	<div >

	
	</div>
</div>
</form>

</div>


</div>
</div>
</div>



<div class="foot" style="
    margin: 0px auto;
    width: 960px;
	
    margin-top: 460px;
">
	
	
	

</div>


<div class = 'showproduct'>

	<div style="
    border-bottom:  solid 1px #e6e6e6;
    padding: 10px;
    font-weight: bold;
font-size: 14px;
">
				Product
		</div>
	<table>
		<tbody>
			<tr>
				<td style="padding-left:6px;">
				<input type="checkbox" id="check_all_l" onclick="$('#checkbox1 input').attr('checked',$('#check_all_l').attr('checked'))" class="noborder" name="checkme"> 全选
				</td>
				<td style="padding-left:20px;">
					起止产品ID: 
					<input type="text" name="beginid" id="beginid"size="8"> - 
					<input type="text" name="endid" id="endid" size="8"><br>
					关键词: 
					<input type="text" name="keyword" id="keyword" value="" size="30"> &nbsp;<input type="button" value="查询" onclick="getproduct();"> &nbsp;  全选 <input type="checkbox" id="check_all" onclick="$('#checkbox2 input').attr('checked',$('#check_all').attr('checked'))">
				
					</td>
			</tr>
			<tr>
				<td>
					<div style="width: 356px; height: 400px; overflow-y:scroll;background: white;" id="checkbox1">  
				
			{foreach $product as $p} 
						<div class="search_result_prd_item">
						<img src="/img/p/{$p.id_product}.jpg">
						<input type="checkbox" value="{$p.id_product}" name="products">
	            		<br>{$p.name}
	            		</div>	
			{/foreach}
					 </div>
					<a href="#" id="add" >
					Remove &gt;&gt;
					</a>
				</td>
				<td>
					<div style="width: 550px; height: 400px;margin-left: 10px; overflow-y: scroll;background: white;" id="checkbox2">
						            			            								
					</div>
						<a href="#" id="remove" >
					&lt;&lt; Add
					</a>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<script type="text/javascript">
			$().ready(function() {
				$('#add').click(function() {
					$('#checkbox1 input:checked').each(function(i) {
						$(this).parent().appendTo('#checkbox2');
						$(this).attr("checked", false);
					});
					return false;
				});
				$('#remove').click(function() {
					$('#checkbox2 input:checked').each(function(i) {
						$(this).parent().appendTo('#checkbox1');
						$(this).attr("checked", false);
					});
					return false;
				});
			});
		
		</script>

<div class="foot" style="
    margin: 0px auto;
    width: 960px;
	margin-top: 10px;
">
	<button style="  height: 40px;  
    margin-left: 50px;
    width: 60px;  font-size: 18px;
">
	<a href="http://localhost/dkcps16/api1/tags/index.php" class="btn btn-default" style="
    text-decoration: none;
    color: rgb(63, 57, 57);
"> 
	<i class="process-icon-save">
	</i>取消</a>
	</button>
	
	
<button id='savetag' onclick="savetag()" style="
    margin-left: 700px;
    height: 40px;
    width: 60px;
    font-size: 18px;
">
	 保存
	</button>
</div>
	
<hr style="
    width: 980px;
    margin: 0px auto;
    margin-top: 20px;
    margin-bottom: 20px;
">
<!--  <table style="margin: 0px auto;">
               <tbody><tr>
                   <td><input type="file" id='import' name="importtag"></td>
                   <td><input type="button"  onclick="test()" value="批量导入产品"></td>
               </tr>
           </tbody></table>  -->



<!-- 大图展示 js 控制 -->
<!-- <div  id = 'bigimg'style="

background: url(../images2014/bottom1.png) no-repeat top center;
height: 400px;
position: fixed;
bottom: 100;
z-index: 500;
width: 100%;
text-align: center;
margin-left: 580px;

">

<img src="/dkcps16/img/p/100010/100010.jpg" width="200px" height="210px" 
onmouseover="this.src='/dkcps16/img/p/100009/100009.jpg';" onmouseout="this.src='/dkcps16/img/p/100010/100010.jpg'" />
</div>
          -->
                                                                                                                                                                                                    "></div>

        <div class = 'showproduct1'>

	
		</div>
</body></html>