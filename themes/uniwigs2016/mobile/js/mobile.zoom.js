(function( $ ) {
/**
 * mobile touch zoom and drag
 *  
 */
function touchZoom( target, item_selector ) {
	
	var _this = this;
	
	if( !$( '.mobile-zoom' ).length ) { 
	
		$( 'body' ).append('\
			<div class="mobile-zoom" style="display: none;">\
				<div class="mobile-zoom-close">&times;</div>\
				<div class="mobile-zoom-control">\
					<span class="mobile-zoom-prev">&lt;</span>\
					<span class="mobile-zoom-info">0/0</span>\
					<span class="mobile-zoom-next">&gt;</span>\
				</div>\
				<div class="mobile-zoom-inner">\
					<img class="mobile-zoom-img" src="" />\
				</div>\
			</div>'
		);
		
		this._target = $( target );
		this._layout = $( '.mobile-zoom' );
		this._isr = item_selector || 'a';
		
		this.init();
	}
	
}


touchZoom.prototype = {
		
	// 初始化
	init: function() {
		this.index = 0;
		
		this.toucher = this._layout.find( '.mobile-zoom-img' )[0];
		
		$( this.toucher ).css( '-webkit-transform-origin', '0 0' );
		
		this.bind();
	},
	
	// 加载切换图片
	load: function( url, img_target ) {
		
		$( this.toucher ).attr( 'src', url ).show();
			
		// 根据图片实际大小进行重置以下参数
		// touch 类型
		this.touch_type = 0;
		// 判断是否为双击
		this.touch_delay = 0;
		
		this.toucher._width = img_target.width;
		this.toucher._height = img_target.height;
		
		// 修改图片大小容器大小
		this.resize();
	},
	
	bind: function() {
		var _this = this, now = function() { return ( new Date() ).getTime(); }, control_timer = null;
		
		// 操作的图片列表点击事件
		this._target.find( this._isr ).each(function( i ) {
			this.i = i;
		}).click(function() {
			
			_this.index = this.i;
			
			// 便于设置当前图片
			_this.switchImage( _this.index );
			
			var url = $( this ).attr( 'href' );
			
			_this._layout.fadeIn( 100 );

			$( 'body' ).css({
				'height'	: $( window ).height(),
				'overflow'	: 'hidden' 
			});
			
			// 先将图片元素隐藏
			$( _this.toucher ).hide();
			
			// 等待图片加载完成
			base.imgLoader( url, function() {
				_this.load( url, this );
			});
			
			return false;
		});
		
		// 快速切换到前一张图片
		this._layout.find( '.mobile-zoom-prev' ).click(function() {
			_this.switchImage( _this.index - 1 );
			_this._target.find( _this._isr ).eq( _this.index ).triggerHandler( 'click' );
		});
		
		// 快速切换到后一张图片
		this._layout.find( '.mobile-zoom-next' ).click(function() {
			_this.switchImage( _this.index + 1 );
			_this._target.find( _this._isr ).eq( _this.index ).triggerHandler( 'click' );
		});
		
		
		$( window ).resize(function() {
			_this.resize();
		});
		
		
		// 关闭
		this._layout.find( '.mobile-zoom-close' ).click(function() {
			_this._layout.hide();

			$( 'body' ).css({
				'height'	: 'auto',
				'overflow'	: 'auto' 
			});
		});
		
		
		// 准备缩放以及拖拽
		this.toucher.addEventListener( 'touchstart', function( event ) {
			
			event.preventDefault();
			
			var touches = event.targetTouches;
			
			// 记录拖拽图片位置
			// 或者是否需要放大最大，或者恢复最小
			if( touches.length == 1 ) {
				
				// 双击 直接放大或者直接缩小
				if( now() - _this.touch_delay < 220 ) {
					
					_this.directZoom( [ touches[0].pageX, touches[0].pageY ] );
				} 
				// 移动
				else {
					
					_this.touch_type = 1;
				
					// 这里不能获取图片当前位置，因为可能存在缩放，图片缩放并没有算在dom 的left,top 中
					event.target.M_drag_start = [
						[ touches[0].pageX, touches[0].pageY ],
						[ _this.getCurTrans()[0], _this.getCurTrans()[1] ]
					];
				}
					
				_this.touch_delay = now();
			}
			
			// 保存缩放的初始信息
			// 记录初始的两个坐标点以及中心点
			if( touches.length == 2 ) {
				
				_this.touch_type = 2;
				
				event.target.M_zoom_start = [
					// 手指 1
					[ touches[0].pageX, touches[0].pageY ],
					// 手指 2
					[ touches[1].pageX, touches[1].pageY ],
					// 当前的left， top
					[ _this.getCurTrans()[0], _this.getCurTrans()[1] ],
					// 当前的缩放值
					_this.getCurScale()
				];
				
				event.target._scale = _this.getCurScale();
			}
			
		}, false );
		
		
		// 执行缩放以及拖拽
		this.toucher.addEventListener( 'touchmove', function( event ) {
			
			var touches = event.targetTouches;
			
			clearTimeout( control_timer );
			_this._layout.find( '.mobile-zoom-control' ).hide();
			
			// 拖拽功能
			if( _this.touch_type == 1 && touches.length == 1 ) {
				
				var dstart = event.target.M_drag_start, scale = _this.getCurScale(),
					
					left = touches[0].pageX - dstart[0][0] + dstart[1][0], 
					
					top = touches[0].pageY - dstart[0][1] + dstart[1][1];
				
				var fix = _this.fixRange( left, top, scale ),
					
					trans = fix.left +'px, '+ fix.top + 'px';
				
				$(  event.target ).css({
					'-webkit-transform': 'translate('+ trans +') scale('+ scale +')'
				});
			}
			
			// 缩放效果
			if( _this.touch_type == 2 && touches.length == 2 ) {
				
				// 缩放比例
				var scale = base.math.float( event.target._scale * _this.scaleStep( event ) );
				
				// 锁定最小值
				if( scale < event.target._scale_min ) {
					return;
				}
				// 锁定最大值
				if( scale >= event.target._scale_max ) {
					return;
				}
				
				var zstart = event.target.M_zoom_start;
					
				var left = zstart[2][0] + ( event.target._width * ( zstart[3] - scale ) ) * 0.5,
					top = zstart[2][1]  + ( event.target._height * ( zstart[3] - scale ) ) * 0.5;
				
				var fix = _this.fixRange( left, top ,scale );
					
				var trans = fix.left +'px, '+ fix.top + 'px';
		
				$( event.target ).css({
					'-webkit-transform': 'translate('+ trans +') scale('+ scale +')'
				});
			}
			
		}, false );
		
		
		// 执行缩放以及拖拽
		this.toucher.addEventListener( 'touchend', function( event ) {
			
			control_timer = setTimeout(function() {
				_this._layout.find( '.mobile-zoom-control' ).show();
			}, 500 );
		});
	},
	
	// 修正left top 是否超出边界
	fixRange: function( left, top, scale ) {
		
		if( left > 0 ) { left = 0; }
		if( top > 0 ) { top = 0; }
		
		var x_max = this._layout.find( '.mobile-zoom-inner' ).width() - this.toucher._width * scale,
			y_max = this._layout.find( '.mobile-zoom-inner' ).height() - this.toucher._height * scale;
		
		if( Math.abs( left ) > Math.abs( x_max ) ) {
			left = x_max;
		}
		if( Math.abs( top ) > Math.abs( y_max ) ) {
			top = y_max;
		}
		
		return { left: left, top: top };
	},
	
	
	// 获取当前样式中的translate 信息
	getCurTrans: function() {
		var tf = $( this.toucher ).css( '-webkit-transform' ), expr = /\((.+)\)/.exec( tf );
		
		if( expr ) {
			return [ 
				base.math.float( expr[1].split( ',' )[4] ), 
				base.math.float( expr[1].split( ',' )[5] ) 
			];
		}
		
		return [ 0, 0 ];
	},

	// 获取当前样式中的缩放比例
	getCurScale: function() {
		var tf = $( this.toucher ).css( '-webkit-transform' ), expr = /\((.+)\)/.exec( tf );
		
		if( expr ) {
			return expr[1].split( ',' )[3];
		}
		
		return 1;
	},
	
	// 缩放值
	scaleStep: function( event ) {
		
		var touchs = event.targetTouches, start = event.target.M_zoom_start,
			
			// 横向 两点距离
			x_len = Math.abs( start[0][0] - start[1][0] ), 
			// 纵向 两点距离
			y_len = Math.abs( start[0][1] - start[1][1] );
		
		var // 横向 两点变化距离
			touch_x = Math.abs( touchs[0].pageX - touchs[1].pageX ), 
			// 纵向 两点变化距离
			touch_y = Math.abs( touchs[0].pageY - touchs[1].pageY );
		
		// 缩放比例s
		var scale = ( touch_x + touch_y ) / ( x_len + y_len );
		
		return base.math.float( scale );
	},
	
	// 直接放大或者缩小
	directZoom: function( arr ) {
		
		// 缩小
		if( this.getCurScale() == this.toucher._scale_max ) {
			
			this.toMin();
		} 
		// 放大
		else {
			var left = ( $( window ).width() - this.toucher._width * this.toucher._scale_max ) * 0.5 + $( window ).width() * 0.5 - arr[0], 
				
				top = ( $( window ).height() - this.toucher._height * this.toucher._scale_max ) * 0.5 + $( window ).height() * 0.5 - arr[1];
				
			var fix = this.fixRange( left, top, 1 );
			
			var trans = fix.left +'px, '+ fix.top +'px';
			
			$(  this.toucher ).css({
				'-webkit-transform': 'translate('+ trans +') scale('+ this.toucher._scale_max +')'
			});
		}
	},
	
	/**
	 * 监听以及设置屏幕的缩放以及相关参数
	 *  
	 */
	resize: function() {
		
		this.toucher._scale_min = Math.max( $( window ).width() / this.toucher._width, $( window ).height() / this.toucher._height );
		
		this.toucher._scale_max = 1;
									
		// 在没有拖拽的时候在屏幕翻转的情况下始终保持图片上下居中
		if( this.touch_type == 0 ) {
			
			this.toMin();
		}
		
		this._layout.css({
			width	: $( window ).width(),
			height	: $( window ).height()
		});	
		
		// 设置inner 位置
		this._layout.find( '.mobile-zoom-inner' ).css({
			width	: $( window ).width(),
			height	: $( window ).height()
		});
		
	},
	
	// 图片还原
	toMin: function() {
		
		var left = ( $( window ).width() - this.toucher._width * this.toucher._scale_min ) * 0.5,
			
			top = ( $( window ).height() - this.toucher._height * this.toucher._scale_min ) * 0.5;
		
		$(  this.toucher ).css({
			'-webkit-transform': 'translate('+ left +'px, '+ top +'px) scale('+ this.toucher._scale_min +')'
		});
	},
	
	// 点击箭头切换同组图片
	switchImage: function( index ) {
		
		var len = this._target.find( this._isr ).length,  cur_i = index;
		
		if( cur_i < 0 ) { cur_i = len - 1; }
		if( cur_i > len - 1 ) { cur_i = 0; }
		
		this._layout.find( '.mobile-zoom-info' ).html( ( cur_i + 1 ) +"/" + len );
		
		this.index = cur_i;
	}
	
};

window.touchZoom = touchZoom;

})( jQuery );