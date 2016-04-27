<?php
/*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
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
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class ProductAssociations extends Module
{
	public function __construct()
	{
		$this->name = 'productassociations';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'Bruno';
		$this->need_instance = 0;

		$this->bootstrap = true;
		parent::__construct();

		$this->displayName = $this->l('Product Associations');
		$this->description = $this->l('Shows information on a product page: Product Associations.');
	}

	public function install()
	{
		if (!parent::install())
			return false;

		/* Default configuration values */
		Configuration::updateValue('PS_PRODUCTASSOCIATIONS_ENABLED', 1);
		Configuration::updateValue('PS_PRODUCTASSOCIATIONS_TITLE', "Product Specifications");

		return $this->registerHook('displayHeader')
			&& $this->registerHook('displayFooterProduct')
			&& $this->registerHook('displayProductAssociations');
	}

	public function uninstall()
	{
		if (!Configuration::deleteByName('PS_PRODUCTASSOCIATIONS_ENABLED')
			|| !Configuration::deleteByName('PS_PRODUCTASSOCIATIONS_TITLE')
			|| !parent::uninstall()
		)
			return false;

		return true;
	}

	public function getContent()
	{
		$html = '';
		//$html .= $this->context->smarty->fetch($this->local_path.'views/templates/admin/specification_list.tpl');
		return $html;
	}

	public function hookDisplayHeader($params)
	{
// 		$this->context->controller->addJQueryPlugin('growl');
	}

	public function hookDisplayFooterProduct($params)
	{
// 		$id_product = (int)$params['product']->id;

// 		$specs = Db::getInstance()->ExecuteS('
// 		select * from px_specifications order by visible desc,sortindex asc,id_specification asc
// 		');

// 		if ((isset($nb_people['nb']) && $nb_people['nb'] > 0) || isset($order['date_add']) || isset($cart['date_add']))
// 			return $this->display(__FILE__, 'producttooltip.tpl');
	}

	public function hookDisplayProductAssociations($params)
	{
		if (!Configuration::get('PS_PRODUCTASSOCIATIONS_ENABLED')) return '';

		//$id_product = (int)$params['product']->id;
		$sku = $params['product']->reference;

		$associations = Db::getInstance()->ExecuteS("
		select pad.association_id,pa.subject,GROUP_CONCAT(concat(pad.sku,':',pad.value)) as skus
		from px_product_association_details pad
			left join px_product_associations pa on pad.association_id=pa.id
		where pa.deleted=0
		and pad.association_id in (
			SELECT DISTINCT association_id
			FROM `px_product_association_details`
			WHERE sku='$sku'
		)
		group by pad.association_id
		order by pa.add_time desc
		");
		if (empty($associations)) {
			$associations = array();
		}
		
		
		
		foreach ($associations as &$assoc) {
			$assoc['items'] = array();
			$arr = explode(',', $assoc['skus']);
			
			foreach ($arr as $item) {
				//获取数组
				$assoc['items'][] = explode(':', $item);
				$i=0;
				foreach($assoc['items'] as $a){
					
				 	if($this->getlink($a[0])){
				
					  $assoc['items'][$i][2]=$this->getlink($a[0]);
					 
					} 
			
				 $i++;
					
				}
				
		
			
				
				
			}
		}
		
		$this->context->smarty->assign(array(
			'associations' => $associations
		));

		if ($associations)
			return $this->display(__FILE__, 'associations.tpl');

		return '';
	}
	
	public function getlink($a){
		
	$res = Db::getInstance()->getRow("select CONCAT('/',cl.link_rewrite,'/',pl.id_product,'-',pl.link_rewrite,'.html') as link from  ps_product_lang  pl
						LEFT JOIN ps_product p on pl.id_product=p.id_product
						left JOIN ps_category_lang cl on cl.id_category=p.id_category_default
						where p.reference = '$a'
						GROUP BY pl.id_product");
	if($res){
			return $res['link'];
		}
		else{
			return  'no exists product';
		}
	

	}

}
