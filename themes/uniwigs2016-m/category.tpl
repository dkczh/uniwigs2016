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
	{if $category->id AND $category->active}
    {*
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
                    <div class="content_scene_cat_bg"{if $category->id_image} style="background:url({$link->getCatImageLink($category->link_rewrite, $category->id_image, 'category_default')|escape:'html':'UTF-8'}) right center no-repeat; background-size:cover; min-height:{$categorySize.height}px;"{/if}>
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
        {if $category->id == '102'}
            <div>
               <img src="{$img_dir}category/human-hair/Halloween-Sale.png" alt="Human Hair Halloween Sale" class="img-responsive">
                <a href="{$base_dir}40453-celebrity-hairstyles">
                    <img src="{$img_dir}category/human-hair/celebrity2016.jpg" alt="human hair celebrity hairstyles" class="img-responsive">
                </a>
                <a href="{$base_dir}40452-human-hair-lace-wigs">
                    <img src="{$img_dir}category/human-hair/lacewigs2016.jpg" alt="human hair lace wigs" class="img-responsive">
                </a>
                <a href="{$base_dir}custom-order">
                    <img src="{$img_dir}category/human-hair/customwigs2016.jpg" alt="human hair wigs customization" class="img-responsive">
                </a>
            </div>         
        {/if}
        {if $category->id == '101'}
            <ul class="category_banner row">
                <li class="maxwidth">
                    <a href="{$base_dir}40459-trendy-wigs">
                        <img src="{$img_dir}category/synthetic/trendy.jpg" alt="trendy wigs" class="img-responsive">
                    </a>
                </li>
                <li>
                    <a href="{$base_dir}40455-classic-wigs">
                        <img src="{$img_dir}category/synthetic/classic.jpg" alt="classic wigs" class="img-responsive">
                    </a>
                </li>
                <li>
                    <a href="{$base_dir}40456-clearance-wigs">
                        <img src="{$img_dir}category/synthetic/clearance.jpg" alt="clearance" class="img-responsive">
                    </a>
                </li>
            </ul>
        {/if}
        {if $category->id == '103'}
            <ul class="category_banner row">
                <li class="maxwidth">
                    <a href="{$base_dir}tag/solid-hair-extension">
                        <img src="{$img_dir}category/extensions/soild-color.jpg" alt="soild color hair extension" class="img-responsive">
                    </a>
                </li>
                <li class="maxwidth">
                    <a href="{$base_dir}tag/ombre-hair-extension">
                        <img src="{$img_dir}category/extensions/ombre.jpg" alt="ombre color hair extension" class="img-responsive">
                    </a>
                </li>
                <li class="maxwidth">
                    <a href="{$base_dir}tag/diy-dyed-extensions">
                        <img src="{$img_dir}category/extensions/diy.jpg" alt="diy dyed extension" class="img-responsive">
                    </a>
                </li>
            </ul>
        {/if}
        {if $category->id == '104'}
            <ul class="category_banner row">
                <li class="maxwidth">
                    <a href="{$base_dir}tag/fashion-piece">
                        <img src="{$img_dir}category/hair-pieces/fashion-piece.jpg" alt="fashion piece" class="img-responsive">
                    </a>
                </li>
                <li>
                    <a href="{$base_dir}tag/lace-closure">
                        <img src="{$img_dir}category/hair-pieces/lace-closure.jpg" alt="lace closure" class="img-responsive">
                    </a>
                </li>
                <li>
                    <a href="{$base_dir}40458-mono-hair-pieces">
                        <img src="{$img_dir}category/hair-pieces/monofilament.jpg" alt="monofilament" class="img-responsive">
                    </a>
                </li>
            </ul>
        {/if}
        {if $category->id == '40453' or $category->id == '40447' or $category->id == '40446' or $category->id == '40448' or $category->id == '40450' or $category->id == '40452'}
             <div class="uk-margin-small-bottom">
                <img src="{$img_dir}category/human-hair/Halloween-Sale.png" alt="Human Hair Halloween Sale" class="img-responsive">
             </div>
        {/if}
        {if $category->id == '40459'}
             {*<div class="uk-margin-small-bottom">
                <img src="/themes/uniwigs2016-m/img/category/synthetic/summer-sale.png" alt="" class="img-responsive">
             </div>*}
        {/if}
        {if $category->id == '40455'}
             {*<div class="uk-margin-small-bottom">
                <img src="/themes/uniwigs2016-m/img/category/synthetic/classic-sale.png" alt="" class="img-responsive">
             </div>*}
        {/if}
		{if $products}
			<div class="content_sortPagiBar clearfix">
            	<div class="sortPagiBar clearfix">
            		{include file="./product-sort.tpl"}
				</div>
			</div>
			{include file="./product-list.tpl" products=$products}
		{/if}
        {if $category->id == '102' or $category->id == '40446' or $category->id == '40447'}
            <section id="customer_shows_container" class="title-hr"></section>
            <script type="text/javascript">
                {literal}
                $(function(){
                    window.load_customer_shows_container = function(){
                       $.get("http://rvm.uniwigs.com/api_review3/home_comments",{
                        pagesize:1,
                        catids:102
                       },function(data){
                        $("#customer_shows_container").html(data);
                        after_load_home_customer_shows();
                       });
                    }
                    load_customer_shows_container();
                });
                {/literal}
            </script>
        {/if}
        {if $category->id == '101' or $category->id == '40459'}
            <section id="customer_shows_container" class="title-hr"></section>
            <script type="text/javascript">
                {literal}
                $(function(){
                    window.load_customer_shows_container = function(){
                       $.get("http://rvm.uniwigs.com/api_review3/home_comments",{
                        pagesize:1,
                        catids:101
                       },function(data){
                        $("#customer_shows_container").html(data);
                        after_load_home_customer_shows();
                       });
                    }
                    load_customer_shows_container();
                });
                {/literal}
            </script>
        {/if}
        {if $category->id == '103'}
            <section id="customer_shows_container" class="title-hr"></section>
            <script type="text/javascript">
                {literal}
                $(function(){
                    window.load_customer_shows_container = function(){
                       $.get("http://rvm.uniwigs.com/api_review3/home_comments",{
                        pagesize:1,
                        catids:103
                       },function(data){
                        $("#customer_shows_container").html(data);
                        after_load_home_customer_shows();
                       });
                    }
                    load_customer_shows_container();
                });
                {/literal}
            </script>
        {/if}
	{elseif $category->id}
		<p class="alert alert-warning">{l s='This category is currently unavailable.'}</p>
	{/if}
{/if}
