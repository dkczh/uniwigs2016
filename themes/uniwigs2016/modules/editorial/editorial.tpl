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
<div class="summer-sale">
	<img src="{$base_dir}themes/uniwigs2016/img/index/summer-sale-banner.jpg" alt="" class="img-responsive">
	<div class="summer-sale-category">
		<ul>
			<li><a href="{$base_dir}40453-celebrity-hairstyles" class="uk-button">celebrity wigs</a></li>
			<li><a href="{$base_dir}tag/diy-dyed-extensions" class="uk-button">diy-dye-extensions</a></li>
			<li><a href="{$base_dir}40459-trendy-wigs" class="uk-button">trendy wigs</a></li>
			<li><a href="http://lavivid.uniwigs.com/" class="uk-button">lavivid</a></li>
		</ul>
	</div>
</div>
<div class="summer-color">
	<div class="summer-color-box">
		<ul id="summer-color-img">
			<li><img src="{$base_dir}themes/uniwigs2016/img/index/summer-color-1.jpg" alt="" class="img-responsive"></li>
			<li><img src="{$base_dir}themes/uniwigs2016/img/index/summer-color-2.jpg" alt="" class="img-responsive"></li>
			<li><img src="{$base_dir}themes/uniwigs2016/img/index/summer-color-3.jpg" alt="" class="img-responsive"></li>
		</ul>
	</div>
	<div class="summer-color-title">
		<img src="{$base_dir}themes/uniwigs2016/img/index/summer-color-title.png" alt="" class="img-responsive">
	</div>
	<div class="summer-color-button">
		<a href="{$base_dir}tag/summer-color" class="uk-button">shop now</a>
	</div>
</div>
</div>
</div>
</div>
</div>
<!-- Module Editorial -->
<style>
	.summer-slae{
		position: relative;
	}
	.summer-sale-category{
		position: absolute;width:50%;margin-top: -26%;margin-left: 5.4%;
	}
	.summer-sale-category a{
		font-size: 1.2em;
	    width: 40%;
	    letter-spacing: 0;
	    font-weight: bold;
	    margin-bottom: 15px;
	}
	.summer-color{
		position: relative;
		margin:100px 0 60px;
		overflow: hidden;
	}
	.summer-color-box{
		float: left;
		width:567px;
	}
	.summer-color-title{
		position: absolute;
		right: 2%;
		margin-top: 6%;
		z-index: 10;
	}
	.summer-color-box .bx-wrapper{
		z-index: 1;
	}
	.summer-color-button{
		position: absolute;
		bottom:22%;
		right: 20%;
	}
	.summer-color-button a{
		font-size: 1.2em;
	    letter-spacing: 0;
	    font-weight: bold;
	    padding: 0 50px;
	}

		
	.sale-banner .row {
	    margin: 0;
	}
	.sale-banner li a .h2 {
	    color: #DC0031;
	}
	@media (min-width: 768px){
		.sale-banner li {
		    float: left;
		    width: 33.333333%;
		    height: 180px;
		    background-color: #EEE;
		}
		.sale-banner li a {
		    display: block;
		    padding: 65px 20px;
		    text-align: center;
		}
		.sale-banner li:nth-child(2n) {
		    background-color: #f4f4f4;
		}
	}
	@media (min-width: 1024px){
		.sale-banner li {
		    float: left;
		    width: 33.333333%;
		    height: 180px;
		    background-color: #EEE;
		}
		.sale-banner li a {
		    display: block;
		    padding: 50px 20px;
		    text-align: center;
		}
	}
	@media (min-width: 1366px){
		.sale-banner li {
		    float: left;
		    width: 33.333333%;
		    height: 245px;
		    background-color: #EEE;
		}
		.sale-banner li a {
		    display: block;
		    padding: 77px;
		    text-align: center;
		}
	}
	@media (min-width: 1440px){
		.sale-banner li {
		    float: left;
		    width: 33.333333%;
		    height: 245px;
		    background-color: #EEE;
		}
		.sale-banner li a {
		    display: block;
		    padding: 90px;
		    text-align: center;
		}
	}
	.customer-show{
		margin-top:60px;
	}
	
	.uk-margin-large-top {
	    margin-top: 40px!important;
	}
</style>
<section class="sale-banner uk-scrollspy-init-inview">
	<ul class="row">
		<li>
			<a href="{$base_dir}content/27-shipping-information">
				<p class="h2">FREE SHIPPING</p>
				<p class="h4">US ORDER OVER $49</p>
			</a>
		</li>
		<li>
			<a href="{$base_dir}login?back=my-account">
				<p class="h4">REGISTER TO GET</p>
				<p class="h2">10% OFF</p>
				<p class="h4">COUPON REG10</p>
			</a>
		</li>
		<li>
			<a href="{$base_dir}content/34-share-your-photos">
				<p class="h2">share your joy</p>
				<p class="h4">FOR A CHANCE TO WIN $100</p>
			</a>
		</li>
	</ul>
</section>
<section id="home_customer_shows_container" class="customer-show container title-hr">

</section>
<!-- /Module Editorial -->
<script type="text/javascript">
$(function() {
	window.load_home_customer_shows = function(){
		$.get("http://rvm.uniwigs.com/api_review3/home_customer_shows",{
		},function(data){
			$("#home_customer_shows_container").html(data);
			after_load_home_customer_shows();
		});
	}
	load_home_customer_shows();
});
</script>
