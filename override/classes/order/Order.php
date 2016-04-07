<?php
/*
* 2007-2015 PrestaShop
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
*  @copyright  2007-2015 PrestaShop SA
*  @license	http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class Order extends OrderCore
{
    public function getProductsDetail()
    {
        /* $items = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
		SELECT *
		FROM `'._DB_PREFIX_.'order_detail` od
		LEFT JOIN `'._DB_PREFIX_.'product` p ON (p.id_product = od.product_id)
		LEFT JOIN `'._DB_PREFIX_.'product_shop` ps ON (ps.id_product = p.id_product AND ps.id_shop = od.id_shop)
		WHERE od.`id_order` = '.(int)$this->id); */
		$id=(int)$this->id;
		  $items = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS("		SELECT SQL_NO_CACHE *,IF (
	cl.`link_rewrite` = 'lavivid',
		CONCAT(
			'http:\/\/lavivid.uniwigs.com\/',
			cl.`link_rewrite`,
			'\/',
			p.`id_product`,
			'-',
			pl.`link_rewrite`
		),
	CONCAT(
			'\/',cl.`link_rewrite`,
			'\/',
			p.`id_product`,
			'-',
			pl.`link_rewrite`
		)
	) as mylink 
FROM `ps_order_detail` od
LEFT JOIN `ps_product` p ON (p.id_product = od.product_id)
LEFT JOIN `ps_product_shop` ps ON (ps.id_product = p.id_product AND ps.id_shop = od.id_shop)
LEFT JOIN ps_product_lang pl on (p.id_product=pl.id_product)
LEFT JOIN ps_category_lang  cl on(p.id_category_default=cl.id_category)
WHERE od.`id_order` = $id
");


		if (empty($items)) {
			return $items;
		}

		$item_ids  = array();
		foreach ($items as $item) {
			$item_ids[] = $item['id_order_detail'];
		}

		foreach ($items as &$item) {
			$item['item_review'] = null;
			$item['item_shares'] = null;
		}

		$item_review_rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS("
        SELECT *
        FROM px_order_item_review
        WHERE id_order_detail in (".implode(',', $item_ids).")");
		foreach ($items as &$item) {
			foreach ($item_review_rows as $review_row) {
				if ($review_row['id_order_detail'] == $item['id_order_detail']) {
					$item['item_review'] = $review_row;
					break;
				}
			}
		}

		$item_share_rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS("
        SELECT *
        FROM px_order_item_share
        WHERE id_order_detail in (".implode(',', $item_ids).")");
		foreach ($items as &$item) {
			foreach ($item_share_rows as $share_row) {
				if ($share_row['id_order_detail'] == $item['id_order_detail']) {
					$item['item_shares'][] = $share_row;
				}
			}
		}

		return $items;
    }
}
