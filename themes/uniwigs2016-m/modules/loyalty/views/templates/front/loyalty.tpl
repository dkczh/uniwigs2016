     

{capture name=path}<a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" title="{l s='Manage my account' mod='loyalty'}" rel="nofollow">{l s='My account' mod='loyalty'}</a><span class="navigation-pipe">{$navigationPipe}</span><span class="navigation_page">{l s='My loyalty points' mod='loyalty'}</span>{/capture}



{if true}

<h1 class="page-heading">{l s='My loyalty points' mod='loyalty'}</h1>

{if $orders}
<div class="block-center uk-overflow-container" id="block-history">
	{if $orders && count($orders)}
	<table id="order-list" class="table uk-table">
		<thead>
			<tr>
				<th class="first_item">{l s='Order' mod='loyalty'}</th>
				<th class="item">{l s='Date' mod='loyalty'}</th>
				<th class="item">{l s='Points' mod='loyalty'}</th>
				<th class="item">{l s='Remark' mod='loyalty'}</th>
				{*<th class="last_item">{l s='Points Status' mod='loyalty'}</th>*}
			</tr>
		</thead>
		<tfoot>
			<tr class="alternate_item">
				<td colspan="2" class="history_method bold" style="text-align:center;">{l s='Total points available:' mod='loyalty'}</td>
				<td class="history_method" style="text-align:left;">{$totalPoints|intval}</td>
				<td class="history_method">&nbsp;</td>
			</tr>
		</tfoot>
		<tbody>
		{foreach from=$displayorders item='order'}
			<tr class="alternate_item">
				{if $order.id=='100000000' }
				<td class="history_link bold">{l s='#' mod='loyalty'}GIFT</td>
				{else}
				<td class="history_link bold">{l s='#' mod='loyalty'}{$order.id|string_format:"%06d"}</td>
				{/if}
				<td class="history_date">{dateFormat date=$order.date full=1}</td>
				<td class="history_method">{$order.points|intval}</td>
				{if $order.remark=='' }
				<td class="history_method">purchase</td>
				{else}
				<td class="history_method">{$order.remark|escape:'html':'UTF-8'}</td>
				{/if}
				
				{*<td class="history_method">{$order.state|escape:'html':'UTF-8'}</td>*}
			</tr>
		{/foreach}
		</tbody>
	</table>
	<div id="block-order-detail" class="unvisible">&nbsp;</div>
	{else}
		<p class="alert alert-warning">{l s='You have not placed any orders.' mod='loyalty'}</p>
	{/if}
</div>
<div id="pagination" class="pagination">
	{if $nbpagination < $orders|@count}
		<ul class="pagination">
		{if $page != 1}
			{assign var='p_previous' value=$page-1}
			<li id="pagination_previous">
				<a href="{summarypaginationlink p=$p_previous n=$nbpagination}" title="{l s='Previous' mod='loyalty'}" rel="nofollow">&laquo;&nbsp;{l s='Previous' mod='loyalty'}</a>
			</li>
		{else}
			<li id="pagination_previous" class="disabled"><span>&laquo;&nbsp;{l s='Previous' mod='loyalty'}</span></li>
		{/if}
		{if $page > 2}
			<li><a href="{summarypaginationlink p='1' n=$nbpagination}" rel="nofollow">1</a></li>
			{if $page > 3}
				<li class="truncate">...</li>
			{/if}
		{/if}
		{section name=pagination start=$page-1 loop=$page+2 step=1}
			{if $page == $smarty.section.pagination.index}
				<li class="current"><span>{$page|escape:'html':'UTF-8'}</span></li>
			{elseif $smarty.section.pagination.index > 0 && $orders|@count+$nbpagination > ($smarty.section.pagination.index)*($nbpagination)}
				<li><a href="{summarypaginationlink p=$smarty.section.pagination.index n=$nbpagination}">{$smarty.section.pagination.index|escape:'html':'UTF-8'}</a></li>
			{/if}
		{/section}
		{if $max_page-$page > 1}
			{if $max_page-$page > 2}
				<li class="truncate">...</li>
			{/if}
			<li><a href="{summarypaginationlink p=$max_page n=$nbpagination}">{$max_page}</a></li>
		{/if}
		{if $orders|@count > $page * $nbpagination}
			{assign var='p_next' value=$page+1}
			<li id="pagination_next"><a href="{summarypaginationlink p=$p_next n=$nbpagination}" title="{l s='Next' mod='loyalty'}" rel="nofollow">{l s='Next' mod='loyalty'}&nbsp;&raquo;</a></li>
		{else}
			<li id="pagination_next" class="disabled"><span>{l s='Next' mod='loyalty'}&nbsp;&raquo;</span></li>
		{/if}
		</ul>
	{/if}
	{if $orders|@count > 10}
		<form action="{$pagination_link}" method="get" class="pagination">
			<p>
				<input type="submit" class="button_mini" value="{l s='OK'  mod='loyalty'}" />
				<label for="nb_item">{l s='items:' mod='loyalty'}</label>
				<select name="n" id="nb_item">
				{foreach from=$nArray item=nValue}
					{if $nValue <= $orders|@count}
						<option value="{$nValue|escape:'html':'UTF-8'}" {if $nbpagination == $nValue}selected="selected"{/if}>{$nValue|escape:'html':'UTF-8'}</option>
					{/if}
				{/foreach}
				</select>
				<input type="hidden" name="p" value="1" />
			</p>
		</form>
	{/if}
	</div>
{*<p style="padding:0 10px">{l s='Vouchers generated here are usable in the following categories : ' mod='loyalty'}
	{if $categories}{$categories}{else}{l s='All' mod='loyalty'}{/if}</p>*}
<div class="box">
	{*if $transformation_allowed}
	<input type="text" class="discount_name form-control uk-margin-small-bottom" id="points" placeholder="input your point to transform voucher" name="discount_name">
	<span style="display: none;" id="cuid">{$customerid}</span>
	<span style="display: none;" id="allpoints">{$totalPoints|intval}</span>
	<button  class="uk-button uk-button-primary" onclick='transform()'><span>transform</span></button>
	<div id="result" style="width: 150px; "></div>
	<a class="btn btn-default" style="border: 1px solid;"
		href="{$link->getModuleLink('loyalty', 'default', ['process' => 'transformpoints'], true)|escape:'html':'UTF-8'}" onclick="return confirm('{l s='Are you sure you want to transform your points into vouchers?' mod='loyalty' js=1}');">
		点击转换
	</a>

	<script src="/point.js"></script>

	<p style="text-align:center; margin-top:20px">
		<a href="{$link->getModuleLink('loyalty', 'default', ['process' => 'transformpoints'])|escape:'html'}" onclick="return confirm('{l s='Are you sure you want to transform your points into vouchers?' mod='loyalty' js=1}');">{l s='Transform my points into a voucher of' mod='loyalty'} <span class="price">{convertPrice price=$voucher}</span>.</a>
	</p>


	{/if*}

	{if $nbDiscounts}
	<h1 class="page-heading">{l s='My vouchers from loyalty points' mod='loyalty'}</h1>
	<div class="block-center uk-overflow-container" id="block-history">
		<table id="order-list" class="table uk-table">
			<thead>
				<tr>
					<th class="first_item">{l s='Created' mod='loyalty'}</th>
					<th class="item">{l s='Value' mod='loyalty'}</th>
					<th class="item">{l s='Code' mod='loyalty'}</th>
					<th class="item">{l s='Valid from' mod='loyalty'}</th>
					<th class="item">{l s='Valid until' mod='loyalty'}</th>
					<th class="item">{l s='Status' mod='loyalty'}</th>
					{*<th class="last_item">{l s='Details' mod='loyalty'}</th>*}
				</tr>
			</thead>
			<tbody>
			{foreach from=$discounts item=discount name=myLoop}
				<tr class="alternate_item">
					<td class="history_date">{dateFormat date=$discount->date_add}</td>
					<td class="history_price"><span class="price">{if $discount->reduction_percent > 0}
							{$discount->reduction_percent}%
						{elseif $discount->reduction_amount}
							{displayPrice price=$discount->reduction_amount currency=$discount->reduction_currency}
						{else}
							{l s='Free shipping' mod='loyalty'}
						{/if}</span></td>
					<td class="history_method bold">{$discount->code}</td>
					<td class="history_date">{dateFormat date=$discount->date_from}</td>
					<td class="history_date">{dateFormat date=$discount->date_to}</td>
					<td class="history_method bold">{if $discount->quantity > 0}{l s='To use' mod='loyalty'}{else}{l s='Used' mod='loyalty'}{/if}</td>
				{*	<td class="history_method">
	                    <a rel="#order_tip_{$discount->id|intval}" class="cluetip" title="{l s='Generated by these following orders' mod='loyalty'}" href="{$smarty.server.SCRIPT_NAME|escape:'html':'UTF-8'}">{l s='more...' mod='loyalty'}</a>
	                    <div class="hidden" id="order_tip_{$discount->id|intval}">
							<ul>
							{foreach from=$discount->orders item=myorder name=myLoop}
								<li>
									{$myorder.id_order|string_format:{l s='Order #%d' mod='loyalty'}}
									({displayPrice price=$myorder.total_paid currency=$myorder.id_currency}) :
									{if $myorder.points > 0}{$myorder.points|string_format:{l s='%d points.' mod='loyalty'}}{else}{l s='Cancelled' mod='loyalty'}{/if}
								</li>
							{/foreach}
	                   		</ul>
						</div>
					</td>
					*}
				</tr>
			{/foreach}
			</tbody>
		</table>
		<div id="block-order-detail" class="unvisible">&nbsp;</div>
	</div>

	{if $minimalLoyalty > 0}<p>{l s='The minimum order amount in order to use these vouchers is:' mod='loyalty'} {convertPrice price=$minimalLoyalty}</p>{/if}

	{else}
	<!-- <p class="alert alert-warning">{l s='Your points: 0' mod='loyalty'}</p> -->
	{/if}
	{else}
	<!-- <p class="alert alert-warning">{l s='Your points: 0' mod='loyalty'}</p>  -->
	{/if}
	{else} 
	{* 设计师数据显示*}
	<label for="meeting">开始日期：</label><input id="begintime" type="date" value="{$frontday}"/>
	<label for="meeting">结束日期：</label><input id="endtime" type="date" value="{$nowday}"/>
	<script src="/designer.js"></script>
	<button onclick="mydesinger()">Query</button>
	{*<span>{$smarty.now|date_format:'%Y-%m-%d'}</span>*}
	<span> (default 7 days results) </span>
		<table class="uk-table uk-table-striped">
			<thead>
		        <tr>
		            <th>ID</th>
		            <th>SKU&Color</th>
		            <th>Price</th>
		            <th>Discount</th>
		            <th>Payment</th>
		            <th>Status</th>
		            <th>Time of Payment</th>
		            <th>Delivery Time</th>
		        </tr>
		    </thead>
		    <tbody id='myresult'>
			{foreach $ddate as $d}
		        <tr>
		            <td>{$d.id}</td>
		            <td>{$d.skus}</td>
					<td>${$d.price}</td>
		            <td>{$d.Discount}</td>
		            <td>${$d.payment}</td>
		            <td>{$d.STATUS}</td>
		            <td>{$d.paydate}</td>
		            <td>{$d.delidate}</td>
		            
		        </tr>
			{/foreach}
		    </tbody>
		</table>

	{/if}




	<ul class="footer_links clearfix">
		<li>
			<a class="btn btn-default button button-small" href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" title="{l s='Back to Your Account' mod='loyalty'}" rel="nofollow"><span><i class="icon-chevron-left"></i>{l s='Back to Your Account' mod='loyalty'}</span></a>
		</li>
		<li>
			<a class="btn btn-default button button-small" href="{if isset($force_ssl) && $force_ssl}{$base_dir_ssl}{else}{$base_dir}{/if}" title="{l s='Home' mod='loyalty'}"><span><i class="icon-chevron-left"></i>{l s='Home' mod='loyalty'}</span></a>
		</li>
	</ul>
</div>