<html><head>
    <title>搜索keyword 编辑器</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="Stylesheet" type="text/css" href="templates/css/list.css">
	<script type="text/javascript" src="templates/js/list.js"></script>
</head>

<body>

<h2>搜索keyword 编辑器</h2>



         <input type="text" class="box" id='key_tag' oninput="tagsearch()" placeholder="输入keyword名称" >
         <button  onclick="tagsearch()"  >搜索 </button>





<button type="button" onclick="document.location = '{$curl}/newcontent.php'"    style="
    float: right;
    height: 40px;
    width: 70px;
    margin-bottom: 10px;
">新建keyword</button>
<div  class = 'tablescroll'>
<table class="bordered">
    <thead>

    <tr>
        <th style="
    width: 50px;
"><input type="checkbox" name="checkme"  onclick="selectall()">全选</th>        
        <th>{$table_list['id']}</th>
        <th>{$table_list['keyword']}</th>
		<th>{$table_list['sku']}</th>
		<th>{$table_list['pid']}</th>

		
		
		<th>action</th>
    </tr>
    </thead>
    <tbody id= 'tablelist'>
	
	{foreach $sqldata as $r} 
	<tr>
	  <td><input type="checkbox" name="checkme"  value='{$r.id_word}'></td> 
      <td  id='tag{$r.id_word}' onclick="document.location = '{$curl}/content.php?id={$r.id_word}'">{$r.id_word}</td>
      <td  onclick="document.location = '{$curl}/content.php?id={$r.id_word}'">{$r.keyword}</td>
      <td  onclick="document.location = '{$curl}/content.php?id={$r.id_word}'">{$r.psku|truncate:40:""}</td>
		<td  onclick="document.location = '{$curl}/content.php?id={$r.id_word}'">{$r.pid|truncate:40:""}</td>
	  <td style="width: 100px;">
	  <button type="button"  onclick="document.location = '{$curl}/content.php?id={$r.id_word}'">编辑</button>
	  <button   type="button" onclick="del('{$r.id_word}')">删除</button>
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