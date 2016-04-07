<?php

$file = __FILE__; //文件完整路径
$dir =  __DIR__ ;//文件所在完整目录  
define('PS_API_TSMARTY',getcwd());

require_once(PS_API_TSMARTY.'/../../config/settings.inc.php'); // 
require_once(PS_API_TSMARTY.'/../../config/config.inc.php'); // 
require_once(PS_API_TSMARTY.'/../../classes/db/Db.php'); // 


if(isset($_GET['id'])){
	
	$a =$_GET['id'] ;
	
	
	$num =($a-1)*10;
	

	
	
	nextsql($num);
	
	
	
//echo $str;
}else{
	
	
	echo '参数错误';
}


function  nextsql($id){
$db = Db::getInstance();	

//echo $id ;
 //联合查询 表结构
$sql = " SELECT SQL_CALC_FOUND_ROWS a.* ,l.name as lang ,count(pt.id_product) as products  ,c.template ,c.skus from ps_tag a  LEFT JOIN ps_product_tag  pt on pt.id_tag = a.id_tag LEFT JOIN ps_lang l on l.id_lang =a.id_lang LEFT JOIN px_tag_extra c on c.id_tag =a.id_tag GROUP BY a.name ,a.id_tag ORDER BY a.id_tag DESC LIMIT $id,10 ";
  
 // echo $sql;
 $result=  $db->ExecuteS($sql)or die("删除失败请检测表是否存在"); 
 $str = '' ; //设定返回的结果集
 
 foreach($result as $a){
	//$str.=$a['id_tag'];
	 $id_tag = (int)$a['id_tag'];
	 $lang  = $a['lang'];
	 $name = $a['name'];
	 $products =$a['products'];
	 $template =$a['template'];
	/*   $str.="<tr>";
	  $str.="<td><input type='checkbox' name='checkme'  value='$id_tag'></td>";
	  
      $str.="<td  id='$id_tag' onclick='document.location = 'http://localhost/api1/tags/tagcontent.php?id=$id_tag'>$id_tag</td>";
	  
	  $str.="<td style='width: 200px;' onclick='document.location = 'http://localhost/api1/tags/tagcontent.php?id=$id_tag''>$lang</td>";
      $str.="<td  onclick='document.location = 'http://localhost/api1/tags/tagcontent.php?id=$id_tag''>$name </td>";
      $str.="<td  onclick='document.location = 'http://localhost/api1/tags/tagcontent.php?id=$id_tag''>$products</td>";
      $str.="<td  onclick='document.location = 'http://localhost/api1/tags/tagcontent.php?id=$id_tag''> $template</td>";
	  $str.="<td style='width: 100px;'>";
	  $str.="<button type='button'  onclick='document.location = 'http://localhost/api1/tags/tagcontent.php?id=$id_tag''>编辑</button>";
	  $str.="<button   type='button' onclick='del('$id_tag')'>删除</button>";
	  
	  $str.="</td></tr> "; */
$str.=<<<EOT
	<tr>
	  <td><input type="checkbox" name="checkme"  value='$id_tag'></td> 
      <td  id='tag$id_tag' onclick="document.location = 'http://localhost/api1/tags/tagcontent.php?id=$id_tag'">$id_tag</td>
	  <td style="width: 200px;" onclick="document.location = 'http://localhost/api1/tags/tagcontent.php?id=$id_tag'">$lang</td>
      <td  onclick="document.location = 'http://localhost/api1/tags/tagcontent.php?id=$id_tag'">$name</td>
      <td  onclick="document.location = 'http://localhost/api1/tags/tagcontent.php?id=$id_tag'">$products</td>
      <td  onclick="document.location = 'http://localhost/api1/tags/tagcontent.php?id=$id_tag'">$template</td>
	  <td style="width: 100px;">
	  <button type="button"  onclick="document.location = 'http://localhost/api1/tags/tagcontent.php?id=$id_tag'">编辑</button>
	  <button   type="button" onclick="del('$id_tag')">删除</button>
	  </td>
		
    </tr> 
EOT;
			
	  
	 
	}
	
//echo   '查询成功'.$id;

echo $str;

}

