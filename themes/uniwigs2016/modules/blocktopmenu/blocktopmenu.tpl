<!-- header  -->
{if isset($catagory)}
	<!-- Tag-->

	{if  $catagory!==""}

	<span></span>
	{include file="$tpl_dir/tags/{$catagory}-header.html"}

	{else}
	<!-- Menu -->
		{if $MENU != ''}
		<div id="block_top_menu" class="uk-navbar sf-contener">
			<ul class="uk-navbar-nav">
		        <li><a href="{$base_dir}102-human-hair-wigs">Human Hair Wigs</a></li>
		        <li><a href="{$base_dir}101-synthetic-wigs">Synthetic Wigs</a></li>
		        <li><a href="{$base_dir}103-hair-extensions">Hair Extensions</a></li>
		        <li><a href="{$base_dir}104-hair-pieces">Hairpieces</a></li>
		        <li><a href="{$base_dir}customer-show">Customer Show</a></li>
		    </ul>
		</div>
		{/if}
		<!--/ Menu -->
	{/if}
	<!--/ Tag-->
	
{else}
	<!-- Product -->
	{if isset($product_catagory)}
		{if  $product_catagory!==""}
		{include file="$tpl_dir/tags/{$product_catagory}-header.html"}
		{/if}
	{else}
		<div id="header_logo">
			<a href="/" title="UniWigs">
				<img class="logo" src="{$logo_url}" alt="UniWigs" width="169">
			</a>
		</div>
		<!-- Menu -->
		{if $MENU != ''}
		<div id="block_top_menu" class="uk-navbar sf-contener">
			<ul class="uk-navbar-nav">
		        <li><a href="{$base_dir}102-human-hair-wigs">Human Hair Wigs</a></li>
		        <li><a href="{$base_dir}101-synthetic-wigs">Synthetic Wigs</a></li>
		        <li><a href="{$base_dir}103-hair-extensions">Hair Extensions</a></li>
		        <li><a href="{$base_dir}104-hair-pieces">Hairpieces</a></li>
		        <li><a href="{$base_dir}customer-show">Customer Show</a></li>
		    </ul>
		</div>
		{/if}
		<!--/ Menu -->
	{/if}
	<!--/ Product -->
	
{/if}
