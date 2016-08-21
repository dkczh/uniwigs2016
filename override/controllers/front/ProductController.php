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

class ProductController extends ProductControllerCore
{
    public $sku = '';

    public function canonicalRedirection($canonical_url = '')
    {
        if (Tools::getValue('live_edit')) {
            return;
        }
        if (Validate::isLoadedObject($this->product)) {
            if ($this->sku) {

            } else {
                parent::canonicalRedirection($this->context->link->getProductLink($this->product));
            }
        }
    }

    /**
     * Initialize product controller
     * @see FrontController::init()
     */
    public function init()
    {
        if ( ($sku=Tools::getValue('sku')) && Validate::isReference($sku) ) {
            $this->sku = $sku;
            $prd = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
            select id_product,reference
            from '._DB_PREFIX_.'product
            where reference = "'.$sku.'"
            limit 1
            ');
            if (empty($prd)) {
                $prd = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
                select id_product,reference
                from '._DB_PREFIX_.'product
                where id_product in (select id_product from '._DB_PREFIX_.'product_attribute where reference = "'.$sku.'")
                limit 1
                ');
            }
            if ($prd) {
                $_GET['id_product'] = $prd[0]['id_product'];
            }
        }

        parent::init();
    }

    /**
     * Assign template vars related to page content
     * @see FrontController::initContent()
     */
    public function initContent()
    {
        parent::initContent();

        if (!$this->errors) {
            $custom_options = array();
            if ($this->product->customizable) {
                $co_recs = Db::getInstance()->ExecuteS('
                    select co.*
                    from px_custom_options co
                    where co.deleted=0
                ');
                if ($co_recs) {
                    foreach ($co_recs as &$co) {
                        $options = explode(',', $co['option_values']);
                        $option_items = array();
                        foreach ($options as $option) {
                            $option_items[] = array(
                                'name' => $option,
                                'custom_time' => $co['custom_time'],
                                'custom_price' => floatval($co['custom_price']),
                            );
                        }
                        if (isset($custom_options[$co['option_label']])) {
                            $custom_options[$co['option_label']] = array_merge($custom_options[$co['option_label']], $option_items);
                        } else {
                            $custom_options[$co['option_label']] = $option_items;
                        }
                    }
                }
            }

			//推送额外字段过去
			$this->getProductAddition($this->product->reference);

            $this->context->smarty->assign('custom_options', $custom_options);

            $this->context->smarty->assign('HOOK_PRODUCT_TAB_CONTENT_SPECIFICATIONS',
                Hook::exec('displayProductSpecs', array('product' => $this->product)));

            $this->context->smarty->assign('HOOK_PRODUCT_ASSOCIATIONS',
                Hook::exec('displayProductAssociations', array('product' => $this->product)));

            // $this->context->smarty->assign('HOOK_PRODUCT_FEATURES',
            //     Hook::exec('displayProductFeatures', array('product' => $this->product)));

			$rvm_db_name = '`dev_uniwigs_reviewmgr_online_2016.08.17`';
			$latest_reviews = Db::getInstance()->query("
			select * from $rvm_db_name.reviews
			where id_review in (
				select id_review from $rvm_db_name.review_products where sku='{$this->product->reference}'
			)
			and review_type='normal'
			and deleted=0
			and visible=1
			order by publish_at desc
			limit 0,20
			");
			$latest_reviews_html = '';
			foreach ($latest_reviews as $review) {
				$latest_reviews_html .= '
				<div class="latest_reviews" itemscope itemtype="http://data-vocabulary.org/Review">
					<span itemprop="reviewer">'.$review['author_name'].'</span>
					<span itemprop="dtreviewed" datatime="'.date('c',$review['publish_at']).'">'.date('Y-m-d H:i:s',$review['publish_at']).'</span>
					<span itemprop="description">'.$review['review_content'].'</span>
				</div>
				';
			}
            $this->context->smarty->assign('PRODUCT_REVIEWS', $latest_reviews_html);
        }
    }


	//获取产品additon 
	public function getProductAddition($skus){
		$res= Db::getInstance()->getRow("select * from px_product_addition where  skus = '".$skus."'");
		//获取到得是一个数组
		if($res){
			$this->context->smarty->assign('productAddition', $res);
		}
	}




}
