<?php
/*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class TagControllerCore extends FrontController
{
	public $php_self = 'tag';
	/**
	 * @var Tag
	 */
	public $tag;
	public $ssl = false;

	public function canonicalRedirection($canonicalURL = '')
	{
// 		if (Tools::getValue('live_edit'))
// 			return;
// 		if (Validate::isLoadedObject($this->tag) && ($canonicalURL = $this->context->link->getCMSLink($this->tag, $this->tag->link_rewrite, $this->ssl)))
// 			parent::canonicalRedirection($canonicalURL);
	}

	/**
	 * Initialize cms controller
	 * @see FrontController::init()
	 */
	public function init()
	{
		if ($url_key = Tools::getValue('url_key'))
			$this->tag = new Tag(null, str_ireplace(array('-','+'),' ',$url_key), $this->context->language->id);

		parent::init();

// 		$this->canonicalRedirection();
	}

	public function setMedia()
	{
		parent::setMedia();

// 		if ($this->assignCase == 1)
// 			$this->addJS(_THEME_JS_DIR_.'cms.js');

// 		$this->addCSS(_THEME_CSS_DIR_.'cms.css');
	}

	/**
	 * Assign template vars related to page content
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{
		parent::initContent();

		$this->context->smarty->assign('id_current_lang', $this->context->language->id);
			
		$tagid = $this->tag->id ;
		$tagname = $this->tag->name ;

		if($tagid!=''){
			$res= Db::getInstance()->getRow('select catagory from px_tag_extra where id_tag='.$tagid);

			if($res){
			foreach($res as $a ){
				$catagory =  $a;
				
			}} else{
				$catagory = '';
			}
			
			$this->context->smarty->assign('tagid',$tagid);
			$this->context->smarty->assign('tagname',$tagname);
			$this->context->smarty->assign('catagory',$catagory);
		}
		
		//推送图片
		
		$mydir= $_SERVER['DOCUMENT_ROOT']."/img/tag/".$tagid."/";
		if(file_exists($mydir)){
		
			$files=$this->get_allimg($mydir,$tagid);
			
			/* var_dump($files); */
			if($files!=null){
			
			$this->context->smarty->assign('tagimg', $files);//将次产品目录下图片搜索出来
			}
		 }
		
		$this->context->smarty->assign(array(
			'tag' => $this->tag,
			'content_only' => (int)Tools::getValue('content_only'),
			'path' => $this->tag->name,
			'products' => $this->tag->getProductsArray(),
		));
		
		$template = 'tag.tpl';
		if ($this->tag->getTemplate()) {
		
			$template = $this->tag->getTemplate();

           $weburl=$_SERVER['HTTP_HOST'];

		   if($weburl=="m.uniwigs.com"){
		   $template=str_replace('.html','-mobile.html',$template);
		  // echo $template;
		   }


			if(!file_exists(_PS_THEME_DIR_.$template))
			{
			$template="404.tpl";
			}

			
		}
		
		$this->setTemplate(_PS_THEME_DIR_.$template);

		$this->getTagBanners();
	}
	
	//获取制定目录下图片路径
	public function get_allimg($dir,$id){
	
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
	
	
	private function getTagBanners()
	{
		$key = "tag_banners_".$this->tag->id;
		if (!Cache::getInstance()->exists($key)) {
			$tag_banners = array();
			$tag_rewrite_link = $this->tag->getRewriteLink();
			if ($tag_rewrite_link) {
				if (is_file(_PS_IMG_DIR_."tbanners/".$tag_rewrite_link.".jpg")) {
					$tag_banners[] = _PS_IMG_."tbanners/".$tag_rewrite_link.".jpg";
				}
				if (is_file(_PS_IMG_DIR_."tbanners/".$tag_rewrite_link."_0.jpg")) {
					$tag_banners[] = _PS_IMG_."tbanners/".$tag_rewrite_link."_0.jpg";
				}
				for ($bind=1;$bind<6;$bind++) {
					if (is_file(_PS_IMG_DIR_."tbanners/".$tag_rewrite_link."_$bind.jpg")) {
						$tag_banners[] = _PS_IMG_."tbanners/".$tag_rewrite_link."_$bind.jpg";
					} else {
						break;
					}
				}
			}
			Cache::getInstance()->set($key, $tag_banners, 86400*7);
		}
		$tag_banners = Cache::getInstance()->get($key);
		$this->context->smarty->assign("tag_banners", $tag_banners);
	}
	
	
	private function getCatagory()
	{
		$tagname = $this->tag;
	
	}
	
}
