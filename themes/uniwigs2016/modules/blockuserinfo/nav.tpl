<!-- Block user information module NAV  -->
{if !$is_logged}
	<div class="header_user_info dropdown uk-button-dropdown" data-uk-dropdown aria-haspopup="true" aria-expanded="false">
		<a id="user-info" class="login_a" href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Log in to your customer account' mod='blockuserinfo'}" >
			{l s='My Account' mod='blockuserinfo'}
		</a>
		<div class="logindown uk-dropdown">
			<ul class="ilogin">
				<li>
					<a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" rel="nofollow" class="uk-button" style="width:100%">Sign In</a>
				</li>
				<li class="sub-nav top_sign">
					<a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" rel="nofollow">Create an Account</a>
				</li>
				<li class="sub-nav">
					<a href="{$base_dir}order-history" rel="nofollow">My Orders</a>
				</li>
				<li class="sub-nav">
					<a href="{$base_dir}module/blockwishlist/mywishlist" rel="nofollow">My Wishlist</a>
				</li>
				<li class="sub-nav">
					<a href="{$base_dir}credit-slip" rel="nofollow">My Credit Slips</a>
				</li>
				<li class="sub-nav">
					<a href="{$base_dir}discount" rel="nofollow">My Coupon Codes</a>
				</li>
				<li class="sub-nav">
					<a href="{$base_dir}identity" rel="nofollow">My Profile</a>
				</li>
			</ul>
		</div>
	</div>
{else}
	<div class="header_user_info dropdown uk-button-dropdown" data-uk-dropdown aria-haspopup="true" aria-expanded="false">
		<a id="user-info" class="login_a" href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Log in to your customer account' mod='blockuserinfo'}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			{l s='My Account' mod='blockuserinfo'}
		</a>
		<ul class="ilogin uk-dropdown">
			<li class="sub-nav">
				<a href="{$base_dir}order-history" rel="nofollow">My Orders</a>
			</li>
			<li class="sub-nav">
				<a href="{$base_dir}module/blockwishlist/mywishlist" rel="nofollow">My Wishlist</a>
			</li>
			<li class="sub-nav">
				<a href="{$base_dir}credit-slip" rel="nofollow">My Credit Slips</a>
			</li>
			<li class="sub-nav">
				<a href="{$base_dir}discount" rel="nofollow">My Coupon Codes</a>
			</li>
			<li class="sub-nav">
				<a href="{$base_dir}identity" rel="nofollow">My Profile</a>
			</li>
			<li class="sub-nav">
				<a href="{$link->getPageLink('index', true, NULL, "mylogout")|escape:'html':'UTF-8'}" rel="nofollow">Sign out</a>
			</li>
		</ul>
	</div>
{/if}
<!-- /Block usmodule NAV -->
