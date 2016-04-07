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
{if !isset($content_only) || !$content_only}
		<!-- .columns-container -->
		{if isset($HOOK_FOOTER)}
			<!-- Footer -->
			<div class="footer-container">
				<footer id="footer"  class="container">
					<div class="row">{$HOOK_FOOTER}</div>
				</footer>
			</div><!-- #footer -->
			<a id="backup_a" class="back" href="#header" data-uk-smooth-scroll><span class="icon-top"></span></a>
			{if $page_name == 'index' or $page_name == 'category' or $page_name == 'search' or $page_name == 'product' or $page_name == 'tag'}
			<div class="fix_nav">
			    <span class="fix_nav_title"></span>
			    <div class="nav_div">
			        <div class="nav_list">
			            <ul>
			                <li class="li1"><a href="{$base_dir}quick-order"><span class="icon-gouwuche"></span><i class="cart_number">{$cart_qties}</i></a></li>
			                <li class="li2"><a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}"><span class="icon-wode"></span></a></li>
			                <li class="li4"><a href="#block_top_menu" data-uk-offcanvas><span class="icon-menu"></span></a></li>
			            </ul>
			        </div>
			    </div>
			</div>
			{/if}
		{/if}
		<!-- #page -->
	</div>
</div>
{/if}
{include file="$tpl_dir./global.tpl"}
	</body>
</html>