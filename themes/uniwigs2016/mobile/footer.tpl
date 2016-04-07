{if !isset($content_only) || !$content_only}
					<footer>
						<div class="livechat">
							<a href="{$base_dir}livechat/chat.php"><i class="icon-chat"></i>Live Chat</a>
						</div>
						<nav class="footer_nav">
							<p>Follow us</p>
							<a href="http://www.facebook.com/uniwigs" class="nav-item"><span class="icon-facebook"></span></a>
							<a href="https://twitter.com/uniwigs" class="nav-item"><span class="icon-twitter"></span></a>
							<a href="http://www.youtube.com/user/uniwigs" class="nav-item"><span class="icon-youtube"></span></a>
							<a href="http://instagram.com/uniwigs" class="nav-item"><span class="icon-instagram"></span></a>
						</nav>
						<div class="foot_user">
							<ul>
								{if !$logged}
								<li><a href="{$base_dir_ssl}signin.php"><span class="icon-login"></span>Login</a></li>
								<li><a href="{$base_dir_ssl}signup.php"><span class="icon-mima"></span>Registered</a></li>
								{else}
								<li>
									<a href="{$base_dir_ssl}user-welcome.php">
										<span class="icon-login"></span>My Account
									</a>
								</li>
								<li>
									<a href="{$base_dir_ssl}?mylogout">
										<span class="icon-tuichu"></span>Sign Out
									</a>
								</li>
								{/if}
								<li><a href="{$base_dir_ssl}order.php"><span class="icon-gouwuche1"></span>Cart <i class="cart_number">{$cart_products_num}</i></a></li>
							</ul>
						</div>
						<div class="full_site">
							<a href="tel:6268102938" class="nav-item"><span class="icon-phone"></span>626-810-2938</a>
							<a href="tel:2132213520" class="nav-item"><span class="icon-phone"></span>213-221-3520</a>
						</div>
						<div class="full_site">
							<a href="{$base_dir}content/contact-us">Contact Us</a>-
							<a href="{$base_dir}content/shipping-information"> Shipping & Tracking</a>-
							<a href="{$base_dir}content/shipping-information"> Privacy Policy</a>
						</div>
						
						<p class="copyright">
						Copyright Notice © 2014 UniWigs.com Store. All Rights Reserved.
						{if $smarty.const._DEVICE_TYPE_!='mobile'}  &nbsp;&nbsp;&nbsp;&nbsp; <a href="javascript:void(0)" onclick="document.location.href=document.location.href.replace('//m.','//www.')">Desktop Version</a>{/if}
						</p>
					</footer>
				</div>
			</section>
{/if}
<a id="backup_a" class="back" href="#"><span class="icon-top"></span></a>
{if $page_name == 'index' or $page_name == 'category' or $page_name == 'search_' or $page_name == 'product_tag' or $page_name == 'product' or $page_name == '2015-big-sale'}
<div class="fix_nav">
    <span class="fix_nav_title"></span>
    <div class="nav_div">
        <div class="nav_list">
            <ul>
                <li class="li1"><a href="{$base_dir_ssl}order.php"><span class="icon-gouwuche"></span><i class="cart_number">{$cart_products_num}</i></a></li>
                <li class="li2"><a href="{$base_dir_ssl}user-welcome.php"><span class="icon-wode"></span></a></li>
                <li class="li4"><a href="#menu" id="hide_menu" data-uk-offcanvas><span class="icon-menu"></span></a></li>
            </ul>
        </div>
    </div>
</div>
{/if}
</div>
</div>
{include file="$tpl_dir./global.tpl"}
<script src="/themes/uniwigs2014_mobile/statics/js/base.min.js{$smarty.const._FRONT_JS_VERSION_}" type="text/javascript"></script>
	</body>
</html>