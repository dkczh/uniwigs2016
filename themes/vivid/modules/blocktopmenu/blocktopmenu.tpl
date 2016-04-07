<!-- header  -->


{if isset($catagory)}
	<!-- Tag-->

	<!-- Menu -->
		{if $MENU != '' && $page_name =='index'}
		<div id="block_top_menu" class="uk-navbar sf-contener">
			<ul class="uk-navbar-nav">
		        <li><a href="#home-product" data-uk-smooth-scroll="">THE COLLECTION</a></li>
		        <li><a href="#designer" data-uk-smooth-scroll="">THE DESIGNER</a></li>
		        <li><a href="#gallery" data-uk-smooth-scroll="">The Gallery</a></li>
		        <li><a href="#lavivid-Videos" data-uk-smooth-scroll="">The Videos</a></li>
		    </ul>
		</div>
		{/if}
		<!--/ Menu -->

	<!--/ Tag-->
	
{else}
	<!-- Product -->

		<div id="header_logo">
			<a href="/" title="UniWigs">
				<img class="logo" src="{$logo_url}" alt="UniWigs" width="169">
			</a>
		</div>
		<!-- Menu -->
		{if $MENU != '' && $page_name =='index'}
		<div id="block_top_menu" class="uk-navbar sf-contener">
			<ul class="uk-navbar-nav">
		        <li><a href="#home-product" data-uk-smooth-scroll="">THE COLLECTION</a></li>
		        <li><a href="#designer" data-uk-smooth-scroll="">THE DESIGNER</a></li>
		        <li><a href="#gallery" data-uk-smooth-scroll="">The Gallery</a></li>
		        <li><a href="#lavivid-Videos" data-uk-smooth-scroll="">The Videos</a></li>
		    </ul>
		</div>
		{/if}
		<!--/ Menu -->

	<!--/ Product -->
	
{/if}
