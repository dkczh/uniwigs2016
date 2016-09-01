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

class Tag extends TagCore
{

 	/** @var string template */
	public $template = NULL;

 	/** @var string skus */
	public $skus = NULL;

	public function __construct($id = null, $name = null, $id_lang = null)
	{
		$this->def = Tag::getDefinition($this);
		$this->setDefinitionRetrocompatibility();

		//echo $name.'<hr>' ;
		//echo $id_lang;
		if ($id)
			parent::__construct($id);
		elseif ($name && Validate::isGenericName($name) && $id_lang && Validate::isUnsignedId($id_lang))
		{
			$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
			SELECT *
			FROM `'._DB_PREFIX_.'tag` t
			WHERE `name` LIKE \''.pSQL($name).'\' AND `id_lang` = '.(int)$id_lang);
			
			//echo '<br>';
			//echo var_dump($row);
			
			if ($row)
			{
			 	$this->id = (int)$row['id_tag'];
			 	$this->id_lang = (int)$row['id_lang'];
				$this->name = $row['name'];
			}
		}
		
		
	}


	public function add($autodate = true, $null_values = false)
	{
		if (!parent::add($autodate, $null_values))
			return false;
// 		elseif (isset($_POST['products'])) {
// 			return $this->setProducts(Tools::getValue('products'));
// 		}
		return true;
	}
   // tempalte值 skus得获取
	public function getSkus(Context $context = null, $sku_or_tpl = true)
	{
		if (!$context)
			$context = Context::getContext();
		$id_lang = $this->id_lang ? $this->id_lang : $context->language->id;

		if ($this->template === NULL && $this->id) {
			$extra = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			select template,skus
			from '._DB_PREFIX_EX_.'tag_extra
			where id_tag='.$this->id.'
			limit 1
			', true, false);
			if ($extra) {
				$this->template = $extra[0]['template'];
				$this->skus = $extra[0]['skus'];
			}
		}
		if ($this->template === NULL) {
			$this->template = '';
			$this->skus = '';
		}

		if ($sku_or_tpl) {
			return $this->skus;
		} else {
			return $this->template;
		}
	}
	// tempalte值 skus得获取
	public function getTemplate(Context $context = null)
	{
		return $this->getSkus($context, false);
	}
	
	/*
	 * $like  如果为true 表示 you may also like 调用 tag产品
	*/
	public function getProductsArray(Context $context = null,$like = null)
	{
		if (!$context)
			$context = Context::getContext();
		$id_lang = $this->id_lang ? $this->id_lang : $context->language->id;

		$active = true;
		$front = true;
		if (!in_array($context->controller->controller_type, array('front', 'modulefront')))
			$front = false;
		$start = 0;
		$limit = 100;

		$products_array = array();

		$sql_part1 = 'SELECT p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity'.(Combination::isFeatureActive() ? ', MAX(product_attribute_shop.id_product_attribute) id_product_attribute, MAX(product_attribute_shop.minimal_quantity) AS product_attribute_minimal_quantity' : '').', pl.`description`, pl.`description_short`, pl.`available_now`,
					pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, MAX(image_shop.`id_image`) id_image,
					MAX(il.`legend`) as legend, m.`name` AS manufacturer_name,
					DATEDIFF(product_shop.`date_add`, DATE_SUB(NOW(),
					INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).'
						DAY)) > 0 AS new, product_shop.price AS orderprice
				FROM `'._DB_PREFIX_.'category_product` cp
				LEFT JOIN `'._DB_PREFIX_.'product` p
					ON p.`id_product` = cp.`id_product`
				'.Shop::addSqlAssociation('product', 'p').
				(Combination::isFeatureActive() ? 'LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa
				ON (p.`id_product` = pa.`id_product`)
				'.Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1').'
				'.Product::sqlStock('p', 'product_attribute_shop', false, $context->shop) :  Product::sqlStock('p', 'product', false, $context->shop)).'
				LEFT JOIN `'._DB_PREFIX_.'product_lang` pl
					ON (p.`id_product` = pl.`id_product`
					AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl').')
				LEFT JOIN `'._DB_PREFIX_.'image` i
					ON (i.`id_product` = p.`id_product`)'.
				Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
				LEFT JOIN `'._DB_PREFIX_.'image_lang` il
					ON (image_shop.`id_image` = il.`id_image`
					AND il.`id_lang` = '.(int)$id_lang.')
				LEFT JOIN `'._DB_PREFIX_.'manufacturer` m
					ON m.`id_manufacturer` = p.`id_manufacturer`';
		if ($this->getSkus()) {
			$skus_array = explode("\n", $this->skus);
			/*$sql = 'SELECT p.*, product_shop.*, pl.* , m.`name` AS manufacturer_name, s.`name` AS supplier_name
					FROM `'._DB_PREFIX_.'product` p
					'.Shop::addSqlAssociation('product', 'p').'
					LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` '.Shop::addSqlRestrictionOnLang('pl').')
					LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
					LEFT JOIN `'._DB_PREFIX_.'supplier` s ON (s.`id_supplier` = p.`id_supplier`)
					WHERE pl.`id_lang` = '.(int)$id_lang.
						($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '').
						($only_active ? ' AND product_shop.`active` = 1' : '').'
						and p.reference in "'.str_ireplace(",", '","', str_ireplace("\n", ',', $this->skus)).'"
					ORDER BY instr(",'.str_ireplace("\n", ',', $this->skus).',", concat(",",p.reference,","))'.
					($limit > 0 ? ' LIMIT '.(int)$start.','.(int)$limit : '');*/
			$sql = $sql_part1.' WHERE 1
						and p.reference in ("'.str_ireplace(",", '","', str_ireplace("\n", ',', $this->skus)).'")
						and product_shop.`id_shop` = '.(int)$context->shop->id
						.($active ? ' AND product_shop.`active` = 1' : '')
						.($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '')
						.' GROUP BY product_shop.id_product
					ORDER BY instr(",'.str_ireplace("\n", ',', $this->skus).',", concat(",",p.reference,","))'.
					($limit > 0 ? ' LIMIT '.(int)$start.','.(int)$limit : '');
			$rq = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
			if($like){
				
				return  $rq;
				
			}
	
			
			$rq = Product::getProductsProperties($id_lang, $rq);
			foreach ($skus_array as $ind=>$skus) {
				$products_tmp = array();
				foreach ($rq as $r) {
					if (stristr(','.$skus.',', ','.$r['reference'].',')) {
						$products_tmp[] = $r;
					}
				}
				$products_array[] = $products_tmp;
			}
		}

		/*$rq2 = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT p.*, product_shop.*, pl.* , m.`name` AS manufacturer_name, s.`name` AS supplier_name
			FROM `'._DB_PREFIX_.'product` p
			'.Shop::addSqlAssociation('product', 'p').'
			LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` '.Shop::addSqlRestrictionOnLang('pl').')
			LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
			LEFT JOIN `'._DB_PREFIX_.'supplier` s ON (s.`id_supplier` = p.`id_supplier`)
			WHERE pl.`id_lang` = '.(int)$id_lang.
				($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '').
				($only_active ? ' AND product_shop.`active` = 1' : '').'
				and p.id_product in (SELECT pt.id_product FROM `'._DB_PREFIX_.'product_tag` pt WHERE pt.id_tag = '.(int)$this->id.')'
		);*/
		/* $sql2 = $sql_part1.' WHERE
					p.id_product in (SELECT pt.id_product FROM `'._DB_PREFIX_.'product_tag` pt WHERE pt.id_tag = '.(int)$this->id.')
					and p.reference not in ("'.str_ireplace(",", '","', str_ireplace("\n", ',', $this->skus)).'")
					and product_shop.`id_shop` = '.(int)$context->shop->id
					.($active ? ' AND product_shop.`active` = 1' : '')
					.($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '')
					.' GROUP BY product_shop.id_product
				ORDER BY p.date_add desc'.
				($limit > 0 ? ' LIMIT '.(int)$start.','.(int)$limit : '');
		$rq2 = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql2);
		$rq2 = Product::getProductsProperties($id_lang, $rq2);
		
		
		
		if (empty($products_array)) {
			$products_array[] = $rq2;
		} else {
			$arr_len = count($products_array);
			$products_array[$arr_len-1] = array_merge($products_array[$arr_len-1], $rq2);
		} */
		
		return $products_array;
	}

	public function setProducts($array)
	{
		$result = Db::getInstance()->execute('DELETE FROM '._DB_PREFIX_.'product_tag WHERE id_tag = '.(int)$this->id);
		if (is_array($array) && !empty($array))
		{
			$array = array_map('intval', $array);
			$result &= ObjectModel::updateMultishopTable('Product', array('indexed' => 0), 'a.id_product IN ('.implode(',', $array).')');
			$ids = array();
			foreach ($array as $id_product)
				$ids[] = '('.(int)$id_product.','.(int)$this->id.')';

			if ($result)
			{
				$result &= Db::getInstance()->execute('INSERT INTO '._DB_PREFIX_.'product_tag (id_product, id_tag) VALUES '.implode(',', $ids));
				// if (Configuration::get('PS_SEARCH_INDEXATION'))
				// 	$result &= Search::indexation(false);
			}
		}
		return $result;
	}

	public function getRewriteLink()
	{
		$rewrite_link = '';
		if (!empty($this->name)) {
			$rewrite_link = preg_replace("/[^\w\-]+/", "-", $this->name);
			$rewrite_link = strtolower($rewrite_link);
		}
		return $rewrite_link;
	}

}
