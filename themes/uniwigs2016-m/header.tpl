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
<!DOCTYPE HTML>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"{if isset($language_code) && $language_code} lang="{$language_code|escape:'html':'UTF-8'}"{/if}><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8 ie7"{if isset($language_code) && $language_code} lang="{$language_code|escape:'html':'UTF-8'}"{/if}><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9 ie8"{if isset($language_code) && $language_code} lang="{$language_code|escape:'html':'UTF-8'}"{/if}><![endif]-->
<!--[if gt IE 8]> <html class="no-js ie9"{if isset($language_code) && $language_code} lang="{$language_code|escape:'html':'UTF-8'}"{/if}><![endif]-->
<html{if isset($language_code) && $language_code} lang="{$language_code|escape:'html':'UTF-8'}"{/if}>
	<head>
		<meta charset="utf-8" />
		<title>
			{*tag 关键词*}
			{if $page_name == 'tag'}{$res.title}
			{elseif $page_name == 'extra/custom-order'}
				Shop Custom Wigs at Uniwigs.com
			{else}
				{*customer show  关键词*}
				{if isset($cshow)}
					Uniwigs Reviews | Customer Show - UniWigs ® Official Site
				{else}
					{$meta_title|escape:'html':'UTF-8'}
				{/if}
			
			{/if}
		</title>
		{if $page_name == 'tag'}
			<meta name="description" content="{$res.description}" />
			<meta name="keywords" content="{$res.keyword}" />
		{elseif $page_name == 'extra/custom-order'}
			<meta name="description" content="Find the most suitable custom wigs with Uniwigs.com, shop for most natural and light weight custom made wigs here." />
			<meta name="keywords" content="custom wigs,custom made wigs" />
		{else}
			{if isset($cshow)}
			<meta name="description" content="Here your can find all the Uniwigs reviews,complaints and customer show. You can see how others looks like with the wigs and hairpieces from Uniwigs.com." />
			<meta name="keywords" content="uniwigs review,uniwigs reviews,uniwig review,uniwig reviews,uniwigs complaints,uniwigs customer show,uniwigs.com reviews,uniwigs complaint,uniwigs extensions review,uniwigs ombre review" />
			{else}
				{if isset($meta_description) AND $meta_description}
					<meta name="description" content="{$meta_description|escape:'html':'UTF-8'}" />
				{/if}
				{if isset($meta_keywords) AND $meta_keywords}
					<meta name="keywords" content="{$meta_keywords|escape:'html':'UTF-8'}" />
				{/if}
			{/if}
		{/if}
		<meta name="robots" content="{if isset($nobots)}no{/if}index,{if isset($nofollow) && $nofollow}no{/if}follow" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="p:domain_verify" content="d68fca74a52eb1928a678cebb9a8f099"/>
		<meta name="author" content="Uniwigs">

		<link rel="icon" type="image/vnd.microsoft.icon" href="{$favicon_url}?{$img_update_time}" />
		<link rel="shortcut icon" type="image/x-icon" href="{$favicon_url}?{$img_update_time}" />
		{if isset($css_files)}
			{foreach from=$css_files key=css_uri item=media}
				<link rel="stylesheet" href="{$css_uri|escape:'html':'UTF-8'}" type="text/css" media="{$media|escape:'html':'UTF-8'}" />
			{/foreach}
		{/if}
		{if isset($js_defer) && !$js_defer && isset($js_files) && isset($js_def)}
			{$js_def}
			{foreach from=$js_files item=js_uri}
			<script type="text/javascript" src="{$js_uri|escape:'html':'UTF-8'}"></script>
			{/foreach}
		{/if}
		{$HOOK_HEADER}
		<link rel="stylesheet" href="http{if Tools::usingSecureMode()}s{/if}://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin,latin-ext" type="text/css" media="all" />
		<link rel="manifest" href="manifest.json">
    	<!-- See https://developers.google.com/web/updates/2014/11/Support-for-theme-color-in-Chrome-39-for-Android -->
		<link rel="apple-touch-icon-precomposed" href="{$base_dir}themes/uniwigs2016-m/img/ios/Icon57.png" />
		<link rel="apple-touch-icon" size="72x72" href="{$base_dir}themes/uniwigs2016-m/img/ios/Icon72.png" />
		<link rel="apple-touch-icon" size="114x114" href="{$base_dir}themes/uniwigs2016-m/img/ios/Icon114.png" />
		<!--[if IE 8]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		{literal}
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics_debug.js','ga');
		 
		  ga('create', 'UA-34159663-1', 'auto');
		  ga('send', 'pageview');
		 
		</script>
		{/literal}
	</head>
	<body{if isset($page_name)} id="{$page_name|escape:'html':'UTF-8'}"{/if} class="lazyload {if isset($page_name)}{$page_name|escape:'html':'UTF-8'}{/if}{if isset($body_classes) && $body_classes|@count} {implode value=$body_classes separator=' '}{/if}{if $hide_left_column} hide-left-column{else} show-left-column{/if}{if $hide_right_column} hide-right-column{else} show-right-column{/if}{if isset($content_only) && $content_only} content_only{/if} lang_{$lang_iso}">
	{if !isset($content_only) || !$content_only}
		{if isset($restricted_country_mode) && $restricted_country_mode}
			<div id="restricted-country">
				<p>{l s='You cannot place a new order from your country.'}{if isset($geolocation_country) && $geolocation_country} <span class="bold">{$geolocation_country|escape:'html':'UTF-8'}</span>{/if}</p>
			</div>
		{/if}
		<div id="page" class="all-elements">
			{if isset($HOOK_TOP)}{$HOOK_TOP}{/if}
			<header id="header" class="row">
				{capture name='displayNav'}{hook h='displayNav'}{/capture}
				{if $smarty.capture.displayNav}
					{if $page_name == 'index' or $page_name == 'category' or $page_name == 'tag'}
						<a href="#block_top_menu" class="cat-title" data-uk-offcanvas></a>
					{elseif $page_name == 'history' or $page_name == 'module-blockwishlist-mywishlist' or $page_name == 'order-slip' or $page_name == 'discount' or $page_name == 'order-follow' or $page_name == 'identity' or $page_name == 'addresses'}
						<a href='{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}' class="header-left"></a>
					{elseif $page_name == 'order-opc'}
						<a href='{$link->getPageLink('index', true)|escape:'html':'UTF-8'}' class="header-left"></a>

					{else}
						<a href='javascript:history.go(-1);' class="header-left"></a>
					{/if}

					{if $page_name == 'index'}
						<h1 id="header_logo">
							<a href="{if isset($force_ssl) && $force_ssl}{$base_dir_ssl}{else}{$base_dir}{/if}" title="{$shop_name|escape:'html':'UTF-8'}">
								<img class="logo img-responsive" src="{$logo_url}" alt="{$shop_name|escape:'html':'UTF-8'}" width="90"/>
							</a>
						</h1>
					{elseif $page_name == 'category'}
						<h1 id="header_logo">
							<span>{$category->name}</span>
						</h1>
					{elseif $page_name == 'tag'}
						<h1 id="header_logo">
							<span>{$tag->name}</span>
						</h1>
					{elseif $page_name == 'module-blockwishlist-mywishlist'}
						<h1 id="header_logo">
							<span>My Wishlist</span>
						</h1>
					{else}
						<h1 id="header_logo">
							<span>{$page_name}</span>
						</h1>
					{/if}
					{$smarty.capture.displayNav}
				{/if}
				{*</header>cart block*}
			<div class="columns-container">
				{if isset($left_column_size) && !empty($left_column_size)}
				<div id="left_column" class="column col-xs-12 col-sm-{$left_column_size|intval}">{$HOOK_LEFT_COLUMN}</div>
				{/if}
				<div id="center_column" class="center_column">
	{/if}
