<html><head>
    <title>keywor 详细页面</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="Stylesheet" type="text/css" href="templates/css/content.css">
	<script type="text/javascript" src="templates/js/content.js"></script>
	<script type="text/javascript" src="templates/js/jquery.js"></script>
		
</head>

<body class="ps_back-office page-sidebar admintags" style="">

 <center><h1>keyword 详细页面</h1></center>


  <center><p>你当前打开的是 id为<span id='tagid'>{$id} </span> 的keyword编辑页面 <p></center>




<div id="main">
<div id="content" class="bootstrap">
<div class="row"  style=" width: 980px; margin: 0 auto;">
	<div class="col-lg-12">
	
	<form id="tag_form" class="defaultForm form-horizontal AdminTags" action='' method="post" enctype="multipart/form-data" novalidate="">
			<input type="hidden" name="id_tag" id="id_tag" value="384">
			<input type="hidden" name="submitAddtag" value="1">
			<div class="panel" id="fieldset_0">
		<div class="panel-heading">
				<i class="icon-tag"></i>Product
		</div>
		
		
		<!-- form-wrapper -->
		{foreach $sqldata as $r} 
		<div class="form-wrapper">
			<div class="form-group">
				<label class="control-label col-lg-3 required">Keyword</label>
				<div class="col-lg-9 ">
				<input type="text" name="keyword" id="keyword" value="{$r.keyword}" class="" required="required">
				</div>
			</div>
				<div class="form-group">
				<label class="control-label col-lg-3">Skus</label>
				<div class="col-lg-9 ">
				<input type="text" name="sku" id="sku" value="{$r.psku}" class="" required="required">
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



<div class="foot" style="
    margin: 0px auto;
    width: 960px;
	margin-top: 10px;
">
	<button style="  height: 40px;  
    margin-left: 50px;
    width: 60px;  font-size: 18px;
">
	<a href="/apitools/keywordedit/index.php" class="btn btn-default" style="
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


</body></html>