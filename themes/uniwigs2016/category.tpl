{*
* 2007-2015 PrestaShop
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
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{include file="$tpl_dir./errors.tpl"}
{if isset($category)}
    {if $category->id == '102'}
        {literal}
        <style>
            .breadcrumb{display: none}
            .category-home h5 a{background:#DC0031;padding:6px 15px;font-weight:bold;color:#fff;letter-spacing: 2px;}
        </style>
        {/literal}
        <section class="containerIndex">
            <section class="category-home">
                <div>
                    <a href="{$base_dir}40447-lace-front-wigs"><img src="{$img_dir}christmas/new-banner.jpg" alt="" class="img-responsive"></a>
                </div>
                <div class="uk-margin-top">
                    <a href="{$base_dir}tag/real-human-hair"><img src="{$img_dir}category/human-hair/real-human-hair.jpg" alt="real human hair" class="img-responsive"></a>
                </div>
                <ul class="row uk-margin-top">
                    <li class="col-md-6 col-sm-6">
                        <a href="{$base_dir}tag/luxury-human-hair">
                            <img src="{$img_dir}category/human-hair/Luxury.jpg" alt="" class="img-responsive">
                        </a>
                        <h3 class="text-center">Luxury Collection Wig</h3>
                        <h5 class="text-center">The supreme quality human hair wig</h5>
                        <h5 class="text-center uk-margin-small-top"><a href="{$base_dir}tag/luxury-human-hair">shop now ></a></h5>
                    </li>
                    <li class="col-md-6 col-sm-6">
                        <a href="{$base_dir}tag/human-hair-wigs-customization">
                            <img src="{$img_dir}category/human-hair/custom.jpg" alt="" class="img-responsive">
                        </a>
                        <h3 class="text-center">custom wigs</h3>
                        <h5 class="text-center">Create your personal wig</h5>
                        <h5 class="text-center uk-margin-small-top"><a href="{$base_dir}tag/human-hair-wigs-customization">shop now ></a></h5>
                    </li>
                </ul>
                <div class="uk-margin-top">
                    <a href="{$base_dir}40453-celebrity-hairstyles"><img src="{$img_dir}category/human-hair/star.jpg" alt="real human hair" class="img-responsive"></a>
                </div>
                <div class="uk-margin-top">
                    <a href="https://www.youtube.com/watch?v=zei6OVyX43w" class="category-video" data-uk-lightbox><img src="{$img_dir}category/human-hair/video-human.jpg" alt="Uniwigs Human Hair Lace Wig Collection" class="img-responsive"></a>
                </div>
                
                {if isset($HumanHairWigsNewArrival)}
                <div class="cagegory_topsale title-hr">
                    <h3>new arrivals</h3>
                    <p class="hr"></p>
                    <ul class="cagegory_products_list row uk-margin-top">
                        {foreach $HumanHairWigsNewArrival as $p}
                        <li>
                            <div class="product-container">
                                <a href="{$category->name|replace:' ':'-'|lower}/{$p['id_product']}-{$p['link_rewrite']}.html" class="prodcut_a" title="{$p['name']}">
                                    <img src="/{$p['id_image']}-home_default/{$p['link_rewrite']}.jpg" alt="{$p['name']}" title="{$p['name']}" class="img-responsive"/>
                                </a>
                                <div class="text-center">
                                    <p class="name uk-margin-small-top">
                                        <a href="{$hs_prd.link}">
                                            {$p['name']|truncate:50:'...'|escape:'htmlall':'UTF-8'}
                                        </a>
                                    </p>
                                    <p class="product-list-price uk-margin-small-top">
                                        <span>
                                            ${$p['price']|string_format:"%.2f"}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </li>
                        {/foreach}
                    </ul>
                </div>
                {/if}

                {if isset($HumanHairWigsHotList)}
                    <div class="cagegory_topsale title-hr">
                        <h3>Hot List</h3>
                        <p class="hr"></p>
                        <ul class="cagegory_products_list row uk-margin-top">
                            {foreach $HumanHairWigsHotList as $p}
                            <li>
                                <div class="product-container">
                                    <a href="{$category->name|replace:' ':'-'|lower}/{$p['id_product']}-{$p['link_rewrite']}.html" class="prodcut_a" title="{$p['name']}">
                                        <img src="/{$p['id_image']}-home_default/{$p['link_rewrite']}.jpg" alt="{$p['name']}" title="{$p['name']}" class="img-responsive"/>
                                    </a>
                                    <div class="text-center">
                                        <p class="name uk-margin-small-top">
                                            <a href="{$hs_prd.link}">
                                                {$p['name']|truncate:50:'...'|escape:'htmlall':'UTF-8'}
                                            </a>
                                        </p>
                                        <p class="product-list-price uk-margin-small-top">
                                            <span>
                                                ${$p['price']|string_format:"%.2f"}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            {/foreach}
                        </ul>
                    </div>
                {/if}

                <div class="sns_ins uk-margin-large-top text-center">
                    <div class="sns_ins_title sns_facebook">
                        <h3><a href="http://www.facebook.com/uniwigs" target="_blank">@uniwigs custom</a></h3>
                    </div>
                    <div id="custome-show" class="uk-margin-small-top">
                        
                    </div>
                    <div class="uk-margin-small-top">
                        <a href="http://www.uniwigs.com/customer-show?caid=102" class="uk-button uk-button-link">CUSTOMER SHOW ></a>
                    </div>
                    <script type="text/javascript">
                        $(function(){
                            window.load_home_customer_shows = function(){
                                $.get("http://rvm.uniwigs.com/api_review3/home_customer_shows",{
                                    pagesize:4,
                                    catids:102
                                },function(data){
                                    $("#custome-show").html(data);
                                });
                            }
                            load_home_customer_shows();
                        });
                    </script>
                </div>

                <div class="category_help uk-margin-large-top">
                    <ul class="row" data-uk-grid-match>
                        <li class="col-md-4">
                            <div class="category_faq">
                                <div class="ask">
                                    <span>What are Full Lace wigs and Glueless Full Lace wigs?</span>
                                </div>
                                <div class="answer text-info uk-margin-small-top">
                                    <p>These two kinds of wigs include lace all around the perimeter and are available for you to wear your hair in updo's and high ponytails. The wigs all have a natural hairline around the perimeter when wearing.
                                    Since there were no combs or clips and no straps inside Full Lace wigs, you have to apply the wigs with either glue or other adhesives. These are suitable for women without hair or with scarce hair. While glueless full lace wigs have adjustable straps on the back and combs on the side and the front to secure the wig from sliding or rolling back, you can adjust the cap to suit your head size for a better fit.</p>
                                </div>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="category_faq">
                                <div class="ask">
                                    <span>How can I choose the color and the size?</span>
                                </div>
                                <div class="answer text-info uk-margin-small-top">
                                    <p>To help you shop for the right color online it's just as easy as in a store, please refer to our hair color chart after you have found the style you like.</p>
                                    <p>As for the cap size, we all know that measuring your head size is an important task to endeavor prior to ordering a wig. Please carefully measure your head size and choose the proper cap size following our cap size guide.</p>
                                </div>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="category_faq">
                                <div class="ask">
                                    <span>Are the knots of the your wig bleached ?</span>
                                </div>
                                <div class="answer text-info uk-margin-small-top">
                                    <p>All of our wigs are knots bleached except color jet-black . For this color ,bleaching knots will damage the hair .so we do not recommend our customer do it their own.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
        </section>
        <script type="text/javascript" src="/themes/uniwigs2016/js/lightbox.js" defer></script>
    {elseif $category->id == '101'}
        {literal}
        <style>
            #columns{max-width: 100%}
            .breadcrumb{display: none}
            .text-detail{width: 172px;padding-right: 10px;text-align: center;}
            .synthetic_clearnce{display:block;border:3px solid #ccc;padding:78px 65px;}
            .synthetic_clearnce h2{letter-spacing: 6px}
            .synthetic_clearnce p{letter-spacing: 2px;font-size:1.3em;}
            @media (min-width:768px) {
                .text-detail-bottom{position: absolute;bottom:25px;left:-80px;}
                .text-detail-top{position: absolute;top:25px;left:-80px;}
            }
            @media (min-width:1600px) {
                .col-md-offset-1{margin-left:18%;}
                .col-md-offset-2{margin-left:10%;}
                .col-md-5{ width: 33.33333%;}
                .col-md-7 img{ margin:0 auto;}
                .category-banner .col-md-4{width:25%;}
            }

        </style>
        {/literal}

        {*<script type="text/javascript" src="{$js_dir}like.js"></script>*}
            <section class="category-home">
                {*<div class="cargory_banner" style="background-color:#fbfbfb">
                    <div class="img-responsive"><img src="{$img_dir}category/synthetic-wigs/Synthetic_banner.jpg" alt="Cool Summer New Wigs" style="margin:0 auto"></div>
                </div>*}
                <div class="clearfix">
                    <div class="col-md-5 col-sm-11 col-sm-offset-2 col-md-offset-1 uk-margin-large-top">
                        <div class="text-detail text-detail-bottom">
                            <h3><a href="{$base_dir}40455-classic-wigs">classic</a></h3>
                            <h5>The classic will last forever!</h5>
                        </div>
                        <a class="pull-left img-responsive" href="{$base_dir}40455-classic-wigs"><img src="{$img_dir}category/synthetic-wigs/classic_wigs.jpg" alt=""></a>
                    </div>
                    <div class="uk-margin-large-top col-md-4 col-sm-8 col-sm-offset-4 col-md-offset-2">
                        <div class="text-detail text-detail-top pull-left">
                            <h3><a href="{$base_dir}40459-trendy-wigs">trendy</a></h3>
                            <h5>Wanna become trendy? Let's start with the hair!</h5>
                        </div>
                        <a class="pull-left img-responsive" href="{$base_dir}40459-trendy-wigs"><img src="{$img_dir}category/synthetic-wigs/trendy_wigs.jpg" alt=""></a>
                    </div>
                </div>
                <div class="category-banner clearfix">
                    <div class="col-md-7 uk-margin-large-top">
                        <a href="{$base_dir}tag/silver-galaxy-trend-wig" class="img-responsive"><img src="{$img_dir}category/synthetic-wigs/silver_galaxy.jpg" alt=""></a>
                    </div>
                    <div class="col-md-4 uk-margin-large-top">
                        <a href="{$base_dir}40456-clearance-wigs" class="synthetic_clearnce text-center">
                            <h2>clearnce</h2>
                            <p>Save Big on the wig!</p>
                            <h5 class="uk-margin-large-top">shop now ></h5>
                        </a>
                    </div>
                </div>

                <div class="synthetic-video container">
                    <div class="row">
                        <div class="col-sm-6 uk-margin-large-top">
                            <a href="https://www.youtube.com/watch?v=C7dazw19buc" class="category-video" data-uk-lightbox><img src="{$img_dir}category/synthetic-wigs/video-synthetic01.jpg" alt="Uniwigs Human Hair Lace Wig Collection" class="img-responsive"></a>
                        </div>
                        <div class="col-sm-6 uk-margin-large-top">
                            <a href="https://www.youtube.com/watch?v=FpGH3KQJ5Z4" class="category-video" data-uk-lightbox><img src="{$img_dir}category/synthetic-wigs/video-synthetic02.jpg" alt="Uniwigs Human Hair Lace Wig Collection" class="img-responsive"></a>
                        </div>
                    </div>
                </div>
                <div class="container">
                     {if isset($SyntheticWigsNewArrival)}
                     <div class="cagegory_topsale title-hr">
                         <h3>new arrivals</h3>
                         <p class="hr"></p>
                         <ul class="cagegory_products_list row uk-margin-top">
                             {foreach $SyntheticWigsNewArrival as $p}
                             <li>
                                 <div class="product-container">
                                     <a href="{$category->name|replace:' ':'-'|lower}/{$p['id_product']}-{$p['link_rewrite']}.html" class="prodcut_a" title="{$p['name']}">
                                         <img src="/{$p['id_image']}-home_default/{$p['link_rewrite']}.jpg" alt="{$p['name']}" title="{$p['name']}" class="img-responsive"/>
                                     </a>
                                     <div class="text-center">
                                         <p class="name uk-margin-small-top">
                                             <a href="{$hs_prd.link}">
                                                 {$p['name']|truncate:50:'...'|escape:'htmlall':'UTF-8'}
                                             </a>
                                         </p>
                                         <p class="product-list-price uk-margin-small-top">
                                             <span>
                                                 ${$p['price']|string_format:"%.2f"}
                                             </span>
                                         </p>
                                     </div>
                                 </div>
                             </li>
                             {/foreach}
                         </ul>
                     </div>
                     {/if}

                     {if isset($SyntheticWigsHotList)}
                         <div class="cagegory_topsale title-hr">
                             <h3>Hot List</h3>
                             <p class="hr"></p>
                             <ul class="cagegory_products_list row uk-margin-top">
                                 {foreach $SyntheticWigsHotList as $p}
                                 <li>
                                     <div class="product-container">
                                         <a href="{$category->name|replace:' ':'-'|lower}/{$p['id_product']}-{$p['link_rewrite']}.html" class="prodcut_a" title="{$p['name']}">
                                             <img src="/{$p['id_image']}-home_default/{$p['link_rewrite']}.jpg" alt="{$p['name']}" title="{$p['name']}" class="img-responsive"/>
                                         </a>
                                         <div class="text-center">
                                             <p class="name uk-margin-small-top">
                                                 <a href="{$hs_prd.link}">
                                                     {$p['name']|truncate:50:'...'|escape:'htmlall':'UTF-8'}
                                                 </a>
                                             </p>
                                             <p class="product-list-price uk-margin-small-top">
                                                 <span>
                                                     ${$p['price']|string_format:"%.2f"}
                                                 </span>
                                             </p>
                                         </div>
                                     </div>
                                 </li>
                                 {/foreach}
                             </ul>
                         </div>
                     {/if}
                    
                    <div class="sns_ins uk-margin-large-top text-center">
                    <div class="sns_ins_title">
                        <h3><a href="http://instagram.com/uniwigs" target="_blank">@uniwigs Trendy</a></h3>
                    </div>
                    <div id="custome-show" class="uk-margin-small-top">
                        {*<ul class="row">
                            <li class="col-md-3 col-sm-3">
                                <a href=""><img src="/40475-2127-vnormal/katerina-graham-curly-remy-human-hair-lace-wig.jpg" alt="" class="img-responsive"></a>
                            </li>
                            <li class="col-md-3 col-sm-3">
                                <a href=""><img src="/40475-2127-vnormal/katerina-graham-curly-remy-human-hair-lace-wig.jpg" alt="" class="img-responsive"></a>
                            </li>
                            <li class="col-md-3 col-sm-3">
                                <a href=""><img src="/40475-2127-vnormal/katerina-graham-curly-remy-human-hair-lace-wig.jpg" alt="" class="img-responsive"></a>
                            </li>
                            <li class="col-md-3 col-sm-3">
                                <a href=""><img src="/40475-2127-vnormal/katerina-graham-curly-remy-human-hair-lace-wig.jpg" alt="" class="img-responsive"></a>
                            </li>
                        </ul>*}
                    </div>
                    <div class="uk-margin-small-top">
                        <a href="http://www.uniwigs.com/customer-show?caid=101" class="uk-button uk-button-link">CUSTOMER SHOW ></a>
                    </div>
                    <script type="text/javascript">
                    {literal}
                    $(function(){
                        window.load_home_customer_shows = function(){
                            $.get("http://rvm.uniwigs.com/api_review3/home_customer_shows",{
                                pagesize:4,
                                catids:101
                            },function(data){
                                $("#custome-show").html(data);
                            });
                        }
                        load_home_customer_shows();
                    });
                    {/literal}
                    </script>
                </div>

                    <div class="category_help uk-margin-large-top">
                        <ul class="row" data-uk-grid-match>
                            <li class="col-md-4">
                                <div class="category_faq">
                                    <div class="ask">
                                        <span>Can the synthetic wig be styled or dyed?</span>
                                    </div>
                                    <div class="answer text-info uk-margin-small-top">
                                        <p>The synthetic wig on our website can be curled and straighten, but the temperature must be controlled under 85 degree centigrade. but, the synthetic wig could not be dyed, it will damage the wig, please do it on human hair product if you need to.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-4">
                                <div class="category_faq">
                                    <div class="ask">
                                        <span>What is your default capsize for synthetic wig?</span>
                                    </div>
                                    <div class="answer text-info uk-margin-small-top">
                                        <p>The default capsize for synthetic wig on Uniwigs is 21.5” inches. If you have special need, please contact support@unwigs. com to custom your unique cap size.
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-4">
                                <div class="category_faq">
                                    <div class="ask">
                                        <span>How to care the synthetic wig?</span>
                                    </div>
                                    <div class="answer text-info uk-margin-small-top">
                                        <p><b>1.</b> It is recommended that you wash your wig one or twice every month according to wearing frequency. </p>
                                        <p><b>2.</b> Choose a slightly acidic shampoo, use hair conditioner and wash in mild water.</p>
                                        <p><b>3.</b> Make sure the water flows in the same direction during washing and avoid rubbing the wig heavily.</p>
                                        <p><b>4.</b> Do not comb or brush the wet wig. Style the wig when it is dry.</p>
                                        <p><b>5.</b> Using a wig brush on a wig is okay but, I suggest using a METAL WIDE TOOTH COMB and avoid using a plastic brush.
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </section>
        <script type="text/javascript" src="/themes/uniwigs2016/js/lightbox.js" defer></script>
        {*
            <div class="modal-scrollable">
                <div id="productmodal" style="display:none">
                    <div class="shopping-modal">
                        <a href="javascript:;" class="close"></a>
                        <div class="shopping-show-main fix">
                            <div class="modal-image">
                                <a href="" target="_blank"><img src="/40019-721-vnormal/ella-synthetic-lace-front-wig.jpg" width="300" height="350"></a>
                            </div>
                            <div class="modal-product-info">
                                <h2 class="product-name">Jorrie Deep Wave 20" Indian Remy Human Hair Silk Top Full Lace Wig</h2>
                                <p class="product-price">
                                    <strong class="new-price">Our Price :<span>$394.89</span></strong>
                                    <span class="old-price">Retail Price:<del>$658.15</del>
                                </p>
                                <div class="product-primary-actions mt10 mb10 fix">
                                    <a href="" class="f-btn btn-buy btn-small btn-primary" target="_blank">view details</a>
                                    <a href="" class="f-btn btn-add btn-small" target="_blank">add to wishlist</a>
                                </div>
                                <div class="product-description">
                                    <p>Top quality Indian remy human hair (Tangle Free + Long Lasting), full french lace 
                                    construction with 4"x4" silk top hidden knots in front, single knots around the perimeter, 
                                    double knots elsewhere, a long deep wave hair style.</p>
                                    <p>Hair Type: 100% Indian remy human hair<br>
                                        Hair Length: 20"<br>
                                        Color Shown: 1B-Off-Black<br>
                                        Hair Texture: Deep Wave<br>
                                        Cap Size: Average<br>
                                        Cap Construction: Full lace cap with 4"x4" Silk top in front
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="theme-popover-mask"></div>
            <script type="text/javascript" src="/modules/blockwishlist/js/ajax-wishlist.js"></script>
            {literal}
            <script type="text/javascript">jQuery(".category_banner").slide({ titCell:".min_img li", mainCell:".max_img",effect:"leftLoop",interTime:4000,autoPlay:true});</script>
            <script>
            function addtowishlist_tmp() {
                _self = $(this);
                WishlistCart('wishlist_block_list', 'add', _self.attr('product_id'), 0, 1);
                return false;
            }
            $(function($) {
                $('#productmodal .product-primary-actions .btn-add').click(addtowishlist_tmp);
                $('.quick-look').click(function(){
                    _self = $(this);
                    $('#productmodal .modal-image img').attr('src', _self.parent().parent().prev().prev().find('img').attr('src').replace('-category', '-vnormal'));
                    $('#productmodal .product-name').html(_self.attr('product_name'));
                    $('#productmodal .product-description').html(_self.attr('product_des'));
                    $('#productmodal .new-price span').html(_self.attr('product_ourprice'));
                    
                    $('#productmodal .modal-image a').attr('href', _self.parent().find('a').attr('href'));
                    $('#productmodal .product-primary-actions .btn-buy').attr('href', _self.parent().find('a').attr('href'));
                    $('#productmodal .product-primary-actions .btn-add').attr('pid', _self.attr('product_id'));

                    $('.theme-popover-mask').fadeIn(100);
                    $('.modal-scrollable').fadeIn(100);
                    $('#productmodal').slideDown(200);
                });
                $('#productmodal .close').click(function(){
                    $('.theme-popover-mask').fadeOut(100);
                    $('.modal-scrollable').fadeOut(100);
                    $('#productmodal').slideUp(200);
                });
            });
            </script>
            {/literal}
        *}
    {elseif $category->id == '103'}
        {literal}
        <style>
            .breadcrumb{display: none}
        </style>
        {/literal}
        <section class="containerIndex" itemscope itemtype="http://schema.org/SearchResultsPage">
            <section class="category-home">
                <ul class="row uk-margin-bottom">
                    <li class="col-md-6 col-sm-6">
                        <a href="{$base_dir}tag/soild">
                            <img src="{$img_dir}category/extensions/soild-color.jpg" alt="" class="img-responsive">
                        </a>
                    </li>
                    <li class="col-md-6 col-sm-6">
                        <a href="{$base_dir}tag/ombre">
                            <img src="{$img_dir}category/extensions/ombre-color.jpg" alt="" class="img-responsive">
                        </a>
                    </li>
                </ul>

                <div class="uk-margin-bottom">
                    <a href="{$base_dir}tag/colorful"><img src="{$img_dir}category/extensions/colorful-hair.jpg" alt="Colorful Hair" class="img-responsive"></a>
                </div>
                <ul class="row uk-margin-bottom">
                    <li class="col-md-6 col-sm-6">
                        <a href="{$base_dir}tag/diy-dyed-extensions">
                            <img src="{$img_dir}category/extensions/diy-dyed.jpg" alt="" class="img-responsive">
                        </a>
                        <h3 class="text-center">DIY-DYED</h3>
                        <p class="text-center h4">Just create your own color!</p>
                        <h5 class="text-center uk-margin-small-top h4 uk-text-bold"><a href="{$base_dir}tag/diy-dyed-extensions">shop now &gt;</a></h5>
                    </li>
                    <li class="col-md-6 col-sm-6">
                        <a href="{$base_dir}tag/invisible-uni-extensions">
                            <img src="{$img_dir}category/extensions/uni-extension.jpg" alt="" class="img-responsive">
                        </a>
                        <h3 class="text-center">UNI-EXTENSIONs</h3>
                        <p class="text-center h4">Change your hairstyle in 1 second!</p>
                        <h5 class="text-center uk-margin-small-top h4 uk-text-bold"><a href="{$base_dir}tag/invisible-uni-extensions">shop now &gt;</a></h5>
                    </li>
                </ul>
                <div class="uk-margin-bottom">
                    <a href="{$base_dir}tag/promotion-area"><img src="{$img_dir}category/extensions/promotion.png" alt="Colorful Hair" class="img-responsive"></a>
                </div>
                {if isset($HairExtensionsHotList)}
                    <div class="cagegory_topsale title-hr">
                        <h3>Hot List</h3>
                        <p class="hr"></p>
                        <ul class="cagegory_products_list row uk-margin-top">
                            {foreach $HairExtensionsHotList as $p}
                            <li>
                                <div class="product-container">
                                    <a href="{$category->name|replace:' ':'-'|lower}/{$p['id_product']}-{$p['link_rewrite']}.html" class="prodcut_a" title="{$p['name']}">
                                        <img src="/{$p['id_image']}-home_default/{$p['link_rewrite']}.jpg" alt="{$p['name']}" title="{$p['name']}" class="img-responsive"/>
                                    </a>
                                    <div class="text-center">
                                        <p class="name uk-margin-small-top">
                                            <a href="{$hs_prd.link}">
                                                {$p['name']|truncate:50:'...'|escape:'htmlall':'UTF-8'}
                                            </a>
                                        </p>
                                        <p class="product-list-price uk-margin-small-top">
                                            <span>
                                                ${$p['price']|string_format:"%.2f"}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            {/foreach}
                        </ul>
                    </div>
                {/if}
               
                <div class="sns_ins uk-margin-large-top text-center">
                    <div class="sns_ins_title">
                        <h3><a href="http://instagram.com/uniwigs" target="_blank">@UniWigs Trendy</a></h3>
                    </div>
                    <div id="custome-show" class="uk-margin-small-top">
                        {*<ul class="row">
                            <li class="col-md-3 col-sm-3">
                                <a href=""><img src="/40475-2127-vnormal/katerina-graham-curly-remy-human-hair-lace-wig.jpg" alt="" class="img-responsive"></a>
                            </li>
                            <li class="col-md-3 col-sm-3">
                                <a href=""><img src="/40475-2127-vnormal/katerina-graham-curly-remy-human-hair-lace-wig.jpg" alt="" class="img-responsive"></a>
                            </li>
                            <li class="col-md-3 col-sm-3">
                                <a href=""><img src="/40475-2127-vnormal/katerina-graham-curly-remy-human-hair-lace-wig.jpg" alt="" class="img-responsive"></a>
                            </li>
                            <li class="col-md-3 col-sm-3">
                                <a href=""><img src="/40475-2127-vnormal/katerina-graham-curly-remy-human-hair-lace-wig.jpg" alt="" class="img-responsive"></a>
                            </li>
                        </ul>*}
                    </div>
                    <div class="uk-margin-small-top">
                        <a href="http://www.uniwigs.com/customer-show?caid=103" class="uk-button uk-button-link">CUSTOMER SHOW ></a>
                    </div>
                    <script type="text/javascript">
                    {literal}
                    $(function(){
                        window.load_home_customer_shows = function(){
                            $.get("http://rvm.uniwigs.com/api_review3/home_customer_shows",{
                                pagesize:4,
                                catids:103
                            },function(data){
                                $("#custome-show").html(data);
                            });
                        }
                        load_home_customer_shows();
                    });
                    {/literal}
                    </script>
                </div>

                <div class="category_help uk-margin-large-top">
                    <ul class="row" data-uk-grid-match>
                        <li class="col-md-4">
                            <div class="category_faq">
                                <div class="ask">
                                    <span>How to apply the flips-in extension?</span>
                                </div>
                                <div class="answer text-info uk-margin-small-top">
                                    <p>please check the steps about installing the flip- in extension below :
                                        http://www.uniwigs.com/content/how-to-wear-remove-flip-in-hair-extensions
                                        And the Video below will be more helpful . If you still confuse about it , feel free to contact our customer service by sending email to support@uniwigs.com</p>
                                    <p><a href="https://www.youtube.com/embed/9crka1TBqQw" data-uk-lightbox data-lightbox-type="image">https://www.youtube.com/embed/9crka1TBqQw</a></p>
                                </div>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="category_faq">
                                <div class="ask">
                                    <span>Can the synthetic extensions be dyed?</span>
                                </div>
                                <div class="answer text-info uk-margin-small-top">
                                    <p>we are sorry that the synthetic product could not be dyed , we recommend you to try it on the human hair product .</p>
                                </div>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="category_faq">
                                <div class="ask">
                                    <span>Can i return the item if i don’t like it?</span>
                                </div>
                                <div class="answer text-info uk-margin-small-top">
                                    <p>Uniwigs could accept return except the custom product ans onsale product , check more detail in our return policy below :
                                        <a href="http://www.uniwigs.com/content/return-policy">http://www.uniwigs.com/content/return-policy</a></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
        </section>
        <script type="text/javascript" src="/themes/uniwigs2016/js/lightbox.js"></script>
    {elseif $category->id == '104'}
        {literal}
        <style>
            .breadcrumb{display: none}
        </style>
        {/literal}
        <section class="container containerIndex" itemscope itemtype="http://schema.org/SearchResultsPage">
            <section class="category-home">
                <div class="cargory_banner">
                    <a href="{$base_dir}tag/hair-loss"><img src="{$img_dir}category/hiar-pieces/hair-loss.jpg" alt="Hair Loss" class="img-responsive"></a>
                </div>
                <ul class="row uk-margin-top">
                    <li class="col-md-6 col-sm-6">
                        <h3 class="text-center">Monofilament</h3>
                        <p class="text-center">The ideal solution for Fine/Thinner hair</p>
                        <h5 class="text-center uk-margin-small-top"><a href="{$base_dir}40458-mono-hair-pieces">shop now ></a></h5>
                        <a href="{$base_dir}40458-mono-hair-pieces">
                            <img src="{$img_dir}category/hiar-pieces/Monofilament.jpg" alt="" class="img-responsive">
                        </a>
                    </li>
                    <li class="col-md-6 col-sm-6">
                        <a href="{$base_dir}tag/lace-closure">
                            <img src="{$img_dir}category/hiar-pieces/lace-closure.jpg" alt="" class="img-responsive">
                        </a>
                        <h3 class="text-center">lace closure</h3>
                        <p class="text-center">A great alternative to a wig</p>
                        <h5 class="text-center uk-margin-small-top"><a href="{$base_dir}tag/lace-closure">shop now ></a></h5>
                    </li>
                </ul>
                <div class="cargory_banner uk-margin-top">
                    <img src="{$img_dir}category/hiar-pieces/pieces-new.jpg" alt="" usemap="#map" class="img-responsive"/>
                    <map name="map">
                        <area shape="poly" coords="987, 2, 999, 308, 1168, 308, 1167, 2" href="{$base_dir}hair-pieces/41122-poppy-remy-human-hair-top-piece.html" onfocus="blur(this);"/>
                        <area shape="poly" coords="792, 2, 799, 307, 992, 308, 979, 1" href="{$base_dir}hair-pieces/41124-paris-remy-human-hair-top-piece.html" onfocus="blur(this);"/>
                        <area shape="poly" coords="612, 2, 611, 306, 792, 307, 787, 2" href="{$base_dir}hair-pieces/41121-pear-remy-human-hair-top-piece.html" onfocus="blur(this);"/>
                        <area shape="poly" coords="457, 3, 356, 307, 605, 306, 607, 3" href="{$base_dir}hair-pieces/41123-jodee-remy-human-hair-top-piece.html" onfocus="blur(this);"/>
                        <area shape="poly" coords="439, 3, 337, 307, 5, 307, 5, 3" href="{$base_dir}tag/mono-hair-pieces" onfocus="blur(this);"/>
                    </map>
                </div>

                {if isset($HairPiecesHotList)}
                    <div class="cagegory_topsale title-hr">
                        <h3>Hot List</h3>
                        <p class="hr"></p>
                        <ul class="cagegory_products_list row uk-margin-top">
                            {foreach $HairPiecesHotList as $p}
                            <li>
                                <div class="product-container">
                                    <a href="{$category->name|replace:' ':'-'|lower}/{$p['id_product']}-{$p['link_rewrite']}.html" class="prodcut_a" title="{$p['name']}">
                                        <img src="/{$p['id_image']}-home_default/{$p['link_rewrite']}.jpg" alt="{$p['name']}" title="{$p['name']}" class="img-responsive"/>
                                    </a>
                                    <div class="text-center">
                                        <p class="name uk-margin-small-top">
                                            <a href="{$hs_prd.link}">
                                                {$p['name']|truncate:50:'...'|escape:'htmlall':'UTF-8'}
                                            </a>
                                        </p>
                                        <p class="product-list-price uk-margin-small-top">
                                            <span>
                                                ${$p['price']|string_format:"%.2f"}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            {/foreach}
                        </ul>
                    </div>
                {/if}

                <div class="category_help uk-margin-large-top">
                    <ul class="row" data-uk-grid-match>
                        <li class="col-md-4">
                            <div class="category_faq">
                                <div class="ask">
                                    <span>What is the difference between free part and middle part?</span>
                                </div>
                                <div class="answer text-info uk-margin-small-top">
                                    <p>Free part means there is no parting line on the hair pieces, so you can part it freely.</p>
                                </div>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="category_faq">
                                <div class="ask">
                                    <span>Can i custom the color?</span>
                                </div>
                                <div class="answer text-info uk-margin-small-top">
                                    <p>Yes, Uniwigs has custom service .Please send your custom request to <a href="mailto:support@uniwigs">support@uniwigs</a>. Com and they will offer you more advises.</p>
                                </div>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="category_faq">
                                <div class="ask">
                                    <span>Can i use clips on the lace closure?</span>
                                </div>
                                <div class="answer text-info uk-margin-small-top">
                                    <p>Yes, there are many ways to apply the lace closure, and using clip is one of them. please contact customer service if you need extra clips with your order.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
        </section>
    {else}
        {if $category->id AND $category->active}
        	{if $scenes || $category->description || $category->id_image}
        		<div class="content_scene_cat">
                	 {if $scenes}
                     	<div class="content_scene">
                            <!-- Scenes -->
                            {include file="$tpl_dir./scenes.tpl" scenes=$scenes}
                            {if $category->description}
                                <div class="cat_desc rte">
                                {if Tools::strlen($category->description) > 350}
                                    <div id="category_description_short">{$description_short}</div>
                                    <div id="category_description_full" class="unvisible">{$category->description}</div>
                                    <a href="{$link->getCategoryLink($category->id_category, $category->link_rewrite)|escape:'html':'UTF-8'}" class="lnk_more">{l s='More'}</a>
                                {else}
                                    <div>{$category->description}</div>
                                {/if}
                                </div>
                            {/if}
                        </div>
        			{else}
                        <!-- Category image -->
                        {if $category->id == '108' or $category->id == '40439' or $category->id == '112' or $category->id == '110' or $category->id == '111' or $category->id == '116' or $category->id == '105'}
                        {else}
                        <div class="uk-margin-small-bottom">
                            <img src="{$link->getCatImageLink($category->link_rewrite, $category->id_image, 'category_default')|escape:'html':'UTF-8'}" alt="{$category->name}">
                        </div>
                        {/if}
                        <div class="content_scene_cat_bg">
                            {if $category->description}
                                <div class="cat_desc">
                                <span class="category-name">
                                    {strip}
                                        {$category->name|escape:'html':'UTF-8'}
                                        {if isset($categoryNameComplement)}
                                            {$categoryNameComplement|escape:'html':'UTF-8'}
                                        {/if}
                                    {/strip}
                                </span>
                                {if Tools::strlen($category->description) > 350}
                                    <div id="category_description_short" class="rte">{$description_short}</div>
                                    <div id="category_description_full" class="unvisible rte">{$category->description}</div>
                                    <a href="{$link->getCategoryLink($category->id_category, $category->link_rewrite)|escape:'html':'UTF-8'}" class="lnk_more">{l s='More'}</a>
                                {else}
                                    <div class="rte">{$category->description}</div>
                                {/if}
                                </div>
                            {/if}
                         </div>
                      {/if}
                </div>
        	{/if}
        {*
        	<h1 class="page-heading{if (isset($subcategories) && !$products) || (isset($subcategories) && $products) || !isset($subcategories) && $products} product-listing{/if}"><span class="cat-name">{$category->name|escape:'html':'UTF-8'}{if isset($categoryNameComplement)}&nbsp;{$categoryNameComplement|escape:'html':'UTF-8'}{/if}</span>{include file="$tpl_dir./category-count.tpl"}</h1>
        	
            {if isset($subcategories)}
            {if (isset($display_subcategories) && $display_subcategories eq 1) || !isset($display_subcategories) }
        	<!-- Subcategories -->
        	<div id="subcategories">
        		<p class="subcategory-heading">{l s='Subcategories'}</p>
        		<ul class="clearfix">
        		{foreach from=$subcategories item=subcategory}
        			<li>
                    	<div class="subcategory-image">
        					<a href="{$link->getCategoryLink($subcategory.id_category, $subcategory.link_rewrite)|escape:'html':'UTF-8'}" title="{$subcategory.name|escape:'html':'UTF-8'}" class="img">
        					{if $subcategory.id_image}
        						<img class="replace-2x" src="{$link->getCatImageLink($subcategory.link_rewrite, $subcategory.id_image, 'medium_default')|escape:'html':'UTF-8'}" alt="{$subcategory.name|escape:'html':'UTF-8'}" width="{$mediumSize.width}" height="{$mediumSize.height}" />
        					{else}
        						<img class="replace-2x" src="{$img_cat_dir}{$lang_iso}-default-medium_default.jpg" alt="{$subcategory.name|escape:'html':'UTF-8'}" width="{$mediumSize.width}" height="{$mediumSize.height}" />
        					{/if}
        				</a>
                       	</div>
        				<h5><a class="subcategory-name" href="{$link->getCategoryLink($subcategory.id_category, $subcategory.link_rewrite)|escape:'html':'UTF-8'}">{$subcategory.name|truncate:25:'...'|escape:'html':'UTF-8'}</a></h5>
        				{if $subcategory.description}
        					<div class="cat_desc">{$subcategory.description}</div>
        				{/if}
        			</li>
        		{/foreach}
        		</ul>
        	</div>
            {/if}
        	{/if}
        *}
        	{if $products}
        		<div class="content_sortPagiBar clearfix">
                	<div class="sortPagiBar clearfix">
                        {include file="./nbr-product-page.tpl"}
                		{include file="./product-sort.tpl"}
        			</div>
                    <div class="top-pagination-content clearfix">
        				{include file="$tpl_dir./pagination.tpl"}
                    </div>
        		</div>
        		{include file="./product-list.tpl" products=$products}
        		<div class="content_sortPagiBar">
        			<div class="bottom-pagination-content clearfix">
                        {include file="./pagination.tpl" paginationId='bottom'}
        			</div>
        		</div>
        	{/if}
        {elseif $category->id}
        	<p class="alert alert-warning">{l s='This category is currently unavailable.'}</p>
        {/if}
    {/if}
{/if}
