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

<h2>Specifications</h2>

<div style="text-align:center;padding:10px;color:red;font-size:14px;font-weight:bold;">{$msg}</div>

<table class='data_table'>
<tr style="">
	<td colspan="7">
		<a href="{$link_base}&opr=add">添加</a>
		<a href="{$link_base}">刷新</a>
	</td>
</tr>
<tr style="background:#ccc;">
	<th style="width:100px;">id</th>
	<th style="width:160px;">name</th>
	<th style="width:130px;">name cn</th>
	<th>content</th>
	<th style="width:100px;">visible</th>
	<th style="width:100px;">sort index</th>
	<th style="width:130px;">操作</th>
</tr>
{foreach from=$all_specs item="spec"}
<tr>
	<td>{$spec.id_specification}</td>
	<td>{$spec.name}</td>
	<td>{$spec.name_cn}</td>
	<td>{$spec.content|truncate:200|escape}</td>
	<td>{$spec.visible}</td>
	<td>{$spec.sortindex}</td>
	<td>
		<a href="{$link_base}&id_spec={$spec.id_specification}&opr=edit">编辑</a>
		{if $spec.visible}
		<a href="{$link_base}&id_spec={$spec.id_specification}&opr=del" onclick="return confirm('确认删除吗？')">删除</a>
		{else}
		<a href="{$link_base}&id_spec={$spec.id_specification}&opr=undel" onclick="return confirm('确认恢复吗？')">恢复</a>
		{/if}
	</td>
</tr>
{/foreach}
</table>
