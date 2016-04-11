<?php

$file = __FILE__; //文件完整路径
$dir =  __DIR__ ;//文件所在完整目录  
define('PS_API_TAG',getcwd());
require_once(PS_API_TAG.'/../tool.php');
require_once(PS_API_TAG.'/../config.php');



if(isset($_GET['id'])){
	
	$a =$_GET['id'] ;
	$num =($a-1)*10;
	nextsql($num);
	
	
	
//echo $str;
}else{
	
	
	echo '参数错误';
}


function  nextsql($id){

$db = Tool::pdo_conn(DB_PDO,DB_USER,DB_PASSWD);  
$curl = TAG_CURL;
//echo $id ;
 //联合查询 表结构
$sql = " SELECT SQL_CALC_FOUND_ROWS a.* ,l.name as lang ,count(pt.id_product) as products  ,c.template ,c.skus from ps_tag a  LEFT JOIN ps_product_tag  pt on pt.id_tag = a.id_tag LEFT JOIN ps_lang l on l.id_lang =a.id_lang LEFT JOIN px_tag_extra c on c.id_tag =a.id_tag GROUP BY a.name ,a.id_tag ORDER BY a.id_tag DESC LIMIT $id,10 ";
  
 // echo $sql;
 $result = Tool::getall($db,$sql);
 $str = '' ; //设定返回的结果集
 
 foreach($result as $a){
	//$str.=$a['id_tag'];
	 $id_tag = (int)$a['id_tag'];
	 $lang  = $a['lang'];
	 $name = $a['name'];
	 $products =$a['products'];
	 
	 $skus =substr($a['skus'],0,27);
	 $myname = str_replace(' ','-',$name);
	 $template =substr($a['template'],0,12);

$str.=<<<EOT
	<tr>
	  <td><input type="checkbox" name="checkme"  value='$id_tag'></td> 
      <td  id='tag$id_tag' onclick="document.location = '$curl/tagcontent.php?id=$id_tag'">$id_tag</td>
	  <td style="width: 200px;" onclick="document.location = '$curl/tagcontent.php?id=$id_tag'">$lang</td>
      <td  onclick="document.location = '$curl/tagcontent.php?id=$id_tag'">$name</td>
      <td  onclick="document.location = '$curl/tagcontent.php?id=$id_tag'">$template</td>
	  <td  onclick="document.location = '$curl/tagcontent.php?id=$id_tag'">$skus</td>
	  <td style="width: 100px;">
	  <button type="button"  onclick="document.location = '$curl/tagcontent.php?id=$id_tag'">编辑</button>
	  <button   type="button" onclick="del('$id_tag')">删除</button>
	  </td>
	  	<td  onclick="document.location = 'http://www.uniwigs.com/tag/$myname'">查看</td>
		
    </tr> 
EOT;
			
	  
	 
	}
	
//echo   '查询成功'.$id;

echo $str;

}

