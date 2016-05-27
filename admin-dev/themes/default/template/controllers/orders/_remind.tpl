<div style="
    border: solid 1px #ddd;
    margin-bottom: 10px;
">
			<p style="
    margin-top: 5px;
    margin-left: 5px;
    font-weight: bold;
">产品定制 时间</p>
<hr>
				<table style="
    margin: 0 auto;
">
					<thead style="
    border-bottom: 1px solid gray;
    padding-bottom: 10px;
">
				<tr>
				<td style="padding: 10px;">订单id</td>
				{*<td style="padding: 10px;">产品</td>*}
				<td style="padding: 10px;">skus</td>
				<td style=" width:180px;padding: 10px;">备货截止日期</td>
				<td style="width:50px;padding: 10px;">p_num</td>
				<td style="width:80px;padding: 10px;">状态</td>
				<td style=" width:80px; padding: 10px;"> 操作人</td>
				<td style=" width:150px; padding: 10px;"> 最后更新</td>
				</tr>
				</thead>
				<tbody>
				{foreach from=$orderremind item=remind}
				<tr>
				
				{if $remind['id_remind']!=''}
				<td style="padding: 10px;">{$remind['id_order']}</td>
				{*<td style="padding: 5px;">{$remind['product_name']}</td>*}
				<td style="padding: 5px;">{$remind['skus']}</td>
				<td style="padding: 5px;">{$remind['date']}</td>
				<td style="padding: 5px;">{$remind['manufacture']}</td>
				<td style="padding: 5px;">{$remind['status']}</td>
				<td style="padding: 5px;">{$remind['actor']}</td>
				<td style="padding: 5px;">{$remind['date_upd']}</td>
				<td>
				<form method="post" action="index.php?controller=AdminOrders&amp;token={$smarty.get.token|escape:'html':'UTF-8'}&amp;vieworder&amp;id_order={$remind['id_order']}">
							<span class="shipping_number_edit" style="display:none;">
								<input type="hidden" name="id_order" value="{$remind['id_order']}">
								<input type="hidden" name="id_remind" value="{$remind['id_remind']}">
								<input type="hidden" name="skus" value="{$remind['skus']}">
								<input type="hidden" name="product_name" value="{htmlspecialchars($remind['product_name'])}">
								<select name="remind_status">
								<option value="生产" checked="checked">生产</option>
								<option value="到货">到货</option>
								<option value="返修">返修</option>
								</select>
								<input type="text" name="remind_manufacture"  value="">
								<input type="date" name="remind_date"  value="{$smarty.now|date_format:'%Y/%m/%d'}"/>
								<button type="submit" class="btn btn-default" name="submitOrderRemind">
									<i class="icon-ok"></i>
									Update
								</button>
							</span>
							<a href="#" class="edit_shipping_number_link btn btn-default">
								<i class="icon-pencil"></i>
									Edit						</a>
							<a href="#" class="cancel_shipping_number_link btn btn-default" style="display: none;">
								<i class="icon-remove"></i>
								Cancel
							</a>
						</form>
				</td>
				{else}
				<td style="padding: 10px;">{$remind['id_order']}</td>
				{*<td style="padding: 5px;">xxx</td>*}
				<td style="padding: 5px;">{$remind['skus']}</td>
				<td style="padding: 5px;">xxx</td>
				<td style="padding: 5px;">xxx</td>
				<td style="padding: 5px;">xxx</td>
				<td style="padding: 5px;">xxx</td>
				<td style="padding: 5px;">xxx</td>
				{if  $order->current_state ==3}
				<td >
					{else}
				<td style=" display: none;">
				{/if}
				<form method="post" action="index.php?controller=AdminOrders&amp;token={$smarty.get.token|escape:'html':'UTF-8'}&amp;vieworder&amp;id_order=100023267">
							<span class="shipping_number_edit" style="display:none;">
								<input type="hidden" name="id_order" value="{$remind['id_order']}">
								<input type="hidden" name="skus" value="{$remind['skus']}">
								<input type="hidden" name="product_name" value="{htmlspecialchars($remind['product_name'])}">
								<select name="remind_status">
								<option value="生产" checked="checked">生产</option>
								<option value="到货">到货</option>
								<option value="返修">返修</option>
								</select>
								<input type="text" name="remind_manufacture"  value="">
								<input type="date" name="remind_date" />
								<button type="submit" class="btn btn-default" name="submitOrderRemind">
									<i class="icon-ok"></i>
									Add
								</button>
							</span>
							<a href="#" class="edit_shipping_number_link btn btn-default">
								<i class="icon-pencil"></i>
								Edit
							</a>
							<a href="#" class="cancel_shipping_number_link btn btn-default" style="display: none;">
								<i class="icon-remove"></i>
								Cancel
							</a>
						</form>
				</td>
				{/if}
	
				</tr>
				{/foreach}						
				</tbody>
				
				</table>
				
				</div>
				
	{if $orderremindhistory }				
				
<div style="
    border: solid 1px #ddd;
    margin-bottom: 10px;
">
			<p style="
    margin-top: 5px;
    margin-left: 5px;
    font-weight: bold;
">操作记录</p>
<hr>
					<table style="
    margin: 0 auto;
">
					<thead style="
    border-bottom: 1px solid gray;
    padding-bottom: 10px;
">
		<tr>
		<td style=" width:550px;padding: 10px;">操作记录</td>
		<td style=" width:180px;padding: 10px;">时间</td>
		</tr>
		</thead>
		<tbody>
	
		{foreach from=$orderremindhistory item=remind_history name=remind_history}
		{if $smarty.foreach.remind_history.first}
		<tr style="background-color: rgba(14, 247, 75, 0.17);color:black;">
		<td style="padding: 5px;">{$remind_history['action']}</td>
		<td style="padding: 5px;">{$remind_history['date_add']}</td>
		</tr>
		{else}
		<tr>
		<td style="padding: 5px;">{$remind_history['action']}</td>
		<td style="padding: 5px;">{$remind_history['date_add']}</td>
		</tr>
		{/if}
		{/foreach}	
		
		</tbody>	
		</table>
</div>
{/if}