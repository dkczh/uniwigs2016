{literal}
<style>
.breadcrumb{display: none}
#columns.container{max-width: 100%;padding: 0;}
.container img{width:100%;display:block;}
.figure{margin:0;padding:0}
.theme-popbod .theme-form input, .theme-popbod .theme-form textarea {
background: #FFF;
border: 1px solid #DDD;
color: #B2B2B6;
letter-spacing: 0.5px;
padding: 10px;
outline: none;
margin: 0;
width: 100%;
max-width: 100%;
display: block;
vertical-align: baseline;
margin-bottom: 20px;
margin-top: 5px;
-webkit-transition: 0.2s border linear;
-moz-transition: 0.2s border linear;
transition: 0.2s border linear;
-webkit-transform: translateZ(0);
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
-webkit-background-clip: padding;
-moz-background-clip: padding;
background-clip: padding-box;
-webkit-border-radius: 0;
-moz-border-radius: 0;
border-radius: 0;
-webkit-appearance: none;
}
.theme-popover {
z-index: 9999;
position: clearfixed;
top: 50%;
left: 50%;
margin: -230px 0 0 -330px;
background-color: #FFF;
display: none;
}
.close{right: -50px;
background: none;
border: 0;
color: #FFF;
font-size: 70px;
line-height: 40px;
width: 40px;
height: 40px;
top: 0;}
.close:hover{text-decoration: none;}
.theme-popover-1{padding:30px;width:600px;height:425px}
.theme-popover-2{
padding: 30px;
width: 909px;
margin: -230px 0 0 -485px;}
.theme-popover-mask {
z-index: 9998;
position: clearfixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background: #000;
opacity: 0.4;
filter: alpha(opacity=40);
display: none;
}
.salon-owner-top{background:url("/extra/tpls/salon/images/bg.png") repeat;}
.salon-owner-top h1{font-size:30px;color:#fff;text-align:center;text-transform: uppercase;line-height: 36px;}
.salon-owner-top b{font-size:36px}
.salon-owner-top b:after{border-top:1px solid #fff;}
.salon-owner-top p{color:#d9d9d9;text-align:center;padding:15px;font-size:13px}
.salon-owner-top h1 span{border-top:1px solid #fff;display:inline-block;width: 133px;height: 13px;}
.salon-btn a{display:inline-block;padding:8px 20px;background:#b73661;border:4px solid #fff;color:#fff;font-size:14px;text-transform: uppercase;width:300px;text-align:center;border-left:0 none}
.salon-btn a:hover{text-decoration: none;background:#DB4778}
.salon-btn a span{font-size: 32px;vertical-align: middle;padding: 0 10px 0 0;}
.salon-cap,.salon-box ul{overflow:hidden}
.salon-btn{overflow:hidden}
.salon-cap .row,.salon-show .row{margin-left:-20px;margin-right:-20px;}
.salon-cap li{float:left;width:33.333333%;padding:20px;}
.salon-cap li.end,.salon-team li.end,.salon-show li.end{margin-right:0}
.salon-box h3{text-align:center;font-size:24px;height: 50px;line-height: 50px;margin: 30px 0;}
.salon-box h3 span{background:#333;color:#fff;padding:10px 25px}
.salon-team li{float:left;width:25%;border-bottom:1px solid #eee;text-align:center;margin-bottom: 30px;padding:10px;}
.salon-show li{width:33.333333%;padding:20px;float:left}
.salon-contact h3{font-size:24px;color:#333;line-height: 30px;margin-bottom: 30px;text-align: center;border-bottom: 1px solid #222;}
.salon-contact h3 em{border-top:1px solid #333;display:inline-block;width: 428px;height: 10px;}
.salon-contact h3 span{padding:0 15px}
.salon-contact .map{float:left;margin-right:50px;height:450px}
.salon-info strong{font-size:17px;font-weight:400}
.salon-info{font-family:Verdana}
.salon-info p{padding-bottom:15px;line-height:30px}
.salon-reviews h3{font-size:20px;margin:30px 0}
.salon-reviews-box>ul>li{overflow:hidden;margin: 0;padding: 18px 0;border-bottom: 1px solid #E5E5E1;padding-bottom: 17px;}
.review {margin: 0 -15px;}
.review .review-sidebar {float: left;padding: 0 15px;min-height: 1px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 15%;}
.review .review-wrapper {float: left;padding: 0 15px;min-height: 1px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 85%;}
.review .review-sidebar-content {margin-top: -3px;}
.review-sidebar .media-avatar {margin-right: 9px;}
.review-sidebar .img {border-radius: 4px;diplay:block}
.media-story {-webkit-box-flex: 1;-moz-box-flex: 1;-webkit-flex: 1;-ms-flex: 1;flex: 1;}
.review-sidebar .user-display-name {font-size: 14px;line-height: 1.28571em;font-weight: bold;}
.ig-common {
display: inline-block;
top: 0;
width: 16px;
height: 16px;
background-image: url("/extra/tpls/salon/images/common.png");
background-repeat: no-repeat;
background-position: -999px -999px;
}
.i-friends-orange-common-wrap {
padding-left: 17px;
line-height: 13px;
}
.ig-wrap-common {
line-height: 16px;
padding-left: 20px;
position: relative;
display: inline-block;
}
.ig-wrap-common .ig-common {
display: block;
position: absolute;
left: 0;
}
.i-friends-orange-common {
background-position: -3px -1059px;
width: 13px;
height: 13px;
}
.i-star-orange-common {
background-position: -3px -2166px;
width: 13px;
height: 13px;
}

.review .review-content {
padding: 0 12px 6px 0;
min-height: 156px;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
word-wrap: break-word;
}
.biz-rating {
margin-bottom: 12px;
}
.rating-very-large {
overflow: hidden;
position: relative;
width: 126px;
height: 22px;
float: left;
margin: -3px 6px 0 0;
}
.biz-rating-very-large .rating-very-large {
float: left;
margin: -3px 6px 0 0;
}
.star-img {
display: block;
width: 100%;
height: 100%;
background: url("/extra/tpls/salon/images/stars_map.png") no-repeat;
}
.rating-very-large .stars_5 {
background-position: -3px -739px;
}
.offscreen {
clip: rect(0 0 0 0);
position: absolute;
left: -9999px;
top: auto;
overflow: hidden;
width: 1px;
height: 1px;
}
.ufc-feedback {
font-size: 12px;
line-height: 1.5em;
color: #555;
}
.biz-rating .rating-qualifier {
display: block;
float: left;
color: #555;
}
.review-footer .rateReview {
float: left;
margin-bottom: 0;
}
.rateReview .review-intro {
white-space: nowrap;
margin-bottom: 6px;
font-weight: bold;
}
.review-footer .rateReview ul {
margin-top: -1px;
}
.ytype {
font-size: 14px;
line-height: 1.28571em;
}
.rateReview .ufc-stat {
margin-right: 6px;display:inline-block
}
.ybtn {
cursor: pointer;
-webkit-user-select: none;
-khtml-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
display: inline-block;
vertical-align: middle;
margin: 0;
padding: 7px 16px;
border: 1px solid;
border-color: #CDCDCD;
border-color: rgba(0, 0, 0, 0.2);
border-radius: 4px;
font-size: 14px;
line-height: 1.28571em;
font-weight: bold;
text-align: center;
color: #333;
background: #F8F8F8;
background: -webkit-linear-gradient(#FFF, #EEE);
background: linear-gradient(#FFF, #EEE);
-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1),inset 0 -2px 2px rgba(0, 0, 0, 0.05),inset 0 -1px 1px #FFF;
box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1),inset 0 -2px 2px rgba(0, 0, 0, 0.05),inset 0 -1px 1px #FFF;
}
.ybtn-small {
padding: 5px 8px;
font-size: 12px;
line-height: 1.5em;
-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
}
a.ybtn {
text-decoration: none !important;
}
.big-ufc .ytype.ybtn {
border-radius: 2px;
padding: 5px 6px;
white-space: nowrap;
}
.i-big-ufc-useful-common {
background-position: -3px -255px;
width: 12px;
height: 18px;
}
.i-big-ufc-funny-common {
background-position: -3px -234px;
width: 18px;
height: 18px;
}
.i-big-ufc-cool-common {
background-position: -3px -214px;
width: 15px;
height: 17px;
}
.theme-popbod-1 p{color:#333;text-align:left;padding:0}
</style>
{/literal}


<div class="clearfix">

	<div class="std">

		<div id="jmainll">

				<div class="salon-owner-top salon-box">
					<div class="container">
						<div><a href="/salon/salon-owner"><img src="/extra/tpls/salon/images/salon-n.jpg" style="margin:40px 0 0"></a></div>
						<div class="salon-banner"><img src="/extra/tpls/salon/images/s_banner.jpg" style="margin:30px 0 20px"></div>
						<h1>Members of Uniwigs Salon Program<br><span></span><b>Salon Syndicate</b><span></span></h1>
						<p>Salon Syndicate was founded in 1967. Located in prestigious Encino, one of Southern California’s most affluent communities, it is a leading trendsetting boutique salon.<br>Working with Uniwigs creates a new option for Salon Syndicate’s customers. Ready-to-wear, Semi-finished and custom made wigs are all available on Uniwigs.com and in Salon Syndicate. You can turn to Salon Syndicate for expert customization, washing, restoration, and servicing.</p>
						<h3><span>Wigs Show</span></h3>
						<div class="salon-cap mt30">
							<ul class="row">
								<li><img src="/extra/tpls/salon/images/cap1.jpg"></li>
								<li><img src="/extra/tpls/salon/images/cap2.jpg"></li>
								<li class="end"><img src="/extra/tpls/salon/images/cap3.jpg"></li>
								<li><img src="/extra/tpls/salon/images/cap4.jpg"></li>
								<li><img src="/extra/tpls/salon/images/cap5.jpg"></li>
								<li class="end"><img src="/extra/tpls/salon/images/cap6.jpg"></li>
							</ul>
						</div>
						<!-- Pop-up window start -->
						<div class="theme-popover theme-popover-1">
							<a href="javascript:;" title="close" class="close close-1">×</a>
							 <div class="theme-popbod theme-popbod-1">
								   <form action="" method="post" class="theme-form" novalidate="novalidate">
								   <input name="merchant_email" value="info@syndicatesalon.com" type="hidden"/>
										<p>Your Name (required)<br>
											<span class="theme-form-control-wrap your-name"><input type="text" name="your-name" value="" size="40" class="theme-form-control theme-text theme-validates-as-required" aria-required="true" aria-invalid="false"></span> </p>
										<p>Your Email (required)<br>
											<span class="theme-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="theme-form-control theme-text theme-email theme-validates-as-required theme-validates-as-email" aria-required="true" aria-invalid="false"></span> </p>
										<p>Subject<br>
											<span class="theme-form-control-wrap your-subject"><input type="text" name="your-subject" value="" size="40" class="theme-form-control theme-text" aria-invalid="false"></span> </p>
										<p>Your Message<br>
											<span class="theme-form-control-wrap your-message"><textarea name="your-message" cols="40" rows="5" class="theme-form-control theme-textarea" aria-invalid="false"></textarea></span> </p>
										<p><button type="submit" class="f-btn btn-small">send</button></p>
										<div class="theme-response-output theme-display-none"></div>
									</form>
							 </div>
						</div>
						<div class="theme-popover-mask theme-popover-mask-1"></div>

						<div class="theme-popover theme-popover-2">
							<a href="javascript:;" title="close" class="close close-2">×</a>
							 <div class="theme-popbod theme-popbod-1">
								<p style="padding-bottom:10px">Show the Picture of Coupon When You Come To Salon Syndicate</p>
								<img src="/extra/tpls/salon/images/coupen.png" width="909">
							 </div>
						</div>
						<div class="theme-popover-mask theme-popover-mask-2"></div>
						<!-- Pop-up window end -->
					</div>
				</div>
				<div class="salon-box salon-team container">
					<h3><span>Team of Salon Syndicate</span></h3>
					<ul class="row">
						<li>
							<figure><img src="/extra/tpls/salon/images/s1.jpg"></figure>
							<p>
								<h4>AMANDA ESTEY</h4>
								<span>ARTIST</span>
							</p>
						</li>
						<li>
							<figure><img src="/extra/tpls/salon/images/s2.jpg"></figure>
							<p>
								<h4>JULIE SIMPSON</h4>
								<span>ARTIST</span>
							</p>
						</li>
						<li>
							<figure><img src="/extra/tpls/salon/images/s3.jpg"></figure>
							<p>
								<h4>KRISTEN THOMAS</h4>
								<span>ARTIST</span>
							</p>
						</li>
						<li class="end">
							<figure><img src="/extra/tpls/salon/images/s4.jpg"></figure>
							<p>
								<h4>LARK SPENCER</h4>
								<span>ARTIST</span>
							</p>
						</li>
						<li>
							<figure><img src="/extra/tpls/salon/images/s5.jpg"></figure>
							<p>
								<h4>LINDA MCLEAN</h4>
								<span>ARTIST</span>
							</p>
						</li>
						<li>
							<figure><img src="/extra/tpls/salon/images/s6.jpg"></figure>
							<p>
								<h4>MICHELLE RAHN</h4>
								<span>ARTIST</span>
							</p>
						</li>
						<li>
							<figure><img src="/extra/tpls/salon/images/s7.jpg"></figure>
							<p>
								<h4>SARAH BAKHTIAR</h4>
								<span>ARTIST</span>
							</p>
						</li>
						<li class="end">
							<figure><img src="/extra/tpls/salon/images/s8.jpg"></figure>
							<p>
								<h4>CARMELA BALLON</h4>
								<span>ARTIST</span>
							</p>
						</li>
					</ul>
				</div>
				<div class="salon-box salon-show container">
					<h3><span>Clients Show</span></h3>
					<ul class="row">
						<li>
							<figure><img src="/extra/tpls/salon/images/show1.jpg"></figure>
						</li>
						<li>
							<figure><img src="/extra/tpls/salon/images/show2.jpg"></figure>
						</li>
						<li class="end">
							<figure><img src="/extra/tpls/salon/images/show3.jpg"></figure>
						</li>
						<li>
							<figure><img src="/extra/tpls/salon/images/show4.jpg"></figure>
						</li>
						<li>
							<figure><img src="/extra/tpls/salon/images/show5.jpg"></figure>
						</li>
						<li class="end">
							<figure><img src="/extra/tpls/salon/images/show6.jpg"></figure>
						</li>
					</ul>
				</div>
				<div class="salon-contact container clearfix">
					<h3><span>CONTACT</span></h3>
					<div class="map"><img src="/extra/tpls/salon/images/map.png"></div>
					<div class="salon-info">
						<p>
							<strong>16919 Ventura Blvd, Encino, CA 91316</strong>
							<br>
							<b>Phone: (818) 981-1020</b>
							<br>
							Email: info@syndicatesalon.com
						</p>
						<div class="salon-btn">
								<a href="javascript:;" class="salon-make theme-login-1"><span class="icon-pencil"></span>Make Appointment</a>
								<a href="javascript:;" class="salon-coupon theme-login-2"><span class="icon-sale"></span>salon syndicate coupon offer</a>
						</div>
						<p>HOURS:<br>
							Mon: Closed<br>
							Tues: 8:00 am – 5:00 pm<br>
							Wed: 7:30 am – 6:30 pm<br>
							Thurs: 8:00 am – 7:00 pm<br>
							Fri: 7:30 am – 6:30 pm<br>
							Sat: 7:30 am – 6:00 pm<br>
							Sun: Closed
						</p>
					</div>
				</div>
				<div class="salon-reviews container">
					<h3>Recommended Reviews From Yelp</h3>
					<div class="radio-btn"><ul></ul></div>
					<div class="salon-reviews-box">
						<ul>
							<li>
								<div class="review">
									<div class="review-sidebar">
										<div class="review-sidebar-content">
											<div class="media-avatar fll"><img src="/extra/tpls/salon/images/60s.jpg"></div>
											<div class="media-story">
												<ul class="user-passport-info">
													<li class="user-name">
														<span class="user-display-name">Michael L.</span>
													</li>
													<li class="user-location">
														<b>Burbank, CA</b>
													</li>
												</ul>
												<ul class="user-passport-stats">
													<li class="friend-count">
														<span class="ig-wrap-common i-friends-orange-common-wrap"><i class="ig-common i-friends-orange-common"></i> <b>5</b> friends</span>
													</li>
													<li class="review-count">
														<span class="ig-wrap-common i-star-orange-common-wrap"><i class="ig-common i-star-orange-common"></i> <b>4</b> reviews</span>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="review-wrapper">
										<div class="review-content">
											<div class="biz-rating clearfix">
												<div class="rating-very-large">
													<i class="star-img stars_5" title="5.0 star rating">
														<img alt="5.0 star rating" class="offscreen" height="303" src="/extra/tpls/salon/images/stars_map.png" width="84">
													</i>
												</div>
												<span class="rating-qualifier">3/21/2014</span>
											</div>
											<p>
												Just had an EXCELLENT haircut today by the one and only Kristen!!! Her skills are top notch (she's an educator for L'oreal) and has a very friendly personality to boot. She's a great listener made sure I got exactly what I wanted. <br><br>The salon is absolutely gorgeous and they carry a great selection of products (Kerastase, Davines, Shu Uemura, etc.).<br><br>I highly suggest booking a service here because you WILL NOT be disappointed!
											</p>
										</div>
										<div class="review-footer clearfix">
											<div class="rateReview ufc-feedback clearfix" >
												<p class="review-intro review-message saving-msg">
													Was this review …?
												</p>
												<ul class="big-ufc">
													<li class="ufc-stat inline-block ytype">
														<a href="javascript:;" rel="useful" class="ybtn ybtn-small useful ytype"><span class="i-wrap ig-wrap-common i-big-ufc-useful-common-wrap button-content"><i class="i ig-common i-big-ufc-useful-common"></i>     <span class="vote-type">Useful</span>
													<span class="count"></span></span></a>
													</li>

													<li class="ufc-stat inline-block ytype">
														<a href="javascript:;" rel="funny" class="ybtn ybtn-small funny ytype"><span class="i-wrap ig-wrap-common i-big-ufc-funny-common-wrap button-content"><i class="i ig-common i-big-ufc-funny-common"></i>     <span class="vote-type">Funny</span>
													<span class="count"></span></span></a>
													</li>

													<li class="ufc-stat inline-block ytype">
														<a href="javascript:;" rel="cool" class="ybtn ybtn-small cool ytype"><span class="i-wrap ig-wrap-common i-big-ufc-cool-common-wrap button-content"><i class="i ig-common i-big-ufc-cool-common"></i>     <span class="vote-type">Cool</span>
													<span class="count"></span></span></a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="review">
									<div class="review-sidebar">
										<div class="review-sidebar-content">
											<div class="media-avatar fll"><img src="/extra/tpls/salon/images/61s.jpg"></div>
											<div class="media-story">
												<ul class="user-passport-info">
													<li class="user-name">
														<span class="user-display-name">Jessica W.</span>
													</li>
													<li class="user-location">
														<b>WOODLAND HLS, CA</b>
													</li>
												</ul>
												<ul class="user-passport-stats">
													<li class="friend-count">
														<span class="ig-wrap-common i-friends-orange-common-wrap"><i class="ig-common i-friends-orange-common"></i> <b>31</b> friends</span>
													</li>
													<li class="review-count">
														<span class="ig-wrap-common i-star-orange-common-wrap"><i class="ig-common i-star-orange-common"></i> <b>13</b> reviews</span>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="review-wrapper">
										<div class="review-content">
											<div class="biz-rating clearfix">
												<div class="rating-very-large">
													<i class="star-img stars_5" title="5.0 star rating">
														<img alt="5.0 star rating" class="offscreen" height="303" src="/extra/tpls/salon/images/stars_map.png" width="84">
													</i>
												</div>
												<span class="rating-qualifier">2/10/2014</span>
											</div>
											<p>
												If you want to have a truly relaxing and enjoyable experience this is the salon for you! &nbsp;Everyone here is so friendly and will go out of their way to make you comfortable - bring you a cuppachino, feed your parking meter and are genuinely happy to see you.<br><br>My stylist Kristen is fantastic! &nbsp;She always gives me exactly what I want - she does amazing color, and I always leave feeling beautiful.
											</p>
										</div>
										<div class="review-footer clearfix">
											<div class="rateReview ufc-feedback clearfix" >
												<p class="review-intro review-message saving-msg">
													Was this review …?
												</p>
												<ul class="big-ufc">
													<li class="ufc-stat inline-block ytype">
														<a href="javascript:;" rel="useful" class="ybtn ybtn-small useful ytype"><span class="i-wrap ig-wrap-common i-big-ufc-useful-common-wrap button-content"><i class="i ig-common i-big-ufc-useful-common"></i>     <span class="vote-type">Useful</span>
													<span class="count"></span></span></a>
													</li>

													<li class="ufc-stat inline-block ytype">
														<a href="javascript:;" rel="funny" class="ybtn ybtn-small funny ytype"><span class="i-wrap ig-wrap-common i-big-ufc-funny-common-wrap button-content"><i class="i ig-common i-big-ufc-funny-common"></i>     <span class="vote-type">Funny</span>
													<span class="count"></span></span></a>
													</li>

													<li class="ufc-stat inline-block ytype">
														<a href="javascript:;" rel="cool" class="ybtn ybtn-small cool ytype"><span class="i-wrap ig-wrap-common i-big-ufc-cool-common-wrap button-content"><i class="i ig-common i-big-ufc-cool-common"></i>     <span class="vote-type">Cool</span>
													<span class="count"></span></span></a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="review">
									<div class="review-sidebar">
										<div class="review-sidebar-content">
											<div class="media-avatar fll"><img src="/extra/tpls/salon/images/62s.jpg"></div>
											<div class="media-story">
												<ul class="user-passport-info">
													<li class="user-name">
														<span class="user-display-name">Nurit K.</span>
													</li>
													<li class="user-location">
														<b>Van Nuys, CA</b>
													</li>
												</ul>
												<ul class="user-passport-stats">
													<li class="friend-count">
														<span class="ig-wrap-common i-friends-orange-common-wrap"><i class="ig-common i-friends-orange-common"></i> <b>11</b> friends</span>
													</li>
													<li class="review-count">
														<span class="ig-wrap-common i-star-orange-common-wrap"><i class="ig-common i-star-orange-common"></i> <b>8</b> reviews</span>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="review-wrapper">
										<div class="review-content">
											<div class="biz-rating clearfix">
												<div class="rating-very-large">
													<i class="star-img stars_5" title="5.0 star rating">
														<img alt="5.0 star rating" class="offscreen" height="303" src="/extra/tpls/salon/images/stars_map.png" width="84">
													</i>
												</div>
												<span class="rating-qualifier">5/30/2014</span>
											</div>
											<p>
												Lark is FABULOUS! I picked this place because it was close and had good reviews, so I was nervous going my first time, but it was fantastic. The place has great atmosphere, and Lark was wonderful. I had a vague idea what I wanted and he figured out a way to frame my face just right. And great customer service to boot! I have been getting all sorts of comments! I will definitely be back!
											</p>
										</div>
										<div class="review-footer clearfix">
											<div class="rateReview ufc-feedback clearfix" >
												<p class="review-intro review-message saving-msg">
													Was this review …?
												</p>
												<ul class="big-ufc">
													<li class="ufc-stat inline-block ytype">
														<a href="javascript:;" rel="useful" class="ybtn ybtn-small useful ytype"><span class="i-wrap ig-wrap-common i-big-ufc-useful-common-wrap button-content"><i class="i ig-common i-big-ufc-useful-common"></i>     <span class="vote-type">Useful</span>
													<span class="count"></span></span></a>
													</li>

													<li class="ufc-stat inline-block ytype">
														<a href="javascript:;" rel="funny" class="ybtn ybtn-small funny ytype"><span class="i-wrap ig-wrap-common i-big-ufc-funny-common-wrap button-content"><i class="i ig-common i-big-ufc-funny-common"></i>     <span class="vote-type">Funny</span>
													<span class="count"></span></span></a>
													</li>

													<li class="ufc-stat inline-block ytype">
														<a href="javascript:;" rel="cool" class="ybtn ybtn-small cool ytype"><span class="i-wrap ig-wrap-common i-big-ufc-cool-common-wrap button-content"><i class="i ig-common i-big-ufc-cool-common"></i>     <span class="vote-type">Cool</span>
													<span class="count"></span></span></a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="review">
									<div class="review-sidebar">
										<div class="review-sidebar-content">
											<div class="media-avatar fll"><img src="/extra/tpls/salon/images/63s.jpg"></div>
											<div class="media-story">
												<ul class="user-passport-info">
													<li class="user-name">
														<span class="user-display-name">Katrina T.</span>
													</li>
													<li class="user-location">
														<b>Sherman Oaks, CA</b>
													</li>
												</ul>
												<ul class="user-passport-stats">
													<li class="friend-count">
														<span class="ig-wrap-common i-friends-orange-common-wrap"><i class="ig-common i-friends-orange-common"></i> <b>11</b> friends</span>
													</li>
													<li class="review-count">
														<span class="ig-wrap-common i-star-orange-common-wrap"><i class="ig-common i-star-orange-common"></i> <b>8</b> reviews</span>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="review-wrapper">
										<div class="review-content">
											<div class="biz-rating clearfix">
												<div class="rating-very-large">
													<i class="star-img stars_5" title="5.0 star rating">
														<img alt="5.0 star rating" class="offscreen" height="303" src="/extra/tpls/salon/images/stars_map.png" width="84">
													</i>
												</div>
												<span class="rating-qualifier">3/37/2014</span>
											</div>
											<p>
												A top notch Salon.  No need to drive all the way to Beverly Hills for an extraordinary hair care experience.  I have had the Syndicate take care off my highlights, cut and blow-drys for the last 3 years and they keep exceeding my expectations.  From the organized front desk to their personable employees and stylists, the Syndicate is an experience in customer service I look forward to each visit.<br>
												Besides being ascetically gorgeous and impeccably clean, you can tell that the owners Brian Dahl and Daniel Combs take pride in their stylist education and knowledge of products available on the market.
											</p>
										</div>
										<div class="review-footer clearfix">
											<div class="rateReview ufc-feedback clearfix" >
												<p class="review-intro review-message saving-msg">
													Was this review …?
												</p>
												<ul class="big-ufc">
													<li class="ufc-stat inline-block ytype">
														<a href="javascript:;" rel="useful" class="ybtn ybtn-small useful ytype"><span class="i-wrap ig-wrap-common i-big-ufc-useful-common-wrap button-content"><i class="i ig-common i-big-ufc-useful-common"></i>     <span class="vote-type">Useful</span>
													<span class="count"></span></span></a>
													</li>

													<li class="ufc-stat inline-block ytype">
														<a href="javascript:;" rel="funny" class="ybtn ybtn-small funny ytype"><span class="i-wrap ig-wrap-common i-big-ufc-funny-common-wrap button-content"><i class="i ig-common i-big-ufc-funny-common"></i>     <span class="vote-type">Funny</span>
													<span class="count"></span></span></a>
													</li>

													<li class="ufc-stat inline-block ytype">
														<a href="javascript:;" rel="cool" class="ybtn ybtn-small cool ytype"><span class="i-wrap ig-wrap-common i-big-ufc-cool-common-wrap button-content"><i class="i ig-common i-big-ufc-cool-common"></i>     <span class="vote-type">Cool</span>
													<span class="count"></span></span></a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
		</div>
	</div>
</div>
{literal}
<script>
jQuery(document).ready(function($) {
	$('.theme-login-1').click(function(){
		$('.theme-popover-mask-1').fadeIn(100);
		$('.theme-popover-1').slideDown(200);
	})
	$('.theme-popover-1 .close-1').click(function(){
		$('.theme-popover-mask-1').fadeOut(100);
		$('.theme-popover-1').slideUp(200);
	})

	$('.theme-login-2').click(function(){
		$('.theme-popover-mask-2').fadeIn(100);
		$('.theme-popover-2').slideDown(200);
	})
	$('.theme-popover-2 .close-2').click(function(){
		$('.theme-popover-mask-2').fadeOut(100);
		$('.theme-popover-2').slideUp(200);
	})


	var error_msg = '';
	var succ_msg = '';
	{/literal}{if $error_msg}error_msg = '{$error_msg|escape:"javascript"}';{/if}{literal}
	{/literal}{if $succ_msg}succ_msg = '{$succ_msg|escape:"javascript"}';{/if}{literal}
	if (error_msg) {
	  alert(error_msg);
	  /*if (error_msg==succ_msg) {
		  document.location.reload();
	  }*/
	}
})
</script>
{/literal}
