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

$catasql= "select id_category,CONCAT('http://m.uniwigs.com/',id_category,'-',link_rewrite) 
as link from  ps_category_lang where id_category not in (1,2)";
$catares = Tool::getall($db,$catasql);

//产品获取   sitemap 生成器
$productsql ="select  pp.id_product, CONCAT('http://m.uniwigs.com/',pc.link_rewrite,'/',pp.id_product,'-',pl.link_rewrite,'.html') as link  from  ps_product pp
LEFT JOIN  ps_product_lang pl on pl.id_product=pp.id_product 
LEFT JOIN  ps_category_lang  pc on  pc.id_category=pp.id_category_default
where pp.id_category_default not in (40441,40440,40445,40441,40462) 
GROUP BY pp.id_product";
$res = Tool::getall($db,$productsql);

$tagsql ='select `name` from  ps_tag';
$tagres =Tool::getall($db,$tagsql);
$str = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$str.="
<url>
<loc>http://lavivid.uniwigs.com/</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>1.0</priority>
</url>
-<url>
<loc>http://lavivid.uniwigs.com/lavivid/41220-lisa-syntheic-wig.html</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://lavivid.uniwigs.com/lavivid/41211-jenny-synthetic-wig.html</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://lavivid.uniwigs.com/lavivid/41216-patsy-synthetic-wig.html</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://lavivid.uniwigs.com/lavivid/41212-carri-synthetic-wig.html</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://lavivid.uniwigs.com/lavivid/41213-kate-synthetic-wig.html</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://lavivid.uniwigs.com/lavivid/41215-halle-synthetic-wig.html</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://lavivid.uniwigs.com/lavivid/41214-liz-synthetic-wig-.html</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url></urlset>";
echo $str;

?>
