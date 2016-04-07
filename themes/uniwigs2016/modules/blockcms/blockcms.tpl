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

{if $block == 1}
	<!-- Block CMS module -->
	{foreach from=$cms_titles key=cms_key item=cms_title}
		<section id="informations_block_left_{$cms_key}" class="block informations_block_left">
			<p class="title_block">
				<a href="{$cms_title.category_link|escape:'html':'UTF-8'}">
					{if !empty($cms_title.name)}{$cms_title.name}{else}{$cms_title.category_name}{/if}
				</a>
			</p>
			<div class="block_content list-block">
				<ul>
					{foreach from=$cms_title.categories item=cms_page}
						{if isset($cms_page.link)}
							<li class="bullet">
								<a href="{$cms_page.link|escape:'html':'UTF-8'}" title="{$cms_page.name|escape:'html':'UTF-8'}">
									{$cms_page.name|escape:'html':'UTF-8'}
								</a>
							</li>
						{/if}
					{/foreach}
					{foreach from=$cms_title.cms item=cms_page}
						{if isset($cms_page.link)}
							<li>
								<a href="{$cms_page.link|escape:'html':'UTF-8'}" title="{$cms_page.meta_title|escape:'html':'UTF-8'}">
									{$cms_page.meta_title|escape:'html':'UTF-8'}
								</a>
							</li>
						{/if}
					{/foreach}
					{if $cms_title.display_store}
						<li>
							<a href="{$link->getPageLink('stores')|escape:'html':'UTF-8'}" title="{l s='Our stores' mod='blockcms'}">
								{l s='Our stores' mod='blockcms'}
							</a>
						</li>
					{/if}
				</ul>
			</div>
		</section>
	{/foreach}
	<!-- /Block CMS module -->
{else}
<section class="container">
	<!-- Block CMS module footer -->
	<section class="footer-block col-xs-12 col-sm-9" id="block_various_links_footer">
		{*<h4>{l s='Information' mod='blockcms'}</h4>
		<ul class="toggle-footer">
			{if isset($show_price_drop) && $show_price_drop && !$PS_CATALOG_MODE}
				<li class="item">
					<a href="{$link->getPageLink('prices-drop')|escape:'html':'UTF-8'}" title="{l s='Specials' mod='blockcms'}">
						{l s='Specials' mod='blockcms'}
					</a>
				</li>
			{/if}
			{if isset($show_new_products) && $show_new_products}
			<li class="item">
				<a href="{$link->getPageLink('new-products')|escape:'html':'UTF-8'}" title="{l s='New products' mod='blockcms'}">
					{l s='New products' mod='blockcms'}
				</a>
			</li>
			{/if}
			{if isset($show_best_sales) && $show_best_sales && !$PS_CATALOG_MODE}
				<li class="item">
					<a href="{$link->getPageLink('best-sales')|escape:'html':'UTF-8'}" title="{l s='Top sellers' mod='blockcms'}">
						{l s='Top sellers' mod='blockcms'}
					</a>
				</li>
			{/if}
			{if isset($display_stores_footer) && $display_stores_footer}
				<li class="item">
					<a href="{$link->getPageLink('stores')|escape:'html':'UTF-8'}" title="{l s='Our stores' mod='blockcms'}">
						{l s='Our stores' mod='blockcms'}
					</a>
				</li>
			{/if}
			{if isset($show_contact) && $show_contact}
			<li class="item">
				<a href="{$link->getPageLink($contact_url, true)|escape:'html':'UTF-8'}" title="{l s='Contact us' mod='blockcms'}">
					{l s='Contact us' mod='blockcms'}
				</a>
			</li>
			{/if}
			{foreach from=$cmslinks item=cmslink}
				{if $cmslink.meta_title != ''}
					<li class="item">
						<a href="{$cmslink.link|escape:'html':'UTF-8'}" title="{$cmslink.meta_title|escape:'html':'UTF-8'}">
							{$cmslink.meta_title|escape:'html':'UTF-8'}
						</a>
					</li>
				{/if}
			{/foreach}
			{if isset($show_sitemap) && $show_sitemap}
			<li>
				<a href="{$link->getPageLink('sitemap')|escape:'html':'UTF-8'}" title="{l s='Sitemap' mod='blockcms'}">
					{l s='Sitemap' mod='blockcms'}
				</a>
			</li>
			{/if}
		</ul>*}
		<dl class="row">
			<dd class="col-md-3 col-sm-3">
				<h4>{l s='COMPANY' mod='blockcms'}</h4>
				<ul class="toggle-footer">
					<li class="item">
						<a href="{$base_dir}content/4-about-us">About Us</a>
					</li>
					<li class="item">
						<a href="http://blog.uniwigs.com/">Wigs Blog</a>
					</li>
					<li class="item">
						<a href="{$base_dir}content/32-uniwigs-charity">Uniwigs Charity</a>
					</li>
					<li class="item">
						<a href="{$base_dir}content/24-uniwigs-affiliate-program">Uniwigs Affiliate</a>
					</li>
				</ul>
			</dd>
			<dd class="col-md-3 col-sm-3">
				<h4>{l s='SERVICE' mod='blockcms'}</h4>
				<ul class="toggle-footer">
					<li class="item">
						<a href="{$base_dir}">Coupons</a>
					</li>
					<li class="item">
						<a href="{$base_dir}content/17-determine-your-wig-size">Wigs Size</a>
					</li>
					<li class="item">
						<a href="{$base_dir}content/18-choosing-a-color-for-wigs">Choosing a Color</a>
					</li>
					<li class="item">
						<a href="{$base_dir}content/category/2-help-center">Help Center</a>
					</li>
					<li class="item">
						<a href="{$base_dir}content/9-how-to-videos">Unwigs TV</a>
					</li>
					<li class="item">
						<a href="{$base_dir}sitemap.xml">Sitemap</a>
					</li>
				</ul>
			</dd>
			<dd class="col-md-3 col-sm-3">
				<h4>{l s='POLICIES' mod='blockcms'}</h4>
				<ul class="toggle-footer">
					<li class="item">
						<a href="{$base_dir}content/2-return-policy">Return Policy</a>
					</li>
					<li class="item">
						<a href="{$base_dir}content/26-privacy-policy">Privacy Policy</a>
					</li>
					<li class="item">
						<a href="{$base_dir}content/27-shipping-information">Shipping & Tracking</a>
					</li>
					<li class="item">
						<a href="{$base_dir}content/33-terms-conditions">Terms and Conditions</a>
					</li>
				</ul>
			</dd>
			<dd class="col-md-3 col-sm-3">
				<h4>{l s='NOW FEATURING' mod='blockcms'}</h4>
				<ul class="toggle-footer">
					{*<li class="item">
						<a href="{$base_dir}">Hot Tags</a>
					</li>*}
					<li class="item">
						<a href="{$base_dir}tag/uniwigs-featured">Featured</a>
					</li>
					<li class="item">
						<a href="{$base_dir}40451-jewish-wigs">Jewish Wigs</a>
					</li>
					<li class="item">
						<a href="{$base_dir}tag/kanekalon-synthetic-wigs">Kanekalon Synthetic Wigs</a>
					</li>
					<li class="item">
						<a href="{$base_dir}tag/ombre-human-hair-wigs">Ombre Hair Products</a>
					</li>
					<li class="item">
						<a href="{$base_dir}tag/hair-loss">Wigs For Hair Loss</a>
					</li>
				</ul>
			</dd>
		</dl>

		{$footer_text}
	</section>
	<!-- /Block CMS module footer -->
{/if}
