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
        </style>
        {/literal}
        <script type="text/javascript" src="/themes/uniwigs2016/js/lightbox.js"></script>
        <section class="containerIndex">
            <section class="category-home">
                {*<div class="uk-margin-top">
                    <a href="https://www.youtube.com/watch?v=mQCrHg-fkwA" data-uk-lightbox>
                        <img src="{$img_dir}category/human-hair/new-banner.jpg" alt="make obvious part" class="img-responsive">
                    </a>
                </div>*}
                <div class="uk-margin-top">
                    <a href="{$base_dir}40453-celebrity-hairstyles"><img src="{$img_dir}category/human-hair/celebrity-wigs.jpg" alt="celebrity wigs" class="img-responsive"></a>
                </div>
                <ul class="row uk-margin-top">
                    <li class="col-md-6 col-sm-6">
                        <a href="{$base_dir}tag/luxury-human-hair">
                            <img src="{$img_dir}category/human-hair/Classic-Lace-Wigs.jpg" alt="Classic Lace Wigs" class="img-responsive">
                            <img src="{$img_dir}category/human-hair/Classic-Lace-Wigs-text.png" alt="Classic Lace Wigs" class="img-responsive">
                        </a>
                    </li>
                    <li class="col-md-6 col-sm-6">
                        <a href="{$base_dir}tag/luxury-human-hair">
                            <img src="{$img_dir}category/human-hair/custom-wigs.jpg" alt="custom wigs" class="img-responsive">
                            <img src="{$img_dir}category/human-hair/custom-wigs-text.png" alt="custom wigs" class="img-responsive">
                        </a>
                    </li>
                </ul>
                
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
                                        <a href="{$category->name|replace:' ':'-'|lower}/{$p['id_product']}-{$p['link_rewrite']}.html">
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
                                            <a href="{$category->name|replace:' ':'-'|lower}/{$p['id_product']}-{$p['link_rewrite']}.html">
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

                <div class="category_help uk-margin-large-top title-hr">
                    <h3>how to videos</h3>
                    <p class="hr"></p>
                    <ul class="row uk-margin-top" data-uk-grid-match>
                        <li class="col-md-4">
                            <a href="https://www.youtube.com/embed/ax1hwdtnJIg" data-uk-lightbox><img src="{$img_dir}category/human-hair/how-to-video-1.jpg" alt="how to video"></a>
                        </li>
                        <li class="col-md-4">
                            <a href="https://www.youtube.com/watch?v=mQCrHg-fkwA" data-uk-lightbox><img src="{$img_dir}category/human-hair/how-to-video-2.jpg" alt="how to video"></a>
                        </li>
                        <li class="col-md-4">
                             <a href="https://www.youtube.com/embed/bhkFakj7VW4" data-uk-lightbox><img src="{$img_dir}category/human-hair/how-to-video-3.jpg" alt="how to video"></a>
                        </li>
                    </ul>
                    <div class="uk-margin-top text-center"><a href="http://www.uniwigs.com/content/9-how-to-videos" class="uk-button">view more ></a></div>
                </div>
            </section>
        </section>
        <script type="text/javascript" src="/themes/uniwigs2016/js/lightbox.js" defer></script>
    {elseif $category->id == '101'}
        {literal}
        <style>
            .breadcrumb{display: none}

        </style>
        {/literal}

        {*<script type="text/javascript" src="{$js_dir}like.js"></script>*}
            <section class="category-home">
                <div class="uk-margin-large-bottom">
                    <a class="img-responsive" href="{$base_dir}40459-trendy-wigs"><img src="{$img_dir}category/synthetic-wigs/trendy_wigs_new.jpg" alt="synthetic trendy wigs"></a>
                </div>
                <div class="uk-margin-large-bottom">
                    <a class="img-responsive" href="{$base_dir}40455-classic-wigs"><img src="{$img_dir}category/synthetic-wigs/classic_wigs_new.jpg" alt="synthetic classic wigs"></a>
                </div>
                <div class="uk-margin-large-bottom">
                    <a href="{$base_dir}tag/silver-galaxy-trend-wig" class="img-responsive"><img src="{$img_dir}category/synthetic-wigs/silver_galaxy_new.jpg" alt="silver galaxy"></a>
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
                                             <a href="{$category->name|replace:' ':'-'|lower}/{$p['id_product']}-{$p['link_rewrite']}.html">
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
                                                 <a href="{$category->name|replace:' ':'-'|lower}/{$p['id_product']}-{$p['link_rewrite']}.html">
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
                    
                    <div class="synthetic-video title-hr">
                        <h3>Trendy Look</h3>
                        <p class="hr"></p>
                        <div class="row uk-margin-top">
                            <div class="col-sm-4 text-center">
                                <a href="https://www.youtube.com/watch?v=Kh2LUFdImjo" class="category-video" data-uk-lightbox>
                                    <p><img src="{$img_dir}category/synthetic-wigs/video-1.jpg" alt="CABELO PLATINADO LAVANDER HAIR | SILVER HAIR | FRONT LACE UNIWIGS" class="img-responsive"></p>
                                    <p class="h5">CABELO PLATINADO LAVANDER HAIR | SILVER HAIR</p>
                                    <p class="text-info"><i>Video by WappaModa</i></p>
                                </a>
                            </div>
                            <div class="col-sm-4 text-center">
                                <a href="https://www.youtube.com/watch?v=8ZNsEo0p-VY" class="category-video" data-uk-lightbox>
                                    <p><img src="{$img_dir}category/synthetic-wigs/video-2.jpg" alt="IM BAAAAAAAACK (with UniWigs Tonya Wig)" class="img-responsive"></p>
                                    <p class="h5">IM BAAAAAAAACK (with UniWigs Tonya Wig)</p>
                                    <p class="text-info"><i>Video by Eleanor Barnes</i></p>
                                </a>
                            </div>
                            <div class="col-sm-4 text-center">
                                <a href="https://www.youtube.com/watch?v=t1s5xbcBvGc" class="category-video" data-uk-lightbox>
                                    <p><img src="{$img_dir}category/synthetic-wigs/video-3.jpg" alt="Lace Front Wig Haul" class="img-responsive"></p>
                                    <p class="h5">Lace Front Wig Haul</p>
                                    <p class="text-info"><i>Video by ChoNunMigookSaram</i></p>
                                </a>
                            </div>
                        </div>
                    </div>

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
                        <a href="{$base_dir}tag/Solid-hair-extension">
                            <img src="{$img_dir}category/extensions/soild-color.jpg" alt="soild color hair extension" class="img-responsive">
                        </a>
                    </li>
                    <li class="col-md-6 col-sm-6">
                        <a href="{$base_dir}tag/ombre-hair-extension">
                            <img src="{$img_dir}category/extensions/ombre-color.jpg" alt="ombre color hair extension" class="img-responsive">
                        </a>
                    </li>
                </ul>

                <div class="uk-margin-bottom">
                    <a href="{$base_dir}tag/colorful-hair-extension"><img src="{$img_dir}category/extensions/colorful-hair.jpg" alt="Colorful Hair" class="img-responsive"></a>
                </div>
                <ul class="row uk-margin-bottom">
                    <li class="col-md-6 col-sm-6">
                        <a href="{$base_dir}tag/diy-dyed-extensions">
                            <img src="{$img_dir}category/extensions/diy-dyed.jpg" alt="diy dyed extension" class="img-responsive">
                        </a>
                        <h3 class="text-center">DIY-DYED</h3>
                        <p class="text-center h4">Just create your own color!</p>
                        <h5 class="text-center uk-margin-small-top h4 uk-text-bold"><a href="{$base_dir}tag/diy-dyed-extensions">shop now &gt;</a></h5>
                    </li>
                    <li class="col-md-6 col-sm-6">
                        <a href="{$base_dir}tag/invisible-uni-extensions">
                            <img src="{$img_dir}category/extensions/uni-extension.jpg" alt="uni extension" class="img-responsive">
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
                                            <a href="{$category->name|replace:' ':'-'|lower}/{$p['id_product']}-{$p['link_rewrite']}.html">
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
                <div class="cargory_banner uk-margin-top">
                    <a href="{$base_dir}tag/toppers"><img src="{$img_dir}category/hiar-pieces/pieces-banner.jpg" alt="Hair Loss" class="img-responsive"></a>
                </div>
                <ul class="row uk-margin-top">
                    <li class="col-md-6 col-sm-6">
                        <h3 class="text-center">Monofilament</h3>
                        <p class="text-center">The ideal solution for Fine/Thinner hair</p>
                        <h5 class="text-center uk-margin-small-top"><a href="{$base_dir}40458-mono-hair-pieces">shop now ></a></h5>
                        <a href="{$base_dir}40458-mono-hair-pieces">
                            <img src="{$img_dir}category/hiar-pieces/Monofilament.jpg" alt="Monofilament" class="img-responsive">
                        </a>
                    </li>
                    <li class="col-md-6 col-sm-6">
                        <a href="{$base_dir}tag/lace-closure">
                            <img src="{$img_dir}category/hiar-pieces/lace-closure.jpg" alt="lace closure" class="img-responsive">
                        </a>
                        <h3 class="text-center">lace closure</h3>
                        <p class="text-center">A great alternative to a wig</p>
                        <h5 class="text-center uk-margin-small-top"><a href="{$base_dir}tag/lace-closure">shop now ></a></h5>
                    </li>
                </ul>
                <div class="cargory_banner uk-margin-top">
                    <img src="{$img_dir}category/hiar-pieces/pieces-new.jpg" alt="pieces new product" usemap="#map" class="img-responsive"/>
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
                                            <a href="{$category->name|replace:' ':'-'|lower}/{$p['id_product']}-{$p['link_rewrite']}.html">
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
                        {if $category->id == '108' or $category->id == '40439' or $category->id == '112' or $category->id == '110' or $category->id == '111' or $category->id == '116' or $category->id == '105' or $category->id == '40442'}
                        <script type="text/javascript" src="/themes/uniwigs2016/js/lightbox.js"></script>
                        {elseif $category->id == '40453'}
                            <div class="uk-margin-small-bottom">
                                <img src="/themes/uniwigs2016/img/category/human-hair/celebrity-wigs-banner.jpg" alt="" class="img-responsive">
                            </div>
                        {elseif $category->id == '40456'}
                            <div class="uk-margin-small-bottom">
                                <img src="/themes/uniwigs2016/img/category/synthetic-wigs/clearance-banner.png" alt="" class="img-responsive"/>
                            </div>
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
        {if $category->id == '40452'}
            {if $products}
            <div>
                <img src="{$img_dir}category/human-hair/lace-wigs.jpg" alt="classic lace wigs">
            </div>
            <ul class="category-tab uk-margin-large-top uk-margin-bottom row" data-uk-tab="{literal}{connect:'#classic-lace-wigs'}{/literal}">
                <li class="col-sm-3"><a href="javascript:;">Lace Front Cap</a></li>
                <li class="col-sm-3"><a href="javascript:;">Glueless Full Lace Cap</a></li>
                <li class="col-sm-3"><a href="javascript:;">Full Lace Cap</a></li>
                <li class="col-sm-3"><a href="javascript:;">Silk Top Lace Cap</a></li>
            </ul>
            <ul id="classic-lace-wigs" class="uk-switcher">
                <li>
                    {include file="./product-list.tpl" products=$products1}
                </li>
                 <li>
                    {include file="./product-list.tpl" products=$products2}
                </li>
                 <li>
                    {include file="./product-list.tpl" products=$products3}
                </li>
                 <li>
                    {include file="./product-list.tpl" products=$products4}
                </li>
            </ul>
            {/if}
        {else}
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
        {/if}
        {elseif $category->id}
        	<p class="alert alert-warning">{l s='This category is currently unavailable.'}</p>
        {/if}
    {/if}
{/if}
