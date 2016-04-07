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
<div id="contact-link" {if isset($is_logged) && $is_logged} class="is_logged"{/if}>
	<a href="{$link->getPageLink('contact', true)|escape:'html':'UTF-8'}" title="{l s='Contact us' mod='blockcontact'}">{l s='Contact us' mod='blockcontact'}</a>
</div>
<div class="top_help uk-button-dropdown" data-uk-dropdown aria-haspopup="true" aria-expanded="false">
	<a id="top_help" href="#" rel="nofollow" title="{l s='help center' mod='blockuserinfo'}">
		{l s='Help' mod='blockuserinfo'}
	</a>
	<div class="ilogin uk-dropdown uk-dropdown-flip">
		<div class="clearfix">
			<ul>
				<li class="uk-nav-header">For Wigs</li>
				<li>
					<a href="{$base_dir}content/16-wig-cap-constructions">
						Wig Cap Constructions
					</a>
				</li>
				<li>
					<a href="{$base_dir}content/17-determine-your-wig-size">
						Determine Your Wig Size
					</a>
				</li>
				<li>
					<a href="{$base_dir}content/18-choosing-a-color-for-wigs">
						Color Selection
					</a>
				</li>
				<li>
					<a href="{$base_dir}content/19-how-to-apply-a-wig">
						How To Apply A Wig
					</a>
				</li>
				
				<li>
					<a href="{$base_dir}content/20-how-to-style-a-wig">
						How To Style A Wig
					</a>
				</li>
				<li>
					<a href="{$base_dir}content/21-how-to-wash">
						How To Wash
					</a>
				</li>
				<li>
					<a href="{$base_dir}content/22-how-to-maintain">
						How To Maintain
					</a>
				</li>
			</ul>
			<ul>
				<li class="uk-nav-header">For Hair Extensions or Hairpieces</li>

				<li>
					<a href="{$base_dir}content/13-choosing-a-color-for-extensions">
						Color Selection
					</a>
				</li>
				<li>
					<a href="{$base_dir}content/10-how-to-wear-remove-clip-in-hair-extensions">
						How To Wear Clip In
					</a>
				</li>
				<li>
					<a href="{$base_dir}content/11-how-to-wear-remove-flip-in-hair-extensions">
						How To Wear Flip In
					</a>
				</li>
				<li>
					<a href="{$base_dir}content/12-how-to-wear-wefts">
						How To Wear Wefts
					</a>
				</li>
				<li>
					<a href="{$base_dir}content/14-how-to-wear-lace-closure">
						How To Wear Lace Closure
					</a>
				</li>
				<li>
					<a href="{$base_dir}content/15-how-to-care-hair-extensions-and-hair-pieces">
						How To Care
					</a>
				</li>
			</ul>
		</div>
		<div>
			<a href="{$base_dir}content/9-how-to-videos">
				<img src="{$img_dir}public/how-to-videos.jpg" width="100%">
			</a>
		</div>
	</div>
</div>