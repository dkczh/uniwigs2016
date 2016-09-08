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
{*literal}
<style>
.promotion-block a,.home-box a{display: block}
.promotion-block{margin:14px 0;}
.home-category li{float:left;width:50%;padding:10px;}
.home-category li a{display: block;padding:15px 0;border:1px solid #222;font-size:14px;text-align: center;color:#000;background: #fff;text-transform: uppercase;}
.home-category li a:hover{opacity: 0.7;}
.home-category li:nth-child(2n+1){padding-right:5px;}
.home-category li:nth-child(2n){padding-left:5px;}
</style>
{/literal*}

{literal}
<style>
.home-list{
	overflow: hidden}
.home-list li{
	width:50%;
	padding-right:5px;
	margin-bottom:10px;
}
.home-list li:nth-child(2n){
	padding-left:5px;
	padding-right:0;
}
.promotion-block a,.home-box a{display: block}
.promotion-block{margin:14px 0;}
.sale-category{
	background: #fff;
	padding-top: 15px;
}
.sale-category a{
	font-weight: bold;

}

</style>
{/literal}
<div><a href="{$base_dir}40453-celebrity-hairstyles"><img src="{$base_dir}themes/uniwigs2016-m/img/home/celebrity-wig-collection.jpg" alt="celebrity wig collection" class="img-responsive"></a></div>
{*<div>
	<img src="{$base_dir}themes/uniwigs2016-m/img/home/labor-day.png" alt="laboy day sale" class="img-responsive">
</div>*}
<div class="sale-category">
	<ul class="home-list uk-flex uk-flex-wrap">
		<li><a href="{$base_dir}40459-trendy-wigs"><img src="{$img_dir}home/trendy-wigs-new.jpg" alt="trendy wigs" class="img-responsive"></a></li>
		<li><a href="{$base_dir}40452-human-hair-lace-wigs"><img src="{$img_dir}home/classic-lace-wigs.jpg" alt="classic lace wigs" class="img-responsive"></a></li>
		<li><a href="{$base_dir}103-hair-extensions"><img src="{$img_dir}home/hair-extensions.jpg" alt="hair extensions" class="img-responsive"></a></li>
		<li><a href="{$base_dir}tag/lace-closure"><img src="{$img_dir}home/lace-closure.jpg" alt="lace closure" class="img-responsive"></a></li>
	</ul>
</div>
<div class="promotion-block">
	<a href="{$base_dir}login?back=my-account"><img src="/themes/uniwigs2016-m/img/home/m10.png" alt="Enjoy 10% off your first order" class="img-responsive"></a>
</div>
<div class="promotion-block">
	<a href="{$base_dir}tag/toppers"><img src="{$base_dir}themes/uniwigs2016-m/img/milanoo_blank.gif" original="{$base_dir}themes/uniwigs2016-m/img/home/top-hair.jpg" alt="remy human hair lace closure" class="img-responsive"></a>
</div>

<!-- Module Editorial -->

{*<div class="home-category">
	<ul class="row">
		<li><a href="{$base_dir}102-human-hair-wigs">human hair ></a></li>
		<li><a href="{$base_dir}101-synthetic-wigs">synthetic wigs ></a></li>
		<li><a href="{$base_dir}103-hair-extensions">hair extensions ></a></li>
		<li><a href="{$base_dir}104-hair-pieces">hair pieces ></a></li>
	</ul>
</div>
<div class="home-box">
	<ul id="home_trendy">
		<li><a href="{$base_dir}40459-trendy-wigs"><img src="{$img_dir}home/trendy-3.jpg" alt="trendy wigs"></a></li>
		<li><a href="{$base_dir}40459-trendy-wigs"><img src="{$img_dir}home/trendy-2.jpg" alt="trendy wigs"></a></li>
		<li><a href="{$base_dir}40459-trendy-wigs"><img src="{$img_dir}home/trendy-1.jpg" alt="trendy wigs"></a></li>
	</ul>
</div>*}


{*<div class="promotion-block">
	<a href="http://lavivid.uniwigs.com"><img src="{$base_dir}themes/uniwigs2016-m/img/home/lavivid.jpg" alt="lavivid" class="img-responsive"></a>
</div>
<div class="home-box">
	<ul id="home_uniextension">
		<li><a href="{$base_dir}tag/invisible-uni-extensions"><img src="{$img_dir}home/uni-extension-1.jpg" alt="uni extension"></a></li>
		<li><a href="{$base_dir}tag/invisible-uni-extensions"><img src="{$img_dir}home/uni-extension-2.jpg" alt="uni extension"></a></li>
	</ul>
</div>*}
<div class="promotion-block">
	<a href="{$base_dir}customer-show"><img src="{$base_dir}themes/uniwigs2016-m/img/milanoo_blank.gif" original="{$base_dir}themes/uniwigs2016-m/img/home/customer-show.jpg" alt="#uniwigs" class="img-responsive"></a>
</div>
<!-- /Module Editorial -->