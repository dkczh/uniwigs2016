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
.data_table{border-collapse: collapse;border-spacing: 0;line-height:20px;width: 100%;}
.data_table td,.data_table th{padding:2px; border:1px solid #000;word-break: break-all;}
</style>
{/literal}

<h2>Product Specifications</h2>

<div style="text-align:center;padding:10px;color:red;font-size:14px;font-weight:bold;">{$msg}</div>

<table class='data_table'>
<tr style="">
	<td colspan="7">
		<a href="{$link_base}&opr=add">添加</a>
		<a href="{$link_base}">刷新</a>
	</td>
</tr>
<tr style="background:#ccc;">
	<th style="width:160px;">sku</th>
	<th>specifications</th>
	<th style="width:130px;">操作</th>
</tr>
{foreach from=$product_specs_list item="product_specs"}
<tr>
	<td>{$product_specs.sku}</td>
	<td>{$product_specs.specifications}</td>
	<td>
		<a href="{$link_base}&sku={$product_specs.sku|escape}&opr=edit">编辑</a>
		<a href="{$link_base}&sku={$product_specs.sku|escape}&opr=del" onclick="return confirm('确认删除吗？')">删除</a>
	</td>
</tr>
{/foreach}
</table>
