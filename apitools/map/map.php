<?php 

define('PS_API_MAP',getcwd());
	
require_once(PS_API_MAP.'/../tool.php'); // 
Header( "Content-type:   application/octet-stream "); 
Header( "Accept-Ranges:   bytes "); 
header( "Content-Disposition:   attachment;   filename=sitemap.xml "); 
header( "Expires:   0 "); 
header( "Cache-Control:   must-revalidate,   post-check=0,   pre-check=0 "); 
header( "Pragma:   public "); 
$dsn = 'mysql:host=localhost;dbname=uniwigs2016';  
$user = 'root';  
$pwd = 'rootadmin123';
   

$db = Tool::pdo_conn($dsn,$user,$pwd);  

$catasql= "select id_category,CONCAT('http://www.uniwigs.com/',id_category,'-',link_rewrite) 
as link from  ps_category_lang where id_category not in (1,2)";
$catares = Tool::getall($db,$catasql);

$productsql ="select  pp.id_product, CONCAT('http://www.uniwigs.com/',pc.link_rewrite,'/',pp.id_product,'-',pl.link_rewrite,'.html') as link  from  ps_product pp
LEFT JOIN  ps_product_lang pl on pl.id_product=pp.id_product 
LEFT JOIN  ps_category_lang  pc on  pc.id_category=pp.id_category_default
where pp.id_category_default != 40441
GROUP BY pp.id_product";
$res = Tool::getall($db,$productsql);

$tagsql ='select `name` from  ps_tag';
$tagres =Tool::getall($db,$tagsql);
$str = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$str.= "<url>
<loc>http://www.uniwigs.com/</loc>
<lastmod>".date("y-m-d",time())."</lastmod>
<changefreq>weekly</changefreq>
<priority>1.0</priority>
</url>
<url> 
<loc>http://www.uniwigs.com/customer-show</loc> 
<lastmod>".date("y-m-d",time())."</lastmod> 
<changefreq>weekly</changefreq> 
<priority>0.9</priority> 
</url> ";


foreach ($catares as $a){
$str.="<url>";
$str.="<loc>".$a['link']."</loc>";
$str.="<lastmod>".date("y-m-d",time())."</lastmod>";
$str.="<changefreq>daily</changefreq>";
$str.="<priority>0.9</priority>";
$str.="</url>";
	
}
foreach($tagres as $a ){
$str.="<url>";
$str.="<loc>http://www.uniwigs.com/tag/".str_replace(" ", "-",$a['name'])."</loc>";
$str.="<lastmod>".date("y-m-d",time())."</lastmod>";
$str.="<changefreq>daily</changefreq>";
$str.="<priority>0.9</priority>";
$str.="</url>";	
	
};

foreach ($res as $a){
$str.="<url>";
$str.="<loc>".$a['link']."</loc>";
$str.="<lastmod>".date("y-m-d",time())."</lastmod>";
$str.="<changefreq>daily</changefreq>";
$str.="<priority>0.8</priority>";
$str.="</url>";
	
}




$str.="</urlset>";
echo $str;

?>
