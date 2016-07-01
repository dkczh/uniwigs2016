{literal}
<style>

#columns.container{max-width:100%;}
.img-video img{width:100%;}
.img-video a{display: block;position: relative;}
.img-video a:after{
	content: "\f01d";font-family: "FontAwesome";position: absolute;left: 47%;top:35%;font-size:7em;color:#fff;}
.img-video a:hover:after{color:#b48f58;}
.nov-banner{background-color:#e6e1de;position: relative;}
.home-product a{display: block;position: relative;}
.home-product .home-product-color{display: none;position: absolute;bottom:0;width: 100%;padding:15px 15px 0;background-color:rgba(255, 255, 255, 0.2);}
.home-product .home-product-color ul{width:82%;}
.home-product .home-product-color li{width:20%;float: left;padding:0 5px 10px;}
.home-product .home-product-color span{width:20%;color:#222;}
.home-product a:hover .home-product-color{display: block}
.home-title span{text-transform: uppercase;font-size:20px;font-weight: bold;display: inline-block;width:240px;padding:15px 0;margin:50px 0 40px;letter-spacing: 1px;border-top: 1px solid #b48f58;border-bottom: 1px solid #b48f58;}
.home-title p{font-size: 16px}
.home-product p{padding:0 15px;}
.designer-abl{margin-top:90px;}
.designer-abl-desc ul{border-left: 1px solid #222;padding-left: 20px;}
.designer-abl-desc ul li{padding:15px 0;font-size:1.1em;}
.designer-abl-desc ul li:before{content: "\f111";font-family: "FontAwesome";position: absolute;left: 10px;}
.gallery-box li{float:left;}
.gallery-box li a{display: block;position: relative;}
.gallery-box li a:after {
    content: "";
    background: rgba(0, 0, 0, 0.3);
    width: 100%;
    height: 100%;
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    transition: all 0.3s linear;
    -moz-transition: all 0.3s linear;
    -webkit-transition: all 0.3s linear;
}
.gallery-box li a:hover:after{
  background: rgba(0, 0, 0, 0);
}

@media (max-width: 480px) {
	#columns.container{padding-left:0;padding-right:0;}
	.gallery-box li a:after {
		background: none;
	}
	.gallery-box li{
		width:50%;
	}
	.nov-banner .arrow,header .row #header_logo{display: none}
	.nov-banner{background-color: #fff;}
	.lavivid_text{padding:10px;}
	#home-product p{
		display: block;
	}
	#home-product .col-xs-12 a{
		background: url("/themes/vivid/img/category/vivid/Carrie-m.jpg") no-repeat center top; 
		height:400px;
	}
	#designer .img-video a{
		background: url("/themes/vivid/img/category/vivid/abl_m.jpg") no-repeat center top; 
		height:320px;
	}

}
@media (min-width: 768px) {
	 .nov-banner{position: relative;background: url("/themes/vivid/img/category/vivid/lavivid0628.png") no-repeat center top;background-size:150%;height:300px;}
	 .nov-banner .lavivid_logo,
	 .nov-banner .lavivid_text{position: absolute;}
	 .nov-banner .lavivid_logo{
	 	top:50px;
	 	left:26%;
		width:45%;
	 }
	 .nov-banner .lavivid_text{
	 	top:216px;
	 	left:26%;
	 	width:45%;
	 }
	 .nov-banner .arrow{
	 	display: none;
	 }
	#home-product .col-xs-12 a{
		background: url("/themes/vivid/img/category/vivid/Carrie.jpg") no-repeat center top;
		height: 320px;
    	background-size: 120%;
	}
	#designer .img-video a{
		background: url("/themes/vivid/img/category/vivid/abl.jpg") no-repeat center top; 
		height:500px;
	}
	#home-product p,#home-product .col-xs-12 h3{
	display: none;
	}
}
@media (min-width: 992px) {
  .gallery-box li{
    width:25%;
    margin-bottom:7px;
  }
  .nov-banner{position: relative;background: url("/themes/vivid/img/category/vivid/lavivid0628.png") no-repeat center top;background-size:150%;height:470px;}
.nov-banner .lavivid_logo,
.nov-banner .lavivid_text{position: absolute;}
.nov-banner .lavivid_logo{
	top:50px;
	left:26%;
	animation: wave 3s linear 1;
}
.nov-banner .lavivid_text{
	top:326px;
	left:26%;
	animation: wave-two 3s linear 1;
}
#home-product .col-xs-12 a{
		background: url("/themes/vivid/img/category/vivid/Carrie.jpg") no-repeat center top;
		height:400px;
	}
	#designer .img-video a{
		background: url("/themes/vivid/img/category/vivid/abl.jpg") no-repeat center top; 
		height:500px;
	}

	.nov-banner .arrow{
	position: absolute;
    top: 30vh;
    left: 50vw;
    margin-left: -30px;
    height: 60px;
    width: 60px;
    display: block;
    z-index: 500;
    opacity: 0;
    animation: myfirst 2s ease-in-out 3s infinite;
}
.nov-banner .arrow i {
    position: absolute;
    font-size: 40px;
    color: rgba(115, 49, 17, 0.6);
    text-align: center;
    height: 60px;
    width: 60px;
    top: 0;
    left: 0;
}
}

@media (min-width: 1200px) {
  .gallery-box li{
    width:20%;
    margin-bottom:0;
  }
    .nov-banner{position: relative;background: url("/themes/vivid/img/category/vivid/lavivid0628.png") no-repeat center top;background-size:130%;height:550px;}
  .nov-banner .lavivid_logo,
  .nov-banner .lavivid_text{position: absolute;}
  .nov-banner .lavivid_logo{
  	top:50px;
  	left:32%;
  	animation: wave 3s linear 1;
  }
  .nov-banner .lavivid_text{
  	top:326px;
  	left:32%;
  	animation: wave-two 3s linear 1;
  }
}
@media (min-width: 1600px) {
	.nov-banner{position: relative;background: url("/themes/vivid/img/category/vivid/lavivid0628.png") no-repeat center top;background-size:cover;height:600px;}
	.nov-banner .lavivid_logo,
	.nov-banner .lavivid_text{
		left:37%;
	}
	.nov-banner .arrow{
		top: 55vh;
		animation: myfirst-two 2s ease-in-out 3s infinite;
	}
}
@keyframes wave {
	0% { transform: translate3d(0,0,0); opacity: 0;}
	50% { transform: translate3d(0,100px,0); opacity: 1;}
	100% { transform: translate3d(0,0,0); opacity: 1;}
}
@keyframes wave-two {
	0% { transform: translate3d(0,0,0); opacity: 0;}
	50% { transform: translate3d(0,120px,0); opacity: 1;}
	100% { transform: translate3d(0,0,0); opacity: 1;}
}
@keyframes myfirst
{
0% {opacity: 0;top: 50vh;}
100% {top: 50vh;opacity: 1;}
50% {top: 55vh;opacity: 1;}
}
@keyframes myfirst-two
{
0% {opacity: 0;top: 55vh;}
100% {top: 55vh;opacity: 1;}
50% {top: 57vh;opacity: 1;}
}

i.arrow:hover {
    opacity: 0.5;
}
</style>
{/literal}

<div class="nov-banner uk-margin-large-bottom">
	{*<div class="lavivid_logo">
		<img src="{$img_dir}category/vivid/logo.png" alt="lavivid logo" class="img-responsive">
	</div>
	<div class="lavivid_text">
		<img src="{$img_dir}category/vivid/text.png" alt="lavivid text" class="img-responsive">
	</div>
	<a class="arrow" href="#home-product" data-uk-smooth-scroll><i class="icon-chevron-down"></i></a>*}
</div>
<section class="desc container">
	<p class="text-center uk-text-normal">Uniwigs proudly announces that La Vivid Collection by Albeir Awad was launched on January 27, 2016.<br>This whole new designer wig collection, which includes 7 different hair styles, each with 10 different hair colors, marks the first time for Uniwigs to collaborate with top level designers.</p>
</section>
<section id="home-product" class="home-product container">
	<div class="home-title text-center">
		<span>The COllection</span>
	</div>
	<div class="row">
		<div class="col-md-4 col-sm-4 uk-margin-bottom">
			<a href="{$base_dir}lavivid/41220-lisa-syntheic-wig.html">
				<div class="home-product-color">
					<span class="pull-left">Color</span>
					<ul class="row pull-left">
						<li><img src="{$base_dir}img/color/AL01001-01R(Almond-Frost).jpg" alt="AL01001-01R(Almond-Frost)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01001-10R(Creamy-Ice).jpg" alt="AL01001-10R(Creamy-Ice)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01001-11R(Hazel-Glaze).jpg" alt="AL01001-11R(Hazel-Glaze)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01001-12R(Maple-Swirl).jpg" alt="AL01001-12R(Maple-Swirl)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01001-13R(Sparking-Amber).jpg" alt="AL01001-13R(Sparking-Amber)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01001-17(Salted-Tiramisu).jpg" alt="AL01001-17(Salted-Tiramisu)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01001-19(Java-Shimmered).jpg" alt="AL01001-19(Java-Shimmered)" class="img-responsive"></li>
					</ul>
				</div>
				<img src="{$img_dir}category/vivid/Lisa.jpg" alt="lavivid lisa" class="img-responsive center-block">
			</a>
			<h3 class="text-center">Lisa</h3>
			<p class="text-center">Delightful sihouette with endless versatility.</p>
		</div>
		<div class="col-md-4 col-sm-4 uk-margin-bottom">
			<a href="{$base_dir}lavivid/41211-jenny-synthetic-wig.html">
				<div class="home-product-color">
					<span class="pull-left">Color</span>
					<ul class="row pull-left">
						<li><img src="{$base_dir}img/color/AL01002-01R-(Almond-Frost).jpg" alt="AL01002-01R-(Almond-Frost)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01002-07(Shadow-Chestnut).jpg" alt="AL01002-07(Shadow-Chestnut)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01002-10R(Creamy-Ice).jpg" alt="AL01002-10R(Creamy-Ice)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01002-11(Hazel-Glaze).jpg" alt="AL01002-11(Hazel-Glaze)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01002-18R(Double-Frost-Java).jpg" alt="AL01002-18R(Double-Frost-Java)" class="img-responsive"></li>
					</ul>
				</div>
				<img src="{$img_dir}category/vivid/Jenny.jpg" alt="lavivid jenny" class="img-responsive">
			</a>
			<h3 class="text-center">Jenny</h3>
		</div>
		<div class="col-md-4 col-sm-4 uk-margin-bottom">
			<a href="{$base_dir}lavivid/41216-patsy-synthetic-wig.html">
				<div class="home-product-color">
					<span class="pull-left">Color</span>
					<ul class="row pull-left">
						<li><img src="{$base_dir}img/color/AL01008-01R(Almond-Frost).jpg" alt="AL01008-01R(Almond-Frost)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01008-09R(Macadamia).jpg" alt="AL01008-09R(Macadamia)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01008-13(Sparking-Amber).jpg" alt="AL01008-13(Sparking-Amber)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01008-16(Chocolate-Caramel).jpg" alt="AL01008-16(Chocolate-Caramel)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01008-18R(Double-Frost-Java).jpg" alt="L01008-18R(Double-Frost-Java)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01008-19(Java-Shimmered).jpg" alt="AL01008-19(Java-Shimmered)" class="img-responsive"></li>
					</ul>
				</div>
				<img class="img-responsive" src="{$img_dir}category/vivid/Patsy.jpg" alt="lavivid patsy">
			</a>
			<h3 class="text-center">Patsy</h3>
			<p class="text-center">A trendy look featuring a wispy cut with progressive mixed layers and heavily texturized mixed ends.</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 uk-margin-bottom">
			<a href="{$base_dir}lavivid/41212-carri-synthetic-wig.html">
				<div class="home-product-color">
					<span class="pull-left">Color</span>
					<ul class="row pull-left">
						<li><img src="{$base_dir}img/color/AL01003-01R(Almond-Frost).jpg" alt="AL01003-01R(Almond-Frost)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01003-06(Light-Brown).jpg" alt="AL01003-06(Light-Brown)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01003-07R(Shadow-Chestnut).jpg" alt="AL01003-07R(Shadow-Chestnut)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01003-09R(Macadamia).jpg" alt="AL01003-09R(Macadamia)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01003-16(Chocolate-Caramel).jpg" alt="AL01003-16(Chocolate-Caramel)" class="img-responsive"></li>
					</ul>
				</div>
			</a>
			<h3 class="text-center">Carrie</h3>
			<p class="text-center">A sexy,captivating style with long,face framing subtle layers</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-sm-4 uk-margin-bottom">
			<a href="{$base_dir}lavivid/41213-kate-synthetic-wig.html">
				<div class="home-product-color">
					<span class="pull-left">Color</span>
					<ul class="row pull-left">
						<li><img src="{$base_dir}img/color/AL01005-09R(Macadamia).jpg" alt="AL01005-09R(Macadamia)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01005-12(Maple-Swirl).jpg" alt="AL01005-12(Maple-Swirl)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01005-13R(Sparking-Amber).jpg" alt="AL01005-13R(Sparking-Amber)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01005-14(Honey-Glaze).jpg" alt="AL01005-14(Honey-Glaze)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01005-15R(Frappuccino).jpg" alt="AL01005-15R(Frappuccino)" class="img-responsive"></li>
					</ul>
				</div>
				<img src="{$img_dir}category/vivid/Kate.jpg" alt="lavivid kate" class="img-responsive">
			</a>
			<h3 class="text-center">KATE</h3>
			<p class="text-center">Casually tousled style with customized razored layers for natural fullness in the crown.</p>
		</div>
		<div class="col-md-4 col-sm-4 uk-margin-bottom">
			<a href="{$base_dir}lavivid/41215-halle-synthetic-wig.html">
				<div class="home-product-color">
					<span class="pull-left">Color</span>
					<ul class="row pull-left">
						<li><img src="{$base_dir}img/color/AL01007-01(Almond-Frost).jpg" alt="AL01007-01(Almond-Frost)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01007-07R(Shadow-Chestnut).jpg" alt="AL01007-07R(Shadow-Chestnut)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01007-09R(Macadamia).jpg" alt="AL01007-09R(Macadamia)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01007-10R(Creamy-Ice).jpg" alt="AL01007-10R(Creamy-Ice)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01007-11(Hazel-Glaze).jpg" alt="AL01007-11(Hazel-Glaze)" class="img-responsive"></li>
					</ul>
				</div>
				<img class="img-responsive" src="{$img_dir}category/vivid/Halle.jpg" alt="lavivid halle">
			</a>
			<h3 class="text-center">Halle</h3>
			<p class="text-center">Short and “edgy” style,with point-cut layered and deathered fringe that can be tamed or tousled.</p>
		</div>
		<div class="col-md-4 col-sm-4 uk-margin-bottom">
			<a href="{$base_dir}lavivid/41214-liz-synthetic-wig-.html">
				<div class="home-product-color">
					<span class="pull-left">Color</span>
					<ul class="row pull-left">
						<li><img src="{$base_dir}img/color/AL01006-01R(Almond-Frost).jpg" alt="AL01006-01R(Almond-Frost)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01006-06(Light-Brown).jpg" alt="AL01006-06(Light-Brown)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01006-07R(Shadow-Chestnut).jpg" alt="AL01006-07R(Shadow-Chestnut)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01006-11R(Hazel-Glaze).jpg" alt="AL01006-11R(Hazel-Glaze)" class="img-responsive"></li>
						<li><img src="{$base_dir}img/color/AL01006-19(Java-Shimmered).jpg" alt="AL01006-19(Java-Shimmered)" class="img-responsive"></li>
					</ul>
				</div>
				<img src="{$img_dir}category/vivid/Liz.jpg" alt="lavivid liz" class="img-responsive">
			</a>
			<h3 class="text-center">Liz</h3>
			<p class="text-center">Unique,yet retro,chin length bob featuring a  side swept fringe horizon.</p>
		</div>
	</div>
</section>
<section id="designer" class="designer">
	<div class="home-title container text-center">
		<span>The Designer</span>
	</div>
	<div class="img-video uk-margin-top uk-margin-bottom">
		<a href="https://www.youtube.com/embed/4xi50NjatpM" data-uk-lightbox>
			
		</a>
	</div>
	<div class="designer-abl container">
		<div class="row">
			<div class="designer-abl-img col-md-4 col-sm-4">
				<img src="{$img_dir}category/vivid/Albeir.jpg" alt="lavivid albeir" class="img-responsive">
			</div>
			<div class="designer-abl-desc col-md-8 col-sm-8">
				<h3>Albeir Awad</h3>
				<ul>
					<li>Albeir Awad based in Los Angeles, is nationally recognized as a top designer and educator in alternative hair industry. </li>
					<li>His great forte is to mix synthetic fibers and multi-color tones to achieve the appealing and natural look. Therefore, in the collection you can see what an amazing diversity of the color combination the designer intends to represent. </li>
					<li>As former Director of Design for Rene of Paris, he has successfully introduced many different collections and received Achievement Award in 2008 for superior, outstanding performance.</li>
					<li>Now Albeir is making that same talent available to other hair companies through the newly formed Albeir Design Consultancy (ADC).</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section id="gallery" class="gallery uk-margin-top container">
	<div class="home-title text-center">
		<span>The Gallery</span>
		<p>The beauty is coming from our work with dedication and passion.</p>
	</div>
	<div class="gallery-box uk-margin-top">
		<ul>
			<li><a href="{$img_dir}category/vivid/gallery-1-large.jpg" data-uk-lightbox="{literal}{group:'gallery'}{/literal}"><img src="{$img_dir}category/vivid/gallery-1.jpg" alt="lavivid" class="img-responsive"></a></li>
			<li><a href="{$img_dir}category/vivid/gallery-2-large.jpg" data-uk-lightbox="{literal}{group:'gallery'}{/literal}"><img src="{$img_dir}category/vivid/gallery-2.jpg" alt="lavivid" class="img-responsive"></a></li>
			<li><a href="{$img_dir}category/vivid/gallery-3-large.jpg" data-uk-lightbox="{literal}{group:'gallery'}{/literal}"><img src="{$img_dir}category/vivid/gallery-3.jpg" alt="lavivid" class="img-responsive"></a></li>
			<li><a href="{$img_dir}category/vivid/gallery-4-large.jpg" data-uk-lightbox="{literal}{group:'gallery'}{/literal}"><img src="{$img_dir}category/vivid/gallery-4.jpg" alt="lavivid" class="img-responsive"></a></li>
			<li><a href="{$img_dir}category/vivid/gallery-5-large.jpg" data-uk-lightbox="{literal}{group:'gallery'}{/literal}"><img src="{$img_dir}category/vivid/gallery-5.jpg" alt="lavivid" class="img-responsive"></a></li>
			<li><a href="{$img_dir}category/vivid/gallery-6-large.jpg" data-uk-lightbox="{literal}{group:'gallery'}{/literal}"><img src="{$img_dir}category/vivid/gallery-6.jpg" alt="lavivid" class="img-responsive"></a></li>
			<li><a href="{$img_dir}category/vivid/gallery-7-large.jpg" data-uk-lightbox="{literal}{group:'gallery'}{/literal}"><img src="{$img_dir}category/vivid/gallery-7.jpg" alt="lavivid" class="img-responsive"></a></li>
			<li><a href="{$img_dir}category/vivid/gallery-8-large.jpg" data-uk-lightbox="{literal}{group:'gallery'}{/literal}"><img src="{$img_dir}category/vivid/gallery-8.jpg" alt="lavivid" class="img-responsive"></a></li>
			<li><a href="{$img_dir}category/vivid/gallery-9-large.jpg" data-uk-lightbox="{literal}{group:'gallery'}{/literal}"><img src="{$img_dir}category/vivid/gallery-9.jpg" alt="lavivid" class="img-responsive"></a></li>
			<li><a href="{$img_dir}category/vivid/gallery-10-large.jpg" data-uk-lightbox="{literal}{group:'gallery'}{/literal}"><img src="{$img_dir}category/vivid/gallery-10.jpg" alt="lavivid" class="img-responsive"></a></li>
		</ul>
	</div>
</section>
<section id="lavivid-Videos" class="gallery uk-margin-top container">
	<div class="home-title text-center">
		<span>The Videos</span>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-6 uk-margin-bottom">
			<a href="https://www.youtube.com/embed/NGznWrSYK1I" data-uk-lightbox>
				<img src="{$img_dir}category/vivid/video1.jpg" alt="lavivid video" width="100%">
			</a>
		</div>
		<div class="col-md-6 col-sm-6 uk-margin-bottom">
			<a href="https://www.youtube.com/embed/iEqe_xeFcRQ" data-uk-lightbox>
				<img src="{$img_dir}category/vivid/video2.jpg" alt="lavivid video" width="100%">
			</a>
		</div>
	</div>
</section>
<script type="text/javascript" src="/themes/vivid/js/lightbox.js"></script>
{*<script src="/themes/vivid/js/jquery.imageScroll.min.js"></script>
{literal}
<script>
     $('.img-holder').imageScroll({
//            image: null,
//            imageAttribute: 'image',
            container: $('#index'),
//            windowObject: $(window),
//            speed:.2,
//            coverRatio:.60,
//            coverRatio:1,
//            holderClass: 'imageHolder',
//            imgClass: 'img-holder-img',
//            holderMinHeight: 200,
//            holderMaxHeight: 563,
//            extraHeight: 50,
//            mediaWidth: 1600,
//            mediaHeight: 900,
//            parallax: true,
//            touch: false
    });
</script>
{/literal*}