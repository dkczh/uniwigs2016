

{$app_name}


<p>这是来自己index.php 分配的变量（{$name}） </p>


<table style="
    width: 80%;
    margin: 0 auto;      
    border: solid 1px gray;
">

<tr>
<td><input type="checkbox" name="checkme"  onclick="checkDelBoxes(this.form, 'tagBox[]', this.checked)"></td>
<td>{$table_list['id']}</td>
<td>{$table_list['language']}</td>
<td>{$table_list['name']}</td>
<td>{$table_list['products']}</td>
<td>{$table_list['template']}</td>
<td>操作</td>
</tr>


{foreach $sqldata as $r} 

<tr>
<td><input type="checkbox" name="checkme"  onclick="checkDelBoxes(this.form, 'tagBox[]', this.checked)"></td>
<td  onclick="document.location = 'http://localhost/api1/tags/tagcontent.php?id={$r.id_tag}'">{$r.id_tag}</td>
<td>{$r.lang}</td>
<td>{$r.name}</td>
<td>{$r.products}</td>
<td>{$r.template}</td>

<td>
<button type="button" onclick='location.reload()'>edit</button>
<button type="button" onclick='del()'>del</button>
</td>
</tr>

{/foreach}


</table>