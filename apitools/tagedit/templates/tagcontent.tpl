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
				<label class="control-label col-lg-3 required">Title</label>
				<div class="col-lg-9 ">
				<input type="text" name="title" id="title" value="{$r.title}" class="" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3 required">Keyword</label>
				<div class="col-lg-9 ">
				<input type="text" name="keyword" id="keyword" value="{$r.keyword}" class="" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3 required">Description</label>
				<div class="col-lg-9 ">
				<input type="text" name="description" id="description" value="{$r.description}" class="" required="required">
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
				<label class="control-label col-lg-3 required">Catagory</label>
				<div class="col-lg-9 ">
				<select name="id_lang" class=" fixed-width-xl" id="id_catagory">
			{if {$r.catagory}=="Synthetic Wigs"}

			<option value="Synthetic Wigs" selected = "selected">Synthetic Wigs</option>
			<option value="Human Hair Wigs" >Human Hair Wigs</option>
			<option value="Hair Extensions">Hair Extensions</option>
			<option value="Hair Pieces">Hair Pieces</option>
			<option value="Default">Default</option>
			{/if}
				
			{if {$r.catagory}=="Human Hair Wigs"}

			<option value="Synthetic Wigs" >Synthetic Wigs</option>
			<option value="Human Hair Wigs" selected = "selected" >Human Hair Wigs</option>
			<option value="Hair Extensions">Hair Extensions</option>
			<option value="Hair Pieces">Hair Pieces</option>
			<option value="Default">Default</option>
			{/if}
			
			{if {$r.catagory}=="Hair Extensions"}

			<option value="Synthetic Wigs" >Synthetic Wigs</option>
			<option value="Human Hair Wigs" >Human Hair Wigs</option>
			<option value="Hair Extensions" selected = "selected" >Hair Extensions</option>
			<option value="Hair Pieces">Hair Pieces</option>
			<option value="Default">Default</option>
			{/if}
			
			{if {$r.catagory}=="Hair Pieces"}

			<option value="Synthetic Wigs" >Synthetic Wigs</option>
			<option value="Human Hair Wigs" >Human Hair Wigs</option>
			<option value="Hair Extensions"  >Hair Extensions</option>
			<option value="Hair Pieces"selected = "selected">Hair Pieces</option>
			<option value="Default">Default</option>
			{/if}



			{if {$r.catagory}=="Default"}
			<option value="Default"selected = "selected">Default</option>
			<option value="Synthetic Wigs" >Synthetic Wigs</option>
			<option value="Human Hair Wigs" >Human Hair Wigs</option>
			<option value="Hair Extensions"  >Hair Extensions</option>
			<option value="Hair Pieces">Hair Pieces</option>
			
			{/if}


			
			{if {$r.catagory}==""}
			<option value="Default"selected = "selected">Default</option>
			<option value="Synthetic Wigs" >Synthetic Wigs</option>
			<option value="Human Hair Wigs" >Human Hair Wigs</option>
			<option value="Hair Extensions"  >Hair Extensions</option>
			<option value="Hair Pieces">Hair Pieces</option>
			
			{/if}
			
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
	

		<div class='imgc'>
		<div class="fileupload" >
	
		<form method="post" target="exec_target" action="/apitools/tagedit/uploadimg.php" enctype="multipart/form-data" >
 <input name='uploads[]' type="file" style="
    float: left;
" multiple> 
<input name='tagid' type="text" value="{$id}" style="
    display: none;
">   
 <input type="submit" name="uploadpic" value="上传">
 </form>
<iframe id="exec_target" name="exec_target" style="
    width: 180px;
    height: 40px;
    border: 0px inset;
"></iframe>    <!-- 提交表单处理iframe框架 -->
		</div>
		<hr style="
			
			margin: 0px auto;
			margin-top: 20px;
			margin-bottom: 20px;
		">
		<DIV class="imgshow">
		
		{if isset($tagimg)}
		<ul>
		{foreach $tagimg as $url} 
		<li>
		<img id="{$url}"style="-webkit-user-select: none; cursor: zoom-in;" 
		src="{$url}" 
		width="145" height="150">
		<button onclick="delimg('{$url}')"  style="
    margin-top: 5px;
">delete</button>
		</li>
		{/foreach}
		</ul>
		{else}
		<span style="color: red;
    font-weight: bold;
    font-size: 20;">此tag不存在bannner图片 请上传添加</span>
		{/if}
		
		</div>
		</div>
		
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
	<a href="/apitools/tagedit/tagedit.php" class="btn btn-default" style="
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