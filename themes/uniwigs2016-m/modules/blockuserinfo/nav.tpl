<!-- Block user information module NAV  -->
{if $page_name == 'my-account' or $page_name == 'category' or $page_name == 'product' or $page_name == 'search' or $page_name == 'tag' or $page_name == 'cms' or $page_name == 'authentication' or $page_name == 'contact'}
<div class="header_home">
	<a class="back_home" href="{$link->getPageLink('index', true)|escape:'html':'UTF-8'}" rel="nofollow"></a>
</div>
{elseif $page_name == 'addresses'}
<div class="header_add">
	<a href="{$link->getPageLink('address', true)|escape:'html':'UTF-8'}" rel="nofollow"></a>
</div>
{elseif $page_name == 'history' or $page_name == 'module-blockwishlist-mywishlist' or $page_name == 'order-slip' or $page_name == 'discount' or $page_name == 'order-follow' or $page_name == 'identity' or $page_name == 'address' or $page_name == 'order-opc'}

{else}
<div class="header_user_info">
	<a class="login" href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Log in to your customer account' mod='blockuserinfo'}"></a>
</div>
{/if}
<!-- /Block usmodule NAV -->
