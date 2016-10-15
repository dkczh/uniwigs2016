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
<script type="text/javascript" src="/themes/uniwigs2016-m/js/lightbox.js"></script>
<script type="text/javascript" src="/themes/uniwigs2016-m/js/touchCarousel.js"></script>
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
		<div class="pb-left-column">
			<!-- product img-->
			{*<div id="image-block" class="clearfix">
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
								<img itemprop="image" src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'large_default')|escape:'html':'UTF-8'}" title="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" alt="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}"/>
							</a>
						{else}
							<img id="bigpic" itemprop="image" src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'large_default')|escape:'html':'UTF-8'}" title="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" alt="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" width="{$largeSize.width}" height="{$largeSize.height}"/>
							
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
			</div>*} <!-- end image-block -->
			<div class="goods_img" data-snap-ignore="true">
				<div id="carousel" class="carousel touchcarousel">
					<ul class="touchcarousel-container">
						{if isset($images)}
							{foreach from=$images key=key item=image name=thumbnails}
								{assign var=imageIds value="`$product->id`-`$image.id_image`"}
								{if !empty($image.legend)}
									{assign var=imageTitle value=$image.legend|escape:'html':'UTF-8'}
								{else}
									{assign var=imageTitle value=$product->name|escape:'html':'UTF-8'}
								{/if}
								<li class="touchcarousel-item">
									{if $key==0}
									<img class="img-responsive" src="{$link->getImageLink($product->link_rewrite, $imageIds, 'large_default')|escape:'html':'UTF-8'}" alt="{$imageTitle}" title="{$imageTitle}"{if isset($cartSize)} height="{$cartSize.height}" width="{$cartSize.width}"{/if} itemprop="image" />
									{else}
									<img class="img-responsive" src="/themes/uniwigs2016-m/img/milanoo_blank.gif" original="{$link->getImageLink($product->link_rewrite, $imageIds, 'large_default')|escape:'html':'UTF-8'}" alt="{$imageTitle}" title="{$imageTitle}"{if isset($cartSize)} height="{$cartSize.height}" width="{$cartSize.width}"{/if} itemprop="image" />
									{/if}
									
								</li>
							{/foreach}
						{/if}
					</ul>
				</div>
				{*<div class="goods_num">
					<span class="current_index">1</span>/{$images|@count}
				</div>*}
			</div>

			
			{*if isset($images) && count($images) > 0}
				<!-- thumbnails -->
				<div id="views_block" class="clearfix {if isset($images) && count($images) < 2}hidden{/if}">
					{if isset($images) && count($images) > 2}
						<span class="view_scroll_spacer">
							<a id="view_scroll_left" class="" title="{l s='Other views'}" href="javascript:{ldelim}{rdelim}">
								{l s='Previous'}
							</a>
						</span>
					{/if}
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
								<li id="thumbnail_{$image.id_image}" class="last">
									<a href="javascript:void(0);" class="" title="{$imageTitle}">
										<img class="img-responsive" id="thumb_{$image.id_image}" src="{$link->getImageLink($product->link_rewrite, $imageIds, 'large_default')|escape:'html':'UTF-8'}" alt="{$imageTitle}" title="{$imageTitle}"{if isset($cartSize)} height="{$cartSize.height}" width="{$cartSize.width}"{/if} itemprop="image" />
									</a>
								</li>
							{/foreach}
						{/if}
						</ul>
					</div> <!-- end thumbs_list -->
					{if isset($images) && count($images) > 2}
						<a id="view_scroll_right" title="{l s='Other views'}" href="javascript:{ldelim}{rdelim}">
							{l s='Next'}
						</a>
					{/if}
				</div> <!-- end views-block -->
				<!-- end thumbnails -->
			{/if*}
			{*if isset($images) && count($images) > 1}
				<p class="resetimg clear no-print">
					<span id="wrapResetImages" style="display: none;">
						<a href="{$link->getProductLink($product)|escape:'html':'UTF-8'}" data-id="resetImages">
							<i class="icon-repeat"></i>
							{l s='Display all pictures'}
						</a>
					</span>
				</p>
			{/if*}
		</div> <!-- end pb-left-column -->
		<!-- end left infos-->
		<!-- center infos -->
		<div class="pb-center-column">
			{if $product->online_only}
				<p class="online_only">{l s='Online only'}</p>
			{/if}
			<h1 itemprop="name">{$product->name|escape:'html':'UTF-8'}</h1>
			<p id="product_reference_a" class="text-center"{if empty($product->reference) || !$product->reference} style="display: none;"{/if}>
				<label>{l s='SKU:'} </label>
				<span class="editable" itemprop="sku"{if !empty($product->reference) && $product->reference} content="{$product->reference}"{/if}>
					{$product->reference|escape:'html':'UTF-8'}
				</span>
			</p>
			
			{if ($display_qties == 1 && !$PS_CATALOG_MODE && $PS_STOCK_MANAGEMENT && $product->available_for_order)}
				<!-- number of item in stock -->
				<p id="pQuantityAvailable"{if $product->quantity <= 0} style="display: none;"{/if}>
					<span id="quantityAvailable">{$product->quantity|intval}</span>
					<span {if $product->quantity > 1} style="display: none;"{/if} id="quantityAvailableTxt">{l s='Product'}</span>
					<span {if $product->quantity == 1} style="display: none;"{/if} id="quantityAvailableTxtMultiple">{l s='Products'}</span>
				</p>
			{/if}
			<!-- availability or doesntExist -->
			<p id="availability_statut"{if !$PS_STOCK_MANAGEMENT || ($product->quantity <= 0 && !$product->available_later && $allow_oosp) || ($product->quantity > 0 && !$product->available_now) || !$product->available_for_order || $PS_CATALOG_MODE} style="display: none;"{/if}>
				{*<span id="availability_label">{l s='Availability:'}</span>*}
				<span id="availability_value" class="label{if $product->quantity <= 0 && !$allow_oosp} label-danger{elseif $product->quantity <= 0} label-warning{else} label-success{/if}">{if $product->quantity <= 0}{if $PS_STOCK_MANAGEMENT && $allow_oosp}{$product->available_later}{else}{l s='This product is no longer in stock'}{/if}{elseif $PS_STOCK_MANAGEMENT}{$product->available_now}{/if}</span>
			</p>
			{if $PS_STOCK_MANAGEMENT}
				{if !$product->is_virtual}{hook h="displayProductDeliveryTime" product=$product}{/if}
				<p class="warning_inline" id="last_quantities"{if ($product->quantity > $last_qties || $product->quantity <= 0) || $allow_oosp || !$product->available_for_order || $PS_CATALOG_MODE} style="display: none"{/if} >{l s='Warning: Last items in stock!'}</p>
			{/if}
			<p id="availability_date"{if ($product->quantity > 0) || !$product->available_for_order || $PS_CATALOG_MODE || !isset($product->available_date) || $product->available_date < $smarty.now|date_format:'%Y-%m-%d'} style="display: none;"{/if}>
				<span id="availability_date_label">{l s='Availability date:'}</span>
				<span id="availability_date_value">{if Validate::isDate($product->available_date)}{dateFormat date=$product->available_date full=false}{/if}</span>
			</p>
			<!-- Out of stock hook -->
			<div id="oosHook"{if $product->quantity > 0} style="display: none;"{/if}>
				{$HOOK_PRODUCT_OOS}
			</div>
			
			{if isset($HOOK_EXTRA_RIGHT) && $HOOK_EXTRA_RIGHT}{$HOOK_EXTRA_RIGHT}{/if}
			
		</div>
		<!-- end center infos-->
		<!-- pb-right-column-->
		<div class="pb-right-column">
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
					<div class="content_prices clearfix">
						{if $product->show_price && !isset($restricted_country_mode) && !$PS_CATALOG_MODE}
							<!-- prices -->
							<div>
								<p class="our_price_display text-center" itemprop="offers" itemscope itemtype="https://schema.org/Offer">{strip}
								{if $product->quantity > 0}<link itemprop="availability" href="https://schema.org/InStock"/>{/if}
								{if $priceDisplay >= 0 && $priceDisplay <= 2}
									<span id="our_price_display" class="now_sprice" itemprop="price" content="{$productPrice}">{convertPrice price=$productPrice|floatval}</span>
									<meta itemprop="priceCurrency" content="{$currency->iso_code}" />
									{hook h="displayProductPriceBlock" product=$product type="price"}
								{/if}
								<span id="old_price"{if (!$product->specificPrice || !$product->specificPrice.reduction)} class="hidden"{/if}>{strip}
								{if $priceDisplay >= 0 && $priceDisplay <= 2}
									{hook h="displayProductPriceBlock" product=$product type="old_price"}
									<span id="old_price_display"><span class="price">{if $productPriceWithoutReduction > $productPrice}{convertPrice price=$productPriceWithoutReduction|floatval}{/if}</span></span>
								{/if}
									{/strip}
								</span>
									{/strip}
								</p>
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
							{if $product->id =='40817'}
								<p class="text-primary text-center" style="color:#920783">
									Youtube Guru Highly Recommend!&nbsp;&nbsp;30% OFF!&nbsp;&nbsp;Coupon: LS0011
								</p>
							{/if}
							{if $product->id =='41377'}
								<p class="text-primary text-center" style="color:#920783">
									<a href="#new-arrival-synthetic" data-uk-modal>
									<span>New Arrival for Presale!&nbsp;&nbsp;30% OFF!</span><br>
									<span>Only 30 Lucky Girls Can Have It</span><br>
									<span>Coupon: BLUE30</span>
									</a>
								</p>
								<div id="new-arrival-synthetic" class="uk-modal">
									 <div class="uk-modal-dialog">
								        <a class="uk-modal-close uk-close"></a>
								        <img src="{$base_dir}themes/uniwigs2016/img/category/synthetic/new-m.png" alt="New Arrival For Presale" class="img-responsive">
								    </div>
								</div>
							{/if}
							<p class="uk-margin-small-bottom text-center"><a href="#product_free_shipping_info" data-uk-modal class="product_free_shipping">Free Shipping US *</a></p>
							<div id="product_free_shipping_info" class="uk-modal">
							    <div class="uk-modal-dialog img-responsive">
							        <a href="#" class="uk-modal-close uk-close"></a>
							        <p class="uk-text-bold text-primary">365 days of the year, we offer Free US Ground Shipping for all orders over $49.</p>
							        <h4 class="uk-margin-top">US DOMESTIC SHIPPING</h4>
							        <div class="uk-overflow-container">
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
							        </div>
							        <h4 class="uk-margin-top">INTERNATIONAL SHIPPING</h4>
							        <div class="uk-overflow-container">
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
								    </div>
								</div>
							</div>
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

					<div class="product_attributes clearfix">
						<div class="jump_options clearfix">
							{if isset($HOOK_PRODUCT_ASSOCIATIONS) && $HOOK_PRODUCT_ASSOCIATIONS}{$HOOK_PRODUCT_ASSOCIATIONS}{/if}
						</div>
						{if isset($groups)}
							<!-- attributes -->
							<div id="attributes">
								<div class="clearfix"></div>
								{foreach from=$groups key=id_attribute_group item=group}
									{if $group.attributes|@count}
										<fieldset class="attribute_fieldset">
											<label class="attribute_label {if $group.group_type == 'color'}color_label{/if}" {if $group.group_type != 'color' && $group.group_type != 'radio'}for="group_{$id_attribute_group|intval}"{/if}>{$group.name|escape:'html':'UTF-8'}&nbsp;&nbsp;<span class="option_result"></span></label>
											{if $group.name|lower == 'front lace size'}
											<a href="#attributes_frontlacesize" data-uk-modal class="highslide">Front Lace Size</a>
											<div id="attributes_frontlacesize" class="uk-modal">
												 <div class="uk-modal-dialog">
											        <a class="uk-modal-close uk-close"></a>
											        <img src="{$base_dir}themes/uniwigs2016/img/products/Front-Lace-Size.jpg" alt="Front Lace Size" class="img-responsive">
											    </div>
											</div>
											{/if}
											{if $group.name|lower == 'hairline'}
											<a href="#attributes_hairline" data-uk-modal class="highslide">Hairline</a>
											<div id="attributes_hairline" class="uk-modal">
												 <div class="uk-modal-dialog">
											        <a class="uk-modal-close uk-close"></a>
											        <img src="{$base_dir}themes/uniwigs2016/img/products/free-part.jpg" alt="Hairline" class="img-responsive">
											    </div>
											</div>
											{/if}
											{if $group.name|lower == 'clip in'}
											<a href="#attributes_clipin" data-uk-modal class="highslide">Clip In</a>
											<div id="attributes_clipin" class="uk-modal">
												 <div class="uk-modal-dialog">
											        <a class="uk-modal-close uk-close"></a>
											        <img src="{$base_dir}themes/uniwigs2016/img/products/clip-in.jpg" alt="Clip In" class="img-responsive">
											    </div>
											</div>
											{/if}
											{if $group.name|lower == 'length'}
											<a href="#attributes_length" data-uk-modal class="highslide">Length & Fit</a>
											<div id="attributes_length" class="uk-modal">
												 <div class="uk-modal-dialog">
											        <a class="uk-modal-close uk-close"></a>
											        <img src="{$base_dir}themes/uniwigs2016/img/products/length.jpg" alt="Length & Fit" class="img-responsive">
											        <img src="{$base_dir}themes/uniwigs2016/img/products/biglayer.png" alt="Length & Fit" class="img-responsive">
											    </div>
											</div>
											{/if}
											{if $group.name|lower == 'cap size'}
											<a href="#attributes_cap_size" data-uk-modal class="highslide">Cap Size</a>
											<div id="attributes_cap_size" class="uk-modal">
												 <div class="uk-modal-dialog">
											        <a class="uk-modal-close uk-close"></a>
											        <img src="{$base_dir}themes/uniwigs2016/img/size-banner.png" alt="Cap Size" class="img-responsive">
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
											        <img src="{$base_dir}themes/uniwigs2016/img/products/dencity.jpg" alt="Density" class="img-responsive">
											    </div>
											</div>
											{/if}
											{if $group.name|lower == 'lace color'}
											<a href="#attributes_lace_color" data-uk-modal class="highslide">lace color</a>
											<div id="attributes_lace_color" class="uk-modal">
												 <div class="uk-modal-dialog">
											        <a class="uk-modal-close uk-close"></a>
											        <img src="{$base_dir}themes/uniwigs2016/img/products/lace-color.jpg" alt="lace color" class="img-responsive">
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
																<img src="/themes/uniwigs2016/img/products/lace-front-cap.jpg" class="img-responsive" alt="lace front cap">
																<p></p>
																<p><em>1.</em> 13” × 3“ Lace front with wefted back.</p>
																<p><em>2.</em> Weft stitched to elastic netting. </p>
																<p><em>3.</em> Adjustable strap allows you to loosen or tighten the cap up to a half inch.</p>
																<p><em>4.</em> Smooth velvet tabs at the nape of the neck.</p>
																<p><span class="round"></span> Invisible finer, durable and softer French lace.</p>
															</li>
															<li class="col-sm-4">
																<h4>FULL LACE (100% HAND-TIED)</h4>
																<img src="/themes/uniwigs2016/img/products/full-lace-cap.jpg" class="img-responsive" alt="full lace cap">
																<p></p>
																<p><em>1.</em> Full lace cap with stretch panel in the crown. The stretch panel gives you an extra half inch for a better fit.</p>
																<p><em>2.</em> Increased hair density along the hairline and at the crown creates a more natural look.</p>
																<p><span class="round"></span> Invisible finer, durable and softer French lace all around.</p>
																<p><span class="round"></span> Uniform mold, standardized size. </p>
															</li>
															<li class="col-sm-4">
																<h4>GLUELESS FULL LACE</h4>
																<img src="/themes/uniwigs2016/img/products/glueless-full-lace-cap.jpg" class="img-responsive" alt="GLUELESS FULL LACE">
																<p></p>
																<p><em>1.</em> Clips and combs attached to the sides near the temple.</p>
																<p><em>2.</em> Increased hair density along the hairline and at the crown creates a more natural look.</p>
																<p><em>3.</em> Full lace cap with stretch at crown and adjustable straps at back.</p>
																<p><span class="round"></span> Invisible finer, durable and softer French lace all around.</p>
																<p><span class="round"></span> Uniform mold, standardized size.  </p>
															</li>
															<li class="col-sm-4">
																<h4>Silk Top FULL LACE (100% HAND-TIED)</h4>
																<img src="/themes/uniwigs2016/img/products/Silk-Top-Full-Lace-Cap.jpg" class="img-responsive" alt="Silk Top FULL LACE (100% HAND-TIED)">
																<p></p>
																<p><em>1.</em> Full lace cap with 4"x4" Silk top in front. 4”*4” Silk Top provide the most realistic scalp, like the hair is growing out of your scalp.</p>
																<p><em>2.</em> Adjustable straps at back.</p>
																<p>&amp;diams Invisible finer, durable and softer French lace all around.</p>
																<p>&amp;diams Uniform mold, standardized size.</p>
															</li>
															<li class="col-sm-4">
																<h4>Silk Top GLUELESS FULL LACE</h4>
																<img src="/themes/uniwigs2016/img/products/Silk-Top-Glueless-Full-Lace-Cap.jpg" class="img-responsive" alt="Silk Top GLUELESS FULL LACE">
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
											{assign var="groupName" value="group_$id_attribute_group"}
											<div class="attribute_list {if $group.group_type == 'color'}attribute_list_color{/if}">
												{if ($group.group_type == 'select')}
													<select name="{$groupName}" id="group_{$id_attribute_group|intval}" class="form-control attribute_select no-print">
														{foreach from=$group.attributes key=id_attribute item=group_attribute}
															<option value="{$id_attribute|intval}"{if (isset($smarty.get.$groupName) && $smarty.get.$groupName|intval == $id_attribute) || $group.default == $id_attribute} selected="selected"{/if} title="{$group_attribute|escape:'html':'UTF-8'}">{$group_attribute|escape:'html':'UTF-8'}</option>
														{/foreach}
													</select>
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
													<p class="text-primary"><small>Unless "Celebrity-Style+ 14 days" is selected, you will receive the wig with solid color.</small></p>
													{/if}
													<input type="hidden" class="color_pick_hidden" name="{$groupName|escape:'html':'UTF-8'}" value="{$default_colorpicker|intval}" />
												{elseif ($group.group_type == 'radio')}
													<ul>
														{foreach from=$group.attributes key=id_attribute item=group_attribute}
															<li>
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
												<label for ="textField{$customizationField}">
													{assign var='key' value='textFields_'|cat:$product->id|cat:'_'|cat:$field.id_customization_field}
													{if !empty($field.name)}
														{$field.name}
													{/if}
													{if $field.required}<sup>*</sup>{/if}
												</label>
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
								<span><i class="icon-jianhao"></i></span>
							</a>
							<a href="#" data-field-qty="qty" class="btn btn-default button-plus product_quantity_up">
								<span><i class="icon-add"></i></span>
							</a>
							<span class="clearfix"></span>
						</p>
						{/if}
						<!-- minimal quantity wanted -->
						<p id="minimal_quantity_wanted_p"{if $product->minimal_quantity <= 1 || !$product->available_for_order || $PS_CATALOG_MODE} style="display: none;"{/if}>
							{l s='The minimum purchase order quantity for the product is'} <b id="minimal_quantity_label">{$product->minimal_quantity}</b>
						</p>
						{if isset($productAddition['custom']) && $productAddition['custom']}
							<div class="custom-time uk-margin-small-top">Custom Time: <span class="text-primary">{$productAddition['custom']}</span></div>
						{/if}
					</div> <!-- end product_attributes -->
					<ul class="box-cart-bottom">
						<p  style="display:none">{$product->quantity}</p>	
					
					<li{if  !$product->available_for_order || (isset($restricted_country_mode) && $restricted_country_mode) || $PS_CATALOG_MODE} class="unvisible"{/if}>
									<p id="add_to_cart" class="buttons_bottom_block no-print">
										<button type="submit" name="Submit" class="exclusive">
											<span>{if $content_only && (isset($product->customization_required) && $product->customization_required)}{l s='Customize'}{else}{l s='Add to cart'}{/if}</span>
										</button>
									</p>
								</li>
						{if isset($HOOK_PRODUCT_ACTIONS) && $HOOK_PRODUCT_ACTIONS}{$HOOK_PRODUCT_ACTIONS}{/if}
					</div> <!-- end box-cart-bottom -->
				</div> <!-- end box-info-product -->
			</form>
			{/if}
		</div> <!-- end pb-right-column-->
	</div> <!-- end primary_block -->
	{if !$content_only}
	<ul class="uk-tab" data-uk-tab="{literal}{connect:'#tab-content'}{/literal}" data-uk-switcher="{literal}{connect:'#tab-content', animation: 'fade'}{/literal}">
		<li><a href="#">Details</a></li>
		{if isset($packItems) && $packItems|@count > 0}<li><a href="#">Package Items</a></li>{/if}
		<li><a href="#">Reviews</a></li>
		<li><a href="#" id="you_may_also_like_product">Recommended</a></li>
		
	</ul>
	<ul id="tab-content" class="uk-switcher">
		<!-- details -->
		<li>
			{if isset($productAddition['video']) && $productAddition['video']}
				<div class="video">
					<a href="{$productAddition['video']}" class="items_video highslide popupvideoa" target="_blank" data-uk-lightbox><span class="icon-videoyoutube"></span></a>
				</div>
			{/if}

			{if isset($features) && $features}
				<!-- features -->
				<table class="uk-table table-data-sheet">
					{foreach from=$features item=feature}
					<tr class="{cycle values="odd,even"}">
						{if isset($feature.value)}
						<th>{$feature.name|escape:'html':'UTF-8'}</th>
						<td>{$feature.value|escape:'html':'UTF-8'}</td>
						{/if}
					</tr>
					{/foreach}
				</table>
				<!--end features -->
			{/if}

			<!-- full description -->
			{if $product->description_short || $packItems|@count > 0}
			<div id="short_description_block" class="rte">
				{if $product->description_short}
					<div class="short_description" itemprop="description">{$product->description|truncate:245:'...'}</div>
				{/if}

				{if $product->description}
					<div id="description_content" class="uk-hidden">{$product->description}</div>
					<p class="buttons_bottom_block">
						<a href="javascript:{ldelim}{rdelim}" class="uk-button">
							{l s='More details'}
						</a>
					</p>
					
				{/if}
			</div>
			{/if}
		</li>
		<!-- details END -->

		<!-- Package Items END -->
		{*if isset($packItems) && $packItems|@count > 0}
		<li>
			<section id="blockpack">
				<h3 class="page-product-heading">{l s='Pack content'}</h3>
				{include file="$tpl_dir./product-list.tpl" products=$packItems}
			</section>
		</li>
		{/if*}
		<!-- Package Items END -->

		<!-- shows and reviews -->
		<li>
			{$PRODUCT_REVIEWS}
			<div class="shows">
				<div class="get-points"><a href="#shareyouphotos" class="share-your-photos" data-uk-modal><img src="/themes/uniwigs2016-m/img/public/get-points.png" alt="" class="img-responsive"></a></div>
				<div id="shareyouphotos" class="uk-modal">
				    <div class="uk-modal-dialog">
				        <a class="uk-modal-close uk-close"></a>
				        <div class="pr-details">
				        	<p>Uniwigs encourages all our dear customers to leave your valuable reviews or photos on our website. In return, we will offer you corresponding loyalty points.</p>
				        	<ul>
				        		<li>For text reviews, you can get <b>200 loyalty points</b>.</li>
				        		<li>For photo reviews, you can get <b>500 loyalty points</b>.</li>
				        		<li>If you leave both text reviews and photos, we will offer you <b>1000 loyalty points</b>.</li>
				        	</ul>
				        	<p style="background: #da6667;color: #fff;text-align: center;padding: 10px 0;font-size: 1.1em;"><b>100</b> loyalty points = <b>$1.00</b></p>
				        </div>
				    </div>
				</div>
				<article class="border-bottom">
					<h2>Customer Shows</h2>
				</article>
				<article class="shows_container"><center style="padding: 14px 0;">No shows yet.</center></article>
				<div class="view_more view_more_shows hide"><a href="/customer-show?psku={$product->reference|escape}">See more shows</a></div>
				<script type="text/javascript">
				var mc = {if isset($main_category)}'{$main_category}'{else}''{/if};
				var cc = {if isset($curr_category)}'{$curr_category}'{else}''{/if};
				{literal}
				window.load_video_image_list = function(){
					$.get("http://rvm.uniwigs.com/api_review3/list_m",{
						prdid:id_product,
						prdsku:productReference,
						mc:mc,
						cc:cc
					},function(data){
						$(".shows_container").html(data);
						if($(".shows_container a.img-responsive").length >= 8){
							$('.view_more_shows').removeClass('hide');
						}
					});
				}
				{/literal}
				load_video_image_list();
				</script>
			</div>

			<div class="reviews">
				<article class="border-bottom">
					<h2 id="customer-top">Customer Reviews</h2>
					{*if $cookie->id_customer && $has_bought}
					<a href="{$product_link}?wreview" class="link_icon link_orange icon_write wreviewlink"></a>
					{/if*}
				</article>
				<article class="comments_container">
					<center style="padding: 14px 0;">No reviews yet.</center>
				</article>
			</div>
			<script type="text/javascript">
				var id_product = '{$product->id|intval}';
				var productReference = '{$product->reference|escape:'htmlall':'UTF-8'}';
			</script>
			<script type="text/javascript">
			var cusid = {if $cookie->id_customer}{$cookie->id_customer}{else}0{/if};
			var hasbt = {if isset($has_bought)}{$has_bought}{else}0{/if};
			{literal}
			$(function() {
				window.topage = 1;
				window.pageprocessing = false;
				window.load_comment_list = function(topage){
					window.pageprocessing = true;
					$.get("http://rvm.uniwigs.com/api_review3/comments",{
						is_wap:1,
						prdid:id_product,
						prdsku:productReference,
						cusid:cusid,
						hasbt:hasbt,
						page:topage||1,
						pagesize:6
					},function(data){
						if ($.trim(data).length > 0) {
							$(".comments_container").html(data);
							setTimeout("$( '.lazyload .comments_container' ).find( 'img' ).lazyload()",2000);
							window.topage = window.topage+1;
							window.pageprocessing = false;
							if($(".comments_container dd").length >= 5){
								$('.view_more').removeClass('hide');
							}
						}
					});
				}
				load_comment_list(window.topage);

				window.review_content_ready = function(){
					$('.page a').click(function(){
						topage = $(this).attr('topage');
						load_comment_list(topage);
					});
				}
			});
			{/literal}
			</script>
		</li>
		<!-- shows and reviews END -->

		<!-- accessories -->
		
		{*if isset($accessories) && $accessories}
			<!--Accessories -->
			<section class="page-product-box">
				<h3 class="page-product-heading">{l s='Accessories'}</h3>
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
													{$accessory.name|truncate:20:'...':true|escape:'html':'UTF-8'}
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
											{if !$PS_CATALOG_MODE && ($accessory.allow_oosp || $accessory.quantity > 0) && isset($add_prod_display) && $add_prod_display == 1}
												<div class="no-print">
													<a class="exclusive button ajax_add_to_cart_button" href="{$link->getPageLink('cart', true, NULL, "qty=1&amp;id_product={$accessory.id_product|intval}&amp;token={$static_token}&amp;add")|escape:'html':'UTF-8'}" data-id-product="{$accessory.id_product|intval}" title="{l s='Add to cart'}">
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
		{/if*}
		
		<!-- accessories END -->

		{if isset($HOOK_PRODUCT_FOOTER) && $HOOK_PRODUCT_FOOTER}{$HOOK_PRODUCT_FOOTER}{/if}

		<!-- description & features -->
		{*if (isset($product) && $product->description) || (isset($features) && $features) || (isset($accessories) && $accessories) || (isset($HOOK_PRODUCT_TAB) && $HOOK_PRODUCT_TAB) || (isset($attachments) && $attachments) || isset($product) && $product->customizable}
			{if isset($attachments) && $attachments}
			<li>
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
			</li>
			{/if}

			{if isset($product) && $product->customizable}
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
			{/if}
		{/if*}
	</ul>
	{/if}
</div> <!-- itemscope product wrapper -->
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
