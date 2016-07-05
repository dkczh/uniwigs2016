/*
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
*/
window.after_load_home_customer_shows = function() {
  $('#bxslider').bxSlider({
		minSlides: 1,
		maxSlides: 4,
		slideWidth: 270,
		slideMargin: 20,
		pager: false,
		nextText: '',
		prevText: '',
		moveSlides:1,
		infiniteLoop:false,
		hideControlOnEnd: true
	});
};
$(document).ready(function(){
  	$('#summer-color-img').bxSlider({
  		mode:'fade',
		useCSS: true,
		maxSlides: 1,
		slideWidth: 567,
		infiniteLoop: true,
		hideControlOnEnd: true,
		pager: false,
		autoHover: false,
		auto: true,
		speed: parseInt(1),
		pause: 2000,
		controls: false,
	});
})