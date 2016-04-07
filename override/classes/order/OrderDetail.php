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
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class OrderDetail extends OrderDetailCore
{
    /** @var int */
    public $item_review = null;

    /** @var int */
    public $item_shares = null;

    public function __construct($id = null, $id_lang = null, $context = null)
    {
        parent::__construct($id, $id_lang, $context);

		if ($id) {
			$res = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT *
			FROM px_order_item_review
			WHERE id_order_detail = '.(int)$id.
			' limit 1');
			if ($res) {
				$this->item_review = $res[0];
			}

			$res = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT *
			FROM px_order_item_share
			WHERE id_order_detail = '.(int)$id.
			' limit 20');
			if ($res) {
				$this->item_shares = $res;
			}
		}
    }
}
