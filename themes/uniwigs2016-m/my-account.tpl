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

{capture name=path}{l s='My account'}{/capture}


{if isset($account_created)}
	<p class="uk-alert uk-alert-success" data-uk-alert>
        <a href="" class="uk-alert-close uk-close"></a>
		{l s='Your account has been created.'}
	</p>
{/if}
{*<div class="row addresses-lists">
	<div class="col-xs-12 col-sm-6 col-lg-4">
		<ul class="myaccount-link-list">
            {if $has_customer_an_address}
            <li><a href="{$link->getPageLink('address', true)|escape:'html':'UTF-8'}" title="{l s='Add my first address'}"><i class="icon-building"></i><span>{l s='Add my first address'}</span></a></li>
            {/if}
            <li><a href="{$link->getPageLink('history', true)|escape:'html':'UTF-8'}" title="{l s='Orders'}"><i class="icon-list-ol"></i><span>{l s='Order history and details'}</span></a></li>
            {if $returnAllowed}
                <li><a href="{$link->getPageLink('order-follow', true)|escape:'html':'UTF-8'}" title="{l s='Merchandise returns'}"><i class="icon-refresh"></i><span>{l s='My merchandise returns'}</span></a></li>
            {/if}
            <li><a href="{$link->getPageLink('order-slip', true)|escape:'html':'UTF-8'}" title="{l s='Credit slips'}"><i class="icon-file-o"></i><span>{l s='My credit slips'}</span></a></li>
            <li><a href="{$link->getPageLink('addresses', true)|escape:'html':'UTF-8'}" title="{l s='Addresses'}"><i class="icon-building"></i><span>{l s='My addresses'}</span></a></li>
            <li><a href="{$link->getPageLink('identity', true)|escape:'html':'UTF-8'}" title="{l s='Information'}"><i class="icon-user"></i><span>{l s='My personal information'}</span></a></li>
        </ul>
	</div>
    {if $voucherAllowed || isset($HOOK_CUSTOMER_ACCOUNT) && $HOOK_CUSTOMER_ACCOUNT !=''}
    	<div class="col-xs-12 col-sm-6 col-lg-4">
            <ul class="myaccount-link-list">
                {if $voucherAllowed}
                    <li><a href="{$link->getPageLink('discount', true)|escape:'html':'UTF-8'}" title="{l s='Vouchers'}"><i class="icon-barcode"></i><span>{l s='My vouchers'}</span></a></li>
                {/if}
                {$HOOK_CUSTOMER_ACCOUNT}
            </ul>
        </div>
    {/if}
</div>*}

<div class="user_info">
    <p><span class="sidebar-login-img"><i class="icon-wode"></i></span></p>
  
</div>
<div class="user_center">
    <ul class="clearfix">
        <li>
            <a href="{$link->getPageLink('history', true)|escape:'html':'UTF-8'}">
                <i class="icon-liebiao"></i>
                <span>My Orders</span>
            </a>
        </li>
        <li>
            <a href="{$link->getModuleLink('blockwishlist', 'mywishlist', array(), true)|escape:'html':'UTF-8'}">
                <i class="icon-xin"></i>
                <span>My Wishlist</span>
            </a>
        </li>
        <li>
            <a href="{$link->getPageLink('order-slip', true)|escape:'html':'UTF-8'}">
                <i class="icon-creditcard"></i>
                <span>My Credit Balance</span>
            </a>
        </li>
        <li>
            <a href="{$link->getPageLink('discount', true)|escape:'html':'UTF-8'}">
                <i class="icon-coupon"></i>
                <span>My Coupon Codes</span>
            </a>
        </li>
        <li>
            <a href="{$link->getPageLink('order-follow', true)|escape:'html':'UTF-8'}">
                <i class="icon-change"></i>
                <span>My merchandise returns</span>
            </a>
        </li>
        <li>
            <a href="{$link->getPageLink('identity', true)|escape:'html':'UTF-8'}">
                <i class="icon-bianjirenwu"></i>
                <span>My Profile</span>
            </a>
        </li>
        <li>
            <a href="{$link->getPageLink('addresses', true)|escape:'html':'UTF-8'}">
                <i class="icon-wuliu"></i>
                <span>My Addresses</span>
            </a>
        </li>
        <!-- MODULE Loyalty -->
        <li class="loyalty">
            <a href="{$link->getModuleLink('loyalty', 'default', ['process' => 'summary'], true)|escape:'html':'UTF-8'}" title="{l s='My loyalty points' mod='loyalty'}" rel="nofollow"><i class="icon-meiyuan"></i><span>{l s='My loyalty points' mod='loyalty'}</span></a>
        </li>
        <!-- END : MODULE Loyalty -->
        <li class="signout">
            <a href="{$link->getPageLink('index', true, NULL, "mylogout")|escape:'html':'UTF-8'}">
                <i class="icon-tuichu"></i>
                <span>Sign Out</span>
            </a>
        </li>
    </ul>
</div>
