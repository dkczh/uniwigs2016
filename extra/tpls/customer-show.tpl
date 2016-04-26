{literal}
<style>
#columns{max-width: 100%;padding:0;}
.containerIndex{position: relative;margin:0 auto;}

@media (min-width: 320px) {
	.containerIndex{width:100%;}
	.containerIndex a.share-your-photos{background: url("/themes/uniwigs2016-m/img/public/m-customer-show-banner.png") no-repeat center top;height:190px;background-size:contain;}
}
@media (min-width: 767px) {
	.containerIndex{width:1000px;}
	.containerIndex a.share-your-photos{background: url("/themes/uniwigs2016/img/public/customer-show-banner.jpg") no-repeat center top;height:350px;background-size:contain;}
}
@media (min-width: 1280px) {
	.containerIndex{width:1280px;}
	.containerIndex a.share-your-photos{background: url("/themes/uniwigs2016/img/public/customer-show-banner.jpg") no-repeat center top;height:450px;}
}
@media (min-width: 1440px) {
	.containerIndex{width:1380px;}
}
@media (min-width: 1680px) {
	.containerIndex{width:1600px;}
}
#pubu .box p.view_btn{
	background: #FAFAFA;
	border-top: 1px solid #F5F5F5;
	padding: 0;
}
 #pubu .pic p.view_btn a{
	padding: 10px;
}
#pubu .pic p.view_btn a:hover{color:#EF3386;}
.columns-container{
	background-color:#eee;}
.breadcrumb,#f-wrapper,.ff-wrapper{
	display: none}
#pubu{
	width:100%;
	position: relative;
	min-height: 500px;}
#pubu .box{
	width: 300px;
	margin: 20px 0 0;
	background: #FFF;
	position: relative;
	border: 0;
	padding: 0;
	line-height: 1.3;
	font-size: 12px;}

#pubu .pic{
	position: relative;
	z-index: 5;
}
	@media (max-width: 1024px) {
		#pubu .pic{box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);}
		#pubu.container{padding: 0}
	}
#pubu .pic a{
	display: block;
	width: 100%}
#pubu .box img,.brand-list .additem img{
	display:block;
	width:100%}
#pubu .box p{
	padding: 10px;
	color: #999}
#pubu .box .name{overflow: hidden;}
#pubu .box span{
	float:left;
	line-height: 25px;
}
#pubu .box .name_icon{
	background-color: #eee;
	color:#cbcbcb;
	width: 25px;
	height: 25px;
	line-height: 23px;
	margin-right: 10px;
	text-align: center;
	border-radius: 50%;
}
.hover-block {
	position: absolute;
	top: -16px;
	left: -14px;
	right: -14px;
	bottom: -5px;
	z-index: 1;
	opacity: 0;
	background: #FFF;
}

.hover-bor {
	border: 1px solid #000;
	background: none;
	filter: alpha(opacity:0.1 );
	opacity: 0.05;
	position: absolute;
	top: 0px;
	left: 0px;
	right: 0px;
	bottom: 0px;
	z-index: -2;
	display: block;
	overflow: hidden;
}
.hover-op {
		position: absolute;
		top: 1px;
		left: 1px;
		bottom: 1px;
		right: 1px;
		z-index: -1;
		box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
}
.customer-nav{
	background-color: #fff;
	height:46px;
	line-height: 46px;
	opacity: 0.95;
	width: 100%;
	z-index: 99997;
	box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.05);
}
@media (max-width: 479px) {
	.customer-nav{display: none}
}
.customer-nav li{width: 20%;}
.customer-nav a{
	color:#666;
	font-size:1.1em;
	display: block;
	width: 100%;
	text-align: center;
	position: relative;
}

.customer-nav a:hover,.customer-nav li.active a{
	color:#ef3386;
}
.customer-nav a .over{
	display: none;
	height:3px;
	background:#ef3386;
	position: absolute;
	bottom: 0;
	left:0;
}
.customer-nav a:hover .over,.customer-nav li.active .over{
	display: block;
	width: 100%;
}

#m-wrapper {
	position: relative;}
#page_loading{
	display: none;
	background: #FFF;
	/*opacity: 0.6;
	height: 60px;
	width: 220px;*/
	padding: 5px 10px 10px 10px;
	position: fixed;
	bottom: 200px;
	left: 50%;
	margin-left: -110px;
	text-align: center;
	font-weight: 500;
	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;
	border-radius: 6px;
	border: 1px solid #111;
	-webkit-box-shadow: 0 0 6px #111;
	-moz-box-shadow: 0 0 3px #111111;
	z-index: 999;}

#pubu .box em{display: block;
position: absolute;
top: 0;
left: 0;
margin-top: 20px;
margin-left: 20px;
width: 45px;
height: 23px;
background: #F38;
color: #FFF;
font-style: normal;
text-align: center;
line-height: 23px;
font-weight: bold;
border: 1px solid #C04;
border-radius: 50% 50%;
font-size: 11px;}
</style>
{/literal}

{assign var="cat_use_name" value='1'}

<section class="containerIndex">
	<a href="/content/34-share-your-photos" target="_blank" class="img-responsive share-your-photos"></a>
<div class="customer-nav">
	<div class="container">
		<ul class="row">
			{if $cat_use_name}
				<li class="col-sm-3{if isset($smarty.get.ca)}{else} active{/if}">
					<a href="/customer-show">All<span class="over"></span></a>
				</li>
				<li class="col-sm-3{if isset($smarty.get.ca) && $smarty.get.ca=='Human Hair Wigs'} active{/if}">
					<a href="/customer-show?ca=Human+Hair+Wigs">Human Hair Wigs<span class="over"></span></a>
				</li>
				<li class="col-sm-3{if isset($smarty.get.ca) && $smarty.get.ca=='Synthetic Wigs'} active{/if}">
					<a href="/customer-show?ca=Synthetic+Wigs">Synthetic Wigs<span class="over"></span></a>
				</li>
				<li class="col-sm-3{if isset($smarty.get.ca) && $smarty.get.ca=='Hair Extensions'} active{/if}">
					<a href="/customer-show?ca=Hair+Extensions">Hair Extensions<span class="over"></span></a>
				</li>
				<li class="col-sm-3{if isset($smarty.get.ca) && $smarty.get.ca=='Hair pieces'} active{/if}">
					<a href="/customer-show?ca=Hair+pieces">Hairpieces<span class="over"></span></a>
				</li>
			{/if}
		</ul>
	</div>
</div>
<div id="pubu">
	{*<div class="box">
		<div class="hover-block">
			<div class="hover-bor"></div>
			<div class="hover-op"></div>
		</div>
        <div class="pic">
			<a href="#">
				<img src="/themes/uniwigs2015/images/0204-1.jpg">
				<p class="description">“This wig is absolutely amazing, from the time i ordered to the time i placed it on my head i was ...”</p>
				<p class="name">
					<span class="name_icon">
						<i class="icon-user"></i>
					</span>
					<span>Jane Smith</span>
				</p>
			</a>
		</div>
    </div>
    <div class="box">
		<div class="hover-block">
			<div class="hover-bor"></div>
			<div class="hover-op"></div>
		</div>
        <div class="pic">
			<a href="#">
				<img src="/themes/uniwigs2015/images/0124-2.jpg">
				<p class="name">
					<span class="name_icon">
						<i class="icon-user"></i>
					</span>
					<span>Jane Smith</span>
				</p>
			</a>
		</div>
    </div>
	<div class="box">
		<div class="hover-block">
			<div class="hover-bor"></div>
			<div class="hover-op"></div>
		</div>
        <div class="pic">
			<a href="#">
				<img src="/themes/uniwigs2015/images/0204-2.jpg">
				<p class="name">
					<span class="name_icon">
						<i class="icon-user"></i>
					</span>
					<span>Jane Smith</span>
				</p>
			</a>
		</div>
    </div>
    <div class="box">
		<div class="hover-block">
			<div class="hover-bor"></div>
			<div class="hover-op"></div>
		</div>
        <div class="pic">
			<a href="#">
				<img src="/themes/uniwigs2015/images/0123-2.jpg">
				<p class="description">“This wig is absolutely amazing, from the time i ordered to the time i placed it on my head i was ...”</p>
				<p class="name">
					<span class="name_icon">
						<i class="icon-user"></i>
					</span>
					<span>Jane Smith</span>
				</p>
			</a>
		</div>
    </div>
    <div class="box">
		<div class="hover-block">
			<div class="hover-bor"></div>
			<div class="hover-op"></div>
		</div>
        <div class="pic">
			<a href="#">
				<img src="/themes/uniwigs2015/images/0204-1.jpg">
				<p class="description">“This wig is absolutely amazing, from the time i ordered to the time i placed it on my head i was ...”</p>
				<p class="name">
					<span class="name_icon">
						<i class="icon-user"></i>
					</span>
					<span>Jane Smith</span>
				</p>
			</a>
		</div>
    </div>
    <div class="box">
		<div class="hover-block">
			<div class="hover-bor"></div>
			<div class="hover-op"></div>
		</div>
        <div class="pic">
			<a href="#">
				<img src="/themes/uniwigs2015/images/0124-2.jpg">
				<p class="name">
					<span class="name_icon">
						<i class="icon-user"></i>
					</span>
					<span>Jane Smith</span>
				</p>
			</a>
		</div>
    </div>
	<div class="box">
		<div class="hover-block">
			<div class="hover-bor"></div>
			<div class="hover-op"></div>
		</div>
        <div class="pic">
			<a href="#">
				<img src="/themes/uniwigs2015/images/0204-2.jpg">
				<p class="name">
					<span class="name_icon">
						<i class="icon-user"></i>
					</span>
					<span>Jane Smith</span>
				</p>
			</a>
		</div>
    </div>
    <div class="box">
		<div class="hover-block">
			<div class="hover-bor"></div>
			<div class="hover-op"></div>
		</div>
        <div class="pic">
			<a href="#">
				<img src="/themes/uniwigs2015/images/0123-2.jpg">
				<p class="description">“This wig is absolutely amazing, from the time i ordered to the time i placed it on my head i was ...”</p>
				<p class="name">
					<span class="name_icon">
						<i class="icon-user"></i>
					</span>
					<span>Jane Smith</span>
				</p>
			</a>
		</div>
    </div>*}
</div>
</section>
<div id="page_loading"><img src="/img/loadingAnimation.gif"></div>
<script type="text/javascript" src="/themes/uniwigs2016/js/lightbox.js"></script>
<script>
window.request_ca = '{$ca|escape}';
window.request_caid = '{$caid|escape}';
window.request_psku = '{$psku|escape}';
</script>

{literal}
<script>
	(function($){
	   //参数
	   var setting={
	      column_width:300,//列宽
		  column_className:'waterfall_column',//列的类名
		  column_space:20,//列间距
		  cell_selector:'.box',//要排列的砖块的选择器，context为整个外部容器
		  img_selector:'img',//要加载的图片的选择器
		  auto_imgHeight:true,//auto_imgHeight:true,//是否需要自动计算图片的高度
		  fadein:true,//是否渐显载入
		  fadein_speed:600,//渐显速率，单位毫秒
		  insert_type:1, //单元格插入方式，1为插入最短那列，2为按序轮流插入
		  getResource:function(index){ }  //获取动态资源函数,必须返回一个砖块元素集合,传入参数为加载的次数
	   },
	   //
	   waterfall=$.waterfall={},//对外信息对象
	   $container=null;//容器
	   waterfall.load_index=0, //加载次数
	   $.fn.extend({
	       waterfall:function(opt){
			  opt=opt||{};
		      setting=$.extend(setting,opt);
			  $container=waterfall.$container=$(this);
			  waterfall.$columns=creatColumn();
			  render($(this).find(setting.cell_selector).detach(),false); //重排已存在元素时强制不渐显
			  waterfall._scrollTimer2=null;
			  $(window).bind('scroll',function(){
			     clearTimeout(waterfall._scrollTimer2);
				 waterfall._scrollTimer2=setTimeout(onScroll,300);
			  });
			  waterfall._scrollTimer3=null;
			  $(window).bind('resize',function(){
			     clearTimeout(waterfall._scrollTimer3);
				 waterfall._scrollTimer3=setTimeout(onResize,300);
			  });
		   }
	   });

	   function creatColumn(){//创建列
	      waterfall.column_num=calculateColumns();//列数
		  //循环创建列
		  var html='';
		  for(var i=0;i<waterfall.column_num;i++){
		     html+='<div class="'+setting.column_className+'" style="width:'+setting.column_width+'px; display:inline-block; *display:inline;zoom:1; margin-left:'+setting.column_space/2+'px;margin-right:'+setting.column_space/2+'px; vertical-align:top;"></div>';
		  }
		  $container.prepend(html);//插入列
		  return $('.'+setting.column_className,$container);//列集合
	   }
	   function calculateColumns(){//计算需要的列数
	      var num=Math.floor(($container.innerWidth())/(setting.column_width+setting.column_space));
		  if(num<1){ num=1; } //保证至少有一列
		  return num;
	   }
	   function render(elements,fadein){//渲染元素
	      if(!$(elements).length) return;//没有元素
	      var $columns = waterfall.$columns;
	      $(elements).each(function(i){
			  if(!setting.auto_imgHeight||setting.insert_type==2){//如果给出了图片高度，或者是按顺序插入，则不必等图片加载完就能计算列的高度了
			     if(setting.insert_type==1){
				    insert($(elements).eq(i),setting.fadein&&fadein);//插入元素
				 }else if(setting.insert_type==2){
				    insert2($(elements).eq(i),i,setting.fadein&&fadein);//插入元素
			     }
				 return true;//continue
			  }
			  if($(this)[0].nodeName.toLowerCase()=='img'||$(this).find(setting.img_selector).length>0){//本身是图片或含有图片
			      var image=new Image;
				  var src=$(this)[0].nodeName.toLowerCase()=='img'?$(this).attr('src'):$(this).find(setting.img_selector).attr('src');
				  image.onload=function(){//图片加载后才能自动计算出尺寸
				      image.onreadystatechange=null;
					  if(setting.insert_type==1){
					     insert($(elements).eq(i),setting.fadein&&fadein);//插入元素
					  }else if(setting.insert_type==2){
						 insert2($(elements).eq(i),i,setting.fadein&&fadein);//插入元素
					  }
					  image=null;
				  }
				  image.onreadystatechange=function(){//处理IE等浏览器的缓存问题：图片缓存后不会再触发onload事件
				      if(image.readyState == "complete"){
						 image.onload=null;
						 if(setting.insert_type==1){
						    insert($(elements).eq(i),setting.fadein&&fadein);//插入元素
						 }else if(setting.insert_type==2){
						    insert2($(elements).eq(i),i,setting.fadein&&fadein);//插入元素
						 }
						 image=null;
					  }
				  }
				  image.onerror=function(){
					  if (window.wait_add_image_count > 0) window.wait_add_image_count--;
					  if (window.wait_add_image_count==0) $('#page_loading').hide();
				  }
				  image.src=src;
			  }else{//不用考虑图片加载
			      if(setting.insert_type==1){
					 insert($(elements).eq(i),setting.fadein&&fadein);//插入元素
				  }else if(setting.insert_type==2){
					 insert2($(elements).eq(i),i,setting.fadein&&fadein);//插入元素
				  }
			  }
		  });
	   }
	   function public_render(elems){//ajax得到元素的渲染接口
	   	  render(elems,true);
	   }
	   function insert($element,fadein){//把元素插入最短列
	      if(fadein){//渐显
		     $element.css('opacity',0).appendTo(waterfall.$columns.eq(calculateLowest())).fadeTo(setting.fadein_speed,1);
		  }else{//不渐显
	         $element.appendTo(waterfall.$columns.eq(calculateLowest()));
		  }

	      if (window.wait_add_image_count > 0) window.wait_add_image_count--;
	      if (window.wait_add_image_count==0) $('#page_loading').hide();
	   }
	   function insert2($element,i,fadein){//按序轮流插入元素
	      if(fadein){//渐显
		     $element.css('opacity',0).appendTo(waterfall.$columns.eq(i%waterfall.column_num)).fadeTo(setting.fadein_speed,1);
		  }else{//不渐显
	         $element.appendTo(waterfall.$columns.eq(i%waterfall.column_num));
		  }

	      if (window.wait_add_image_count > 0) window.wait_add_image_count--;
	      if (window.wait_add_image_count==0) $('#page_loading').hide();
	   }
	   function calculateLowest(){//计算最短的那列的索引
	      var min=waterfall.$columns.eq(0).outerHeight(),min_key=0;
		  waterfall.$columns.each(function(i){
			 if($(this).outerHeight()<min){
			    min=$(this).outerHeight();
				min_key=i;
			 }
		  });
		  return min_key;
	   }
	   function getElements(){//获取资源
	      $.waterfall.load_index++;
	      return setting.getResource($.waterfall.load_index,public_render);
	   }
	   waterfall._scrollTimer=null;//延迟滚动加载计时器
	   function onScroll(){//滚动加载
	      if (window.wait_add_image_count > 0) return;

	      clearTimeout(waterfall._scrollTimer);
		  waterfall._scrollTimer=setTimeout(function(){
		      var $lowest_column=waterfall.$columns.eq(calculateLowest());//最短列
			  var bottom=$lowest_column.offset().top+$lowest_column.outerHeight();//最短列底部距离浏览器窗口顶部的距离
			  var scrollTop=document.documentElement.scrollTop||document.body.scrollTop||0;//滚动条距离
			  var windowHeight=document.documentElement.clientHeight||document.body.clientHeight||0;//窗口高度
			  if(scrollTop>=bottom-windowHeight){
				 render(getElements(),true);
			  }
		  },100);
	   }
	   function onResize(){//窗口缩放时重新排列
	      if (window.wait_add_image_count > 0) return;

	      if(calculateColumns()==waterfall.column_num) return; //列数未改变，不需要重排
	      var $cells=waterfall.$container.find(setting.cell_selector);
		  waterfall.$columns.remove();
		  waterfall.$columns=creatColumn();
	      render($cells,false); //重排已有元素时强制不渐显
	   }
	})(jQuery);
</script>
<script>
	/*var opt={
	  getResource:function(index,render){//index为已加载次数,render为渲染接口函数,接受一个dom集合或jquery对象作为参数。通过ajax等异步方法得到的数据可以传入该接口进行渲染，如 render(elem)
		  if(index>=7) index=index%7+1;
		  var html='';
		  for(var i=20*(index-1);i<20*(index-1)+20;i++){
			 var k='';
			 for(var ii=0;ii<3-i.toString().length;ii++){
		        k+='0';
			 }
			 k+=i;
		     var src="http://cued.xunlei.com/demos/publ/img/P_"+k+".jpg";
			 html+='<div class="box"><div class="pic"><a href="http://cued.xunlei.com/demos/publ/img/P_'+k+'.jpg" onclick="return hs.expand(this)" class="highslide"><img src="'+src+'" /></a><p>'+k+'</p></div></div>';
		  }
		  return $(html);
	  },
	  auto_imgHeight:true,
	  insert_type:1
	}
	$('#pubu').waterfall(opt);*/

	//开始请求index
	window.requestindex = 0;
	window.isdataempty = false;
	window.ajaxkey = true;
	window.wait_add_image_count = 0;
	window.requestindex = $("#pubu .box").length;
	var opt={
	  getResource:function(index,render){//index为已加载次数,render为渲染接口函数,接受一个dom集合或jquery对象作为参数。通过ajax等异步方法得到的数据可以传入该接口进行渲染，如 render(elem)
	  	if (! ajaxkey) return;
	    ajaxkey = false;

	    if (window.wait_add_image_count > 0) return;

	    if (! isdataempty) {
	    	$('#page_loading').show();

		    $.ajax({
				type:"get",//设置get请求方式
				url:"http://rvm.uniwigs.com/api_review3/cshow?"+Math.random(),//设置请求的脚本地址
				data:{
					rindex:window.requestindex,
					ca:window.request_ca,
					caid:window.request_caid,
					psku:window.request_psku
				},//设置请求的数据
				dataType:"json",//设置请求返回的数据格式
				success:function(data){
					if (!data || data.length==0) {
						isdataempty = true;
						$('#page_loading').hide();
					}

					window.requestindex += data.length;

					window.wait_add_image_count = data.length;

					var html = '';
				    for(i in data){
						if (data[i].isvideo) {
							html += '<div class="box"><div class="hover-block"><div class="hover-bor"></div><div class="hover-op"></div></div><div class="pic"><a href="'+data[i].videosrc+'" data-uk-lightbox class="highslide"><img src="'+data[i].src+'"></a><em>VIDEO</em><p class="description">'+data[i].title+'</p><p class="name"><span class="name_icon"><i class="icon-login"></i></span><span>'+data[i].author_name+'</span></p><p class="view_btn"><a href="/index.php?controller=product&sku='+encodeURIComponent(data[i].sku)+'" class="view_btn">VIEW PRODUCT ></a></p></div></div>';
						} else {
							//html += "<div class='box'><div class='pic'><a href='"+data[i].src+"' onclick='return hs.expand(this)' class='highslide'><img src='"+data[i].src+"'></a><p class='description'>"+data[i].title+"</p><p><a href='/index.php?controller=product&sku="+encodeURIComponent(data[i].sku)+"' class='view'>VIEW PRODUCT</a></p></div></div>";
							html += "<div class='box'><div class='hover-block'><div class='hover-bor'></div><div class='hover-op'></div></div><div class='pic'><a href='/index.php?controller=product&sku="+encodeURIComponent(data[i].sku)+"' class='highslide'><img src='http://rvm.uniwigs.com/timthumb.php?src="+encodeURIComponent(data[i].src)+"&w=210&h=280'></a><p class='description'>"+data[i].title+"</p><p class='name'><span class='name_icon'><i class='icon-user'></i></span><span>"+data[i].author_name+"</span></p><p class='view_btn'><a href='/index.php?controller=product&sku="+encodeURIComponent(data[i].sku)+"' class='view_btn'>VIEW PRODUCT ></a></p></div></div>";
						}
				    }
				    render($(html));
				},
				complete:function(){
					ajaxkey = true;
				}
		    });
	    }

	    return null;
	  },
	  auto_imgHeight:true,
	  insert_type:1
	}
	$('#pubu').waterfall(opt);
	$(window).trigger('scroll');
</script>
{/literal}

{literal}
<script>
$(function(){
	$(document).on('mouseenter', '#pubu .box', function(){
        $(this).find('.hover-block')
            .stop()
            .animate({ opacity : '1'}, 300)
            .addClass('op');
    });
    $(document).on('mouseleave', '#pubu .box', function(){
        $(this).find('.hover-block')
            .stop()
            .animate({ opacity : '0'}, 300)
            .removeClass('op')
    });
});
</script>
<script>
$(function(){
	var ua = navigator.userAgent;
	function toFixed() {
		if( $( "body" ).scrollTop()>=265){
			$( ".customer-nav" ).css({"top":"0","left":"0","position": "fixed"});
		}else{
			$( ".customer-nav" ).css({"position": "static"});
		}
	}
	if ( ua ) {
		$( window ).scroll(function(){
			toFixed();
		});
		document.addEventListener('touchmove',function(){
			toFixed();
		});
		document.addEventListener('touchend',function(){
			toFixed();
		});
	}
});
</script>
{/literal}

