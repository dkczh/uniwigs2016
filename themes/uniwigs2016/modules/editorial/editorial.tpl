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


{*<div id="editorial_block_center" class="editorial_block">
	{if $editorial->body_home_logo_link}<a href="{$editorial->body_home_logo_link|escape:'html':'UTF-8'}" title="{$editorial->body_title|escape:'html':'UTF-8'|stripslashes}">{/if}
	{if $homepage_logo}<img class="img-responsive" src="{$link->getMediaLink($image_path)|escape:'html'}" alt="{$editorial->body_title|escape:'html':'UTF-8'|stripslashes}" {if $image_width}width="{$image_width}"{/if} {if $image_height}height="{$image_height}" {/if}/>{/if}
	{if $editorial->body_home_logo_link}</a>{/if}
	{if $editorial->body_logo_subheading}<p id="editorial_image_legend">{$editorial->body_logo_subheading|stripslashes}</p>{/if}
	{if $editorial->body_title}<h1>{$editorial->body_title|stripslashes}</h1>{/if}
	{if $editorial->body_subheading}<h2>{$editorial->body_subheading|stripslashes}</h2>{/if}
	{if $editorial->body_paragraph}<div class="rte">{$editorial->body_paragraph|stripslashes}</div>{/if}
</div>*}
</div>
</div>
</div>
</div>
<!-- Module Editorial -->
<style>
	.sale-banner .row {
	    margin: 0;
	}
	.sale-banner li a .h2 {
	    color: #DC0031;
	}
	@media (min-width: 768px){
		.sale-banner li {
		    float: left;
		    width: 33.333333%;
		    height: 180px;
		    background-color: #EEE;
		}
		.sale-banner li a {
		    display: block;
		    padding: 65px 20px;
		    text-align: center;
		}
		.sale-banner li:nth-child(2n) {
		    background-color: #f4f4f4;
		}
	}
	@media (min-width: 1024px){
		.sale-banner li {
		    float: left;
		    width: 33.333333%;
		    height: 180px;
		    background-color: #EEE;
		}
		.sale-banner li a {
		    display: block;
		    padding: 50px 20px;
		    text-align: center;
		}
	}
	@media (min-width: 1366px){
		.sale-banner li {
		    float: left;
		    width: 33.333333%;
		    height: 245px;
		    background-color: #EEE;
		}
		.sale-banner li a {
		    display: block;
		    padding: 77px;
		    text-align: center;
		}
	}
	@media (min-width: 1440px){
		.sale-banner li {
		    float: left;
		    width: 33.333333%;
		    height: 245px;
		    background-color: #EEE;
		}
		.sale-banner li a {
		    display: block;
		    padding: 90px;
		    text-align: center;
		}
	}
	.customer-show{
		margin-top:60px;
	}
	
	.uk-margin-large-top {
	    margin-top: 40px!important;
	}
</style>
<section class="sale-banner uk-scrollspy-init-inview">
	<ul class="row">
		<li>
			<a href="{$base_dir}content/27-shipping-information">
				<p class="h2">FREE SHIPPING</p>
				<p class="h4">US ORDER OVER $49</p>
			</a>
		</li>
		<li>
			<a href="{$base_dir}login?back=my-account">
				<p class="h4">REGISTER TO GET</p>
				<p class="h2">10% OFF</p>
				<p class="h4">COUPON REG10</p>
			</a>
		</li>
		<li>
			<a href="{$base_dir}content/34-share-your-photos">
				<p class="h2">share your joy</p>
				<p class="h4">FOR A CHANCE TO WIN $100</p>
			</a>
		</li>
	</ul>
</section>
<section id="home_customer_shows_container" class="customer-show container title-hr">

</section>
<!-- /Module Editorial -->
<script type="text/javascript">
$(function() {
	window.load_home_customer_shows = function(){
		$.get("http://rvm.uniwigs.com/api_review3/home_customer_shows",{
		},function(data){
			$("#home_customer_shows_container").html(data);
			after_load_home_customer_shows();
		});
	}
	load_home_customer_shows();
});
</script>
