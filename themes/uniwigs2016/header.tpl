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
				Customer Show | UniWigs.com -UniWigs ® Official Site
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
			<meta name="description" content="Here your can find all the customer show of Uniwigs.com. You can see how others looks like with the hair extension before and after. Also you can find the real evaluation of UNIWIGS by the customers. 
" />
			<meta name="keywords" content="hair extensions before and after,customer show,uniwigs customer show" />
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
		<meta name="viewport" content="width=device-width, minimum-scale=0.25, maximum-scale=1.6, initial-scale=1.0" />
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
        
        <script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"5225031"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");</script>
        <noscript>
        <img src="//bat.bing.com/action/0?ti=5225031&Ver=2" height="0" width="0" style="display:none; visibility: hidden;" />
        </noscript>
        {/literal}
	</head>
	<body{if isset($page_name)} id="{$page_name|escape:'html':'UTF-8'}"{/if} class="lazyload {if isset($page_name)}{$page_name|escape:'html':'UTF-8'}{/if}{if isset($body_classes) && $body_classes|@count} {implode value=$body_classes separator=' '}{/if}{if $hide_left_column} hide-left-column{else} show-left-column{/if}{if $hide_right_column} hide-right-column{else} show-right-column{/if}{if isset($content_only) && $content_only} content_only{/if} lang_{$lang_iso}">
	{if !isset($content_only) || !$content_only}
		{if isset($restricted_country_mode) && $restricted_country_mode}
			<div id="restricted-country">
				<p>{l s='You cannot place a new order from your country.'}{if isset($geolocation_country) && $geolocation_country} <span class="bold">{$geolocation_country|escape:'html':'UTF-8'}</span>{/if}</p>
			</div>
		{/if}
		<div id="page">
			<div class="header-container">
				<header id="header">
					{capture name='displayBanner'}{hook h='displayBanner'}{/capture}
					{if $smarty.capture.displayBanner}
						{if $page_name !='index'}
						<div class="banner">
							<div class="container">
								<div class="row">
									{$smarty.capture.displayBanner}
								</div>
							</div>
						</div>
						{/if}
					{/if}
					{capture name='displayNav'}{hook h='displayNav'}{/capture}
					{if $smarty.capture.displayNav}
						<div class="nav">
							<div class="container">
								<div class="row">
									<div class="logtab">
										<ul>
											<li class="on">
												<a href="http://www.uniwigs.com">Uniwigs</a>
											</li>
											<li>
												<a href="http://lavivid.uniwigs.com">LaVivid</a>
											</li>
										</ul>
									</div>
									<nav>{$smarty.capture.displayNav}</nav>
								</div>
							</div>
						</div>
					{/if}
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
							{if isset($HOOK_TOP)}{$HOOK_TOP}{/if}
							</div>
						</div>
					</div>
				</header>
				{if isset($category)}
				{if $category->id == '102' or $category->id == '40452' or $category->id == '40453' or $category->id == '105' or $category->id == '40447' or $category->id == '40448' or $category->id == '40446' or $category->id == '40450' or $category->id == '40449' or $category->id == '40451'}
				<div class="banner-sale">
					<div class="container">
						<div class="row">
							<p><span>Human Hair Wigs Halloween Sale </span><span>20% OFF</span><span>code: <b>HHW20</b></span><a href="#sale-details" data-uk-modal>DETAILS</a></p>
						</div>
					</div>
					<div id="sale-details" class="uk-modal">
					    <div class="uk-modal-dialog">
					        <a class="uk-modal-close uk-close uk-close-alt"></a>
					        <div>
					        	<a href="{$base_dir}102-human-hair-wigs">
					        	<img src="/themes/uniwigs2016/img/index/human-hair-sale.png" alt="Human hair wigs Halloween sale" class="img-responsive"></a>
					        </div>
					    </div>
					</div>
				</div>
				{/if}
				
				{if $category->id == '101' or $category->id == '40455' or $category->id == '40459' or $category->id == '40456'}
				<div class="banner-sale">
					<div class="container">
						<div class="row">
							<p><span>Trick or UniWigs </span><span>25% OFF</span><span>code: <b>Halloween25</b></span><a href="#sale-details" data-uk-modal>DETAILS</a></p>
						</div>
					</div>
					<div id="sale-details" class="uk-modal">
					    <div class="uk-modal-dialog">
					        <a class="uk-modal-close uk-close uk-close-alt"></a>
					        <div>
					        	<a href="{$base_dir}tag/halloween-wigs">
					        	<img src="/themes/uniwigs2016/img/index/halloween-sale.png" alt="Halloween Sale" class="img-responsive"></a>
					        </div>
					    </div>
					</div>
				</div>
				{/if}

				{/if}
			</div>
			<div class="columns-container">
				<div id="slider_row" class="row">
					{capture name='displayTopColumn'}{hook h='displayTopColumn'}{/capture}
					{if $smarty.capture.displayTopColumn}
						<div id="top_column" class="center_column col-xs-12 col-sm-12">{$smarty.capture.displayTopColumn}</div>
					{/if}
				</div>
				<div id="columns" class="container">
					{if $page_name !='index' && $page_name !='pagenotfound'}
						{include file="$tpl_dir./breadcrumb.tpl"}
					{/if}
					<div class="row">
						
							{if isset($left_column_size) && !empty($left_column_size)}
							<div id="left_column" class="column col-xs-12 col-sm-{$left_column_size|intval}">
								
								{if isset($category)}
									{if $category->id == '40452' or $category->id == '40453' or $category->id == '105' or $category->id == '40447' or $category->id == '40448' or $category->id == '40446' or $category->id == '40450' or $category->id == '40449' or $category->id == '40451'}
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
									{$HOOK_LEFT_COLUMN}
									{else}
									{$HOOK_LEFT_COLUMN}
									{/if}
								{else}
								{$HOOK_LEFT_COLUMN}
								{/if}


							</div>
							{/if}
						
						
							{if isset($left_column_size) && isset($right_column_size)}
								{assign var='cols' value=(12 - $left_column_size - $right_column_size)}
							{else}
								{assign var='cols' value=12}
							{/if}
					
						<div id="center_column" class="center_column col-xs-12 col-sm-{$cols|intval}">
	{/if}