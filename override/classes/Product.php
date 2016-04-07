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

class Product extends ProductCore
{
    public static function addCustomizationPrice(&$products, &$customized_datas)
    {
        if (!$customized_datas) {
            return;
        }

        foreach ($products as &$product_update) {
            if (!Customization::isFeatureActive()) {
                $product_update['customizationQuantityTotal'] = 0;
                $product_update['customizationQuantityRefunded'] = 0;
                $product_update['customizationQuantityReturned'] = 0;
            } else {
                $customization_quantity = 0;
                $customization_quantity_refunded = 0;
                $customization_quantity_returned = 0;

                /* Compatibility */
                $product_id = isset($product_update['id_product']) ? (int)$product_update['id_product'] : (int)$product_update['product_id'];
                $product_attribute_id = isset($product_update['id_product_attribute']) ? (int)$product_update['id_product_attribute'] : (int)$product_update['product_attribute_id'];
                $id_address_delivery = (int)$product_update['id_address_delivery'];
                $product_quantity = isset($product_update['cart_quantity']) ? (int)$product_update['cart_quantity'] : (int)$product_update['product_quantity'];
                $price = isset($product_update['price']) ? $product_update['price'] : $product_update['product_price'];
                if (isset($product_update['price_wt']) && $product_update['price_wt']) {
                    $price_wt = $product_update['price_wt'];
                } else {
                    $price_wt = $price * (1 + ((isset($product_update['tax_rate']) ? $product_update['tax_rate'] : $product_update['rate']) * 0.01));
                }

                if (!isset($customized_datas[$product_id][$product_attribute_id][$id_address_delivery])) {
                    $id_address_delivery = 0;
                }
                if (isset($customized_datas[$product_id][$product_attribute_id][$id_address_delivery])) {
                    foreach ($customized_datas[$product_id][$product_attribute_id][$id_address_delivery] as $customization) {
                        $customization_quantity += (int)$customization['quantity'];
                        $customization_quantity_refunded += (int)$customization['quantity_refunded'];
                        $customization_quantity_returned += (int)$customization['quantity_returned'];
                    }
                }

                $product_update['customizationQuantityTotal'] = $customization_quantity;
                $product_update['customizationQuantityRefunded'] = $customization_quantity_refunded;
                $product_update['customizationQuantityReturned'] = $customization_quantity_returned;

                if ($customization_quantity) {
                    $product_update['total_wt'] = $price_wt * ($product_quantity - $customization_quantity);
                   // $product_update['total_customization_wt'] = $price_wt * $customization_quantity + $product_update['customer_total_price'];//////////////////////
					  $product_update['total_customization_wt'] = $price_wt * $customization_quantity;
                    $product_update['total'] = $price * ($product_quantity - $customization_quantity);
                  //  $product_update['total_customization'] = $price * $customization_quantity + $product_update['customer_total_price'];/////////////////
					$product_update['total_customization'] = $price * $customization_quantity ;
                }
            }
        }
    }

    public function updateLabels()
    {
        $has_required_fields = 0;
        foreach ($_POST as $field => $value) {
            /* Label update */
            if (strncmp($field, 'label_', 6) == 0) {
                $select_name = str_ireplace('label_', 'select_', $field);
                $select_name = substr($select_name, 0, strripos($select_name, '_'));
                $select_value = '';
                if (!empty($_POST[$select_name])) {
                    $select_value = $_POST[$select_name];
                    $value = $select_value;
                }

                if (!$tmp = $this->_checkLabelField($field, $value)) {
                    return false;
                }
                /* Multilingual label name update */
                if (Shop::isFeatureActive()) {
                    foreach (Shop::getContextListShopID() as $id_shop) {
                        if (!Db::getInstance()->execute('INSERT INTO `'._DB_PREFIX_.'customization_field_lang`
                        (`id_customization_field`, `id_lang`, `id_shop`, `name`) VALUES ('.(int)$tmp[2].', '.(int)$tmp[3].', '.$id_shop.', \''.pSQL($value).'\')
                        ON DUPLICATE KEY UPDATE `name` = \''.pSQL($value).'\'')) {
                            return false;
                        }
                    }
                } elseif (!Db::getInstance()->execute('
                    INSERT INTO `'._DB_PREFIX_.'customization_field_lang`
                    (`id_customization_field`, `id_lang`, `name`) VALUES ('.(int)$tmp[2].', '.(int)$tmp[3].', \''.pSQL($value).'\')
                    ON DUPLICATE KEY UPDATE `name` = \''.pSQL($value).'\'')) {
                    return false;
                }

                $is_required = isset($_POST['require_'.(int)$tmp[1].'_'.(int)$tmp[2]]) ? 1 : 0;
                $has_required_fields |= $is_required;
                /* Require option update */
                if (!Db::getInstance()->execute(
                    'UPDATE `'._DB_PREFIX_.'customization_field`
                    SET `required` = '.(int)$is_required.'
                    WHERE `id_customization_field` = '.(int)$tmp[2])) {
                    return false;
                }
            }
        }

        if ($has_required_fields && !ObjectModel::updateMultishopTable('product', array('customizable' => 2), 'a.id_product = '.(int)$this->id)) {
            return false;
        }

        if (!$this->_deleteOldLabels()) {
            return false;
        }

        return true;
    }

}
