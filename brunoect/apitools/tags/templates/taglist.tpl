<html><head>
    <title>tag编辑器</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="Stylesheet" type="text/css" href="templates/taglist.css">
	<script type="text/javascript" src="templates/taglist.js"></script>
</head>

<body>

<h2>tags 编辑器</h2>


<button type="button" onclick="document.location = 'http://localhost/dkcps16/api1/tags/newtagcontent.php'"    style="
    float: right;
    height: 40px;
    width: 70px;
    margin-bottom: 10px;
">新建tag</button>
<div  class = 'tablescroll'>
<table class="bordered">
    <thead>

    <tr>
        <th><input type="checkbox" name="checkme"  onclick="selectall()"></th>        
        <th>{$table_list['id']}</th>
        <th>{$table_list['language']}</th>
		<th>{$table_list['name']}</th>
		<th>{$table_list['products']}</th>
		<th>{$table_list['template']}</th>
		<th>action</th>
    </tr>
    </thead>
    <tbody id= 'tablelist'>
	
	{foreach $sqldata as $r} 
	<tr>
	  <td><input type="checkbox" name="checkme"  value='{$r.id_tag}'></td> 
      <td  id='tag{$r.id_tag}' onclick="document.location = 'http://localhost/dkcps16/api1/tags/tagcontent.php?id={$r.id_tag}'">{$r.id_tag}</td>
	  <td style="width: 200px;" onclick="document.location = 'http://localhost/dkcps16/api1/tags/tagcontent.php?id={$r.id_tag}'">{$r.lang}</td>
      <td  onclick="document.location = 'http://localhost/dkcps16/api1/tags/tagcontent.php?id={$r.id_tag}'">{$r.name}</td>
      <td  onclick="document.location = 'http://localhost/dkcps16/api1/tags/tagcontent.php?id={$r.id_tag}'">{$r.products}</td>
      <td  onclick="document.location = 'http://localhost/dkcps16/api1/tags/tagcontent.php?id={$r.id_tag}'">{$r.template}</td>
	  <td style="width: 100px;">
	  <button type="button"  onclick="document.location = 'http://localhost/dkcps16/api1/tags/tagcontent.php?id={$r.id_tag}'">编辑</button>
	  <button   type="button" onclick="del('{$r.id_tag}')">删除</button>
	  </td>
		
    </tr>  
	{/foreach}	
</tbody>



</table>


</div>
<button type="button" onclick="delcheckbox()">删除</button>
<button type="button" onclick="lastpage()">首页</button>
<button type="button" onclick="prepage()">上一页</button>
<button type="button" onclick="nextpage()">下一页</button>
<button type="button" onclick="firstpage()">尾页</button>
<!-- <button type="button" onclick="prepage()">test</button> -->
<br>

 <span style="float: left;">Page 
 <b id='prenum'>{$page['cpage']}</b> /  <b id='lastnum'>{$page['allpage']}</b>	<!-- 	| Display -->
					<!-- 	<select name="pagination">
						<option value="20">20</option>
						<option value="50">50</option>
						<option value="100">100</option>
						<option value="300" selected="selected">300</option>
						</select> -->
						/ {$page['row']}result(s)
					</span>   



</body></html>