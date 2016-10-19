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

{capture name=path}{l s='Your shopping cart'}{/capture}

{if isset($account_created)}
	<p class="alert alert-success">
		{l s='Your account has been created.'}
	</p>
{/if}

{assign var='current_step' value='summary'}
{include file="$tpl_dir./order-steps.tpl"}
{include file="$tpl_dir./errors.tpl"}

{if isset($empty)}
	<div class="relative empty">
		<img src="/themes/uniwigs2016-m/img/empty.png" width="140">
		<p class="text">Oops! Your bag is empty!</p>
	</div>
	<div><a href="{$base_dir}" class="uk-button">Continue Shopping</a></div>
{elseif $PS_CATALOG_MODE}
	<p class="alert alert-warning">{l s='This store has not accepted your new order.'}</p>
{else}
	{if isset($lastProductAdded) AND $lastProductAdded}
		<div class="cart_last_product">
			<div class="cart_last_product_header">
				<div class="left">{l s='Last product added'}</div>
			</div>
			<a class="cart_last_product_img" href="{$link->getProductLink($lastProductAdded.id_product, $lastProductAdded.link_rewrite, $lastProductAdded.category, null, null, $lastProductAdded.id_shop)|escape:'html':'UTF-8'}">
				<img src="{$link->getImageLink($lastProductAdded.link_rewrite, $lastProductAdded.id_image, 'small_default')|escape:'html':'UTF-8'}" alt="{$lastProductAdded.name|escape:'html':'UTF-8'}"/>
			</a>
			<div class="cart_last_product_content">
				<p class="product-name">
					<a href="{$link->getProductLink($lastProductAdded.id_product, $lastProductAdded.link_rewrite, $lastProductAdded.category, null, null, null, $lastProductAdded.id_product_attribute)|escape:'html':'UTF-8'}">
						{$lastProductAdded.name|escape:'html':'UTF-8'}
					</a>
				</p>
				{if isset($lastProductAdded.attributes) && $lastProductAdded.attributes}
					<small>
						<a href="{$link->getProductLink($lastProductAdded.id_product, $lastProductAdded.link_rewrite, $lastProductAdded.category, null, null, null, $lastProductAdded.id_product_attribute)|escape:'html':'UTF-8'}">
							{$lastProductAdded.attributes|escape:'html':'UTF-8'}
						</a>
					</small>
				{/if}
			</div>
		</div>
	{/if}
	{assign var='total_discounts_num' value="{if $total_discounts != 0}1{else}0{/if}"}
	{assign var='use_show_taxes' value="{if $use_taxes && $show_taxes}2{else}0{/if}"}
	{assign var='total_wrapping_taxes_num' value="{if $total_wrapping != 0}1{else}0{/if}"}
	{* eu-legal *}
	{hook h="displayBeforeShoppingCartBlock"}
	<div id="order-detail-content" class="table_block table-responsive">

		<table id="cart_summary" class="table table-bordered {if $PS_STOCK_MANAGEMENT}stock-management-on{else}stock-management-off{/if}">
			<tbody>
				{assign var='odd' value=0}
				{assign var='have_non_virtual_products' value=false}
				{foreach $products as $product}
					{if $product.is_virtual == 0}
						{assign var='have_non_virtual_products' value=true}
					{/if}
					{assign var='productId' value=$product.id_product}
					{assign var='productAttributeId' value=$product.id_product_attribute}
					{assign var='quantityDisplayed' value=0}
					{assign var='odd' value=($odd+1)%2}
					{assign var='ignoreProductLast' value=isset($customizedDatas.$productId.$productAttributeId) || count($gift_products)}
					{* Display the product line *}
					{include file="$tpl_dir./shopping-cart-product-line.tpl" productLast=$product@last productFirst=$product@first}
					{* Then the customized datas ones*}
					{if isset($customizedDatas.$productId.$productAttributeId[$product.id_address_delivery])}
						{foreach $customizedDatas.$productId.$productAttributeId[$product.id_address_delivery] as $id_customization=>$customization}
							<tr
								id="product_{$product.id_product}_{$product.id_product_attribute}_{$id_customization}_{$product.id_address_delivery|intval}"
								class="product_customization_for_{$product.id_product}_{$product.id_product_attribute}_{$product.id_address_delivery|intval}{if $odd} odd{else} even{/if} customization alternate_item {if $product@last && $customization@last && !count($gift_products)}last_item{/if}">
								<td colspan="2">
									{foreach $customization.datas as $type => $custom_data}
										{if $type == $CUSTOMIZE_FILE}
											<div class="customizationUploaded">
												<ul class="customizationUploaded">
													{foreach $custom_data as $picture}
														<li><img src="{$pic_dir}{$picture.value}_small" alt="" class="customizationUploaded" width="98" height="114"/></li>
													{/foreach}
												</ul>
											</div>
										{elseif $type == $CUSTOMIZE_TEXTFIELD}
											<ul class="typedText">
												{foreach $custom_data as $textField}
													<li>
														{if $textField.name}
															{$textField.name}
														{else}
															{l s='Text #'}{$textField@index+1}
														{/if}
														: {$textField.value}
													</li>
												{/foreach}
											</ul>
										{/if}
									{/foreach}
								
									<div class="cart_quantity" colspan="1">
										{if isset($cannotModify) AND $cannotModify == 1}
											<span>{if $quantityDisplayed == 0 AND isset($customizedDatas.$productId.$productAttributeId)}{$customizedDatas.$productId.$productAttributeId|@count}{else}{$product.cart_quantity-$quantityDisplayed}{/if}</span>
										{else}
											
											<div class="cart_quantity_button clearfix">
												{if $product.minimal_quantity < ($customization.quantity -$quantityDisplayed) OR $product.minimal_quantity <= 1}
													<a
														id="cart_quantity_down_{$product.id_product}_{$product.id_product_attribute}_{$id_customization}_{$product.id_address_delivery|intval}"
														class="cart_quantity_down btn btn-default button-minus"
														href="{$link->getPageLink('cart', true, NULL, "add=1&amp;id_product={$product.id_product|intval}&amp;ipa={$product.id_product_attribute|intval}&amp;id_address_delivery={$product.id_address_delivery}&amp;id_customization={$id_customization}&amp;op=down&amp;token={$token_cart}")|escape:'html':'UTF-8'}"
														rel="nofollow"
														title="{l s='Subtract'}">
														<span><i class="icon-jianhao"></i></span>
													</a>
												{else}
													<a
														id="cart_quantity_down_{$product.id_product}_{$product.id_product_attribute}_{$id_customization}"
														class="cart_quantity_down btn btn-default button-minus disabled"
														href="#"
														title="{l s='Subtract'}">
														<span><i class="icon-jianhao"></i></span>
													</a>
												{/if}
												<input type="hidden" value="{$customization.quantity}" name="quantity_{$product.id_product}_{$product.id_product_attribute}_{$id_customization}_{$product.id_address_delivery|intval}_hidden"/>
												<input type="text" value="{$customization.quantity}" class="cart_quantity_input form-control grey" name="quantity_{$product.id_product}_{$product.id_product_attribute}_{$id_customization}_{$product.id_address_delivery|intval}"/>
												<a
													id="cart_quantity_up_{$product.id_product}_{$product.id_product_attribute}_{$id_customization}_{$product.id_address_delivery|intval}"
													class="cart_quantity_up btn btn-default button-plus"
													href="{$link->getPageLink('cart', true, NULL, "add=1&amp;id_product={$product.id_product|intval}&amp;ipa={$product.id_product_attribute|intval}&amp;id_address_delivery={$product.id_address_delivery}&amp;id_customization={$id_customization}&amp;token={$token_cart}")|escape:'html':'UTF-8'}"
													rel="nofollow"
													title="{l s='Add'}">
													<span><i class="icon-add"></i></span>
												</a>
												{if isset($cannotModify) AND $cannotModify == 1}
												{else}
													<a
														id="{$product.id_product}_{$product.id_product_attribute}_{$id_customization}_{$product.id_address_delivery|intval}"
														class="cart_quantity_delete button_del"
														href="{$link->getPageLink('cart', true, NULL, "delete=1&amp;id_product={$product.id_product|intval}&amp;ipa={$product.id_product_attribute|intval}&amp;id_customization={$id_customization}&amp;id_address_delivery={$product.id_address_delivery}&amp;token={$token_cart}")|escape:'html':'UTF-8'}"
														rel="nofollow"
														title="{l s='Delete'}">
														<i class="icon-delete"></i>
													</a>
												{/if}
											</div>
										{/if}
									</div>
								</td>
							</tr>
							{assign var='quantityDisplayed' value=$quantityDisplayed+$customization.quantity}
						{/foreach}

						{* If it exists also some uncustomized products *}
						{if $product.quantity-$quantityDisplayed > 0}{include file="$tpl_dir./shopping-cart-product-line.tpl" productLast=$product@last productFirst=$product@first}{/if}
					{/if}
				{/foreach}
				{assign var='last_was_odd' value=$product@iteration%2}
				{foreach $gift_products as $product}
					{assign var='productId' value=$product.id_product}
					{assign var='productAttributeId' value=$product.id_product_attribute}
					{assign var='quantityDisplayed' value=0}
					{assign var='odd' value=($product@iteration+$last_was_odd)%2}
					{assign var='ignoreProductLast' value=isset($customizedDatas.$productId.$productAttributeId)}
					{assign var='cannotModify' value=1}
					{* Display the gift product line *}
					{include file="$tpl_dir./shopping-cart-product-line.tpl" productLast=$product@last productFirst=$product@first}
				{/foreach}
			</tbody>
			<tbody>
				{if sizeof($discounts)}
					{foreach $discounts as $discount}
					{if ((float)$discount.value_real == 0 && $discount.free_shipping != 1) || ((float)$discount.value_real == 0 && $discount.code == '')}
						{continue}
					{/if}
						<tr class="cart_discount {if $discount@last}last_item{elseif $discount@first}first_item{else}item{/if}" id="cart_discount_{$discount.id_discount}">
							<td class="cart_discount_name">{$discount.name}</td>
							<td class="cart_discount_price">
								<span class="price-discount">
								{if !$priceDisplay}{displayPrice price=$discount.value_real*-1}{else}{displayPrice price=$discount.value_tax_exc*-1}{/if}
								</span>
								{if strlen($discount.code)}
									<a
										href="{if $opc}{$link->getPageLink('order-opc', true)}{else}{$link->getPageLink('order', true)}{/if}?deleteDiscount={$discount.id_discount}"
										class="price_discount_delete"
										title="{l s='Delete'}">
										<i class="icon-delete"></i>
									</a>
								{/if}
							</td>
						</tr>
					{/foreach}
				{/if}
				{if $cart->id_customer==102318 or true }
					<tr class="cart_total_delivery">
						<td class="text-left">Total points</td>
						<td class="points" style="text-align:right">
							<span class="total_points">-$0</span>
							<a href="javascript:;" class="total_points_delete" title="Delete" onclick='cleanpoints()'>
								<i class="icon-delete"></i>
							</a>
						</td>
					</tr>
				{/if}
			</tbody>
		</table>
		<table class="table table-bordered">
			<tfoot>
				{assign var='rowspan_total' value=2+$total_discounts_num+$total_wrapping_taxes_num}

				{if $use_taxes && $show_taxes && $total_tax != 0}
					{assign var='rowspan_total' value=$rowspan_total+1}
				{/if}

				{if $priceDisplay != 0}
					{assign var='rowspan_total' value=$rowspan_total+1}
				{/if}

				{if $total_shipping_tax_exc <= 0 && (!isset($isVirtualCart) || !$isVirtualCart) && $free_ship}
					{assign var='rowspan_total' value=$rowspan_total+1}
				{else}
					{if $use_taxes && $total_shipping_tax_exc != $total_shipping}
						{if $priceDisplay && $total_shipping_tax_exc > 0}
							{assign var='rowspan_total' value=$rowspan_total+1}
						{elseif $total_shipping > 0}
							{assign var='rowspan_total' value=$rowspan_total+1}
						{/if}
					{elseif $total_shipping_tax_exc > 0}
						{assign var='rowspan_total' value=$rowspan_total+1}
					{/if}
				{/if}

				{if $use_taxes}s
					{if $priceDisplay}
						<tr class="cart_total_price">
							<td colspan="2" id="cart_voucher" class="cart_voucher">
								{if $voucherAllowed}
									<form action="{if $opc}{$link->getPageLink('order-opc', true)}{else}{$link->getPageLink('order', true)}{/if}" method="post" id="voucher">
										<fieldset>
											<input type="text" class="discount_name form-control" id="discount_name" name="discount_name" value="{if isset($discount_name) && $discount_name}{$discount_name}{/if}" placeholder="USE COUPON CODE"/>
											<input type="hidden" name="submitDiscount" />
											<button type="submit" name="submitAddDiscount" class="button btn btn-default button-small"></button>
										</fieldset>
									</form>
									{if $displayVouchers}
										<p id="title" class="title-offers">{l s='Take advantage of our exclusive offers:'}</p>
										<div id="display_cart_vouchers">
											{foreach $displayVouchers as $voucher}
												{if $voucher.code != ''}<span class="voucher_name" data-code="{$voucher.code|escape:'html':'UTF-8'}">{$voucher.code|escape:'html':'UTF-8'}</span> - {/if}{$voucher.name}<br />
											{/foreach}
										</div>
									{/if}
								{/if}
							</td>
						</tr>
						
						{if true}
							<tr><td colspan="2" style="height:15px;background:#f5f5f5"></td></tr>
							<tr class="cart_total_delivery">
								<td colspan="2">
									<p>Valid Points: <span id='npoints'>{$points}</span></p>
									{if {$points}>0}
									<p>
										<input type="text" id="points_name" class="form-control" name="points_name" value="" placeholder="USE VALID POINTS">
										<button onclick='addPoints()' class="button btn btn-default button-small"></button>
									</p>
									{/if}
								</td>
							</tr>
						{/if}
					{else}
						<tr class="cart_total_price">
							<td colspan="2" id="cart_voucher" class="cart_voucher">
								{if $voucherAllowed}
									<form action="{if $opc}{$link->getPageLink('order-opc', true)}{else}{$link->getPageLink('order', true)}{/if}" method="post" id="voucher">
										<fieldset>
											<input type="text" class="discount_name form-control" id="discount_name" name="discount_name" value="{if isset($discount_name) && $discount_name}{$discount_name}{/if}" placeholder="USE COUPON CODE"/>
											<input type="hidden" name="submitDiscount" />
											<button type="submit" name="submitAddDiscount" class="button btn btn-default button-small"></button>
										</fieldset>
									</form>
									{if $displayVouchers}
										<p id="title" class="title-offers">{l s='Take advantage of our exclusive offers:'}</p>
										<div id="display_cart_vouchers">
											{foreach $displayVouchers as $voucher}
												{if $voucher.code != ''}<span class="voucher_name" data-code="{$voucher.code|escape:'html':'UTF-8'}">{$voucher.code|escape:'html':'UTF-8'}</span> - {/if}{$voucher.name}<br />
											{/foreach}
										</div>
									{/if}
								{/if}
							</td>	
						</tr>

						{if true}
							<tr><td colspan="2" style="height:15px;background:#f5f5f5"></td></tr>
							<tr class="cart_total_delivery">
								<td colspan="2">
									<p>Valid Points: <span id='npoints'>{$points}</span></p>
									{if {$points}>0}
									<p>
										<input type="text" id="points_name" class="form-control" name="points_name" value="" placeholder="USE VALID POINTS">
										<button onclick='addPoints()' class="button btn btn-default button-small"></button>
									</p>
									{/if}
								</td>
							</tr>
						{/if}
					{/if}
				{else}
					<tr class="cart_total_price">
						<td colspan="2" id="cart_voucher" class="cart_voucher">
							{if $voucherAllowed}
								<form action="{if $opc}{$link->getPageLink('order-opc', true)}{else}{$link->getPageLink('order', true)}{/if}" method="post" id="voucher">
									<fieldset>
										<input type="text" class="discount_name form-control" id="discount_name" name="discount_name" value="{if isset($discount_name) && $discount_name}{$discount_name}{/if}" placeholder="USE COUPON CODE"/>
										<input type="hidden" name="submitDiscount" />
										<button type="submit" name="submitAddDiscount" class="button btn btn-default button-small">
										</button>
									</fieldset>
								</form>
								{if $displayVouchers}
									<p id="title" class="title-offers">{l s='Take advantage of our exclusive offers:'}</p>
									<div id="display_cart_vouchers">
										{foreach $displayVouchers as $voucher}
											{if $voucher.code != ''}<span class="voucher_name" data-code="{$voucher.code|escape:'html':'UTF-8'}">{$voucher.code|escape:'html':'UTF-8'}</span> - {/if}{$voucher.name}<br />
										{/foreach}
									</div>
								{/if}
							{/if}
						</td>	
					</tr>
					{if $cart->id_customer==102318  or true}
						<tr><td colspan="2" style="height:15px;background:#f5f5f5"></td></tr>
						<tr class="cart_total_delivery">
							<td colspan="2">
								<p>Valid Points: <span id='npoints'>{$points}</span></p>
								{if $points>0}
								<p>
									<input type="text" id="points_name" class="form-control" name="points_name" value="" placeholder="USE VALID POINTS">
									<button onclick='addPoints()' class="button btn btn-default button-small"></button>
								</p>
								{/if}
							</td>
						</tr>
					{/if}
				{/if}				
			</tfoot>
		</table>
		{*存放购物车id 信息*}
		<span id='cart_points' style="display: none;">{$cart->id}</span>
			<script type="text/javascript">
		  clear({$cart->id});
		</script>
		
		{literal}
		<script type="text/javascript">
		var point =   $('#cart_points').text();
		clear(point);
		function clear(id_cart){
		  $.post('points.php',{id_cart:id_cart});
		  }
		</script>
		{/literal}
		<script>
			

			var id_cart =$('#cart_points').html();
			//增加 积分输入限制
			$("#points_name").keyup(function(){
			
			//当前用户可用最大积分
			  if($("#points_name").val()*1>$("#npoints").html()*1){

			  	$("#points_name").val($("#npoints").html()*1);
			  }
			  
			  
			  //当前购物车 最大可用积分
			 var  input_points= $("#points_name").val()*{$nrate};
			 var  nprice =$("#total_price").html().replace('$','')*1;
		
			 var  npoint = $(".total_points").html().replace('-$','')*1;
			 if(input_points.toFixed(2)>(nprice+npoint)){
			
			  
			  
			  $("#points_name").val(((nprice+npoint)*100).toFixed(0));
			   //$(".total_points").html('-$0');
			  
			  }

			});
			
			//增加地址选择重新清除积分 

			$('#id_address_delivery').change(function(){
			
			$(".total_points").html('-$0');
			$("#points_name").val('');
			});
			
			function  cleanpoints(){

					//获取当前购物车总价格
					/*var total_price =parseFloat($('.total_points').html().replace('-$',''))+parseFloat($('#total_price').html().replace('$',''));
					
					$('.total_points').html('-$0'); 
				    $('#total_price').html('$'+total_price.toFixed(2));
					$.post("checkpoints.php",{ cart:$('#cart_points').html(), point:0});*/
					location.reload();
					
			}

			function  addPoints(){
				
			  var nprice =$("#total_price").html().replace('$','')*1;

			  if(nprice==0){
			  location.reload();
			  }

			  if ($('.total_points').html()=='-$0') {
			
					var points =  $('#points_name').val()*{$nrate};
					//获取当前的总价格
					var total_price =$('#total_price').html().replace('$','');
					//计算积分后的价格
					var nowprice = total_price*1 -points.toFixed(2);

					if(nowprice>=0){
					
						if(nowprice==0){
				
						
						$('.total_points').html('-$'+points.toFixed(2)); 
						$('#total_price').html('$'+nowprice.toFixed(2));
						
						point = $('#points_name').val();
						$.post("checkpoints.php",{ cart:$('#cart_points').html(), point:point});
						
						$('#opc_payment_methods-content').html('<div id="HOOK_PAYMENT">'+
						'<p class="center"><button class="button btn btn-default button-medium"name="confirmOrder"'
						+'id="confirmOrder"onclick="confirmFreeOrder();" type="submit"> <span>I confirm my order.</span></button></p></div>');
				
						
						
						}else{
						
							$('.total_points').html('-$'+points.toFixed(2)); 
							$('#total_price').html('$'+nowprice.toFixed(2));
						
							point = $('#points_name').val();
							$.post("checkpoints.php",{ cart:$('#cart_points').html(), point:point});
							//修改paypal提交的积分
							$('#paypal input[name ^="amount"]').val(nowprice.toFixed(2));
							$('#paypal input[name ^="amount_"]').remove();
							$('#paypal input[name ^="item_name_"]').remove();
							$('#paypal input[name ^="quantity_"]').remove();
							$('#paypal input[name ="amount"]').after('<input type="hidden" name="item_name_1" value="Your order"></input>'
						+'<input type="hidden" name="amount_1" value="'+nowprice.toFixed(2)+'"></input>'
						+'<input type="hidden" name="quantity_1" value="1"></input>');

						}
						
					
					}else{

					alert('out of the total of paid');

					return;
					}
					

				}else{
				
					
					//获取需要转换的积分
					var points =  $('#points_name').val()*{$nrate};
					//修整当前 已经计算的积分 
					var fixpoints = $('.total_points').html().replace('-$',''); 

					//获取当前的总价格
					var total_price =$('#total_price').html().replace('$','');
					
					//计算积分后的价格
					var nowprice = total_price*1 - points.toFixed(2)+fixpoints*1;
						
					if(nowprice>=0){
					
						if(nowprice==0)
							{
							
							$('.total_points').html('-$'+points.toFixed(2)); 
							$('#total_price').html('$'+nowprice.toFixed(2));
							
							point = $('#points_name').val();
							$.post("checkpoints.php",{ cart:$('#cart_points').html(), point:point});
							
							$('#opc_payment_methods-content').html('<div id="HOOK_PAYMENT">'+
							'<p class="center"><button class="button btn btn-default button-medium"name="confirmOrder"'
							+'id="confirmOrder"onclick="confirmFreeOrder();" type="submit"> <span>I confirm my order.</span></button></p></div>');
						
							}
							else
							{
								//修正显示 积分和支付总金额
								$('.total_points').html('-$'+points.toFixed(2)); 
								$('#total_price').html('$'+nowprice.toFixed(2));	
								point = $('#points_name').val();
							    $.post("checkpoints.php",{ cart:$('#cart_points').html(), point:point});	
								//修改paypal提交的积分
								$('#paypal input[name ^="amount"]').val(nowprice.toFixed(2));
								$('#paypal input[name ^="amount_"]').remove();
								$('#paypal input[name ^="item_name_"]').remove();
								$('#paypal input[name ^="quantity_"]').remove();
								
								$('#paypal input[name ="amount"]').after('<input type="hidden" name="item_name_1" value="Your order"></input>'
							+'<input type="hidden" name="amount_1" value="'+nowprice.toFixed(2)+'"></input>'
							+'<input type="hidden" name="quantity_1" value="1"></input>');
							}	

						}else
						{

							alert('out of the total of paid');

							return;

						}

					}
			}
		</script>				
						
		<div class="table order-price-box">
				<div class="order-price-list" style="display:none">
					{assign var='rowspan_total' value=2+$total_discounts_num+$total_wrapping_taxes_num}
					{if $use_taxes && $show_taxes && $total_tax != 0}
						{assign var='rowspan_total' value=$rowspan_total+1}
					{/if}
					{if $priceDisplay != 0}
						{assign var='rowspan_total' value=$rowspan_total+1}
					{/if}
					{if $total_shipping_tax_exc <= 0 && (!isset($isVirtualCart) || !$isVirtualCart) && $free_ship}
						{assign var='rowspan_total' value=$rowspan_total+1}
					{else}
						{if $use_taxes && $total_shipping_tax_exc != $total_shipping}
							{if $priceDisplay && $total_shipping_tax_exc > 0}
								{assign var='rowspan_total' value=$rowspan_total+1}
							{elseif $total_shipping > 0}
								{assign var='rowspan_total' value=$rowspan_total+1}
							{/if}
						{elseif $total_shipping_tax_exc > 0}
							{assign var='rowspan_total' value=$rowspan_total+1}
						{/if}
					{/if}

					{if $use_taxes}
						{if $priceDisplay}
							<dl class="cart_total_price">
								<dt class="text-left uk-text-bold">{if $display_tax_label}{l s='Total products (tax excl.)'}{else}{l s='Total products'}{/if}</td>
								<dd class="price" id="total_product">{displayPrice price=$total_products}</d>
							</tr>
						{else}
							<dl class="cart_total_price">
								<dt class="text-left uk-text-bold">{if $display_tax_label}{l s='Total products (tax incl.)'}{else}{l s='Total products'}{/if}</dt>
								<dd class="price" id="total_product">{displayPrice price=$total_products_wt}</dd>
							</tr>
						{/if}
					{else}
						<dl class="cart_total_price">
							
							<dt class="text-left uk-text-bold">{l s='Total products'}</dt>
							<dd class="price" id="total_product">{displayPrice price=$total_products}</dd>
						</dl>
					{/if}
					<dl{if $total_wrapping == 0} style="display: none;"{/if}>
						<dt colspan="2" class="text-left uk-text-bold">
							{if $use_taxes}
								{if $display_tax_label}{l s='Total gift wrapping (tax incl.)'}{else}{l s='Total gift-wrapping cost'}{/if}
							{else}
								{l s='Total gift-wrapping cost'}
							{/if}
						</dt>
						<dd colspan="1" class="price-discount price" id="total_wrapping">
							{if $use_taxes}
								{if $priceDisplay}
									{displayPrice price=$total_wrapping_tax_exc}
								{else}
									{displayPrice price=$total_wrapping}
								{/if}
							{else}
								{displayPrice price=$total_wrapping_tax_exc}
							{/if}
						</dd>
					</dl>
					{if $cart->id_customer==102318  or true }
						<dl class="cart_total_delivery">
							<dt colspan="2" class="text-left uk-text-bold">Total points</dt>
							<dd colspan="1" class="total_points" style="text-align: right;">-$0</dd>
						</dl>
					{/if}
					{if $total_shipping_tax_exc <= 0 && (!isset($isVirtualCart) || !$isVirtualCart) && $free_ship}
						<dl class="cart_total_delivery{if !$opc && (!isset($cart->id_address_delivery) || !$cart->id_address_delivery)} unvisible{/if}">
							<dt class="text-left uk-text-bold">{l s='Total shipping'}</dt>
							<dd class="price" id="total_shipping">{l s='Free shipping!'}</dd>
						</dl>
					{else}
						{if $use_taxes && $total_shipping_tax_exc != $total_shipping}
							{if $priceDisplay}
								<dl class="cart_total_delivery{if $total_shipping_tax_exc <= 0} unvisible{/if}">
									<dt class="text-left uk-text-bold">{if $display_tax_label}{l s='Total shipping (tax excl.)'}{else}{l s='Total shipping'}{/if}</dt>
									<dd class="price" id="total_shipping">{displayPrice price=$total_shipping_tax_exc}</dd>
								</dl>
							{else}
								<dl class="cart_total_delivery{if $total_shipping <= 0} unvisible{/if}">
									<dt class="text-left uk-text-bold">{if $display_tax_label}{l s='Total shipping (tax incl.)'}{else}{l s='Total shipping'}{/if}</dt>
									<dd class="price" id="total_shipping" >{displayPrice price=$total_shipping}</dd>
								</dl>
							{/if}
						{else}
							<dl class="cart_total_delivery{if $total_shipping_tax_exc <= 0} unvisible{/if}">
								<dt class="text-left uk-text-bold">{l s='Total shipping'}</dt>
								<dd class="price" id="total_shipping" >{displayPrice price=$total_shipping_tax_exc}</dd>
							</dl>
						{/if}
					{/if}
					<dl class="cart_total_voucher{if $total_discounts == 0} unvisible{/if}">
						<dt class="text-left uk-text-bold">
							{if $display_tax_label}
								{if $use_taxes && $priceDisplay == 0}
									{l s='Total Coupon (tax incl.)'}
								{else}
									{l s='Total Coupon (tax excl.)'}
								{/if}
							{else}
								{l s='Total Coupon'}
							{/if}
						</dt>
						<dd class="price-discount price" id="total_discount">
							{if $use_taxes && $priceDisplay == 0}
								{assign var='total_discounts_negative' value=$total_discounts * -1}
							{else}
								{assign var='total_discounts_negative' value=$total_discounts_tax_exc * -1}
							{/if}
							{displayPrice price=$total_discounts_negative}
						</dd>
					</dl>
					{if $use_taxes && $show_taxes && $total_tax != 0 }
						{if $priceDisplay != 0}
						<dl class="cart_total_price">
							<dt class="text-left uk-text-bold">{if $display_tax_label}{l s='Total (tax excl.)'}{else}{l s='Total'}{/if}</dt>
							<dd class="price" id="total_price_without_tax">{displayPrice price=$total_price_without_tax}</dd>
						</dl>
						{/if}
						<dl class="cart_total_tax">
							<dt class="text-left uk-text-bold">{l s='Tax'}</dt>
							<dd class="price" id="total_tax">{displayPrice price=$total_tax}</dd>
						</dl>
					{/if}
				</div>
				<dl class="cart_total_price order-total">
					<dt class="total_price_container text-left h4 uk-text-bold">
						<span>{l s='Total'}</span>
		                <div class="hookDisplayProductPriceBlock-price">
		                    {hook h="displayCartTotalPriceLabel"}
		                </div>
					</dt>
					{if $use_taxes}
						<dd class="price" id="total_price_container">
							<span id="total_price" class="h4 uk-text-bold">{displayPrice price=$total_price}</span>
						</dd>
					{else}
						<dd class="price" id="total_price_container">
							<span id="total_price" class="h4 uk-text-bold">{displayPrice price=$total_price_without_tax}</span>
						</dd>
					{/if}
				</dl>
		
		</table>
	</div> <!-- end order-detail-content -->

	{if $show_option_allow_separate_package}
	<p>
		<label for="allow_seperated_package" class="checkbox inline">
			<input type="checkbox" name="allow_seperated_package" id="allow_seperated_package" {if $cart->allow_seperated_package}checked="checked"{/if} autocomplete="off"/>
			{l s='Send available products first'}
		</label>
	</p>
	{/if}

	{* Define the style if it doesn't exist in the PrestaShop version*}
	{* Will be deleted for 1.5 version and more *}
	{if !isset($addresses_style)}
		{$addresses_style.company = 'address_company'}
		{$addresses_style.vat_number = 'address_company'}
		{$addresses_style.firstname = 'address_name'}
		{$addresses_style.lastname = 'address_name'}
		{$addresses_style.address1 = 'address_address1'}
		{$addresses_style.address2 = 'address_address2'}
		{$addresses_style.city = 'address_city'}
		{$addresses_style.country = 'address_country'}
		{$addresses_style.phone = 'address_phone'}
		{$addresses_style.phone_mobile = 'address_phone_mobile'}
		{$addresses_style.alias = 'address_title'}
	{/if}
	{if !$advanced_payment_api && ((!empty($delivery_option) && (!isset($isVirtualCart) || !$isVirtualCart)) OR $delivery->id || $invoice->id) && !$opc}
		<div class="order_delivery clearfix row">
			{if !isset($formattedAddresses) || (count($formattedAddresses.invoice) == 0 && count($formattedAddresses.delivery) == 0) || (count($formattedAddresses.invoice.formated) == 0 && count($formattedAddresses.delivery.formated) == 0)}
				{if $delivery->id}
					<div class="col-xs-12 col-sm-6"{if !$have_non_virtual_products} style="display: none;"{/if}>
						<ul id="delivery_address" class="address item box">
							<li><h3 class="page-subheading">{l s='Delivery address'}&nbsp;<span class="address_alias">({$delivery->alias})</span></h3></li>
							{if $delivery->company}<li class="address_company">{$delivery->company|escape:'html':'UTF-8'}</li>{/if}
							<li class="address_name">{$delivery->firstname|escape:'html':'UTF-8'} {$delivery->lastname|escape:'html':'UTF-8'}</li>
							<li class="address_address1">{$delivery->address1|escape:'html':'UTF-8'}</li>
							{if $delivery->address2}<li class="address_address2">{$delivery->address2|escape:'html':'UTF-8'}</li>{/if}
							<li class="address_city">{$delivery->postcode|escape:'html':'UTF-8'} {$delivery->city|escape:'html':'UTF-8'}</li>
							<li class="address_country">{$delivery->country|escape:'html':'UTF-8'} {if $delivery_state}({$delivery_state|escape:'html':'UTF-8'}){/if}</li>
						</ul>
					</div>
				{/if}
				{if $invoice->id}
					<div class="col-xs-12 col-sm-6">
						<ul id="invoice_address" class="address alternate_item box">
							<li><h3 class="page-subheading">{l s='Invoice address'}&nbsp;<span class="address_alias">({$invoice->alias})</span></h3></li>
							{if $invoice->company}<li class="address_company">{$invoice->company|escape:'html':'UTF-8'}</li>{/if}
							<li class="address_name">{$invoice->firstname|escape:'html':'UTF-8'} {$invoice->lastname|escape:'html':'UTF-8'}</li>
							<li class="address_address1">{$invoice->address1|escape:'html':'UTF-8'}</li>
							{if $invoice->address2}<li class="address_address2">{$invoice->address2|escape:'html':'UTF-8'}</li>{/if}
							<li class="address_city">{$invoice->postcode|escape:'html':'UTF-8'} {$invoice->city|escape:'html':'UTF-8'}</li>
							<li class="address_country">{$invoice->country|escape:'html':'UTF-8'} {if $invoice_state}({$invoice_state|escape:'html':'UTF-8'}){/if}</li>
						</ul>
					</div>
				{/if}
			{else}
				{foreach from=$formattedAddresses key=k item=address}
					<div class="col-xs-12 col-sm-6"{if $k == 'delivery' && !$have_non_virtual_products} style="display: none;"{/if}>
						<ul class="address {if $address@last}last_item{elseif $address@first}first_item{/if} {if $address@index % 2}alternate_item{else}item{/if} box">
							<li>
								<h3 class="page-subheading">
									{if $k eq 'invoice'}
										{l s='Invoice address'}
									{elseif $k eq 'delivery' && $delivery->id}
										{l s='Delivery address'}
									{/if}
									{if isset($address.object.alias)}
										<span class="address_alias">({$address.object.alias})</span>
									{/if}
								</h3>
							</li>
							{foreach $address.ordered as $pattern}
								{assign var=addressKey value=" "|explode:$pattern}
								{assign var=addedli value=false}
								{foreach from=$addressKey item=key name=foo}
								{$key_str = $key|regex_replace:AddressFormat::_CLEANING_REGEX_:""}
									{if isset($address.formated[$key_str]) && !empty($address.formated[$key_str])}
										{if (!$addedli)}
											{$addedli = true}
											<li><span class="{if isset($addresses_style[$key_str])}{$addresses_style[$key_str]}{/if}">
										{/if}
										{$address.formated[$key_str]|escape:'html':'UTF-8'}
									{/if}
									{if ($smarty.foreach.foo.last && $addedli)}
										</span></li>
									{/if}
								{/foreach}
							{/foreach}
						</ul>
					</div>
				{/foreach}
			{/if}
		</div>
	{/if}
	<div id="HOOK_SHOPPING_CART">{$HOOK_SHOPPING_CART}</div>
	{if !$opc}
	<p class="cart_navigation clearfix">
		<a  href="{if $back}{$link->getPageLink('order', true, NULL, 'step=1&amp;back={$back}')|escape:'html':'UTF-8'}{else}{$link->getPageLink('order', true, NULL, 'step=1')|escape:'html':'UTF-8'}{/if}" class="button btn btn-default standard-checkout button-medium" title="{l s='Proceed to checkout'}">
			<span>{l s='Proceed to checkout'}<i class="icon-chevron-right right"></i></span>
		</a>
	</p>
	{/if}
	<div class="clear"></div>
	<div class="cart_navigation_extra">
		<div id="HOOK_SHOPPING_CART_EXTRA">{if isset($HOOK_SHOPPING_CART_EXTRA)}{$HOOK_SHOPPING_CART_EXTRA}{/if}</div>
	</div>
{strip}
{addJsDef deliveryAddress=$cart->id_address_delivery|intval}
{addJsDefL name=txtProduct}{l s='product' js=1}{/addJsDefL}
{addJsDefL name=txtProducts}{l s='products' js=1}{/addJsDefL}
{/strip}
{/if}
