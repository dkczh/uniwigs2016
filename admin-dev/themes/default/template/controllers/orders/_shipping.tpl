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

{*<div>使用分单界面

{if $order->getDifferShipping()}
 判断是否使用了分单系统
<label><input name="differ_no" type="radio" value="" />否 </label> 
<label><input name="differ_yes" type="radio" value="" checked />是 </label> 
{else}
<label><input name="differ_no" type="radio" value="" checked />否 </label> 
<label><input name="differ_yes" type="radio" value="" />是 </label> 
{/if}
</div>
*}
<script type="text/javascript">
  $("input[name='differ_no']").click(function(){  
    $('#shipping_table').show();
	$('#differ_shipping_table').hide();
	$("input[name='differ_yes']").removeAttr("checked");
	
  });
  $("input[name='differ_yes']").click(function(){  
    $('#shipping_table').hide();
	$('#differ_shipping_table').show();
	$("input[name='differ_no']").removeAttr("checked");
	
  });
  
</script>

<div class="table-responsive">



	{*分单系统 *}
	
	<table class="table" id="differ_shipping_table" >

	

		<thead>
			<tr>
				<th>
					<span class="title_box ">{l s='Date'}</span>
				</th>
				<th>
					<span class="title_box ">&nbsp;</span>
				</th>
				<th>
					<span class="title_box ">{l s='Product_name'}</span>
				</th>
				<th>
					<span class="title_box ">{l s='Carrier'}</span>
				</th>
				<th>
					<span class="title_box ">{l s='Tracking number'}</span>
				</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$order->getDifferShipping() item=line}
			<tr>
				{if $line.date_add == null}
				<td>xxxx</td>
				{else}
				<td>{dateFormat date=$line.date_add full=true}</td>
				{/if}
				
				<td>&nbsp;</td>
				<td>{$line.product_name}
				<hr>
				<p>{$line.product_reference}</p>
				</td>
				
				{if $line.real_carrier == null}
				<td class="weight">xxxx</td>
				{else}
				<td class="weight">{$line.real_carrier}</td>
				{/if}
				
				{if $line.tracking_number == null}
				<td><span class="shipping_number_show">xxxx</span></td>
				{else}
				<td><span class="shipping_number_show">{$line.tracking_number}</span></td>
				{/if}
				
				
				<td>
					{if true}
						<form method="post" action="{$link->getAdminLink('AdminOrders')|escape:'html':'UTF-8'}&amp;vieworder&amp;id_order={$order->id|intval}">
							<span class="shipping_number_edit" style="display:none;">
								<input type="hidden" name="id_order_carrier" value="{$line.id_order_carrier|htmlentities}" />
								
								<input type="hidden" name="carrier_product" value="{htmlspecialchars($line.product_name)}" />
								<input type="hidden" name="skus" value="{htmlspecialchars($line.product_reference)}" />
								<select name="rcarrier">
									<option value="0" selected="selected">USPS</option>
									<option value="UPS">UPS</option>
									<option value="FEDEX">FEDEX</option>
									<option value="DHL">DHL</option>
									<option value="EMS">EMS</option>
								</select>
							    
								<input type="text" name="tracking_number" value="{$line.tracking_number|htmlentities}" />
								<button type="submit" class="btn btn-default" name="submitDifferShippingNumber">
									<i class="icon-ok"></i>
									{l s='Update'}
								</button>
							</span>
							<a href="#" class="edit_shipping_number_link btn btn-default">
								<i class="icon-pencil"></i>
								{l s='Edit'}
							</a>
							<a href="#" class="cancel_shipping_number_link btn btn-default" style="display: none;">
								<i class="icon-remove"></i>
								{l s='Cancel'}
							</a>
						</form>
					{/if}
				</td>
			</tr>
			{/foreach}
		</tbody>
		
  <tfoot>

  </tfoot>
	</table>
	
	<table >
	     <tr>
     <td style="
    width: 485px;color: red;
">指定统一的物流方式</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	   <td>&nbsp;</td>
	   <td>&nbsp;</td>
      <td><form method="post" action="{$link->getAdminLink('AdminOrders')|escape:'html':'UTF-8'}&amp;vieworder&amp;id_order={$order->id|intval}">
							<span class="shipping_number_edit" style="display:none;">
							
								<select name="rcarrier">
									<option value="0" selected="selected">USPS</option>
									<option value="UPS">UPS</option>
									<option value="FEDEX">FEDEX</option>
									<option value="DHL">DHL</option>
									<option value="EMS">EMS</option>
								</select>
							    
								<input type="text" name="tracking_number" value="{$line.tracking_number|htmlentities}" />
								<button type="submit" class="btn btn-default" name="submitSameShippingNumber">
									<i class="icon-ok"></i>
									{l s='Update'}
								</button>
							</span>
							<a href="#" class="edit_shipping_number_link btn btn-default">
								<i class="icon-pencil"></i>
								{l s='Edit'}
							</a>
							<a href="#" class="cancel_shipping_number_link btn btn-default" style="display: none;">
								<i class="icon-remove"></i>
								{l s='Cancel'}
							</a>
						</form></td>
    </tr>
	</table>
	
	
	
	{*旧版参考*}
	
	<hr>
	<p>旧版信息参考 物流操作以新版为准 {* count($order->getShipping()) *}</p>
	<table class="table" id="shipping_table" >
	
		<thead>
			<tr>
				<th>
					<span class="title_box ">{l s='Date'}</span>
				</th>
				<th>
					<span class="title_box ">&nbsp;</span>
				</th>
				<th>
					<span class="title_box ">{l s='Carrier'}</span>
				</th>
				<th>
					<span class="title_box ">{l s='Weight'}</span>
				</th>
				<th>
					<span class="title_box ">{l s='Shipping cost'}</span>
				</th>
				<th>
					<span class="title_box ">{l s='Tracking number'}</span>
				</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$order->getShipping() item=line}
			<tr>
				<td>{dateFormat date=$line.date_add full=true}</td>
				<td>&nbsp;</td>
{if $line.rcarrier=='' }
				<td>{$line.carrier_name}</td>
				{else}
<td>{$line.rcarrier}</td>
				{/if}

				<td class="weight">{$line.weight|string_format:"%.3f"} {Configuration::get('PS_WEIGHT_UNIT')}</td>
				<td class="center">
					{if $order->getTaxCalculationMethod() == $smarty.const.PS_TAX_INC}
						{displayPrice price=$line.shipping_cost_tax_incl currency=$currency->id}
					{else}
						{displayPrice price=$line.shipping_cost_tax_excl currency=$currency->id}
					{/if}
				</td>
				<td>
					<span class="shipping_number_show">{if $line.url && $line.tracking_number}<a class="_blank" href="{$line.url|replace:'@':$line.tracking_number}">{$line.tracking_number}</a>{else}{$line.tracking_number}{/if}</span>
				</td>
				<td>
				
				</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
	
</div>
