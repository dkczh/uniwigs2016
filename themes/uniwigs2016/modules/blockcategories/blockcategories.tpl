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

<!-- Block categories module 
<div id="categories_block_left" class="block">
	<h2 class="title_block">
		{if isset($currentCategory)}
			{$currentCategory->name|escape}
		{else}
			{l s='Categories' mod='blockcategories'}
		{/if}
	</h2>
	<div class="block_content">
		<ul class="tree {if $isDhtml}dhtml{/if}">
			{foreach from=$blockCategTree.children item=child name=blockCategTree}
				{if $smarty.foreach.blockCategTree.last}
					{include file="$branche_tpl_path" node=$child last='true'}
				{else}
					{include file="$branche_tpl_path" node=$child}
				{/if}
			{/foreach}
		</ul>
	</div>
</div>-->
{if $currentCategory->id == '40452' or $currentCategory->id == '40453' or $currentCategory->id == '105' or $currentCategory->id == '40447' or $currentCategory->id == '40448' or $currentCategory->id == '40446' or $currentCategory->id == '40450' or $currentCategory->id == '40449' or $currentCategory->id == '40451'}
<div class="block">
	<p class="title_block">how to  (Quick&Easy Tips)</p>
	<div class="block_content text-center">
		<a href="{$base_dir}content/9-how-to-videos" class="img-responsive uk-margin-small-bottom">
			<img src="{$img_dir}category/human-hair/left-video-1.jpg" alt="">
		</a>
		<a href="{$base_dir}content/9-how-to-videos" class="img-responsive">
			<img src="{$img_dir}category/human-hair/left-video-2.jpg" alt="">
		</a>
		<a href="{$base_dir}content/9-how-to-videos" class="uk-button uk-button-link uk-margin-small-bottom">view more ></a>	
	</div>
	<div class="block_content">
		<a href="{$base_dir}content/28-uniwigs-wigs" class="img-responsive uk-margin-small-bottom"><img src="{$img_dir}category/human-hair/left-faq.png" alt=""></a>
		<a href="{$base_dir}customer-show?ca=Human+Hair+Wigs" class="img-responsive uk-margin-small-bottom"><img src="{$img_dir}category/human-hair/left-youtube.png" alt=""></a>
		<a href="{$base_dir}tag/color-ring" class="img-responsive uk-margin-small-bottom"><img src="{$img_dir}category/human-hair/left-color-tips.jpg" alt=""></a>
	</div>
</div>
{/if}
<!-- /Block categories module -->

