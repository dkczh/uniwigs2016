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

class CategoryController extends CategoryControllerCore
{
    /**
     * Initializes controller
     *
     * @see FrontController::init()
     * @throws PrestaShopException
     */
    public function init()
    {
        // Get category ID
        $id_category = (int)Tools::getValue('id_category');
	echo "<!--child:$id_category-->";
        if (!$id_category || !Validate::isUnsignedId($id_category)) {
            $this->errors[] = Tools::displayError('Missing category ID');
        }

        // Instantiate category
        $this->category = new Category($id_category, $this->context->language->id);

        if (in_array($this->category->id, array(101, 102, 103, 104))) {
            $this->display_column_left = false;


            //在没有建立 相应tag之前 是不会又产品推送到前台的
            $this->getProducts('HumanHairWigsNewArrival');
            $this->getProducts('HumanHairWigsHotList');

            $this->getProducts('SyntheticWigsNewArrival');
            $this->getProducts('SyntheticWigsHotList');

            $this->getProducts('HairExtensionsHotList');

            $this->getProducts('HairPiecesHotList');

        }

        parent::init();

        // Check if the category is active and return 404 error if is disable.
        if (!$this->category->active) {
            header('HTTP/1.1 404 Not Found');
            header('Status: 404 Not Found');
        }

        // Check if category can be accessible by current customer and return 403 if not
        if (!$this->category->checkAccess($this->context->customer->id)) {
            header('HTTP/1.1 403 Forbidden');
            header('Status: 403 Forbidden');
            $this->errors[] = Tools::displayError('You do not have access to this category.');
            $this->customer_access = false;
        }
    }


    //获取热销产品和最新产品

    public function getProducts($products)
    {

        if ($this->getTagSkus($products)) {
            $sql = "SELECT a.id_product,a.reference,a.price,b.name,b.link_rewrite,c.id_image from ps_product a  
		RIGHT JOIN  ps_product_lang b on a.id_product=b.id_product  
		RIGHT JOIN ps_image c on a.id_product=c.id_product 
		where a.reference in (" . $this->getTagSkus($products) . ") 
		and b.id_shop=1
		GROUP BY id_product";
            $res = Db::getInstance()->query($sql);

            /* if($res){
                foreach($res as $a){

                echo $a['id_product']."</br>";
                }
            } */

            $this->context->smarty->assign("$products", $res);

        }

    }

    //获取制定tag 名称的产品 
    public function getTagSkus($products)
    {
        $sql = "SELECT b.skus from ps_tag a LEFT JOIN px_tag_extra b on  a.id_tag = b.id_tag WHERE a.name= '" . $products . "'";
        $res = Db::getInstance()->getRow($sql);
        if ($res) {
            $str = '';
            foreach ($res as $a) {
                $arr = explode(',', $a);
                foreach ($arr as $s) {
                    $str .= "'" . $s . "',";
                }

                $str = substr($str, 0, -1);
                return $str;

            }

        } else {
            return false;
        }
    }
}
