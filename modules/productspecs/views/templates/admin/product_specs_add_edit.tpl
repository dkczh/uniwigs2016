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

{literal}
<style>
#frm_specs dt,dd{float:left;padding-top:20px;}
#frm_specs dt{clear:left;width:25%;text-align:right;}
#frm_specs dd{margin-left: 10px;width:70%}
#frm_specs dd input[type="text"]{width:500px;}
#frm_specs dd textarea{width:500px;height:200px;}
#frm_specs dd label{margin-right:20px;}
</style>
{/literal}

<form id="frm_specs" method="post">
<dl>
	{if $opr=='add'}
	<dt>SKU</dt>
	<dd>
		<input name="sku" type="text" value="" />
	</dd>
	{/if}
	<dt>Specifications</dt>
	<dd>
		{foreach from=$all_specs item="spec"}
		<label>
		<input type="checkbox" name="id_specifications[]"
			value="{$spec.id_specification}"{if isset($spec.checked) && $spec.checked} checked{/if} />
		{$spec.name}
		</label>
		{/foreach}
	</dd>
	<dt> </dt>
	<dd>
		<button type="submit" name="op_save">保存</button>
		<a href="{$link_base}">取消</a>
	</dd>
	<br style="clear:both;"/>
</dl>
</form>
