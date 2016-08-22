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


require_once(dirname(__FILE__).'/../config/config.inc.php');
//Dispatcher::getInstance()->dispatch();

$oid = intval($_GET['oid']);
$iid = intval($_GET['iid']);
$review_id = intval($_GET['review_id']);
$review_at = intval($_GET['review_at']);
$type = $_GET['type'];
$content_length = (int)$_GET['content_length'];
$photo_count = (int)$_GET['photo_count'];
$video_count = (int)$_GET['video_count'];

if ($type=='review') {
	Db::getInstance(_PS_USE_SQL_SLAVE_)->execute("
	insert into px_order_item_review(id_order_detail,id_review,review_at,date_add)
	value($iid,$review_id,$review_at,'".date('Y-m-d H:i:s')."')");

	// Hook validate order
	Hook::exec('addReview', array(
	    'customer' => Context::getContext()->customer,
	    'oid' => $oid,
	    'iid' => $iid,
	    'content_length' => $content_length,
	    'photo_count' => $photo_count,
	    'video_count' => $video_count,
	));
} elseif ($type=='share') {
	Db::getInstance(_PS_USE_SQL_SLAVE_)->execute("
	insert into px_order_item_share(id_order_detail,id_share,share_at,date_add)
	value($iid,$review_id,$review_at,'".date('Y-m-d H:i:s')."')");
}

echo 'ok';


