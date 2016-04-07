<div class="main_box" id="main_box">
	<section class="container containerProduct">
		<article class="layout">
			{literal}<script type="text/JavaScript">
				// <![CDATA[
				function MM_findObj(n, d) { //v4.01
					var p, i, x;
					if (!d) d = document;
					if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
						d = parent.frames[n.substring(p + 1)].document;
						n = n.substring(0, p);
					}
					if (! (x = d[n]) && d.all) x = d.all[n];
					for (i = 0; ! x && i < d.forms.length; i++) x = d.forms[i][n];
					for (i = 0; ! x && d.layers && i < d.layers.length; i++) x = MM_findObj(n, d.layers[i].document);
					if (!x && d.getElementById) x = d.getElementById(n);
					return x;
				}

				function MM_validateForm() { //v4.0
					var i, p, q, nm, test, num, min, max, errors = '',
					args = MM_validateForm.arguments;
					for (i = 0; i < (args.length - 2); i += 3) {
						test = args[i + 2];
						val = MM_findObj(args[i]);
						if (val) {
							nm = val.name;//alert(val.value);
							if ((val = val.value) != "") {
								if (test.indexOf('isEmail') != -1) {
									p = val.indexOf('@');
									if (p < 1 || p == (val.length - 1)) errors += '- ' + nm + ' must contain an e-mail address.\n';
								} else if (test != 'R') {
									num = parseFloat(val);
									if (isNaN(val)) errors += '- ' + nm + ' must contain a number.\n';
									if (test.indexOf('inRange') != -1) {
										p = test.indexOf(':');
										min = test.substring(8, p);
										max = test.substring(p + 1);
										if (num < min || max < num) errors += '- ' + nm + ' must contain a number between ' + min + ' and ' + max + '.\n';
									}
								}
							} else if (test.charAt(0) == 'R') {
								errors += '- ' + nm + ' is required.\n';
							}
						}
					}
					if (errors) alert('The following error(s) occurred:\n' + errors);
					document.MM_returnValue = (errors == '');
				}
				// ]]>
			</script>{/literal}
				{literal}
				<script type="text/JavaScript">
					 $(function() {
						$(".custom_color a.open_img1").click(function(){
							$(".custom_color_img1").slideDown(200);
						});
						$('.custom_color_img .close1').click(function(){
							$('.custom_color_img1').slideUp(200);
						});
						$(".custom_color a.open_img2").click(function(){
							$(".custom_color_img2").slideDown(200);
						});
						$('.custom_color_img .close2').click(function(){
							$('.custom_color_img2').slideUp(200);
						});
						$(".custom_color a.open_img3").click(function(){
							$(".custom_color_img3").slideDown(200);
						});
						$('.custom_color_img .close3').click(function(){
							$('.custom_color_img3').slideUp(200);
						});
					})
				</script>
				{/literal}
			{literal}
			<style>
				.luxury-banner{
				  margin-bottom: 20px;
				  padding-bottom: 20px;
				  border-bottom: 1px solid #E5E5E5;
				}
				.custom-order h3{font-size:14px;padding:0;}
				.custom-order img{max-width: 100%;}
				.uk-accordion-title,.custom_title{padding:8px 0;margin:10px 0;color:#333;font-size:14px;border-bottom: 1px solid #D0D0D0;position:relative;cursor: pointer;}
				.uk-accordion-title:after{position: absolute;content: "\e608";font-family: "iconfont";right:0;font-size: 1.1em;}
				.uk-accordion-title.uk-active:after{content: "\e634";}
				.uk-accordion-title.uk-active{color:#fc368d;}
				.custom_them li,.custom_them dd{float:left}
				.custom_them{text-align:left}
				.custom_them ul{text-align: center;}
				.custom_them label{cursor: pointer;}
				.hair_style li{width:33.333333%;padding:5px;text-align: center;}
				.contact_info li{width:100%;margin:6px 0;}
				.cap_type li{width:100%;margin:8px 0;}
				.cap_type p{margin:5px 0 0}
				.hair_density dl{float:left;margin:10px 0;width: 100%;}
				.hair_density dt{float:left;font-weight: 700;width: 100%}
				.hair_density dd{padding:5px 15px 0 0;}
				.custom_color_style dt{font-weight:bold;margin:10px 0;padding-bottom:5px;border-bottom:1px solid #ccc}
				.custom_color_style dd{width:100%;padding:5px 0}
				.custom_them input.bodycopysm{padding: 5px;float: left;width: 90%;margin:5px 0;}
				
				.custom_color li{width:100%;margin:10px 0;position: relative;}
				.custom_color li p{margin-bottom:8px}
				.custom_color_style,.contact_info li{text-align:left}
				.custom_color_style dl{float:left;width:33%}
				.custom_them textarea{width:99%;border-color: #DDD;padding:8px;border: 1px solid #ddd;}
				.custom_submit{text-align:center;padding-top:15px; border-top: 1px solid #DDD;}
				.custom_them input.custom_btn{background: #fc368d;border: 1px solid #fc368d;text-transform: uppercase;font-weight: bold;cursor: pointer;}
				.custom_them input:hover.custom_btn{background: #EF3386;border: 1px solid #CC2770;}
				.uk-responsive-width{max-width: 100%}
				.layout {padding: 10px;}
				input[type=text], input[type=number], input[type=password], input[type=tel], input[type=email], input[type=date] {
				    height: 45px;
				    padding: 0 4%;
				    width: 100%;
				    border: 1px solid #ddd;
				    border-radius: 3px;
				    color: #333;
				    vertical-align: middle;
				}
				input[type="submit"]{
				    display: block;
				    width: 100%;
				    height: 45px;
				    line-height: 45px;
				    font-size: 1.2em;
				    border: 0;
				    border-radius: 3px;
				    text-align: center;
				    color: #fff;
				}
			</style>
			{/literal}
			<div class="luxury-banner">
				<a href="{$base_dir}tag/luxury-human-hair"><img src="/themes/uniwigs2016-m/img/luxury-wig.jpg" alt="" width="100%"></a>
			</div>
			<div class="custom-order uk-accordion" data-uk-accordion>
					<h3>HOW TO CREATE A UNIQUE CUSTOM WIG AT UNIWIGS ?</h3>
					<form id="frmCustomOrder" method="POST" onSubmit="MM_validateForm('first-name','','R','last-name','','R','phone-number','','R','email_co','','RisEmail');return document.MM_returnValue">
							<div class="custom_title uk-accordion-title">1. Choose your favorite hair texture</div>
							<div class="custom_them uk-accordion-content">
								<ul class="hair_style clearfix">
										<li>
											<p>
												<a href="/themes/uniwigs2016-m/img/form/large/Deep-Wave.jpg" data-uk-lightbox="{literal}{group:'customer-photo'}{/literal}" title="Deep Wave">
													<img src="/themes/uniwigs2016-m/img/form/Deep-Wave.jpg">
												</a>
											</p>
											<p>Deep Wave</p>
										</li>
										<li>
											<p>
												<a href="/themes/uniwigs2016-m/img/form/large/Natural-Wave.jpg" data-uk-lightbox="{literal}{group:'customer-photo'}{/literal}" title="Natural Wave">
													<img src="/themes/uniwigs2016-m/img/form/Natural-Wave.jpg">
												</a>
											</p>
											<p>Natural Wave</p>
										</li>
										<li>
											<p><a href="/themes/uniwigs2016-m/img/form/large/Body-Wave.jpg" data-uk-lightbox="{literal}{group:'customer-photo'}{/literal}" title="Body Wave"><img src="/themes/uniwigs2016-m/img/form/Body-Wave.jpg"></a></p>
											<p>Body Wave</p>
										</li>
										<li>
											<p><a href="/themes/uniwigs2016-m/img/form/large/Natural-Straight.jpg" data-uk-lightbox="{literal}{group:'customer-photo'}{/literal}" title="Natural Straight"><img src="/themes/uniwigs2016-m/img/form/Natural-Straight.jpg"></a></p>
											<p>Natural Straight</p>
										</li>
										<li>
											<p><a href="/themes/uniwigs2016-m/img/form/large/Straight.jpg" data-uk-lightbox="{literal}{group:'customer-photo'}{/literal}" title="Straight"><img src="/themes/uniwigs2016-m/img/form/Straight.jpg"></a></p>
											<p>Straight</p>
										</li>
										<li>
											<p><a href="/themes/uniwigs2016-m/img/form/large/Kinky-Straight.jpg" data-uk-lightbox="{literal}{group:'customer-photo'}{/literal}" title="Kinky Straight"><img src="/themes/uniwigs2016-m/img/form/Kinky-Straight.jpg"></a></p>
											<p>Kinky Straight</p>
										</li>
										<li>
											<p><a href="/themes/uniwigs2016-m/img/form/large/Yaki-Straight.jpg" data-uk-lightbox="{literal}{group:'customer-photo'}{/literal}" title="Kinky Straight"><img src="/themes/uniwigs2016-m/img/form/Yaki-Straight.jpg"></a></p>
											<p>Yaki Straight</p>
										</li>
										<li>
											<p><a href="/themes/uniwigs2016-m/img/form/large/Jerry-Curl.jpg" data-uk-lightbox="{literal}{group:'customer-photo'}{/literal}" title="Jerry Curl"><img src="/themes/uniwigs2016-m/img/form/Jerry-Curl.jpg"></a></p>
											<p>Jerry Curl</p>
										</li>
										<li>
											<p><a href="/themes/uniwigs2016-m/img/form/large/Loose-curl.jpg" data-uk-lightbox="{literal}{group:'customer-photo'}{/literal}" title="Loose curl"><img src="/themes/uniwigs2016-m/img/form/Loose-curl.jpg"></a></p>
											<p>Loose curl</p>
										</li>
										<li>
											<p><a href="/themes/uniwigs2016-m/img/form/large/Afro-Curl.jpg" data-uk-lightbox="{literal}{group:'customer-photo'}{/literal}" title="Afro Curl"><img src="/themes/uniwigs2016-m/img/form/Afro-Curl.jpg"></a></p>
											<p>Afro Curl</p>
										</li>
										<li>
											<p><a href="/themes/uniwigs2016-m/img/form/large/Body-curl.jpg" data-uk-lightbox="{literal}{group:'customer-photo'}{/literal}" title="Body curl"><img src="/themes/uniwigs2016-m/img/form/Body-curl.jpg"></a></p>
											<p>Body curl</p>
										</li>
									</ul>
							</div>
							<div class="custom_title uk-accordion-title">2. Decide the right cap construction</div>
							<div class="custom_them uk-accordion-content">
								<ul class="cap_type clearfix">
									<li>
										<p><img src="/themes/uniwigs2016-m/img/form/Mono-Top-Cap-Handtied.jpg"></p>
										<p>Mono Top Cap / Handtied</p>
									</li>
									<li>
										<p><img src="/themes/uniwigs2016-m/img/form/Mono-Top-Cap-Wefted-Back.jpg"></p>
										<p>Mono Top Cap / Wefted Back</p>
									</li>
									<li>
										<p><img src="/themes/uniwigs2016-m/img/form/skin-top-cap.jpg"></p>
										<p>Skin Top Cap</p>
									</li>
									<li>
										<p><img src="/themes/uniwigs2016-m/img/form/lace-front-cap-I.jpg"></p>
										<p>Lace Front-I Cap</p>
									</li>
									<li>
										<p><img src="/themes/uniwigs2016-m/img/form/full-lace-syn.jpg"></p>
										<p>Full Lace Cap</p>
									</li>
									<li>
										<p><img src="/themes/uniwigs2016-m/img/form/lace-front.jpg"></p>
										<p>Lace Front</p>
									</li>
									<li>
										<p><img src="/themes/uniwigs2016-m/img/form/glueless-full-lace-cap.jpg"></p>
										<p>Glueless Full Lace Cap</p>
									</li>
									<li>
										<p><img src="/themes/uniwigs2016-m/img/form/silk-top-full-lace-cap.jpg"></p>
										<p>Silk Top Full Lace Cap</p>
									</li>
									<li>
										<p><img src="/themes/uniwigs2016-m/img/form/silk-top-glueless-full-lace-cap.jpg"></p>
										<p>Silk Top Glueless Full Lace Cap</p>
									</li>
								</ul>
							</div>
							<div class="custom_title uk-accordion-title">3. Take your unique cap- measurement</div>
							<div class="custom_them uk-accordion-content">
								<img src="/themes/uniwigs2016-m/img/form/cap-size.jpg" alt="">
							</div>
							<div class="custom_title uk-accordion-title">4. Determine the hair material , density, length</div>
							<div class="custom_them uk-accordion-content">
								<div class="hair_density clearfix">
									<dl>
										<dt>Fiber:</dt>
										<dd>Synthetic Fiber</dd>
										<dd>Heat Friendly Synthetic Fiber</dd>
										<dd>Remy Human Hair</dd>
										<dd>Human Hair Blend</dd>
									</dl>
									<dl>
										<dt>Part:</dt>
										<dd>Left Part</dd>
										<dd>Right Part</dd>
										<dd>Center Part</dd>
										<dd>Free Style</dd>
									</dl>
									<dl>
										<dt>Baby Hairs:</dt>
										<dd>Around the perimeter</dd>
										<dd>Back Only</dd>
										<dd>Front Only</dd>
										<dd>No baby hair</dd>
									</dl>
									<div class="hair_density_two">
										<dl>
											<dt>Density</dt>
											<dd>
												<p>
													<img src="/themes/uniwigs2016-m/img/form/dencity.jpg" alt="">
												</p>
											</dd>
										</dl>
										<dl>
											<dt>Length & Fit  </dt>
											<dd>
												<p>
													<img src="/themes/uniwigs2016-m/img/form/length.jpg" alt="">
												</p>
											</dd>
										</dl>
									</div>
								</div>
							</div>
							<div class="custom_title uk-accordion-title">5. Choose the hair color from our color ring</div>
							<div class="custom_them uk-accordion-content">
								<div class="custom_color clearfix">
									<ul class="row">
										<li>
											<img src="/themes/uniwigs2016-m/img/form/human-hair.jpg">
											<p>Human Hair</p>
										</li>
										<li>
											<img src="/themes/uniwigs2016-m/img/form/futura.jpg">
											<p>Futura</p>
										</li>
										<li>
											<img src="/themes/uniwigs2016-m/img/form/kakalon.jpg">
											<p>Kanekalon</p>	
										</li>
									</ul>
									
								</div>
								
							</div>
							<div class="custom_title">6. Your contact information <span>(we will contact you soon to confirm the details )</span></div>
							<div class="custom_them contact_info">
									<ul class="clearfix">
										<li><input name="first-name" placeholder="First Name" type="text"></li>
										<li><input name="last-name" placeholder="Last Name" type="text"></li>
										<li><input name="email_co" placeholder="E-mail address" type="email"></li>
										<li><input name="phone-number" placeholder="Phone Number" type="tel"></li>
										<li><input name="best-time-to-call" placeholder="Best time to call is" type="text"></li>
									</ul>
							</div>
							<div class="custom_them">
								
								<textarea name="Additional-Comments" placeholder="Additonal comments" cols="50" rows="5"></textarea>
							</div>
							<div class="custom_them clearfix hidden">
								<div class="custom_submit">
									<input type="submit" value="submit" class="custom_btn"
										width="78" height="30">
								</div>
							</div>
							<input type="hidden" name="upload_img" value=''/>
					</form>
					{literal}
					<style>
					.hidden{display: none}
					.fadeIn {
					opacity: 0;
					-webkit-transition: opacity 1400ms ease-out;
					-moz-transition: opacity 1400ms ease-out;
					-o-transition: opacity 1400ms ease-out;
					transition: opacity 1400ms ease-out;
					}
					.nowAvatar {
					max-height:180px;_height:180px;
					padding:10px 0 0 10px;
					}
					.setAvatar h2:first-child {
					margin-top: 13px;
					}
					.setAvatar h2 {
					font-size: 16px;
					margin: 0 0 0 10px;
					}
					#uploadFile3 {
					width: 100%;
					height: 44px;
					background: #4178b6;
					line-height: 44px;
					font-size: 16px;
					text-align: center;
					color: #fff;
					margin: 15px auto;
					overflow: hidden;
					}
					#photoActionfile {
					position: relative;
					z-index: 10;
					float: none;
					opacity: 0;
					cursor: pointer;
					}
					</style>
					<script>
					function submitUploadResult(data) {
						if (data['status']==1) {
							$('.setAvatar .msg').html('<font color="red">Upload Successfully.</font>');

							//$('.setAvatar .imgs').html('');
							//$(':hidden[name=upload_img]').val('');

							var imgsrcs = '';
							for (var ind in data['content']) {
								if (imgsrcs.length > 0) {
									imgsrcs += ";";
								}
								imgsrcs += data['content'][ind]["src"];
								$('.setAvatar .imgs').append('<img class="nowAvatar fadeIn" src="'+data['content'][ind]["src"]+'" alt="" onload="this.style.opacity = 1;"/>');
							}
							
							var setval = $(':hidden[name=upload_img]').val()?$(':hidden[name=upload_img]').val():'';
							if (setval.length > 0) {
								setval += ";";
							}
							setval += imgsrcs;
							$(':hidden[name=upload_img]').val(setval);
						} else {
							$('.setAvatar .msg').html(data['msg']);
						}
					}
					$(function(){
						$('#photoActionfile').change(function(){
							$('#uploadFile3').submit();
						});
					})
					</script>
					{/literal}
					<div class="custom_them" style="padding-bottom: 10px;">
						<div class="setAvatar">
							<div class="msg"></div>
							<div class="imgs">
								<img class="nowAvatar fadeIn" src="" alt="" onload="this.style.opacity = 1;"/>
							</div>
							<form id="uploadFile3" method="post"
								enctype="multipart/form-data" target="iframe"
								action="">
								Upload Photo <input type="file" id="photoActionfile" name="media"/>
							</form>
						</div>
						<div style="position:absolute;width:0px;height:0px;overflow:hidden;">
							<iframe id="iframe" name="iframe"></iframe>
						</div>
					</div>
					<div class="custom_them fix">
						<div class="custom_submit">
								<input type="submit" value="submit" class="custom_btn" width="78" height="30" onclick="$('#frmCustomOrder :submit').click();">
						</div>
					</div>
			</div>
		</article>
	</section>
	<script type="text/javascript" src="/themes/uniwigs2016-m/js/accordion.min.js"></script>
	<script type="text/javascript" src="/themes/uniwigs2016-m/js/lightbox.js"></script>