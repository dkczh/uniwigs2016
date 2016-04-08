<?php


define('PS_API_TAG',getcwd());

require_once(PS_API_TAG.'/../tool.php');
require_once(PS_API_TAG.'/../config.php');

require_once(PS_API_TAG.'/../smarty.config.php');

$id=$_GET['id'];
$db = Tool::pdo_conn(DB_PDO,DB_USER,DB_PASSWD);  
$sql = "  SELECT SQL_CALC_FOUND_ROWS a.* ,l.name as lang ,count(pt.id_product) as products  ,c.catagory,c.template ,c.skus,c.keyword,c.description from ps_tag a  LEFT JOIN ps_product_tag  pt on pt.id_tag = a.id_tag LEFT JOIN ps_lang l on l.id_lang =a.id_lang LEFT JOIN px_tag_extra c on c.id_tag =a.id_tag   WHERE a.id_tag =$id ";

$products = " select a.id_product,a.id_tag, b.name ,b.id_lang as lang
from ps_product_tag a, ps_product_lang b
Where a.id_product=b.id_product and id_tag= $id and b.id_lang =1";

//获取 tag 基本属性 结果集
$results = Tool::getall($db,$sql);


//获取tag 管理产品结果集
$productsresult = Tool::getall($db,$products);

//var_dump($results);
//echo  $products;
//var_dump($productsresult);
//获取某目录下所有文件、目录名（不包括子目录下文件、目录名）

$smarty = new Smarty_Search();

$smarty->assign('id',$id);
$smarty->assign('sqldata',$results);
$smarty->assign('product',$productsresult);

$dir= $_SERVER['DOCUMENT_ROOT']."/img/tag/".$id."/";
if(file_exists($dir)){
	$files = get_allimg($dir,$id);
	if($files!=null){
	$smarty->assign('tagimg', $files);//将次产品目录下图片搜索出来
	}
 }
$smarty->display('tagcontent.tpl');


//获取制定目录下所有图片路径
function get_allimg($dir,$id){
	
	$handler = opendir($dir);
    while (($filename = readdir($handler)) !== false) 
	{
        if ($filename != "." && $filename != "..") 
			{
                $files[] = "/"."img/tag/".$id."/".$filename ;
           }
       }
   
    closedir($handler);
	//判断此目录下 是否有文件存在
	if(isset($files)){
		return $files;
	}	
	else{
		return null;
	}
}