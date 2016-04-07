{*
* 2007-2014 PrestaShop
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
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{if $page_total>1}
{literal}
<style>
ul.pagination{text-align:center;height: 40px;list-style-type:none}
ul.pagination li{list-style-type:none; display:inline;}
ul.pagination a{padding:5px 10px;border:1px solid #000;}
ul.pagination a.currpa{background-color:#ccc;}
</style>
{/literal}
<ul class="pagination">
	<li><a{if $pa>1} href="{$link_base}&pa={$pa-1}"{/if}>Prev</a></li>

	{section name="i" loop=$page_total}
	<li>
	{if $smarty.section.i.rownum != $pa}
	<a href="{$link_base}&pa={$smarty.section.i.rownum}">{$smarty.section.i.rownum}</a>
	{else}
	<a class='currpa'>{$smarty.section.i.rownum}</a>
	{/if}
	</li>
	{/section}

	<li><a{if $pa>1} href="{$link_base}&pa={$pa+1}"{/if}>Next</a></li>
</ul>
{/if}
