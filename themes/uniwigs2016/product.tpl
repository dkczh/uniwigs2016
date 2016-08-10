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
{if $errors|@count == 0}
	{if !isset($priceDisplayPrecision)}
		{assign var='priceDisplayPrecision' value=2}
	{/if}
	{if !$priceDisplay || $priceDisplay == 2}
		{assign var='productPrice' value=$product->getPrice(true, $smarty.const.NULL, 6)}
		{assign var='productPriceWithoutReduction' value=$product->getPriceWithoutReduct(false, $smarty.const.NULL)}
	{elseif $priceDisplay == 1}
		{assign var='productPrice' value=$product->getPrice(false, $smarty.const.NULL, 6)}
		{assign var='productPriceWithoutReduction' value=$product->getPriceWithoutReduct(true, $smarty.const.NULL)}
	{/if}
<div itemscope itemtype="https://schema.org/Product">
	<meta itemprop="url" content="{$link->getProductLink($product)}">
	<div class="primary_block row">
		{if isset($adminActionDisplay) && $adminActionDisplay}
			<div id="admin-action" class="container">
				<p class="alert alert-info">{l s='This product is not visible to your customers.'}
					<input type="hidden" id="admin-action-product-id" value="{$product->id}" />
					<a id="publish_button" class="btn btn-default button button-small" href="#">
						<span>{l s='Publish'}</span>
					</a>
					<a id="lnk_view" class="btn btn-default button button-small" href="#">
						<span>{l s='Back'}</span>
					</a>
				</p>
				<p id="admin-action-result"></p>
			</div>
		{/if}
		{if isset($confirmation) && $confirmation}
			<p class="confirmation">
				{$confirmation}
			</p>
		{/if}
		<!-- left infos-->
		<div class="pb-left-column col-xs-12 col-sm-6 col-md-6">
			<!-- product img-->
			<div id="image-block" class="clearfix">
				{if $product->new}
					<span class="new-box">
						<span class="new-label">{l s='New'}</span>
					</span>
				{/if}
				{if $product->on_sale}
					<span class="sale-box no-print">
						<span class="sale-label">{l s='Sale!'}</span>
					</span>
				{elseif $product->specificPrice && $product->specificPrice.reduction && $productPriceWithoutReduction > $productPrice}
					<span class="discount">{l s='Reduced price!'}</span>
				{/if}
				{if $have_image}
					<span id="view_full_size">
						{if $jqZoomEnabled && $have_image && !$content_only}
							<a class="jqzoom" title="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" rel="gal1" href="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'thickbox_default')|escape:'html':'UTF-8'}">
								<img itemprop="image" src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'large_default')|escape:'html':'UTF-8'}" title="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" alt="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" width="500" height="583"/>
							</a>
						{else}
							<img id="bigpic" itemprop="image" src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'large_default')|escape:'html':'UTF-8'}" title="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" alt="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" width="500" height="583"/>
							{if !$content_only}
								<span id="view_product_larger" class="span_link no-print">{l s='View larger'}</span>
							{/if}
						{/if}
					</span>
				{else}
					<span id="view_full_size">
						<img itemprop="image" src="{$img_prod_dir}{$lang_iso}-default-large_default.jpg" id="bigpic" alt="" title="{$product->name|escape:'html':'UTF-8'}" width="{$largeSize.width}" height="{$largeSize.height}"/>
						{if !$content_only}
							<span class="span_link">
								{l s='View larger'}
							</span>
						{/if}
					</span>
				{/if}
			</div> <!-- end image-block -->
			{if isset($images) && count($images) > 0}
				<!-- thumbnails -->
				<div id="views_block" class="clearfix {if isset($images) && count($images) < 2}hidden{/if}">
					<div id="thumbs_list">
						<ul id="thumbs_list_frame">
						{if isset($images)}
							{foreach from=$images item=image name=thumbnails}
								{assign var=imageIds value="`$product->id`-`$image.id_image`"}
								{if !empty($image.legend)}
									{assign var=imageTitle value=$image.legend|escape:'html':'UTF-8'}
								{else}
									{assign var=imageTitle value=$product->name|escape:'html':'UTF-8'}
								{/if}
								<li id="thumbnail_{$image.id_image}"{if $smarty.foreach.thumbnails.last} class="last"{/if}>
									<a{if $jqZoomEnabled && $have_image && !$content_only} href="javascript:void(0);" rel="{literal}{{/literal}gallery: 'gal1', smallimage: '{$link->getImageLink($product->link_rewrite, $imageIds, 'large_default')|escape:'html':'UTF-8'}',largeimage: '{$link->getImageLink($product->link_rewrite, $imageIds, 'thickbox_default')|escape:'html':'UTF-8'}'{literal}}{/literal}"{else} href="{$link->getImageLink($product->link_rewrite, $imageIds, 'thickbox_default')|escape:'html':'UTF-8'}"	data-fancybox-group="other-views" class="fancybox{if $image.id_image == $cover.id_image} shown{/if}"{/if} title="{$imageTitle}">
										<img class="img-responsive" id="thumb_{$image.id_image}" src="{$link->getImageLink($product->link_rewrite, $imageIds, 'cart_default')|escape:'html':'UTF-8'}" alt="{$imageTitle}" title="{$imageTitle}"{if isset($cartSize)} height="{$cartSize.height}" width="{$cartSize.width}"{/if} itemprop="image" />
									</a>
								</li>
							{/foreach}
							{if isset($productAddition['video']) && $productAddition['video']}
							
							<li class="video">
								<a href="{$productAddition['video']}" class="items_video highslide popupvideoa" target="_blank" data-uk-lightbox data-lightbox-type="image"></a>
							</li>
							
							{/if}
						{/if}
						</ul>
					</div> <!-- end thumbs_list -->
				</div> <!-- end views-block -->
				<!-- end thumbnails -->
			{/if}
			
			{if !$content_only}
				<!-- usefull links-->
				<ul id="usefull_link_block" class="clearfix no-print uk-margin-top">
					{if $HOOK_EXTRA_LEFT}{$HOOK_EXTRA_LEFT}{/if}
					<li class="print">
						<a href="javascript:print();">
							{l s='Print'}
						</a>
					</li>
				</ul>
			{/if}
			{if isset($images) && count($images) > 1}
				<p class="resetimg clear no-print">
					<span id="wrapResetImages" style="display: none;">
						<a href="{$link->getProductLink($product)|escape:'html':'UTF-8'}" data-id="resetImages">
							<i class="icon-repeat"></i>
							{l s='Display all pictures'}
						</a>
					</span>
				</p>
			{/if}
		</div> <!-- end pb-left-column -->
		<!-- end left infos-->
		<!-- center infos -->
		<div class="pb-center-column col-xs-12 col-sm-6">
			{if $product->online_only}
				<p class="online_only">{l s='Online only'}</p>
			{/if}
			<h1 itemprop="name">{$product->name|escape:'html':'UTF-8'}</h1>

			{*<p class="sale"><em>To register to get $40 off! Code:UW40 <span>( AVL for order over $300 )</span></em></p>*}
			
			{*<p id="product_reference"{if empty($product->reference) || !$product->reference} style="display: none;"{/if}>
				<label>{l s='SKU:'} </label>
				<span class="editable" itemprop="sku"{if !empty($product->reference) && $product->reference} content="{$product->reference}"{/if}>{if !isset($groups)}{$product->reference|escape:'html':'UTF-8'}{/if}</span>
			</p>*}

			<ul class="product-sku" {if empty($product->reference) || !$product->reference} style="display: none;"{/if}>
				
			<!-- 	<li id="product_reference" class="sku" itemprop="sku" {if !empty($product->reference) && $product->reference} content="{$product->reference}"{/if}>
				 -->
				<li id="product_reference_a" class="sku" itemprop="sku" {if !empty($product->reference) && $product->reference} content="{$product->reference}"{/if}>
					
					<label>{l s='SKU:'} </label>
				<!-- 	<span>{if !isset($groups)}{$product->reference|escape:'html':'UTF-8'}{/if}</span> -->
					<span>{$product->reference|escape:'html':'UTF-8'}</span>
					
				</li>
				<li class="price-star fll mr20 hide">
					<a href="javascript:void(0);"  class="product-rating-link">
						<span class="star" style="width:0%"></span>
					</a>
					<a href="#product_reviews" data-uk-smooth-scroll>
						<span id="review_count">0</span> reviews
					</a>
				</li>
				{*
				{if isset($like_count)}
				<li class="product_like">
					<div id="like_count_area" class="like_count_area {if $like_count<=0}hide{/if}">
						<span id="like_count" class="like-number">{$like_count}</span> {if $like_count>1}loves{else}love{/if}
					</div>
				</li>
				{/if}
				<li class="product_like">
					<div id="like_count_area" class="like_count_area">
						<span id="like_count" class="like-number">0</span> loves
					</div>
				</li>
				*}
			</ul>

			{if isset($HOOK_EXTRA_RIGHT) && $HOOK_EXTRA_RIGHT}{$HOOK_EXTRA_RIGHT}{/if}

			<div class="content_prices clearfix">
				{if $product->show_price && !isset($restricted_country_mode) && !$PS_CATALOG_MODE}
					<!-- prices -->
					<div>
						<p class="our_price_display" itemprop="offers" itemscope itemtype="https://schema.org/Offer">{strip}
							{if $product->quantity > 0}<link itemprop="availability" href="https://schema.org/InStock"/>{/if}
							<label>{l s='Our Price:'} </label>
							{if $priceDisplay >= 0 && $priceDisplay <= 2}
								<span id="our_price_display" class="now_sprice" itemprop="price" content="{$productPrice}">{convertPrice price=$productPrice|floatval}</span>
								{if $tax_enabled  && ((isset($display_tax_label) && $display_tax_label == 1) || !isset($display_tax_label))}
									{if $priceDisplay == 1} {l s='tax excl.'}{else} {l s='tax incl.'}{/if}
								{/if}
								<meta itemprop="priceCurrency" content="{$currency->iso_code}" />
								{hook h="displayProductPriceBlock" product=$product type="price"}
							{/if}
							<span id="old_price"{if (!$product->specificPrice || !$product->specificPrice.reduction)} class="hidden"{/if}>{strip}
								{if $priceDisplay >= 0 && $priceDisplay <= 2}
									{hook h="displayProductPriceBlock" product=$product type="old_price"}
									<span id="old_price_display">Retail Price: <span class="price">{if $productPriceWithoutReduction > $productPrice}{convertPrice price=$productPriceWithoutReduction|floatval}{/if}</span></span>
								{/if}
							{/strip}</span>
						{/strip}</p>
						<p id="reduction_percent" {if $productPriceWithoutReduction <= 0 || !$product->specificPrice || $product->specificPrice.reduction_type != 'percentage'} style="display:none;"{/if}>{strip}
							<span id="reduction_percent_display">
								{if $product->specificPrice && $product->specificPrice.reduction_type == 'percentage'}-{$product->specificPrice.reduction*100}%{/if}
							</span>
						{/strip}</p>
						{*<p id="reduction_amount" {if $productPriceWithoutReduction <= 0 || !$product->specificPrice || $product->specificPrice.reduction_type != 'amount' || $product->specificPrice.reduction|floatval ==0} style="display:none"{/if}>{strip}
							<span id="reduction_amount_display">
							{if $product->specificPrice && $product->specificPrice.reduction_type == 'amount' && $product->specificPrice.reduction|floatval !=0}
								-{convertPrice price=$productPriceWithoutReduction|floatval-$productPrice|floatval}
							{/if}
							</span>
						{/strip}</p>*}
						
						{if $priceDisplay == 2}
							<br />
							<span id="pretaxe_price">{strip}
								<span id="pretaxe_price_display">{convertPrice price=$product->getPrice(false, $smarty.const.NULL)}</span> {l s='tax excl.'}
							{/strip}</span>
						{/if}
					</div> <!-- end prices -->
					{if $packItems|@count && $productPrice < $product->getNoPackPrice()}
						<p class="pack_price">{l s='Instead of'} <span style="text-decoration: line-through;">{convertPrice price=$product->getNoPackPrice()}</span></p>
					{/if}
					{if $product->ecotax != 0}
						<p class="price-ecotax">{l s='Including'} <span id="ecotax_price_display">{if $priceDisplay == 2}{$ecotax_tax_exc|convertAndFormatPrice}{else}{$ecotax_tax_inc|convertAndFormatPrice}{/if}</span> {l s='for ecotax'}
							{if $product->specificPrice && $product->specificPrice.reduction}
							<br />{l s='(not impacted by the discount)'}
							{/if}
						</p>
					{/if}
					{if !empty($product->unity) && $product->unit_price_ratio > 0.000000}
						{math equation="pprice / punit_price" pprice=$productPrice  punit_price=$product->unit_price_ratio assign=unit_price}
						<p class="unit-price"><span id="unit_price_display">{convertPrice price=$unit_price}</span> {l s='per'} {$product->unity|escape:'html':'UTF-8'}</p>
						{hook h="displayProductPriceBlock" product=$product type="unit_price"}
					{/if}
				{/if} {*close if for show price*}
				{hook h="displayProductPriceBlock" product=$product type="weight" hook_origin='product_sheet'}
                {hook h="displayProductPriceBlock" product=$product type="after_price"}
				<div class="clear"></div>
			</div> <!-- end content_prices -->

			<div class="jump_options clearfix">
				{if isset($HOOK_PRODUCT_ASSOCIATIONS) && $HOOK_PRODUCT_ASSOCIATIONS}{$HOOK_PRODUCT_ASSOCIATIONS}{/if}
			</div>

			<p id="availability_date"{if ($product->quantity > 0) || !$product->available_for_order || $PS_CATALOG_MODE || !isset($product->available_date) || $product->available_date < $smarty.now|date_format:'%Y-%m-%d'} style="display: none;"{/if}>
				<span id="availability_date_label">{l s='Availability date:'}</span>
				<span id="availability_date_value">{if Validate::isDate($product->available_date)}{dateFormat date=$product->available_date full=false}{/if}</span>
			</p>
			<!-- Out of stock hook -->
			<div id="oosHook"{if $product->quantity > 0} style="display: none;"{/if}>
				{$HOOK_PRODUCT_OOS}
			</div>
			
		</div>
		<!-- end center infos-->
		<!-- pb-right-column-->
		<div class="pb-right-column col-xs-12 col-sm-6 col-md-6">
			{if ($product->show_price && !isset($restricted_country_mode)) || isset($groups) || $product->reference || (isset($HOOK_PRODUCT_ACTIONS) && $HOOK_PRODUCT_ACTIONS)}
			<!-- add to cart form-->
			<form id="buy_block"{if $PS_CATALOG_MODE && !isset($groups) && $product->quantity > 0} class="hidden"{/if} action="{$link->getPageLink('cart')|escape:'html':'UTF-8'}" method="post">
				<!-- hidden datas -->
				<p class="hidden">
					<input type="hidden" name="token" value="{$static_token}" />
					<input type="hidden" name="id_product" value="{$product->id|intval}" id="product_page_product_id" />
					<input type="hidden" name="add" value="1" />
					<input type="hidden" name="id_product_attribute" id="idCombination" value="" />
				</p>
				<div class="box-info-product">	
					<div class="product_attributes clearfix">
						{if isset($groups)}
							<!-- attributes -->
							<div id="attributes">
								<div class="clearfix"></div>
								{foreach from=$groups key=id_attribute_group item=group}
									{if $group.attributes|@count}
										
										{if $group.name !='Color Gamut'}
										<fieldset class="attribute_fieldset">
										{else}
										<fieldset class="attribute_fieldset" style="display: none;">
										{/if}


											<label class="attribute_label {if $group.group_type == 'color'}color_label{/if}" {if $group.group_type != 'color' && $group.group_type != 'radio'}for="group_{$id_attribute_group|intval}"{/if}>{$group.name|escape:'html':'UTF-8'}&nbsp;&nbsp;<span class="option_result text-info"></span></label>
											{assign var="groupName" value="group_$id_attribute_group"}
											<div class="attribute_list">
												{if ($group.group_type == 'select')}
													<select name="{$groupName}" id="group_{$id_attribute_group|intval}" class="form-control attribute_select no-print">
														{foreach from=$group.attributes key=id_attribute item=group_attribute}
															<option value="{$id_attribute|intval}"{if (isset($smarty.get.$groupName) && $smarty.get.$groupName|intval == $id_attribute) || $group.default == $id_attribute} selected="selected"{/if} title="{$group_attribute|escape:'html':'UTF-8'}">{$group_attribute|escape:'html':'UTF-8'}</option>
														{/foreach}
													</select>
													{if $group.name|lower == 'front lace size'}
													<a href="#attributes_frontlacesize" data-uk-modal class="highslide">Front Lace Size</a>
													<div id="attributes_frontlacesize" class="uk-modal">
														 <div class="uk-modal-dialog">
													        <a class="uk-modal-close uk-close"></a>
													        <img src="{$base_dir}themes/uniwigs2016/img/products/Front-Lace-Size.jpg" alt="">
													    </div>
													</div>
													{/if}
													{if $group.name|lower == 'hairline'}
													<a href="#attributes_hairline" data-uk-modal class="highslide">Hairline</a>
													<div id="attributes_hairline" class="uk-modal">
														 <div class="uk-modal-dialog">
													        <a class="uk-modal-close uk-close"></a>
													        <img src="{$base_dir}themes/uniwigs2016/img/products/free-part.jpg" alt="">
													    </div>
													</div>
													{/if}
													{if $group.name|lower == 'clip in'}
													<a href="#attributes_clipin" data-uk-modal class="highslide">Clip In</a>
													<div id="attributes_clipin" class="uk-modal">
														 <div class="uk-modal-dialog">
													        <a class="uk-modal-close uk-close"></a>
													        <img src="{$base_dir}themes/uniwigs2016/img/products/clip-in.jpg" alt="">
													    </div>
													</div>
													{/if}
													{if $group.name|lower == 'length'}
													<a href="#attributes_length" data-uk-modal class="highslide">Length & Fit</a>
													<div id="attributes_length" class="uk-modal">
														 <div class="uk-modal-dialog">
													        <a class="uk-modal-close uk-close"></a>
													        <img src="{$base_dir}themes/uniwigs2016/img/products/length.jpg" alt="">
													        <img src="{$base_dir}themes/uniwigs2016/img/products/biglayer.png" alt="">
													    </div>
													</div>
													{/if}
													{if $group.name|lower == 'cap size'}
													<a href="#attributes_cap_size" data-uk-modal class="highslide">Cap Size</a>
													<div id="attributes_cap_size" class="uk-modal">
														 <div class="uk-modal-dialog">
													        <a class="uk-modal-close uk-close"></a>
													        <img src="{$base_dir}themes/uniwigs2016/img/size-banner.png" alt="">
													    </div>
													</div>
													{/if}
													{if $group.name|lower == 'density'}
													<a href="#attributes_density" data-uk-modal class="highslide">Density</a>
													<div id="attributes_density" class="uk-modal">
														 <div class="uk-modal-dialog">
													        <a class="uk-modal-close uk-close"></a>
													        <div>
													        	<h3>The standard of Uniwigs Lace Wigs Density (Weight(g))</h3>
														        <div class="row">
														        	<div class="col-sm-6 col-md-6">
														        		<table class="uk-table uk-table-striped">
														        			<caption>Full Handtied Lace Wigs</caption>
														        			<thead>
														        				<tr>
														        					<th></th>
														        					<th>130%</th>
														        					<th>150%</th>
														        					<th>180%</th>
														        				</tr>
														        			</thead>
														        			<tbody>
														        				<tr>
														        					<td>8"</td>
														        					<td>95g</td>
														        					<td>115g</td>
														        					<td>130g</td>
														        				</tr>
														        				<tr>
														        					<td>10"</td>
														        					<td>105g</td>
														        					<td>125g</td>
														        					<td>135g</td>
														        				</tr>
														        				<tr>
														        					<td>12"</td>
														        					<td>115g</td>
														        					<td>140g</td>
														        					<td>155g</td>
														        				</tr>
														        				<tr>
														        					<td>14"</td>
														        					<td>135g</td>
														        					<td>160g</td>
														        					<td>175g</td>
														        				</tr>
														        				<tr>
														        					<td>16"</td>
														        					<td>155g</td>
														        					<td>170g</td>
														        					<td>185g</td>
														        				</tr>
														        				<tr>
														        					<td>18"</td>
														        					<td>170g</td>
														        					<td>185g</td>
														        					<td>200g</td>
														        				</tr>
														        				<tr>
														        					<td>20"</td>
														        					<td>180g</td>
														        					<td>205g</td>
														        					<td>225g</td>
														        				</tr>
														        				<tr>
														        					<td>22"</td>
														        					<td>190g</td>
														        					<td>220g</td>
														        					<td>240g</td>
														        				</tr>
														        				<tr>
														        					<td>24"</td>
														        					<td>210g</td>
														        					<td>235g</td>
														        					<td>255g</td>
														        				</tr>
														        				<tr>
														        					<td>26"</td>
														        					<td>220g</td>
														        					<td>245g</td>
														        					<td>265g</td>
														        				</tr>
														        			</tbody>
														        		</table>
														        	</div>
														        	<div class="col-sm-6 col-md-6">
														        		<table class="uk-table uk-table-striped">
														        			<caption>Lace Front Wigs</caption>
														        			<thead>
														        				<tr>
														        					<th></th>
														        					<th>130%</th>
														        					<th>150%</th>
														        					<th>180%</th>
														        				</tr>
														        			</thead>
														        			<tbody>
														        				<tr>
														        					<td>8"</td>
														        					<td>90g</td>
														        					<td>100g</td>
														        					<td>115g</td>
														        				</tr>
														        				<tr>
														        					<td>10"</td>
														        					<td>95g</td>
														        					<td>115g</td>
														        					<td>130g</td>
														        				</tr>
														        				<tr>
														        					<td>12"</td>
														        					<td>112g</td>
														        					<td>132g</td>
														        					<td>147g</td>
														        				</tr>
														        				<tr>
														        					<td>14"</td>
														        					<td>132g</td>
														        					<td>157g</td>
														        					<td>172g</td>
														        				</tr>
														        				<tr>
														        					<td>16"</td>
														        					<td>145g</td>
														        					<td>170g</td>
														        					<td>185g</td>
														        				</tr>
														        				<tr>
														        					<td>18"</td>
														        					<td>155g</td>
														        					<td>180g</td>
														        					<td>195g</td>
														        				</tr>
														        				<tr>
														        					<td>20"</td>
														        					<td>170g</td>
														        					<td>200g</td>
														        					<td>220g</td>
														        				</tr>
														        				<tr>
														        					<td>22"</td>
														        					<td>180g</td>
														        					<td>210g</td>
														        					<td>245g</td>
														        				</tr>
														        				<tr>
														        					<td>24"</td>
														        					<td>195g</td>
														        					<td>225g</td>
														        					<td>245g</td>
														        				</tr>
														        				<tr>
														        					<td>26"</td>
														        					<td>210g</td>
														        					<td>240g</td>
														        					<td>260g</td>
														        				</tr>
														        			</tbody>
														        		</table>
														        	</div>
														        </div>
													        </div>
													        <img src="{$base_dir}themes/uniwigs2016/img/products/dencity.jpg" alt="">
													    </div>
													</div>
													{/if}
													{if $group.name|lower == 'lace color'}
													<a href="#attributes_lace_color" data-uk-modal class="highslide">lace color</a>
													<div id="attributes_lace_color" class="uk-modal">
														 <div class="uk-modal-dialog">
													        <a class="uk-modal-close uk-close"></a>
													        <img src="{$base_dir}themes/uniwigs2016/img/products/lace-color.jpg" alt="">
													    </div>
													</div>
													{/if}
													{if $group.name|lower == 'cap construction'}
													<a href="#attributes_cap_construction" data-uk-modal class="highslide">Cap Construction</a>
													<div id="attributes_cap_construction" class="uk-modal">
														 <div class="uk-modal-dialog">
													        <a class="uk-modal-close uk-close"></a>
													        <div class="specification_desitem">
																<ul class="row img-responsive">
																	<li class="col-sm-4">
																		<h4>LACE FRONT</h4>
																		<img src="/themes/uniwigs2016/img/products/lace-front-cap.jpg">
																		<p></p>
																		<p><em>1.</em> 13” × 3“ Lace front with wefted back.</p>
																		<p><em>2.</em> Weft stitched to elastic netting. </p>
																		<p><em>3.</em> Adjustable strap allows you to loosen or tighten the cap up to a half inch.</p>
																		<p><em>4.</em> Smooth velvet tabs at the nape of the neck.</p>
																		<p><span class="round"></span> Invisible finer, durable and softer French lace.</p>
																	</li>
																	<li class="col-sm-4">
																		<h4>FULL LACE (100% HAND-TIED)</h4>
																		<img src="/themes/uniwigs2016/img/products/full-lace-cap.jpg">
																		<p></p>
																		<p><em>1.</em> Full lace cap with stretch panel in the crown. The stretch panel gives you an extra half inch for a better fit.</p>
																		<p><em>2.</em> Increased hair density along the hairline and at the crown creates a more natural look.</p>
																		<p><span class="round"></span> Invisible finer, durable and softer French lace all around.</p>
																		<p><span class="round"></span> Uniform mold, standardized size. </p>
																	</li>
																	<li class="col-sm-4">
																		<h4>GLUELESS FULL LACE</h4>
																		<img src="/themes/uniwigs2016/img/products/glueless-full-lace-cap.jpg">
																		<p></p>
																		<p><em>1.</em> Clips and combs attached to the sides near the temple.</p>
																		<p><em>2.</em> Increased hair density along the hairline and at the crown creates a more natural look.</p>
																		<p><em>3.</em> Full lace cap with stretch at crown and adjustable straps at back.</p>
																		<p><span class="round"></span> Invisible finer, durable and softer French lace all around.</p>
																		<p><span class="round"></span> Uniform mold, standardized size.  </p>
																	</li>
																	<li class="col-sm-4">
																		<h4>Silk Top FULL LACE (100% HAND-TIED)</h4>
																		<img src="/themes/uniwigs2016/img/products/Silk-Top-Full-Lace-Cap.jpg">
																		<p></p>
																		<p><em>1.</em> Full lace cap with 4"x4" Silk top in front. 4”*4” Silk Top provide the most realistic scalp, like the hair is growing out of your scalp.</p>
																		<p><em>2.</em> Adjustable straps at back.</p>
																		<p>&amp;diams Invisible finer, durable and softer French lace all around.</p>
																		<p>&amp;diams Uniform mold, standardized size.</p>
																	</li>
																	<li class="col-sm-4">
																		<h4>Silk Top GLUELESS FULL LACE</h4>
																		<img src="/themes/uniwigs2016/img/products/Silk-Top-Glueless-Full-Lace-Cap.jpg">
																		<p></p>
																		<p><em>1.</em> Full lace cap with 4"x4" Silk top in front. 4”*4” Silk Top provide the most realistic scalp, like the hair is growing out of your scalp.</p>
																		<p><em>2.</em> Adjustable straps at back.</p>
																		<p><em>3.</em> Clips and combs attached to the sides near the temple.</p>
																		<p><em>4.</em> The stretch panel gives you an extra half inch for a better fit.</p>
																		<p><span class="round"></span> Invisible finer, durable and softer French lace all around.</p>
																		<p><span class="round"></span> Uniform mold, standardized size.</p>
																	</li>
																</ul>
															</div>
													    </div>
													</div>
													{/if}
												{elseif ($group.group_type == 'color')}
													<ul id="color_to_pick_list" class="clearfix">
														{assign var="default_colorpicker" value=""}
														{foreach from=$group.attributes key=id_attribute item=group_attribute}
															{assign var='img_color_exists' value=file_exists($col_img_dir|cat:$id_attribute|cat:'.jpg')}
															<li{if $group.default == $id_attribute} class="selected"{/if}>
																<a href="{$img_col_dir}{$id_attribute|intval}.jpg" id="color_{$id_attribute|intval}" name="{$colors.$id_attribute.name|escape:'html':'UTF-8'}" class="color_pick{if ($group.default == $id_attribute)} selected{/if}"{if !$img_color_exists && isset($colors.$id_attribute.value) && $colors.$id_attribute.value} style="background:{$colors.$id_attribute.value|escape:'html':'UTF-8'};"{/if} title="{$colors.$id_attribute.name|escape:'html':'UTF-8'}" data-uk-lightbox>
																	{if $img_color_exists}
																		<img src="{$img_col_dir}{$id_attribute|intval}.jpg" alt="{$colors.$id_attribute.name|escape:'html':'UTF-8'}" title="{$colors.$id_attribute.name|escape:'html':'UTF-8'}" width="20" height="20" />
																	{/if}
																</a>
															</li>
															{if ($group.default == $id_attribute)}
																{$default_colorpicker = $id_attribute}
															{/if}
														{/foreach}
													</ul>
													{if $product->id == '40677' or $product->id == '40682' or $product->id == '41128' or $product->id == '41054' or $product->id == '40475' or $product->id == '40685' or $product->id == '40792' or $product->id == '40678' or $product->id == '40698' or $product->id == '40469' or $product->id == '40683' or $product->id == '40793' or $product->id == '40977' or $product->id == '40686' or $product->id == '40699' or $product->id == '40681' or $product->id == '40680' or $product->id == '40473' or $product->id == '40466' or $product->id == '41167' or $product->id == '40474'}
													<p class="text-primary"><small>Celebrity color can only be received by choosing "Celebrity-Style+ 14 days"; you will receive the single color if you select the others.</small></p>
													<p class="text-primary"><small>e.g.: If you choose the 2#, you will get a wig all in 2# dark brown.</small></p>
													{/if}
													<input type="hidden" class="color_pick_hidden" name="{$groupName|escape:'html':'UTF-8'}" value="{$default_colorpicker|intval}" />
												{elseif ($group.group_type == 'radio')}
													<ul>
														{foreach from=$group.attributes key=id_attribute item=group_attribute}
															<li for="{$groupName|escape:'html':'UTF-8'}">
																<input type="radio" class="attribute_radio" name="{$groupName|escape:'html':'UTF-8'}" value="{$id_attribute}" {if ($group.default == $id_attribute)} checked="checked"{/if} />
																<span>{$group_attribute|escape:'html':'UTF-8'}</span>
															</li>
														{/foreach}
													</ul>
												{/if}
											</div> <!-- end attribute_list -->
										</fieldset>
									{/if}
								{/foreach}
							</div> <!-- end attributes -->
						{/if}



						{if isset($product) && $product->customizable}
						<!-- customization -->
						<div id="customizationForm-box">
							<a href="javscript:;" class="page-product-heading custom_options_a" data-uk-toggle="{literal}{target:'#custom_options', cls:'custom_options_box_primary'}{/literal}">{l s='Product customization'}</a>
							{*<p class="infoCustomizable">
									{l s='After saving your customized product, remember to add it to your cart.'}
									{if $product->uploadable_files}
									<br />
									{l s='Allowed file formats are: GIF, JPG, PNG'}{/if}
							</p>*}

							{if $product->uploadable_files|intval}
								<div id="custom_options" class="customizableProductsFile custom_options_box">
									<h5 class="product-heading-h5">{l s='Pictures'}</h5>
									<ul id="uploadable_files" class="clearfix">
										{counter start=0 assign='customizationField'}
										{foreach from=$customizationFields item='field' name='customizationFields'}
											{if $field.type == 0}
												<li class="customizationUploadLine{if $field.required} required{/if}">{assign var='key' value='pictures_'|cat:$product->id|cat:'_'|cat:$field.id_customization_field}
													{if isset($pictures.$key)}
														<div class="customizationUploadBrowse">
															<img src="{$pic_dir}{$pictures.$key}_small" alt="" />
																<a href="{$link->getProductDeletePictureLink($product, $field.id_customization_field)|escape:'html':'UTF-8'}" title="{l s='Delete'}" >
																	<img src="{$img_dir}icon/delete.gif" alt="{l s='Delete'}" class="customization_delete_icon" width="11" height="13" />
																</a>
														</div>
													{/if}
													<div class="customizationUploadBrowse form-group">
														<label class="customizationUploadBrowseDescription">
															{if !empty($field.name)}
																{$field.name}
															{else}
																{l s='Please select an image file from your computer'}
															{/if}
															{if $field.required}<sup>*</sup>{/if}
														</label>
														<input type="file" name="file{$field.id_customization_field}" id="img{$customizationField}" class="form-control customization_block_input {if isset($pictures.$key)}filled{/if}" />
													</div>
												</li>
												{counter}
											{/if}
										{/foreach}
									</ul>
								</div>
							{/if}

							{if $product->text_fields|intval}
								<div id="custom_options" class="customizableProductsText custom_options_box">

									<ul id="text_fields">
									{counter start=0 assign='customizationField'}
									{foreach from=$customizationFields item='field' name='customizationFields'}
										{if $field.type == 1}
											{if isset($custom_options.{$field.name})}
											<li class="customizationUploadLine{if $field.required} required{/if}">
												<label for ="textField{$customizationField}">{assign var='key' value='textFields_'|cat:$product->id|cat:'_'|cat:$field.id_customization_field}{if !empty($field.name)}{$field.name}{/if}{if $field.required}<sup>*</sup>{/if}</label>
												<div class="customer_select">
													<select name="textField{$field.id_customization_field}" class="form-control customization_block_input" id="textField{$customizationField}">
														{foreach from=$custom_options.{$field.name} item='option_item'}
														<option value="{$option_item.name|escape}"{if isset($textFields.$key) && ($textFields.$key==$option_item.name)} selected{/if}>
															{if $option_item.name|lower == 'no'}
															NO
															{else}
															{$option_item.name}
															{/if}
															{if $option_item.custom_time} +{$option_item.custom_time}{/if}
															{if $option_item.custom_price>0} +${$option_item.custom_price}{/if}
														</option>
														{/foreach}
													</select>
													{if $field.name|lower == 'highlight percentage'}
														<a href="#attributes_highlight_percentage" data-uk-modal class="highslide">Highlight Percentage</a>
														<div id="attributes_highlight_percentage" class="uk-modal">
															 <div class="uk-modal-dialog">
														        <a class="uk-modal-close uk-close"></a>
														       <div class="specification_desitem">
																	<p>How to measure the highlight percentage: By the percentage of the whole cap. For example: the 10% highlight means the highlight area is 10% of the whole cap.</p>
																</div>
														    </div>
														</div>
													{/if}
													{if $field.name|lower == 'mixed percentage'}
														<a href="#attributes_mixed_percentage" data-uk-modal class="highslide">Mixed Percentage</a>
														<div id="attributes_mixed_percentage" class="uk-modal">
															 <div class="uk-modal-dialog">
														        <a class="uk-modal-close uk-close"></a>
														       <div class="specification_desitem">
																	<p>How to measure the mixed percentage: By the percentage of the whole hair on the wig. For example: 10% mixed color means that the mixed color hair is 10% of the whole hair on the wig.</p>
																</div>
														    </div>
														</div>
													{/if}
													{if $field.name|lower == 'lace color'}
														<a href="#attributes_lace_color" data-uk-modal class="highslide">Lace Color</a>
														<div id="attributes_lace_color" class="uk-modal">
															 <div class="uk-modal-dialog">
														        <a class="uk-modal-close uk-close"></a>
														        <img src="{$base_dir}themes/uniwigs2016/img/products/lace-color.jpg" alt="">
														    </div>
														</div>
													{/if}
													{if $field.name|lower == 'cap size'}
														<a href="#attributes_cap_size" data-uk-modal class="highslide">Cap Size</a>
														<div id="attributes_cap_size" class="uk-modal">
															 <div class="uk-modal-dialog">
														        <a class="uk-modal-close uk-close"></a>
														       	<div class="specification_desitem">
																	<article id="user" class="doc">
																		<h2>
																			Determine Your Wig Size
																		</h2>
																		<dl class="doc-con">
																			<div id="guide">
																				<p>Measuring your head size is an important task to endeavor prior to order a wig. Here are 5 simple steps to measure your head correctly: Before you measure, make sure to flatten your hair: use a cloth tape measure and do not pull the tape measure, just rest it over or around your head. Pulling or stretching the tape will give you the wrong size.</p>
																				<div class="guide_dl">
																				<div class="guide_them"><img src="../themes/uniwigs2016/img/cms/24.png" alt="">
																				<p>1) Measure around your head at the hairline.</p>
																				</div>
																				<div class="guide_them"><img src="../themes/uniwigs2016/img/cms/25.png" alt="">
																				<p>2) Measure your head from the nape over the crown to the top of your forehead where your natural hairline is.</p>
																				</div>
																				<div class="guide_them"><img src="../themes/uniwigs2016/img/cms/26.png" alt="">
																				<p>3) Measure from the ear-tab of one ear, across your head, to the same side of your other ear.</p>
																				</div>
																				<div class="guide_them"><img src="../themes/uniwigs2016/img/cms/27.png" alt="">
																				<p>4) Measure from the point in front of one ear where your hairline ends, over the crown of your head, to the same point of your other ear.</p>
																				</div>
																				<div class="guide_them"><img src="../themes/uniwigs2016/img/cms/28.png" alt="">
																				<p>5) Measure your nape of neck.</p>
																				</div>
																				</div>
																				<div class="guide_them fix">
																				<p>&nbsp;</p>
																				<p>Cap size for UniWigs Human Hair Lace Wigs(lace front and full lace):</p>
																				<img src="../themes/uniwigs2016/img/cms/29.jpg" alt=""></div>
																				<div class="guide_them">
																				<p>Mono Top (Hand-tied) Cap, Skin Top Cap (for Jewish Wigs) and all the Synthetic Wigs are average sized with Circumference 21.5"</p>
																				<p>You can also come to our <a href="../custom-order">Customer Order</a> page to custom the exact wig that can best fit your head.</p>
																				<p><strong><br></strong></p>
																				<p><strong>Please Note:</strong><br> <span>*This is guide to understand the cap size.</span><br> <span>*It does not mean that each wig comes in all of these cap sizes.</span><br> <span>*Sizes will vary slightly due to different types of wigs.</span></p>
																				</div>
																			</div>
																		</dl>
																	</article>
																</div>
														    </div>
														</div>
													{/if}
													{if $field.name|lower == 'hairline'}
														<a href="#attributes_hairlines" data-uk-modal class="highslide">Hairline</a>
														<div id="attributes_hairlines" class="uk-modal">
															 <div class="uk-modal-dialog">
														        <a class="uk-modal-close uk-close"></a>
														        <img src="{$base_dir}themes/uniwigs2016/img/products/free-part.jpg" alt="">
														    </div>
														</div>
													{/if}
													
												</div>
											</li>
											{else}
											<li class="customizationUploadLine{if $field.required} required{/if}">
												<label for ="textField{$customizationField}">
													{assign var='key' value='textFields_'|cat:$product->id|cat:'_'|cat:$field.id_customization_field}
													{if !empty($field.name)}
														{$field.name}
													{/if}
													{if $field.required}<sup>*</sup>{/if}
												</label>
												<textarea name="textField{$field.id_customization_field}" class="form-control customization_block_input" id="textField{$customizationField}" rows="3" cols="20">{strip}
													{if isset($textFields.$key)}
														{$textFields.$key|stripslashes}
													{/if}
												{/strip}</textarea>
											</li>
											{/if}
											{counter}
										{/if}
									{/foreach}
									</ul>
								</div>
							{/if}

							<input type="hidden" name="submitCustomizedDatas" value="1" />
						</div>
						<!-- end customization -->
						{/if}

						<!-- quantity wanted -->
						{if !$PS_CATALOG_MODE}
						<p id="quantity_wanted_p"{if (!$allow_oosp && $product->quantity <= 0) || !$product->available_for_order || $PS_CATALOG_MODE} style="display: none;"{/if}>
							<label for="quantity_wanted">{l s='Quantity'}</label>
							<input type="number" min="1" name="qty" id="quantity_wanted" class="text" value="{if isset($quantityBackup)}{$quantityBackup|intval}{else}{if $product->minimal_quantity > 1}{$product->minimal_quantity}{else}1{/if}{/if}" />
							<a href="#" data-field-qty="qty" class="btn btn-default button-minus product_quantity_down">
								<span><i class="icon-minus"></i></span>
							</a>
							<a href="#" data-field-qty="qty" class="btn btn-default button-plus product_quantity_up">
								<span><i class="icon-plus"></i></span>
							</a>
							<span class="clearfix"></span>
						</p>
						{/if}
						<!-- minimal quantity wanted -->
						<p id="minimal_quantity_wanted_p"{if $product->minimal_quantity <= 1 || !$product->available_for_order || $PS_CATALOG_MODE} style="display: none;"{/if}>
							{l s='The minimum purchase order quantity for the product is'} <b id="minimal_quantity_label">{$product->minimal_quantity}</b>
						</p>
						{if isset($productAddition['custom']) && $productAddition['custom']}
							<div class="custom-time uk-margin-small-top">Production Time: <span class="text-primary">{$productAddition['custom']}</span></div>
						{/if}
					</div> <!-- end product_attributes -->
					<div class="box-cart-bottom">

						<p  style="display:none">{$product->quantity}</p>
					
						<p id="add_to_cart" class="buttons_bottom_block no-print {if (!$allow_oosp && $product->quantity <= 0) || !$product->available_for_order || (isset($restricted_country_mode) && $restricted_country_mode) || $PS_CATALOG_MODE}unvisible{/if}">
							<button type="submit" name="Submit" class="exclusive">
								<span>{if $content_only && (isset($product->customization_required) && $product->customization_required)}{l s='Customize'}{else}{l s='Add to cart'}{/if}</span>
							</button>
						</p>
					

						{if isset($HOOK_PRODUCT_ACTIONS) && $HOOK_PRODUCT_ACTIONS}{$HOOK_PRODUCT_ACTIONS}{/if}
					</div> <!-- end box-cart-bottom -->
				</div> <!-- end box-info-product -->
				
				{if $category->id=='102'}
				<p class="pro_promotions uk-margin-top uk-margin-bottom text-primary" style="color:#920783">
					Free Color Ring for First Order with Human Hair Wigs
				</p>
				{/if}

				<div class="prod-help">
					<h4>More Information</h4>
					<ul class="arrow-bullet-links clearfix">
						<li><a href="#specification_infos" data-uk-modal id="Product_Specifications_product">Product Specifications</a></li>
						<li><a href="#wear_care" data-uk-modal id="Wear_Care_product">Wear & Care</a></li>
						<li><a href="#shipping_return" data-uk-modal id="Shipping_Return_product">Shipping & Return</a></li>
						<li><a href="#product_faq" data-uk-modal id="FAQ_product">FAQ</a></li>
					</ul>
				</div>
				
				<div id="specification_infos" class="uk-modal">
				    <div class="uk-modal-dialog img-responsive">
				        <a href="#" class="uk-modal-close uk-close"></a>
				        {if isset($HOOK_PRODUCT_TAB_CONTENT_SPECIFICATIONS) && $HOOK_PRODUCT_TAB_CONTENT_SPECIFICATIONS}
				        {$HOOK_PRODUCT_TAB_CONTENT_SPECIFICATIONS}
				        {/if}
					</div>
				</div>

				<div id="wear_care" class="uk-modal">
				    <div class="uk-modal-dialog img-responsive">
				        <a href="#" class="uk-modal-close uk-close"></a>
						{include file="$tpl_dir./wear_and_care.tpl"}
					</div>
				</div>

				<div id="shipping_return" class="uk-modal">
				    <div class="uk-modal-dialog img-responsive">
				        <a href="#" class="uk-modal-close uk-close"></a>
						<article class="pro_shipping">
							<h3>US Domestic Shipping</h3>
							<table class="uk-table uk-table-striped">
								<thead>
									<tr>
										<th>Shipping Method</th>
										<th>Transportation Time</th>
										<th>Total Delivery Time</th>
										<th>Shipping Cost</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>US Ground Shipping</td>
										<td>4-7 business days</td>
										<td>5-9 business days</td>
										<td>$4.95</td>
									</tr>
									<tr>
										<td>US Air Shipping</td>
										<td>2-3 business days</td>
										<td>3-5 business days</td>
										<td>$18.89</td>
									</tr>
									<tr>
										<td>US Express Shipping</td>
										<td>1 business day</td>
										<td>2-3 business days</td>
										<td>$28.89</td>
									</tr>
								</tbody>
							</table>
							<h3 class="f14">International Shipping</h3>
							<table class="uk-table">
								<thead>
									<tr>
										<th>Shipping Method</th>
										<th>Transportation Time</th>
										<th>Total Delivery Time</th>
										<th>Shipping Cost</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>International Shipping</td>
										<td>6-12 business days</td>
										<td>7-14 business days</td>
										<td>$29.89</td>
									</tr>
									<tr>
										<td colspan="5">As for international shipping, customer is responsible for any duties, taxes, or brokerage fees that may apply. We do not collect any duties or taxes from you and do not know how much they will cost you. Please check with your own country.</td>
									</tr>
								</tbody>
							</table>
							<p class="text-primary">
								<b>Note</b>: For items with "custom time‘, please be subject to the Custom Time remaked on the website.
							</p>
							<p class="text-primary">
								365 days of the year, we offer Free US Ground Shipping for all orders over $49.
							</p>
							<p class="p-con">
								Shipping and handling time is calculated based on your location and the method of shipping you selected! Different custom product will require 2-4 weeks' processing time accordingly. Please pay attention to the custom time on the product's page.
								<br><br>
								For complete shipping details, please refer to our <a
								href="{$base_dir}content/27-shipping-information" class="text-primary a-underline" rel="nofollow">Shipping Policy</a>.
								{*<br><br>
								If you do not love your wig, you can apply for returned goods, please refer to our <a
								href="{$base_dir}content/2-return-policy" class="text-primary a-underline" rel="nofollow">Return Policy</a>.
								<br><br>
								For any inquiries, please <a
								href="{$base_dir}contact-us" class="text-primary a-underline" rel="nofollow">Contact
								Us</a>.*}
							</p>

							<p class="title mt20">EXCHANGE/RETURN POLICY</p>
							<p class="pb10">
								If you are not completely happy with your product(s), we are glad to accept any illegible exchanges or returns. Please refer to our <a
								href="{$base_dir}content/2-return-policy" class="text-primary a-underline" rel="nofollow">Return Policy</a> for product illegibility.
							</p>
							<h3 class="f14">How To Exchange or Return:</h3>
							<p class="pb10">
								1. Please send an email to <a href="mailto:support@uniwigs.com" target="_blank">
								support@uniwigs.com</a> containing your order No., reasons for exchange/return
								and new item(s) to exchange!
							</p>
							<p class="pb10">
								2. Please repackage your item(s) and mail it to the address provided on the <a
								href="{$base_dir}content/2-return-policy" class="text-primary a-underline"
								rel="nofollow">Return Policy</a> page within 10 days of receiving your order.
								A tracking number will be needed in order to process the exchange/return as soon as possible.
							</p>
							<h3 class="f14">Note:</h3>
							<p class="pb10">
								* Please be advised that you must contact us prior to sending your package back so that we
								can take care of your case accordingly.
							</p>
							<p class="pb10">
								* Please note that any unauthorized return without contacting us will be denied at our
								warehouse facility.
							</p>
							<p class="pb10">
								For any inquiries, please <a
								href="{$base_dir}contact-us" class="text-primary a-underline" rel="nofollow">Contact
								Us</a>.
							</p>
						</article>
					</div>
				</div>

				<div id="product_faq" class="uk-modal">
				    <div class="uk-modal-dialog img-responsive">
				        <a href="#" class="uk-modal-close uk-close"></a>
						{if $category->id == '102' or $category->id == '101' or $category->id == '104' or $category->id == '40446' or $category->id == '40447' or $category->id == '40448' or $category->id == '40449' or $category->id == '40450' or $category->id == '40451' or $category->id == '40452' or $category->id == '40453' or $category->id == '40454' or $category->id == '40455' or $category->id == '40456' or $category->id == '40459' or $category->id == '112' or $category->id == '113' or $category->id == '114' or $category->id == '115' or $category->id == '116' or $category->id == '110' or $category->id == '111' or $category->id == '40458'}
							<div class="uk-accordion" data-uk-accordion>
									<h4 class="uk-accordion-title">1.1 Why should I choose UniWigs?</h4>
									<div class="uk-accordion-content">
											<p>Throughout our history, Uniwigs' philosophy has always been to make hair that is unique, stylish and individual to fit each customer. From the drawing of our first sketches to presenting our finished products, Uniwigs applies the utmost attention to detail and quality.</p>
											<p>Uniwigs also believes every woman is unique and every unique woman deserves a unique wig. Uniwigs strives for uniqueness within our industry. We design our hair products at our own design center in LA and produce them at our own factories based in Asia to avoid any extra expenses. Giving you the best quality at the most affordable possible price on the market. Design, development, production, quality control and sales-Uniwigs controls every step of the hair making process and ensure high quality and longevity.</p>
											<p>With fashionable designers and strong production capability, Uniwigs is also able to make customized order to meet personal needs. Our clients now have the chance to fulfill their dream hair by choosing various colors and caps from UniWigs.</p>
									</div>
									<h4 class="uk-accordion-title">1.2 Lace Front Wigs and Mono Wigs</h4>
									<div class="uk-accordion-content">
											<p>Lace Front Wigs: Lace Front Wigs or Front Lace Wigs applies to a wig that only has lace in the front and wefted at the back. This gives you a natural front hairline and provides extreme comfort to the scalp. UniWigs provides you with human hair lace front wigs and synthetic wigs to choose from.</p>
											<p>Mono Wigs: UniWigs Mono wigs are made of hand-tied mono top cap construction to simulate a natural hair growth with stretch net at the back for the best comfort and fit.</p>
											<p>Please refer to all the <a target="_blank" href="{$base_dir}content/35-cap-constructions">cap constructions</a>.</p>
									</div>
									<h4 class="uk-accordion-title">1.3 How to distinguish human hair wigs and synthetic wigs?</h4>
									<div class="uk-accordion-content">
											<p><strong>Compare the price</strong></p>
											<p>That is very obvious: with the same style and length, Human hair wigs are much more expensive than synthetic ones. Therefore, If your human hair wig is relatively cheap, you may need to consider whether it's blended with synthetic fiber or the hair that collected to make this wig is not of a healthy quality.</p>
																		<p><strong>Identify the material</strong></p>
											<p>Burn/Singe the hair and smell: Choose a small strand of hair and burn it. If the hair is 100% human hair, it smells like a barbecue; if not, it smells like plastic. </p>
											<p>Check the ashes after burning the hair. If the hair is 100% human hair, you can twist the ashes to turn it into powder; if not, the ashes will remain in tact.</p>
									</div>
									<h4 class="uk-accordion-title">1.4 Are the knots of UniWigs lace wigs bleached?</h4>
									<div class="uk-accordion-content">
											<p>When hair is hand-tied to the base of a lace wig, you can see a knot on the lace. Lace cannot be hidden. Thus we have to bleach the knots to help create the illusion that your hair is growing out of your head.</p>
											<p>UniWigs lace wigs are made of high quality lace with single knots around the perimeter and double knots elsewhere. All lace wigs knots have been bleached along the perimeter. </p>
											<p>NOTICE: When hair is hand-tied to the lace, there is a dark knot where hair is secured. Bleaching of these knots helps to lighten the appearance. With the use of peroxide (bleach) gives the illusion that hair is growing from your scalp. Even without bleaching, knots made with darker color hair (Black to dark brown) will still be more noticeable than lighter colored hair.</p>
											<p>Please don't bleach the knots if you are not familiar with wig production.</p>
											<p>Please specify your bleaching demand to us via Live Chat or Email before you place your order with us.</p>
									</div>
									<h4 class="uk-accordion-title">1.5 What are Full Lace wigs and Glueless Full Lace wigs?</h4>
									<div class="uk-accordion-content">
											<p>These two kinds of wigs include lace all around the perimeter and are available for you to wear your hair in updo's and high ponytails. The wigs all have a natural hairline around the perimeter when wearing. </p>
											<p>Since there were no combs or clips and no straps inside Full Lace wigs, you have to apply the wigs with either glue or other adhesives. These are suitable for women without hair or with scarce hair. While glueless full lace wigs have adjustable straps on the back and combs on the side and the front to secure the wig from sliding or rolling back, you can adjust the cap to suit your head size for a better fit.</p>
									</div>
									<h4 class="uk-accordion-title">1.6 What's the difference between Remy human hair and virgin remy human hair?</h4>
									<div class="uk-accordion-content">
											<p><strong>Remy Hair</strong></p>
											<p>Remy or Remi is not a brand name. Technically, the term refers to the characteristics in a collection of hair that is, un-damaged, healthy hair. Remy hair is shinier, softer, and has a longer lifespan than non-Remy hair. Non-Remy has been chemically processed (typically for texture or color) before the hair was collected.</p>
											<p>Remy hair strands can be processed by coloring or other treatments to reach a certain style, thus some ingredients of the hair mainly the cuticles could be destroyed. Remy hair is not as good as virgin hair, thus remy human hair wigs are cheaper than virgin remy hair.</p>
											<p><img src="{$img_dir}cms/1.jpg" width="100%"></p>
											<p><strong>Virgin Remy Hair</strong></p>
											<p>The best type of Remy hair is virgin, also called "cuticle" hair. When hair is harvested from a donor, the cuticles remain intact to protect the hair from damage.</p>
											<p>Virgin hair is hair that has never been processed or treated with ANY kind of chemicals. The hair is in its natural state with its cuticles running in the same direction and is fully intact. You can bleach, dye and process Virgin hair just as you would do to your own hair.</p>
											<p>The texture of virgin hair is generally straight, wavy or curly. However any hair that has been chemically processed for texture, for example yaki, body wave or curls is no longer virgin.</p>
											<p><strong>Uniwigs Remy human hair wigs</strong></p>
											<p>Uniwigs Remy human hair wigs are properly processed to style any wigs at the customers demand, without any over-processing or without the use of unhealthy hair that has fallen from heads like some unprincipled manufacturers. Therefore any products labeled as "Remy human hair" on www.uniwigs.com, are not "virgin Remy hair products" however, we ensure they are of meticulously high quality.</p>
									</div>
									<h4 class="uk-accordion-title">1.7 How can I choose the color and the size?</h4>
									<div class="uk-accordion-content">
											<p>To help you shop for the right color online it's just as easy as in a store, please refer to our <a target="_blank" href="{$base_dir}content/18-choosing-a-color-for-wigs">hair color chart</a> after you have found the style you like. </p>
											<p>As for the cap size, we all know that measuring your head size is an important task to endeavor prior to ordering a wig. Please carefully measure your head size and choose the proper cap size following our <a target="_blank" href="{$base_dir}content/31-find-your-size">cap size guide</a>.</p>
									</div>
									<h4 class="uk-accordion-title">1.8 Can I curl or straighten my wig?</h4>
									<div class="uk-accordion-content">
											<p>Of course you can if you purchase our Human hair wigs for the ultimate styling versatility - you can curl or straighten them as you would your own hair. However, just like our own hair, the less heat you use the better.</p>
											<p>Synthetic wigs, on the other hand, can be irreparably damaged if you try to curl or straighten the hair with heated tools, except occasionally with some <a target="_blank" href="{$base_dir}tag/heat-friendly-synthetic-wigs">heat friendly wigs</a>.</p>
									</div>
									<h4 class="uk-accordion-title">1.9 How do I apply a wig?</h4>
									<div class="uk-accordion-content">
											<p>To perfectly apply a wig is not easy. First, you need to pin your hair up. Then, use a wig cap on any type of hair length to hold it all in place and to ensure a smooth fit. Even if you are bald, we recommend you still use a wig cap - it will help with friction and ensure the wig stays on. Next, put the wig on your head from front to back. There are two tabs on each front/side of the wig. Position them right in front of your ears. </p>
											<p>Don't worry if it doesn't look perfect right away. Go ahead and style/brush it into place the way you'd like it to look.</p>
											<p>If you still are not sure, go and <a target="_blank" href="{$base_dir}content/19-how-to-apply-a-wig">watch the video</a> then.</p>
									</div>
									<h4 class="uk-accordion-title">1.10 How should I care for my wigs?</h4>
									<div class="uk-accordion-content">
											<p>Looking after your human hair wigs is very important in order to increase the life of them. You may like to follow <a target="_blank" href="{$base_dir}content/36-care-instructions-for-wigs">these steps</a> to better protect your human hair wigs.</p>
									</div>
									<h4 class="uk-accordion-title">1.11 Do you have baby hairs on your wigs?</h4>
									<div class="uk-accordion-content">
											<p>
												Yes. Both our human hair wigs and synthetic wigs have baby hairs on the front and at the back of the wigs. Here are two pics showing how the baby hairs look like.
											</p>
											<p><img src="{$img_dir}cms/1.11.jpg"></p>
									</div>
									<h4 class="uk-accordion-title">1.12 Will I look natural with the human hair wig?</h4>
									<div class="uk-accordion-content">
											<p>
												Yes, you will look very natural with our lace wigs because firstly the hair is hand-tied to the lace which will make the hair look exactly like growing from your head. 
											</p>
											<p><img src="{$img_dir}cms/1.12-1.jpg"></p>
											<p>
												Secondly, the hairline of our human hair wigs is very natural as if they are your own scalp which you will see from the pic below:
											</p>
											<p><img src="{$img_dir}cms/1.12-2.jpg"></p>
									</div>
							</div>
						{/if}
						{if $category->id == '103' or $category->id == '106' or $category->id == '107' or $category->id == '108' or $category->id == '109' or $category->id == '40439' or $category->id == '40442' or $category->id == '40457'}
							<div class="uk-accordion" data-uk-accordion>
									<h4 class="uk-accordion-title">2.1 What types of hair extensions do you have?</h4>
									<div class="uk-accordion-content">
											<p>We have 4 kinds of hair extensions at UniWigs, including:</p>
											<p>
											1. Clip-in hair extensions<br/>
											2. Flip-in hair extensions<br/>
											3. Tape hair extensions<br/>
											4. Hair Weft Extensions<br/>
											</p>
									</div>
									<h4 class="uk-accordion-title">2.2 Can my hair extensions be straightened, curled and or colored?</h4>
									<div class="uk-accordion-content">
											<p>Of course you can if you have our Human hair wigs for the ultimate styling versatility - you can curl or straighten them as you would do to your own hair. Again, the less heat or colorant you use the better.</p>
											<p>However, Synthetic wigs can be irreparably damaged if you try to curl or straighten the hair with heat tools.</p>
											<p>For coloring, you can color the natural color products into any color you like. But, for other colored hair products, we do not recommend to repeatedly color as this may cause extreme damage. If you still want to color them, please ask a professional stylist to do the coloring, and usually only make lighter colors to darker, but avoid trying to turn darker colored wigs into lighter colors.</p>
									</div>
									<h4 class="uk-accordion-title">2.3 How do I apply clip-in hair extensions?</h4>
									<div class="uk-accordion-content">
											<p>Here is a step by step pic advising you how to put on flip-in hair extensions:</p>
											<img src="{$img_dir}cms/how-to-wear-clip-in.jpg">
									</div>
									<h4 class="uk-accordion-title">2.4 How do I apply flip-in hair extensions?</h4>
									<div class="uk-accordion-content">
											<p>Here is a step by step pic advising you how to put on flip-in hair extensions:</p>
											<img src="{$img_dir}cms/flip-in.jpg" width="100%">
									</div>
									<h4 class="uk-accordion-title">2.5 How do I apply tape hair extensions?</h4>
									<div class="uk-accordion-content">
											<p>Here is a step by step pic advising you how to put on tape hair extensions:</p>
											<img src="{$img_dir}cms/how-to-apply-tape_in_extensions.jpg">
									</div>
									<h4 class="uk-accordion-title">2.6 How should I care for my hair extensions?</h4>
									<div class="uk-accordion-content">
											<p>Please <a target="_blank" href="{$base_dir}content/37-care-instructions-for-hair-extensions">click here</a> to check out the care tips.</p>
									</div>
							</div>
						{/if}
					</div>
				</div>	

				<div class="porduct_desc uk-margin-small-top">
					<ul class="uk-tab" data-uk-tab="{literal}{connect:'#tab-content'}{/literal}" data-uk-switcher="{literal}{connect:'#tab-content', animation: 'fade'}{/literal}">
						{if $category->id == '40441'}
						<li><a href="#" id="Description_product">Description</a></li>
						{else}
						<li><a href="#" id="Feature_product">Features</a></li>
						<li><a href="#" id="Description_product">Description</a></li>
						{/if}
					</ul>
					<ul id="tab-content" class="uk-switcher uk-margin-small-top">
						{if $category->id == '40441'}
							<li>
								<div class="pr-details" itemprop="description">
									{$product->description}
								</div>
							</li>
						{else}
							<li>
								{if isset($features) && $features}
									<!-- features -->
									<table class="table-data-sheet uk-table uk-table-striped text-info">
										{foreach from=$features item=feature}
										<tr class="{cycle values="odd,even"}">
											{if isset($feature.value)}
											<td>{$feature.name|escape:'html':'UTF-8'}</td>
											<td>{$feature.value|escape:'html':'UTF-8'}
												{if  $feature.mtitle }
												({$feature.mtitle|escape:'html':'UTF-8'})
												{/if}

											</td>
											{/if}
										</tr>
										{/foreach}
									</table>
									
									<!--end features -->
								{/if}
							</li>
							<li>
								<div class="pr-details" itemprop="description">
									{$product->description}
								</div>
							</li>
						{/if}
					</ul>
					
				</div>
			</form>
			{/if}
		</div> <!-- end pb-right-column-->
	</div> <!-- end primary_block -->
	{if !$content_only}
		{if isset($accessories) && $accessories}
			<!--Accessories -->
			<section class="title-hr">
				<h3 class="">{l s='Accessories'}</h3>
				<p class="hr"></p>
				<div class="block products_block accessories-block clearfix">
					<div class="block_content">
						<ul id="bxslider" class="bxslider clearfix">
							{foreach from=$accessories item=accessory name=accessories_list}
								{if ($accessory.allow_oosp || $accessory.quantity_all_versions > 0 || $accessory.quantity > 0) && $accessory.available_for_order && !isset($restricted_country_mode)}
									{assign var='accessoryLink' value=$link->getProductLink($accessory.id_product, $accessory.link_rewrite, $accessory.category)}
									<li class="item product-box ajax_block_product{if $smarty.foreach.accessories_list.first} first_item{elseif $smarty.foreach.accessories_list.last} last_item{else} item{/if} product_accessories_description">
										<div class="product_desc">
											<a href="{$accessoryLink|escape:'html':'UTF-8'}" title="{$accessory.legend|escape:'html':'UTF-8'}" class="product-image product_image">
												<img class="lazyOwl" src="{$link->getImageLink($accessory.link_rewrite, $accessory.id_image, 'home_default')|escape:'html':'UTF-8'}" alt="{$accessory.legend|escape:'html':'UTF-8'}" width="{$homeSize.width}" height="{$homeSize.height}"/>
											</a>
											<div class="block_description">
												<a href="{$accessoryLink|escape:'html':'UTF-8'}" title="{l s='More'}" class="product_description">
													{$accessory.description_short|strip_tags|truncate:25:'...'}
												</a>
											</div>
										</div>
										<div class="s_title_block">
											<h5 itemprop="name" class="product-name">
												<a href="{$accessoryLink|escape:'html':'UTF-8'}">
													{$accessory.name|truncate:50:'...':true|escape:'html':'UTF-8'}
												</a>
											</h5>
											{if $accessory.show_price && !isset($restricted_country_mode) && !$PS_CATALOG_MODE}
											<span class="price">
												{if $priceDisplay != 1}
													{displayWtPrice p=$accessory.price}
												{else}
													{displayWtPrice p=$accessory.price_tax_exc}
												{/if}
												{hook h="displayProductPriceBlock" product=$accessory type="price"}
											</span>
											{/if}
											{hook h="displayProductPriceBlock" product=$accessory type="after_price"}
										</div>
										<div class="clearfix" style="margin-top:5px">
											{if !$PS_CATALOG_MODE && ($accessory.allow_oosp || $accessory.quantity > 0)}
												<div class="no-print">
													<a class="exclusive btn btn-default button button-medium ajax_add_to_cart_button" href="{$link->getPageLink('cart', true, NULL, "qty=1&amp;id_product={$accessory.id_product|intval}&amp;token={$static_token}&amp;add")|escape:'html':'UTF-8'}" data-id-product="{$accessory.id_product|intval}" title="{l s='Add to cart'}">
														<span>{l s='Add to cart'}</span>
													</a>
												</div>
											{/if}
										</div>
									</li>
								{/if}
							{/foreach}
						</ul>
					</div>
				</div>
			</section>
			<!--end Accessories -->
		{/if}
		{if (isset($quantity_discounts) && count($quantity_discounts) > 0)}
			<!-- quantity discount -->
			<section class="page-product-box">
				<h3 class="page-product-heading">{l s='Volume discounts'}</h3>
				<div id="quantityDiscount">
					<table class="std table-product-discounts">
						<thead>
							<tr>
								<th>{l s='Quantity'}</th>
								<th>{if $display_discount_price}{l s='Price'}{else}{l s='Discount'}{/if}</th>
								<th>{l s='You Save'}</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$quantity_discounts item='quantity_discount' name='quantity_discounts'}
							<tr id="quantityDiscount_{$quantity_discount.id_product_attribute}" class="quantityDiscount_{$quantity_discount.id_product_attribute}" data-discount-type="{$quantity_discount.reduction_type}" data-discount="{$quantity_discount.real_value|floatval}" data-discount-quantity="{$quantity_discount.quantity|intval}">
								<td>
									{$quantity_discount.quantity|intval}
								</td>
								<td>
									{if $quantity_discount.price >= 0 || $quantity_discount.reduction_type == 'amount'}
										{if $display_discount_price}
											{if $quantity_discount.reduction_tax == 0 && !$quantity_discount.price}
												{convertPrice price = $productPriceWithoutReduction|floatval-($productPriceWithoutReduction*$quantity_discount.reduction_with_tax)|floatval}
											{else}
												{convertPrice price=$productPriceWithoutReduction|floatval-$quantity_discount.real_value|floatval}
											{/if}
										{else}
											{convertPrice price=$quantity_discount.real_value|floatval}
										{/if}
									{else}
										{if $display_discount_price}
											{if $quantity_discount.reduction_tax == 0}
												{convertPrice price = $productPriceWithoutReduction|floatval-($productPriceWithoutReduction*$quantity_discount.reduction_with_tax)|floatval}
											{else}
												{convertPrice price = $productPriceWithoutReduction|floatval-($productPriceWithoutReduction*$quantity_discount.reduction)|floatval}
											{/if}
										{else}
											{$quantity_discount.real_value|floatval}%
										{/if}
									{/if}
								</td>
								<td>
									<span>{l s='Up to'}</span>
									{if $quantity_discount.price >= 0 || $quantity_discount.reduction_type == 'amount'}
										{$discountPrice=$productPriceWithoutReduction|floatval-$quantity_discount.real_value|floatval}
									{else}
										{$discountPrice=$productPriceWithoutReduction|floatval-($productPriceWithoutReduction*$quantity_discount.reduction)|floatval}
									{/if}
									{$discountPrice=$discountPrice * $quantity_discount.quantity}
									{$qtyProductPrice=$productPriceWithoutReduction|floatval * $quantity_discount.quantity}
									{convertPrice price=$qtyProductPrice - $discountPrice}
								</td>
							</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
			</section>
		{/if}

		{$PRODUCT_REVIEWS}

		<!-- product comments -->
		<script type="text/javascript">
			$(function() {
				var mc = {if isset($main_category)}'{$main_category}'{else}''{/if};
				var cc = {if isset($curr_category)}'{$curr_category}'{else}''{/if};
				var cusid = {if $cookie->id_customer}{$cookie->id_customer}{else}0{/if};
				var hasbt = {if isset($has_bought)}{$has_bought}{else}0{/if};
				window.load_video_image_list = function(){
					$.get("http://rvm.uniwigs.com/api_review3/list",{
						prdid:id_product,
						prdsku:productReference,
						mc:mc,
						cc:cc
					},function(data){
						$(".video_image_list").html(data);
						$('.product_customer_reviews').addClass('loaded');
					});
				}
				load_video_image_list();

				window.load_comment_list = function(){
					$.get("http://rvm.uniwigs.com/api_review3/comments",{
						prdid:id_product,
						prdsku:productReference,
						cusid:cusid,
						hasbt:hasbt
					},function(data){
						$(".comments_container").html(data);
						$('.product_customer_reviews').addClass('loaded');
					});
				}
				load_comment_list();

				window.review_content_ready = function(){
					$('.page a').click(function(){
						topage = $(this).attr('topage');
						$.get("http://rvm.uniwigs.com/api_review3/comments",{
							prdid:id_product,
							prdsku:productReference,
							cusid:cusid,
							hasbt:hasbt,
							page:topage
							},function(data){
								$(".comments_container").html(data);
							}
						);
					});

					$(".reply_item_content").hover(function(){
						$(this).find(".reviews_content_reply a").show();
					}, function() {
						$(this).find(".reviews_content_reply a").hide();
					});
				    $(".reviews_content_reply a").click(function(e){
			            $(this.parentNode).next().toggle(0,function(){
			                $(this).parents('div').siblings().find('.replay-form').hide();
			            });
			            e.preventDefault();
				    });
				}

				//window.submitCommetTail = function(data){
				window.reciveMsg_addcomment = function(data){
					if (data['status']==0) {
						alert(data['msg']);
						$('.review_btn').show();
						$('#btnSubmitComment').unbind('click');
					} else {
						load_comment_list();
					}
				}

				window.load_product_stat_data = function(){
					$.get("http://rvm.uniwigs.com/api_review3/product_stat_data",{
						prdid:id_product,
						prdsku:productReference
					},function(data){
						eval('data='+data);
						$("#review_count").text(data.review_count);
						if (data.review_count >= 1) {
							$(".price-star span.star").css('width',data.review_rating/5*100+'%');
							$("#like_count").text(data.like_count);
							$(".price-star").removeClass('hide');
						}
					});
				}
				load_product_stat_data();
			});
		</script>
		<div id="product_reviews" class="product_customer_reviews title-hr">
			<h3>SHOW & COMMENTS</h3>
			<p class="hr"></p>
			<div class="row">
				<div class="comments_photo col-sm-8 uk-margin-top">
					<div class="comments-title"><h4>Customer Comments</h4><span class="text-muted">! Products can comment only after purchase</span></div>
					
					<div class="comments_container"></div>
				</div>
				<div class="video_image_list col-sm-4"></div>
			</div>
		</div>



		{if isset($packItems) && $packItems|@count > 0}
		<section id="blockpack">
			<h3 class="page-product-heading">{l s='Pack content'}</h3>
			{include file="$tpl_dir./product-list.tpl" products=$packItems}
		</section>
		{/if}
		<!--HOOK_PRODUCT_TAB -->
		{*<section class="page-product-box title-hr uk-margin-top">
			{$HOOK_PRODUCT_TAB}
			{if isset($HOOK_PRODUCT_TAB_CONTENT) && $HOOK_PRODUCT_TAB_CONTENT}{$HOOK_PRODUCT_TAB_CONTENT}{/if}
		</section>*}
		<!--end HOOK_PRODUCT_TAB -->

		{if isset($HOOK_PRODUCT_FOOTER) && $HOOK_PRODUCT_FOOTER}{$HOOK_PRODUCT_FOOTER}{/if}
		<!-- description & features -->
		{if (isset($product) && $product->description) || (isset($features) && $features) || (isset($accessories) && $accessories) || (isset($HOOK_PRODUCT_TAB) && $HOOK_PRODUCT_TAB) || (isset($attachments) && $attachments) || isset($product) && $product->customizable}
			{if isset($attachments) && $attachments}
			<!--Download -->
			<section class="page-product-box">
				<h3 class="page-product-heading">{l s='Download'}</h3>
				{foreach from=$attachments item=attachment name=attachements}
					{if $smarty.foreach.attachements.iteration %3 == 1}<div class="row">{/if}
						<div class="col-lg-4">
							<h4><a href="{$link->getPageLink('attachment', true, NULL, "id_attachment={$attachment.id_attachment}")|escape:'html':'UTF-8'}">{$attachment.name|escape:'html':'UTF-8'}</a></h4>
							<p class="text-muted">{$attachment.description|escape:'html':'UTF-8'}</p>
							<a class="btn btn-default btn-block" href="{$link->getPageLink('attachment', true, NULL, "id_attachment={$attachment.id_attachment}")|escape:'html':'UTF-8'}">
								<i class="icon-download"></i>
								{l s="Download"} ({Tools::formatBytes($attachment.file_size, 2)})
							</a>
							<hr />
						</div>
					{if $smarty.foreach.attachements.iteration %3 == 0 || $smarty.foreach.attachements.last}</div>{/if}
				{/foreach}
			</section>
			<!--end Download -->
			{/if}

			{*if isset($product) && $product->customizable}
			<!--Customization -->
			<section class="page-product-box">
				<h3 class="page-product-heading">{l s='Product customization'}</h3>
				<!-- Customizable products -->
				<form method="post" action="{$customizationFormTarget}" enctype="multipart/form-data" id="customizationForm" class="clearfix">
					<p class="infoCustomizable">
						{l s='After saving your customized product, remember to add it to your cart.'}
						{if $product->uploadable_files}
						<br />
						{l s='Allowed file formats are: GIF, JPG, PNG'}{/if}
					</p>
					{if $product->uploadable_files|intval}
						<div class="customizableProductsFile">
							<h5 class="product-heading-h5">{l s='Pictures'}</h5>
							<ul id="uploadable_files" class="clearfix">
								{counter start=0 assign='customizationField'}
								{foreach from=$customizationFields item='field' name='customizationFields'}
									{if $field.type == 0}
										<li class="customizationUploadLine{if $field.required} required{/if}">{assign var='key' value='pictures_'|cat:$product->id|cat:'_'|cat:$field.id_customization_field}
											{if isset($pictures.$key)}
												<div class="customizationUploadBrowse">
													<img src="{$pic_dir}{$pictures.$key}_small" alt="" />
														<a href="{$link->getProductDeletePictureLink($product, $field.id_customization_field)|escape:'html':'UTF-8'}" title="{l s='Delete'}" >
															<img src="{$img_dir}icon/delete.gif" alt="{l s='Delete'}" class="customization_delete_icon" width="11" height="13" />
														</a>
												</div>
											{/if}
											<div class="customizationUploadBrowse form-group">
												<label class="customizationUploadBrowseDescription">
													{if !empty($field.name)}
														{$field.name}
													{else}
														{l s='Please select an image file from your computer'}
													{/if}
													{if $field.required}<sup>*</sup>{/if}
												</label>
												<input type="file" name="file{$field.id_customization_field}" id="img{$customizationField}" class="form-control customization_block_input {if isset($pictures.$key)}filled{/if}" />
											</div>
										</li>
										{counter}
									{/if}
								{/foreach}
							</ul>
						</div>
					{/if}
					{if $product->text_fields|intval}
						<div class="customizableProductsText">
							<h5 class="product-heading-h5">{l s='Text'}</h5>
							<ul id="text_fields">
							{counter start=0 assign='customizationField'}
							{foreach from=$customizationFields item='field' name='customizationFields'}
								{if $field.type == 1}
									<li class="customizationUploadLine{if $field.required} required{/if}">
										<label for ="textField{$customizationField}">
											{assign var='key' value='textFields_'|cat:$product->id|cat:'_'|cat:$field.id_customization_field}
											{if !empty($field.name)}
												{$field.name}
											{/if}
											{if $field.required}<sup>*</sup>{/if}
										</label>
										<textarea name="textField{$field.id_customization_field}" class="form-control customization_block_input" id="textField{$customizationField}" rows="3" cols="20">{strip}
											{if isset($textFields.$key)}
												{$textFields.$key|stripslashes}
											{/if}
										{/strip}</textarea>
									</li>
									{counter}
								{/if}
							{/foreach}
							</ul>
						</div>
					{/if}
					<p id="customizedDatas">
						<input type="hidden" name="quantityBackup" id="quantityBackup" value="" />
						<input type="hidden" name="submitCustomizedDatas" value="1" />
						<button class="button btn btn-default button button-small" name="saveCustomization">
							<span>{l s='Save'}</span>
						</button>
						<span id="ajax-loader" class="unvisible">
							<img src="{$img_ps_dir}loader.gif" alt="loader" />
						</span>
					</p>
				</form>
				<p class="clear required"><sup>*</sup> {l s='required fields'}</p>
			</section>
			<!--end Customization -->
			{/if*}
		{/if}
	{/if}
</div> <!-- itemscope product wrapper -->
<script type="text/javascript" src="/themes/uniwigs2016/js/accordion.min.js"></script>
<script type="text/javascript" src="/themes/uniwigs2016/js/lightbox.js"></script>
{strip}
{if isset($smarty.get.ad) && $smarty.get.ad}
	{addJsDefL name=ad}{$base_dir|cat:$smarty.get.ad|escape:'html':'UTF-8'}{/addJsDefL}
{/if}
{if isset($smarty.get.adtoken) && $smarty.get.adtoken}
	{addJsDefL name=adtoken}{$smarty.get.adtoken|escape:'html':'UTF-8'}{/addJsDefL}
{/if}
{addJsDef allowBuyWhenOutOfStock=$allow_oosp|boolval}
{addJsDef availableNowValue=$product->available_now|escape:'quotes':'UTF-8'}
{addJsDef availableLaterValue=$product->available_later|escape:'quotes':'UTF-8'}
{addJsDef attribute_anchor_separator=$attribute_anchor_separator|escape:'quotes':'UTF-8'}
{addJsDef attributesCombinations=$attributesCombinations}
{addJsDef currentDate=$smarty.now|date_format:'%Y-%m-%d %H:%M:%S'}
{if isset($combinations) && $combinations}
	{addJsDef combinations=$combinations}
	{addJsDef combinationsFromController=$combinations}
	{addJsDef displayDiscountPrice=$display_discount_price}
	{addJsDefL name='upToTxt'}{l s='Up to' js=1}{/addJsDefL}
{/if}
{if isset($combinationImages) && $combinationImages}
	{addJsDef combinationImages=$combinationImages}
{/if}
{addJsDef customizationId=$id_customization}
{addJsDef customizationFields=$customizationFields}
{addJsDef default_eco_tax=$product->ecotax|floatval}
{addJsDef displayPrice=$priceDisplay|intval}
{addJsDef ecotaxTax_rate=$ecotaxTax_rate|floatval}
{if isset($cover.id_image_only)}
	{addJsDef idDefaultImage=$cover.id_image_only|intval}
{else}
	{addJsDef idDefaultImage=0}
{/if}
{addJsDef img_ps_dir=$img_ps_dir}
{addJsDef img_prod_dir=$img_prod_dir}
{addJsDef id_product=$product->id|intval}
{addJsDef jqZoomEnabled=$jqZoomEnabled|boolval}
{addJsDef maxQuantityToAllowDisplayOfLastQuantityMessage=$last_qties|intval}
{addJsDef minimalQuantity=$product->minimal_quantity|intval}
{addJsDef noTaxForThisProduct=$no_tax|boolval}
{if isset($customer_group_without_tax)}
	{addJsDef customerGroupWithoutTax=$customer_group_without_tax|boolval}
{else}
	{addJsDef customerGroupWithoutTax=false}
{/if}
{if isset($group_reduction)}
	{addJsDef groupReduction=$group_reduction|floatval}
{else}
	{addJsDef groupReduction=false}
{/if}
{addJsDef oosHookJsCodeFunctions=Array()}
{addJsDef productHasAttributes=isset($groups)|boolval}
{addJsDef productPriceTaxExcluded=($product->getPriceWithoutReduct(true)|default:'null' - $product->ecotax)|floatval}
{addJsDef productPriceTaxIncluded=($product->getPriceWithoutReduct(false)|default:'null' - $product->ecotax * (1 + $ecotaxTax_rate / 100))|floatval}
{addJsDef productBasePriceTaxExcluded=($product->getPrice(false, null, 6, null, false, false) - $product->ecotax)|floatval}
{addJsDef productBasePriceTaxExcl=($product->getPrice(false, null, 6, null, false, false)|floatval)}
{addJsDef productBasePriceTaxIncl=($product->getPrice(true, null, 6, null, false, false)|floatval)}
{addJsDef productReference=$product->reference|escape:'html':'UTF-8'}
{addJsDef productAvailableForOrder=$product->available_for_order|boolval}
{addJsDef productPriceWithoutReduction=$productPriceWithoutReduction|floatval}
{addJsDef productPrice=$productPrice|floatval}
{addJsDef productUnitPriceRatio=$product->unit_price_ratio|floatval}
{addJsDef productShowPrice=(!$PS_CATALOG_MODE && $product->show_price)|boolval}
{addJsDef PS_CATALOG_MODE=$PS_CATALOG_MODE}
{if $product->specificPrice && $product->specificPrice|@count}
	{addJsDef product_specific_price=$product->specificPrice}
{else}
	{addJsDef product_specific_price=array()}
{/if}
{if $display_qties == 1 && $product->quantity}
	{addJsDef quantityAvailable=$product->quantity}
{else}
	{addJsDef quantityAvailable=0}
{/if}
{addJsDef quantitiesDisplayAllowed=$display_qties|boolval}
{if $product->specificPrice && $product->specificPrice.reduction && $product->specificPrice.reduction_type == 'percentage'}
	{addJsDef reduction_percent=$product->specificPrice.reduction*100|floatval}
{else}
	{addJsDef reduction_percent=0}
{/if}
{if $product->specificPrice && $product->specificPrice.reduction && $product->specificPrice.reduction_type == 'amount'}
	{addJsDef reduction_price=$product->specificPrice.reduction|floatval}
{else}
	{addJsDef reduction_price=0}
{/if}
{if $product->specificPrice && $product->specificPrice.price}
	{addJsDef specific_price=$product->specificPrice.price|floatval}
{else}
	{addJsDef specific_price=0}
{/if}
{addJsDef specific_currency=($product->specificPrice && $product->specificPrice.id_currency)|boolval} {* TODO: remove if always false *}
{addJsDef stock_management=$PS_STOCK_MANAGEMENT|intval}
{addJsDef taxRate=$tax_rate|floatval}
{addJsDefL name=doesntExist}{l s='This combination does not exist for this product. Please select another combination.' js=1}{/addJsDefL}
{addJsDefL name=doesntExistNoMore}{l s='This product is no longer in stock' js=1}{/addJsDefL}
{addJsDefL name=doesntExistNoMoreBut}{l s='with those attributes but is available with others.' js=1}{/addJsDefL}
{addJsDefL name=fieldRequired}{l s='Please fill in all the required fields before saving your customization.' js=1}{/addJsDefL}
{addJsDefL name=uploading_in_progress}{l s='Uploading in progress, please be patient.' js=1}{/addJsDefL}
{addJsDefL name='product_fileDefaultHtml'}{l s='No file selected' js=1}{/addJsDefL}
{addJsDefL name='product_fileButtonHtml'}{l s='Choose File' js=1}{/addJsDefL}
{/strip}
{/if}
{if isset($googleJs)}
{$googleJs}
{/if}