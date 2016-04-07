<!DOCTYPE HTML>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"{if isset($language_code) && $language_code} lang="{$language_code|escape:'html':'UTF-8'}"{/if}><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8 ie7"{if isset($language_code) && $language_code} lang="{$language_code|escape:'html':'UTF-8'}"{/if}><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9 ie8"{if isset($language_code) && $language_code} lang="{$language_code|escape:'html':'UTF-8'}"{/if}><![endif]-->
<!--[if gt IE 8]> <html class="no-js ie9"{if isset($language_code) && $language_code} lang="{$language_code|escape:'html':'UTF-8'}"{/if}><![endif]-->
<html{if isset($language_code) && $language_code} lang="{$language_code|escape:'html':'UTF-8'}"{/if}>
	<head>
		<meta charset="utf-8" />
		<title>{$meta_title|escape:'html':'UTF-8'}</title>
		{if isset($meta_description) AND $meta_description}
			<meta name="description" content="{$meta_description|escape:'html':'UTF-8'}" />
		{/if}
		{if isset($meta_keywords) AND $meta_keywords}
			<meta name="keywords" content="{$meta_keywords|escape:'html':'UTF-8'}" />
		{/if}
		<meta name="generator" content="PrestaShop" />
		<meta name="robots" content="{if isset($nobots)}no{/if}index,{if isset($nofollow) && $nofollow}no{/if}follow" />
		<meta name="viewport" content="user-scalable=0, width=device-width, initial-scale=1.0,  minimum-scale=1.0, maximum-scale=1.0" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<link rel="icon" type="image/vnd.microsoft.icon" href="{$favicon_url}?{$img_update_time}" />
		<link rel="shortcut icon" type="image/x-icon" href="{$favicon_url}?{$img_update_time}" />
		<link href="/themes/uniwigs2016/mobile/css/reset.css" rel="stylesheet" type="text/css" media="all">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script type="text/javascript">!window.jQuery && document.write('<SCRIPT type="text/javascript" src="/themes/uniwigs2016/mobile/js/jquery-2.1.4.min.js"><\/SCRIPT>');</script>
		<script type="text/javascript" src="/themes/uniwigs2016/mobile/js/uikit.min.js"></script>
		<link rel="stylesheet" href="http{if Tools::usingSecureMode()}s{/if}://fonts.googleapis.com/css?family=Open+Sans:300,600&amp;subset=latin,latin-ext" type="text/css" media="all" />
		<!--[if IE 8]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		<link rel="apple-touch-icon-precomposed" href="{$base_dir}themes/uniwigs2014_mobile/statics/images/ios/Icon57.png" />
		<link rel="apple-touch-icon" size="72x72" href="{$base_dir}themes/uniwigs2014_mobile/statics/images/ios/Icon72.png" />
		<link rel="apple-touch-icon" size="114x114" href="{$base_dir}themes/uniwigs2014_mobile/statics/images/ios/Icon114.png" />
	</head>
	<body{if isset($page_name)} id="{$page_name|escape:'html':'UTF-8'}"{/if} class="lazyload">

	{if !isset($content_only) || !$content_only}
		{if isset($restricted_country_mode) && $restricted_country_mode}
			<div id="restricted-country">
				<p>{l s='You cannot place a new order from your country.'}{if isset($geolocation_country) && $geolocation_country} <span class="bold">{$geolocation_country|escape:'html':'UTF-8'}</span>{/if}</p>
			</div>
		{/if}
		<div class="all-elements">
			<div id="menu" class="page-sidebar uk-offcanvas">
				<div class="page-sidebar-scroll uk-offcanvas-bar">
					{*<div class="menu-header">
						{include file=$tpl_dir./searchform.html}
					</div>*}
					<div class="navigation-item">
							<a href="#" class="nav-item submenu-deploy">Human Hair Wigs<i class="icon-bottom"></i><i class="icon-top"></i></a>
							<div class="nav-submenu" style="overflow: hidden; display: none;">
								<a href="{$base_dir}tag/human-hair-lace-wigs">Lace Wigs<i class="icon-right"></i></a>
								<a href="{$base_dir}custom-order">Custom Wigs<i class="icon-right"></i></a>
								<a href="{$base_dir}human-hair-wigs">All Products<i class="icon-right"></i></a>
							</div>
					</div>
					<div class="navigation-item">
							<a href="#" class="nav-item submenu-deploy">Synthetic Wigs<i class="icon-bottom"></i><i class="icon-top"></i></a>
							<div class="nav-submenu" style="overflow: hidden; display: none;">
								<a href="{$base_dir}tag/trendy-wigs">Trendy Wigs<i class="icon-right"></i></a>
								<a href="{$base_dir}tag/classic-wigs-synthetic-wigs">Classic Wigs<i class="icon-right"></i></a>
								<a href="{$base_dir}tag/clearance-synthetic-wigs">Clearance<i class="icon-right"></i></a>
								<a href="{$base_dir}synthetic-wigs">All Products<i class="icon-right"></i></a>
							</div>
					</div>
					<div class="navigation-item">
							<a href="#" class="nav-item submenu-deploy">Hair Extensions<i class="icon-bottom"></i><i class="icon-top"></i></a>
							<div class="nav-submenu" style="overflow: hidden; display: none;">
								<a href="{$base_dir}flip-in-hair-extensions">Flip In<i class="icon-right"></i></a>
								<a href="{$base_dir}clip-in-hair-extensions">Clip In<i class="icon-right"></i></a>
								<a href="{$base_dir}event/diy-dyed-extensions">Diy Dyed<i class="icon-right"></i></a>
								<a href="{$base_dir}hair-extensions">All Products<i class="icon-right"></i></a>
							</div>
					</div>
					<div class="navigation-item">
							<a href="#" class="nav-item submenu-deploy">Hairpieces<i class="icon-bottom"></i><i class="icon-top"></i></a>
							<div class="nav-submenu" style="overflow: hidden; display: none;">
								<a href="{$base_dir}tag/mono-hair-pieces">Monofilament<i class="icon-right"></i></a>
								<a href="{$base_dir}tag/lace-closure">Lace Closure<i class="icon-right"></i></a>
								<a href="{$base_dir}tag/fashion-piece">Fashion Piece<i class="icon-right"></i></a>
								<a href="{$base_dir}hair-pieces">All Products<i class="icon-right"></i></a>
							</div>
					</div>
				</div>
			</div>
			<div id="content" class="page-content">
				<header class="fixed-header">
						{if $page_name == 'index'}
							<a href='#menu' id="hide_menu" class="pull-left header-left" data-uk-offcanvas><i class="icon-menu"></i></a>
						{elseif $page_name == 'category' or $page_name == 'product_tag'}
							<a href='#menu' id="hide_menu" class="pull-left header-left" data-uk-offcanvas><i class="icon-menu"></i></a>
						{elseif $page_name == 'my-creditBalance' or $page_name == 'my-account' or $page_name == 'addresses'}
							<a href='{$base_dir_ssl}user-welcome.php' class="pull-left header-left"><i class="icon-left"></i></a>
						{elseif $page_name == 'password'}
							<a href='{$base_dir_ssl}user-welcome.php' class="pull-left header-left"><i class="icon-left"></i></a>
						{elseif $page_name == 'signin' or $page_name == 'signup'}
							<a href='{$base_dir}' class="pull-left header-left"><i class="icon-left"></i></a>
						{else}
							<a href='javascript:history.go(-1);' class="pull-left header-left"><i class="icon-left"></i></a>
						{/if}

						{if $page_name == 'index'}
							<span class="header-center">
								<span><img src="{$base_dir}themes/uniwigs2014_mobile/statics/images/logo.png" alt="uniwigs" width="88"></span>
							</span>
						{elseif $page_name == 'category'}
							<span class="header-center">
								<span>{$category->name}</span>
							</span>
						{elseif $page_name == 'product'}
							<span class="header-center">
								<span>Product Detail</span>
							</span>
						{elseif $page_name == 'user-welcome'}
							<span class="header-center">
								<span>My Account</span>
							</span>
						{elseif $page_name == 'product_tag'}
							<span class="header-center">
								<span>{$tag_name}</span>
							</span>
						{elseif $page_name == 'search_'}
							<span class="header-center">
								<span>{$page_name}{$search_query}</span>
							</span>
						{else}
							<span class="header-center">
								<span>{$page_name}</span>
							</span>
						{/if}

						{if $page_name == 'index'}
							<a href='{$base_dir_ssl}user-welcome.php' class="pull-right header-right"><i class="icon-wode"></i></a>
						{elseif $page_name == 'product' or $page_name == 'user-welcome' or $page_name == 'category' or $page_name == 'product_tag' or $page_name == '404' or $page_name == 'cms' or $page_name == 'customer-show' or $page_name == '2015-big-sale'}
							<a href='{$base_dir}' class="pull-right header-right"><i class="icon-home"></i></a>
						{else}
						{/if}
						
						{*<a href="{$base_dir_ssl}order.php" id="mini_cart"><i class="icon-suitcase"></i><span class="cart_number">{$cart_products_num}</span></a>*}
				</header>
				{if $page_name == 'category' or $page_name == 'index' or $page_name == 'product_tag'}
					<div class="header_search">
						
					</div>
				{/if}
				<section id="wrapper">
					<div class="page-warp">
	{/if}
