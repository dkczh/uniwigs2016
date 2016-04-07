/**
 * 基础的底层包
 *  
 */
;(function() {
	
	var exports = {};
	
	window.base = exports;
	
	// 唯一不重复的id 
	exports.uid = function( start, len ) {
		var str = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz" + ( new Date() ).getTime(), len = len || 12;
		
		var temp = [];

		for( var i = 0; i < len; i ++ ) {
			temp.push( str.charAt( Math.floor( Math.random() * str.length ) ) );
		}
		
		return ( ( start + '-' ) || '' ) + temp.join( "" );
	}
	
	/**
	 * 监听器
	 * 
	 */
	exports.listen = {
		
		_t: null,
		
		// 窗体大小有没有发生改变
		resize: function( callback ) {
			clearTimeout( this._t );
			
			this._t = setTimeout(function() {
				$( window ).resize(function() {
					callback();
				});
			}, 79 );
		}
	};
	
	
	/**
	 * page 信息
	 * 
	 */
	exports.page = {
		
		// window 高宽
		screen: {
			width: function() {
				return $( window ).width() + $( window ).scrollLeft();
			},
			
			height: function() {
				return $( window ).height() + $( window ).scrollTop();
			}
		}
	};
	
	
	/**
	 * 数据处理
	 * 
	 */
	exports.chars = {
		
		// 转换为 json 格式
		toJson: function( str ) {
			var json = {}, arr = str.split( ';' );
			
			for( var i = 0; i < arr.length; i ++ ) {
				
				var item = arr[i].split( ':' );
				
				json[ item[0] ] = item[1];
			}
			
			return json;
		},
		
		// json 转换为字符串
		toStr: function( json, s1, s2 ) {
			var arr = [];
			
			for( var key in json ) {
				arr.push( key + ( s1 || ':' )  + json[ key ] );
			}
			
			return arr.join( s2 || ';' );
		},
		
		// 将一个字符串分段,
		// return array: 始终返回一个切割好的字符串数组或原字符串数组(字符串长度小于num)
		//	@param
		// 	str: 要分段的字符串，必选
		// 	num: 以多少个字符为一个组，必选
		//  dir: 从字符串的开始或结束开始切换(默认为1，即从开始位置切割；-1为从结束位置切割)
		strcut: function( str, num, dir ) {
			if( str.length <= num ) {
				return [ str ];
			} 
			
			var temp = [], arr = [], index = 0;
				
			for( var i = 0; i < str.length; i ++ ) {
				temp.push( str.charAt( i ) );
			}
			
			// 反向切割分组
			if( dir === -1 ) {
				temp.reverse();
			}
			
			for( var i = 0; i < temp.length; i ++ ) {
				// 每num 个字符为一组
				if( i !== 0 && ( i % num == 0 ) ) {
					// 将分完组的字符也进行一次反向
					if( dir === -1 ) {
						arr[ index ].reverse();
					}
					
					arr[ index ] = arr[ index ].join( '' );
					index ++;
				}
				
				if( !arr[ index ] ) {
					arr[ index ] = [];
				}
				
				// 如果为最后一项
				if( i === temp.length - 1 ) {
					arr[ index ].push( temp[i] );
					
					if( dir === -1 ) {
						arr[ index ].reverse();
					}
					
					arr[ index ] = arr[ index ].join( '' );
					break;
				}
				
				arr[ index ].push( temp[i] );
			}
			
			return dir === -1 ? arr.reverse() : arr;
		}
		
	};
	
	
	/**
	 * 数学函数包
	 * 
	 */
	exports.math = {
		
		// 随机函数
		// 随机数   最大值 为   end + start， 最小值为 start
		rand: function( end, start ) {
			var num = Math.floor( Math.random() * end );
			
			return ( start || 0 ) + num;
		},
		
		// 把数字转换为浮点数
		// @param {num}: 要转换的数字
		// @param {pos}: 小数点后保留的位数
		float: function( num, pos ) {
			var mynum = typeof num === 'number' ? num : parseFloat( num ), mypos = pos || 2;
			
			if( isNaN( mynum ) ) {
				return null;
			}
			
			return Math.round( mynum * Math.pow( 10, mypos ) ) / Math.pow( 10, mypos );
		}
	};
	
	
	
	/**
	 * 等待图片加载
	 * @params: { url: 原始对象集合: Array } || url || image element array
	 * @params: Function
	 * @Callback 1.image target, 2.是否为缓存
	 *  
	 */

	exports.imgLoader = function( param, callback ) {
		var data = {};
		
		if( $.isPlainObject( param ) ) {
			data = param;
		} 
		else if( $.isArray( param ) || ( $.type( param ) === 'object' && !$.isPlainObject( param ) ) ) {
			$.each( param, function() {
				data[ $( this ).attr( 'src' ) ] = this;
			});
		} 
		else if( typeof param === 'string' ) {
			data[ param ] = [];
		}
		
		for( var key in data ) {
			
			var url = key, img = new Image();
			
			img.src = url;
			
			img._callback = callback;
			img._orgi = data[ key ];
			
			if( !img.complete ) { 
				$( img ).load(function() {
					this._callback.call( this._orgi.length ? this._orgi : this, false );
				});
			}
			// 如果图片已经存在于浏览器缓存，直接调用回调函数
			else {
				// 如果为 true 则表示在缓存中
				img._callback.call( img._orgi.length ? img._orgi : img, true );
				return;
			}
		}
	};
	

	var cookies = exports.cookies = {
		
		set: function( name, value, days ) {
	        var exp = new Date();
	       	exp.setTime( exp.getTime() + days * 24 * 3600 * 1000 );
	        var arr = document.cookie.match( new RegExp("(^| )"+name+"=([^;]*)(;|$)") );
	        
	        document.cookie = name + "=" + escape( value ) + ";expires=" + exp.toGMTString() + ";path=/";
		},
		
		get: function( name ) {
	        var arr = document.cookie.match( new RegExp("(^| )"+name+"=([^;]*)(;|$)") );
	        if( arr != null ) {
	                return unescape(arr[2]);
	                return null;
	        }
		},
		
		remove: function( name ) {
	        var exp = new Date();
	        exp.setTime( exp.getTime() - 1 );
	        var cval = cookies.get( name );
	        if( cval != null ) {
				document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
	        }
		}
	};
	

})( jQuery );


/*$(function(){
	$('#searchform input[name=search_query]').keydown(function(event){
		if (event.keyCode==13) {
			searchformsubmit();
		}
	});
});*/
//header search form
function searchformsubmit(btn) {
//	search_query = $("#searchform input[name=search_query]").val();
	search_query = $(btn).prev().val();
	search_query = search_query.trim();
	if (search_query == "Search By Keyword"
			|| search_query == "") {
		$("#searchform input[name=search_query]").focus();
		return false;
	}

	window._gaq.push(['_trackEvent','search','search',search_query.toLowerCase()]);

	//window.location.href = '/search/' + search_query.replace(new RegExp("[^a-z0-9_]+", 'gi'),"-").replace(new RegExp("^[-_]+|[-_]+$", 'g'),"").toLowerCase();
	//window.location.href = '/search/' + search_query.replace(new RegExp("[^a-z0-9_ ]+", 'gi'),"-").replace(new RegExp("(^[-_]+)|([-_]+$)", 'g'),"").replace(/[ \-_]{2,}/g, " ").toLowerCase();
	window.location.href = '/search/' + encodeURIComponent(search_query.replace(/[^a-z0-9 _\-\/]+/gi," ").trim().replace(/[ _\-]{2,}/g, " ").trim().replace(/\s+/g, ",").toLowerCase());
	return false;
}



$(function(){

	$( '.lazyload' ).find( 'img' ).lazyload();

	window.doclearpass = function(clearbtn){
		$(clearbtn).hide().next().val('');
	}
	$('<em class="delete hide" style="-webkit-transform-origin: 0px 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);" onclick="doclearpass(this)"></em>').insertBefore(':input.clearbtn');
	$(':input.clearbtn').keyup(function(){
		if ($(this).val().length>0) {
			$(this).prev().show();
		} else {
			$(this).prev().hide();
		}
	});

/*	
	$('#hide_menu,.all_category').click(function(){
		$("#menu").addClass("slider-open");
		$("#content").addClass("slider-open");
	})
	$('.shortcut-remove').click(function(){
		$("#menu").removeClass("slider-open");
		$("#content").removeClass("slider-open");
	})
*/	
	$('.submenu-deploy').click(function(){
			$(this).toggleClass('submenu-deploy-hover');
			$(this).parent().find('.nav-submenu').toggle(100);
			$(this).parent().find('.sidebar-decoration').toggle(100);
			return false;
	});

	$('.mobile-nav-button').click(function(){
			$(this).toggleClass('mobile-nav-button-hover');
			$(this).parent().find('.iside').toggle();
			return false;
	});
	
	$( '#add_to_cart,.checkout-btn-wap,#review-form .prod-pg-submit-review-button,#comment_one button' ).click(function() {
		$( this ).addClass( 'disabled' ).attr( 'disabled', 'disabled' ).text('Loading...');
	})


	/*$('#searchBtn').click(function(){
			$(this).parent().parent().find('.header_search').toggleClass('header_search_hover');
			return false;
	});*/

	/* gotop */
	function gotop() {
		var $ua = navigator.userAgent.toLowerCase(), isChrome = $ua
				.indexOf("chrome") > -1, isSafari = $ua.indexOf("safari") > -1;
		var $top = $("#backup_a"), $th = isChrome || isSafari ? document.body.scrollTop
				: document.documentElement.scrollTop;
		if ($th != 0) {
			$top.fadeIn(300);
		} else {
			$top.hide();
		}
		$(window).scroll(
				function() {
					$th = isChrome || isSafari ? document.body.scrollTop
							: document.documentElement.scrollTop;
					if ($th == 0) {
						$top.hide();
					} else if ($th > 600) {
						$top.show();
					}
				});
		$top.click(function(e) {
			$("body,html").animate({
				scrollTop : 0
			});
			e.preventDefault();
		});
	}

	$(function() {
		gotop();
	});

	$(".fix_nav_title").click(function(event) {
		$(this).toggleClass('on');

        $(".nav_div").toggle();
	});
	$(".nav_div li a").click(function(event) {
		$(".nav_div").hide();
		$(".fix_nav_title").removeClass('on');
	});

});

// lazyload
	(function( $ ) {
	
	$.fn.lazyload = function( beginDis ) {
		// Lazy image array[object]
		var	lazyArray = this;
		
		// Get page top method
		function pageTop() {
			return ( document.body.clientHeight < document.documentElement.clientHeight ? document.body.clientHeight : document.documentElement.clientHeight ) + Math.max( document.documentElement.scrollTop, document.body.scrollTop );
		}
	
		// Image load method
		function imgLoad() {
			// Each the images
			lazyArray.each(function() {
				var oft = $( this ).offset();
				
				if( !oft || this.nodeType === undefined ) return;
				
				if( oft.top <= pageTop() + ( beginDis || 0 ) ) {
					var original = $( this ).attr( 'original' );
					
					// To display the image
					if( original ) {
						$( this ).attr( 'src', original ).removeAttr( 'original' );
					}
				}
			});
		}
	
		// Default Check
		imgLoad();
	
		// Bind the scroll event for window
		$( window ).bind( 'scroll', function() {
			imgLoad();
		});
	};

})( jQuery );

/*
$(function() {
    FastClick.attach(document.body);
});
*/

document.addEventListener("touchstart", function(){}, true)
