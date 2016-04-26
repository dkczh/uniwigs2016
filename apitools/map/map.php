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

//产品获取   sitemap 生成器
$productsql ="select  pp.id_product, CONCAT('http://www.uniwigs.com/',pc.link_rewrite,'/',pp.id_product,'-',pl.link_rewrite,'.html') as link  from  ps_product pp
LEFT JOIN  ps_product_lang pl on pl.id_product=pp.id_product 
LEFT JOIN  ps_category_lang  pc on  pc.id_category=pp.id_category_default
where pp.id_category_default not in (40441,40440,40445,40441,40462) 
and pp.active = 1
GROUP BY pp.id_product";
$res = Tool::getall($db,$productsql);

$tagsql ='select `name` from  ps_tag';
$tagres =Tool::getall($db,$tagsql);
$str = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$str.= "<url>
<loc>http://www.uniwigs.com/</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod>
<changefreq>weekly</changefreq>
<priority>1.0</priority>
</url>
<url> 
<loc>http://www.uniwigs.com/customer-show</loc> 
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq> 
<priority>0.9</priority> 
</url>
-<url>
<loc>http://www.uniwigs.com/102-human-hair-wigs</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/40452-human-hair-lace-wigs</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/40453-celebrity-hairstyles</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/40446-full-lace-wigs</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/40447-lace-front-wigs</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/40448-glueless-full-lace-wigs</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/40449-monofilament-wigs</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/40450-silk-top-lace-wigs</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/40451-jewish-wigs</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/101-synthetic-wigs</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/40455-classic-wigs</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/40459-trendy-wigs</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/40456-clearance-wigs</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/103-hair-extensions</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/108-clip-in-hair-extensions</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/40439-flip-in-hair-extensions</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/40457-ombre-hair-extensions</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/104-hair-pieces</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/40458-mono-hair-pieces</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/112-ponytails</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/110-bangs</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/111-half-wigs</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/116-top-hairpieces</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/105-care-products</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>
-<url>
<loc>http://www.uniwigs.com/customer-show</loc>
<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod> 
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url> ";


/* foreach ($catares as $a){
$str.="<url>";
$str.="<loc>".$a['link']."</loc>";
$str.="<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod>";
$str.="<changefreq>daily</changefreq>";
$str.="<priority>0.9</priority>";
$str.="</url>";
	
} */
foreach($tagres as $a ){
$str.="<url>";
$str.="<loc>http://www.uniwigs.com/tag/".str_replace(" ", "-",$a['name'])."</loc>";
$str.="<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod>";
$str.="<changefreq>daily</changefreq>";
$str.="<priority>0.9</priority>";
$str.="</url>";	
	
};

foreach ($res as $a){
	
if($a['link']!=''){
$str.="<url>";
$str.="<loc>".$a['link']."</loc>";
$str.="<lastmod>".date("Y-m-d",strtotime("-1 day"))."</lastmod>";
$str.="<changefreq>daily</changefreq>";
$str.="<priority>0.8</priority>";
$str.="</url>";
}	
}




$str.="</urlset>";
echo $str;

?>