<?php /* Smarty version Smarty-3.1.19, created on 2016-03-17 04:38:53
         compiled from "templates\tagcontent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25674569c9b15c159b5-08529480%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99e9353f5eacd6678bd997d158ee381c95b68146' => 
    array (
      0 => 'templates\\tagcontent.tpl',
      1 => 1457918756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25674569c9b15c159b5-08529480',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_569c9b15c86e49_19247013',
  'variables' => 
  array (
    'id' => 0,
    'sqldata' => 0,
    'r' => 0,
    'skus' => 0,
    'a' => 0,
    'tagimg' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_569c9b15c86e49_19247013')) {function content_569c9b15c86e49_19247013($_smarty_tpl) {?><html><head>
    <title>tags 详细页面</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="Stylesheet" type="text/css" href="templates/tagcontent.css">
	<script type="text/javascript" src="templates/tagcontent.js"></script>
	<script type="text/javascript" src="templates/jquery.js"></script>
		
</head>

<body class="ps_back-office page-sidebar admintags" style="">

 <center><h1>tags 详细页面</h1></center>


  <center><p>你当前打开的是 id为<span id='tagid'><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
 </span> 的tag编辑页面 <p></center>




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
		<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sqldata']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value) {
$_smarty_tpl->tpl_vars['r']->_loop = true;
?> 
		<div class="form-wrapper">
			<div class="form-group">
				<label class="control-label col-lg-3 required">Name</label>
				<div class="col-lg-9 ">
				<input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['name'];?>
" class="" required="required">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3 required">Language</label>
				<div class="col-lg-9 ">
				<select name="id_lang" class=" fixed-width-xl" id="id_lang">
				<option value="<?php echo $_smarty_tpl->tpl_vars['r']->value['lang'];?>
"><?php echo $_smarty_tpl->tpl_vars['r']->value['lang'];?>
</option>
				</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-lg-3 required">Catagory</label>
				<div class="col-lg-9 ">
				<select name="id_lang" class=" fixed-width-xl" id="id_catagory">
			<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['r']->value['catagory'];?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1=="Synthetic Wigs") {?>

			<option value="Synthetic Wigs" selected = "selected">Synthetic Wigs</option>
			<option value="Human Hair Wigs" >Human Hair Wigs</option>
			<option value="Hair Extensions">Hair Extensions</option>
			<option value="Hair Pieces">Hair Pieces</option>
			
			<?php }?>
				
			<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['r']->value['catagory'];?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2=="Human Hair Wigs") {?>

			<option value="Synthetic Wigs" >Synthetic Wigs</option>
			<option value="Human Hair Wigs" selected = "selected" >Human Hair Wigs</option>
			<option value="Hair Extensions">Hair Extensions</option>
			<option value="Hair Pieces">Hair Pieces</option>
			
			<?php }?>
			
			<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['r']->value['catagory'];?>
<?php $_tmp3=ob_get_clean();?><?php if ($_tmp3=="Hair Extensions") {?>

			<option value="Synthetic Wigs" >Synthetic Wigs</option>
			<option value="Human Hair Wigs" >Human Hair Wigs</option>
			<option value="Hair Extensions" selected = "selected" >Hair Extensions</option>
			<option value="Hair Pieces">Hair Pieces</option>
			
			<?php }?>
			
			<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['r']->value['catagory'];?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4=="Hair Pieces") {?>

			<option value="Synthetic Wigs" >Synthetic Wigs</option>
			<option value="Human Hair Wigs" >Human Hair Wigs</option>
			<option value="Hair Extensions"  >Hair Extensions</option>
			<option value="Hair Pieces"selected = "selected">Hair Pieces</option>
			
			<?php }?>
			
			<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['r']->value['catagory'];?>
<?php $_tmp5=ob_get_clean();?><?php if ($_tmp5=='') {?>

			<option value="Synthetic Wigs"  selected = "selected">Synthetic Wigs</option>
			<option value="Human Hair Wigs" >Human Hair Wigs</option>
			<option value="Hair Extensions"  >Hair Extensions</option>
			<option value="Hair Pieces">Hair Pieces</option>
			
			<?php }?>
			
				</select>
				</div>
		</div>
			
			<div class="form-group">
				<label class="control-label col-lg-3">Template</label>
				<div class="col-lg-9 ">
				<input type="text" name="template" id="template" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['template'];?>
" class="" required="required">
				</div>
			</div>
		
		<?php } ?>
		
			<div class="form-group">
			
				<label class="control-label col-lg-3">SKUs</label>
				<div class="col-lg-9 ">
				
				<div name="skus" id="skus" class=" textarea-autosize"  
				style=" height:400px; overflow:auto">
			
					<ul id="pCon1">
				<?php  $_smarty_tpl->tpl_vars['a'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['a']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['skus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['a']->key => $_smarty_tpl->tpl_vars['a']->value) {
$_smarty_tpl->tpl_vars['a']->_loop = true;
?> 
				<li>
				<div class="context">
				<img src="/img/tmp/product_mini_<?php echo $_smarty_tpl->tpl_vars['a']->value['pid'];?>
_1.jpg" alt="" class="imgm img-thumbnail" style="
				width: 48px;
				height: 55px;
			"><span><?php echo $_smarty_tpl->tpl_vars['a']->value['skus'];?>
</span></div>
				</li>
				<?php } ?>
				</ul>
				
			
				</div>
				</div>
				
				
				</div>
					
			</div>
		</div>	
		
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
<input name='tagid' type="text" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" style="
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
		
		<?php if (isset($_smarty_tpl->tpl_vars['tagimg']->value)) {?>
		<ul>
		<?php  $_smarty_tpl->tpl_vars['url'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['url']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tagimg']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['url']->key => $_smarty_tpl->tpl_vars['url']->value) {
$_smarty_tpl->tpl_vars['url']->_loop = true;
?> 
		<li>
		<img id="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
"style="-webkit-user-select: none; cursor: zoom-in;" 
		src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" 
		width="145" height="150">
		<button onclick="delimg('<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
')"  style="
    margin-top: 5px;
">delete</button>
		</li>
		<?php } ?>
		</ul>
		<?php } else { ?>
		<span style="color: red;
    font-weight: bold;
    font-size: 20;">此tag不存在bannner图片 请上传添加</span>
		<?php }?>
		
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
	<a href="/apitools/tagedit/index.php" class="btn btn-default" style="
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

<script>
function moveSonU(tag,pc){
	var tagPre=get_previoussibling(tag);
        var t=document.getElementById(pc);
	if(tagPre!=undefined){
		t.insertBefore(tag,tagPre);
	}
}
function moveSonD(tag){
	var tagNext=get_nextsibling(tag);
	if(tagNext!=undefined){
		insertAfter(tag,tagNext);
	}
}
function get_previoussibling(n){
	if(n.previousSibling!=null){
		var x=n.previousSibling;
		while (x.nodeType!=1)
		{
			x=x.previousSibling;
		}
		return x;
	}
}
function get_nextsibling(n){
	if(n.nextSibling!=null){
		var x=n.nextSibling;
		while (x.nodeType!=1)
		{
			x=x.nextSibling;
		}
		return x;
	}
}
function insertAfter(newElement,targetElement){
	var parent=targetElement.parentNode;
	if(parent.lastChild==targetElement){
		parent.appendChild(newElement);
	}else{
		parent.insertBefore(newElement,targetElement.nextSibling);
	}
}
function myOrder(myList,m,mO,mT){
//myList为ul的id值，m为0显示文字，m为1显示图片，mO、mT为文字或图片内容
	var pCon=document.getElementById(myList);
	var pSon=pCon.getElementsByTagName("li");
	for(i=0;i<pSon.length;i++){
		var conTemp=document.createElement("div");
		conTemp.setAttribute("class","control");
		var clickUp=document.createElement("a");
		var clickDown=document.createElement("a");
		if(m==0){
		var upCon=document.createTextNode(mO);
		var downCon=document.createTextNode(mT);
		}else{
		var upCon=document.createElement("img");
		var downCon=document.createElement("img");
		upCon.setAttribute("src",mO);
		downCon.setAttribute("src",mT);
		}
		clickUp.appendChild(upCon);
		clickUp.setAttribute("href","javascript:void(0)");
		clickDown.appendChild(downCon);
		clickDown.setAttribute("href","javascript:void(0)");
		pSon[i].appendChild(conTemp);
		conTemp.appendChild(clickUp);
		conTemp.appendChild(clickDown);
		clickUp.onclick=function(){
			moveSonU(this.parentNode.parentNode,myList);
		}
		clickDown.onclick=function(){
			moveSonD(this.parentNode.parentNode);
		}
	}
}
myOrder("pCon1",0,"上移","下移");
</script>
</body></html><?php }} ?>
