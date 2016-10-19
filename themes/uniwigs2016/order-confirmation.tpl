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

{capture name=path}{l s='Order confirmation'}{/capture}

<h1 class="page-heading">{l s='Order confirmation'}</h1>

{assign var='current_step' value='payment'}
{include file="$tpl_dir./order-steps.tpl"}

{include file="$tpl_dir./errors.tpl"}

{$HOOK_ORDER_CONFIRMATION}
{$HOOK_PAYMENT_RETURN}
{if $is_guest}
	<p>{l s='Your order ID is:'} <span class="uk-text-bold">{$id_order_formatted}</span> . {l s='Your order ID has been sent via email.'}</p>
    <p class="cart_navigation exclusive uk-margin-top">
	<a class="uk-button" href="{$link->getPageLink('guest-tracking', true, NULL, "id_order={$reference_order|urlencode}&email={$email|urlencode}")|escape:'html':'UTF-8'}" title="{l s='Follow my order'}"><i class="icon-chevron-left"></i>{l s='Follow my order'}</a>
    </p>
{else}
<p class="cart_navigation exclusive">
	<a class="uk-button" href="{$link->getPageLink('history', true)|escape:'html':'UTF-8'}" title="{l s='Go to your order history page'}"><i class="icon-chevron-left"></i>{l s='View your order history'}</a>
</p>
{/if}

<img src="//cdsch2.veinteractive.com/DataReceiverService.asmx/Pixel?journeycode=02777F1F-581B-406B-A475-48DAF47A5813" width="1" height="1"/>

<script>
	ga('require', 'ec');
	ga('ec:setAction', 'purchase',{$id_order_formatted});

	ga(function(tracker) {
	
	  tracker.send('event', 'page_payment_return', 'view','success', {
	   
	  });
	});
</script>
{literal}
{/literal}
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=939483269478039&amp;ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
<!-- Google Code for conv Conversion Page -->
{literal}
<script type="text/javascript">
/*
 <![CDATA[ */
var google_conversion_id = 923345832;

var google_conversion_language = "en";

var google_conversion_format = "3";

var google_conversion_color = "ffffff";

var google_conversion_label = "S8U_CJCfxQ4QqMekuAM";

var google_conversion_value = 1.00;

var google_conversion_currency = "USD";

var google_remarketing_only = false;
/* ]]> */
</script>
{/literal}
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/923345832/?value=1.00&amp;currency_code=USD&amp;label=S8U_CJCfxQ4QqMekuAM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>