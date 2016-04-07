// 修改语种价格标点
function resetPrice( str ) {
	if( str === undefined ) {
		return str;
	}
	
	str = str + '';
	
	var priceArr = str.split( '.' );
	
	// 小数点前面的数字
	var p1 = priceArr.length ? priceArr[0] : str,
		
		arr = base.chars.strcut( p1, 3, -1 );
		
	//gvs.langcode
	
	var pointSign = '.';
	// 俄语站为空格
	if( /ru/.test( gvs.langcode ) || gvs.currencycode=='RUB') {
		pointSign = ' ';
	}
	
	// 不进行价格标点转换	
	if( !gvs.isrp ) {
		// 日文不添加  .00
		if( gvs.isjp ) {
			var priceStr = arr.join( '，' ) + ( priceArr.length && priceArr[1] ? '.' + priceArr[1] : '' );
		} else {
			var priceStr = arr.join( ',' ) + ( priceArr.length && priceArr[1] ? pointSign + priceArr[1] : '' );
			//非美元货币设置
			if(gvs.currencycode!="USD" && gvs.currencycode!='RUB'){
				pointSign = ',';
				priceStr = arr.join( '.' ) + ( priceArr.length && priceArr[1] ? pointSign + priceArr[1] : '' );
			}
		}
		//日文货币
		if(gvs.currencycode=='JPY'){
			pointSign = '，';
			
			priceStr = arr.join( '，' ) + ( priceArr.length && priceArr[1] ? pointSign + priceArr[1] : '' );
		}
		if( arr[1] && arr.join( '' ).length < 4 && priceArr.length && priceArr.length < 2 ) {
			if( !/\./.test( priceStr ) ) {
				priceStr += '.00';
			}
		}
		
		priceStr+=' ';	
		return priceStr;
		
	} else {
		
		if( /es/.test( gvs.langcode ) && arr.join( '' ).length < 5 ) {
			pointSign = '';
		}
		
		var priceStr = arr.join( pointSign ) + ( priceArr.length && priceArr[1] ? ',' + priceArr[1] : '' );
		
		if(gvs.currencycode=="USD"){
			priceStr = arr.join( ',' ) + ( priceArr.length && priceArr[1] ? '.' + priceArr[1] : '' );
		}
		//非美元货币设置
		if(gvs.currencycode!="USD" && gvs.currencycode!='RUB'){
			pointSign = ',';
			
			priceStr = arr.join( '.' ) + ( priceArr.length && priceArr[1] ? pointSign + priceArr[1] : '' );
		}
		//日文货币
		if(gvs.currencycode=='JPY'){
			pointSign = '，';
			
			priceStr = arr.join( '，' ) + ( priceArr.length && priceArr[1] ? pointSign + priceArr[1] : '' );
		}
		
		if( arr.join( '' ).length < 4 && priceArr.length && priceArr.length < 2 ) {
			if( !/,/.test( priceStr ) ) {
				priceStr += ',00';
			}
		}
		
		priceStr+=' ';	
		return priceStr;
	}
}


$.fn.unitSwitch = function ( elem ) {
	var json = {
			// 长度
			1: 2.54,
			// 重量
			2: 0.45359237
		};
	
	var inputs = $( elem ).find( 'input[type=text], input[type=number]' );
	
	var _prevUnit = $( this ).val();
	
	this.change(function() {
		if( _prevUnit !== $( this ).val() ) {
			checkChange();
		}
		
		_prevUnit = $( this ).val();
	});
	
	function checkChange() {
		inputs.each(function() {
			var num = 0, v = $.trim( $( this ).val() ), type = $.trim( $( this ).attr( 'units' ) );
			
			if( v !== '' && type != undefined && type != '' && json[ type ] ) {
				
				if( _prevUnit == 'in' ) {
					v *= json[ type ];
				} else {
					v /= json[ type ];
				}
				
				toChange( this, v );
			}
		});
	}
	
	function toChange( target, num ) {
		// 保留两位小数
		num = Math.round( num * Math.pow( 10, 1 ) ) / Math.pow( 10, 1 );
		
		$( target ).val( num );
	}
};

$.fn.inRange = function ( select, isCartPage ) {
	var inputs = this.find( 'input[type=text], input[type=number]' );
	
	inputs.bind( 'keyup.inrange, change.inrange', function() {
		check( inputs );
	});
	
	function check( items ){
		items.each(function(){
			var cur_unit = $.trim( $( select ).val() ), num = parseFloat( $.trim( $( this ).val() ) ), cur_range = $.trim( $( this ).attr( cur_unit ) );
		
			if( cur_range && cur_range != '' && !isNaN( num ) ) {
				var isOut = false, arr = cur_range.split( ',' );
				
				var min = parseFloat( arr[0] ), max = parseFloat( arr[1] );
				if( min && !isNaN( min ) && num < min ) {
					isOut = true;
				}
				
				if( max && !isNaN( max ) && num > max ) {
					isOut = true;
				}
				
				var box = $( this ).parent().parent();
				if( isCartPage ) {
					box = $( this ).parent().parent().next();
				}
				
				var tips_key = $( select ).val() == 'cm' ? '.tips1' : '.tips2', curTips = box.find( tips_key );
				
				box.find( '.tips1, .tips2' ).hide();
				curTips[ isOut ? 'show' : 'hide' ]();
			}
		});
	}
	
	$( select ).bind( 'change.inrange', function(){
		check( inputs );
	});
};



function changeUnits( elem ) {
	$( 'label.custom_unit' ).text( $( elem ).val() );
	$( 'label.custom_unit_kg' ).text( $( elem ).find( 'option:selected' ).attr( 'aunit' ) );
}



function checkKnum() {
	var locked = true, proqty_num = parseInt( $( "#proqty" ).val() );
	
	if( gvs.knum && gvs.knum != 1 ) {
		
		if( proqty_num < gvs.knum ) {
			locked = true;
			$( "#s-knum_tips" ).fadeIn( 80 );
		} else {
			locked = false;
			$( "#s-knum_tips" ).fadeOut( 80 );
		}
	} else {
		return false;
	}
	
	return locked;
}



function lockedProductSubmit() {
	var submitLocked = false, customSize = $( '#cussize' );
	
	if( !$( '.skuLinkage' ).length ) {
		return false;
	}
	
	// 如果有自定义属性选择
	if( customSize && customSize.length ) {
		// 如果选择size 的select 是被禁用的
		if( $( '.skusize' ).length && $( '.skusize' ).is( ':disabled' ) ) {
			// 判断自定义尺码是否有勾选
			if( customSize.is( ':checked' ) ) {
				submitLocked = false;
			} else {
				submitLocked = true;
			}
		}
	}
	
	// 循环select
	$( '.skuLinkage' ).each(function() {
		// 如果为不可用的不进循环
		if( !$( this ).is( ':disabled' ) ) {
			var selectedElem = $( this ).find( 'option:selected' );
			
			if( $.trim( $( this ).val() ) === '' || ( selectedElem && selectedElem.hasClass( 'no_stock' ) ) ) {
				submitLocked = true;
			}
		}
	});
	
	// 手机站只能定制
	if( $( ".custom_model_input" ).length ) {
		if( !$( ".skusize_select" ).length ) {
			if( !$( "#cussize" ).length ) {
				
				submitLocked = true;
			} else {
				if( $( "#cussize" ).is( ":checked" ) == false ) {
					submitLocked = true;
				}	
			}
		}
	}
	
	var snum = parseInt( $( '#instockNum' ).html() ), qty = parseInt( $( '#proqty' ).val() );
	if( snum && !isNaN( snum ) && qty && !isNaN( qty ) ) {

		if( qty > snum ) {
			submitLocked = true;
		}
	}
	/*
	if( gvs.knum && gvs.knum != 1 ) {
		var num = base.math.float( $( '#proqty' ).val() );
		
		if( num < gvs.knum ) {
			submitLocked = true;
		} else {}
	}
	*/

	return submitLocked;
}



// 批发价以及输入数量
/**
 * {arr} 批发价数组
 * {defPrice} 产品 原始价格，如果为只能自定义的商品，这个原始价格为产品价格+定制价格
 * {elem} input target
 * {gvs.knum} 捆绑数量
 *  
 */
function getSales( arr, defPrice, elem ) {
	//knum = 2;
	
	defPrice = base.math.float( defPrice );
	
	var sarr = $.parseJSON( arr ), num = base.math.float( $( elem ).val() );
	
	var sp = parseFloat( $( '#s-price' ).val() );
	
	// 如果有库存数量
	// 判断输入的数量是否大于库存数量
	var inElem = $( '#instockNum' ), isnum = base.math.float( $.trim( inElem.text() ) );
	
	if( $.trim( inElem.text() ) != '' ) {
		if( !isNaN( isnum ) && num > isnum ) {
			$( elem ).val( isnum );
			num = isnum;
		}
	}
	
	// 修正输入的数量始终为1
	if( num < 1 ) {
		num = 1;
	}
	
	// 判断捆绑数量
	if( gvs.knum && gvs.knum != 1 ) {
		$( "#s-knum_tips" )[ num < gvs.knum ? "fadeIn": "fadeOut" ]( 200 );
	}
	
	
	var my_price = defPrice, 
		
		fp = $( '.s-final_price' );
	
	// 选择了主商品，，则使用打折价
	var selectMain = false;
	$( ".s_pack_goods" ).each(function() {
		var _input = $( this ).find( 'input[type=checkbox]' );
		if( _input.is( ":checked" ) && _input.attr( "mainflag" ) ) {
			selectMain = true;
			
			//my_price = $( "#s-price" ).attr( "price" ) || 0;
			my_price = base.math.float( $( "#s-price" ).val() );
		}
	});
	
	// 数量为1 或者没有折扣价
	if( num === 1 || !sarr || $.isEmptyObject( sarr ) ) {
		
		fp.attr( "price", base.math.float( num * ( base.math.float( my_price ) ) ) );
		fp.find( '.smt_price' ).text( resetPrice( fp.attr( "price" ) ) );
		
		$( '#s-price' ).data( "changed", false );
		
	// 数量大于1的时候判断是否使用批发价
	} else if( num > 1 && sarr && !$.isEmptyObject( sarr ) ) {
		
		var pprice = my_price;
		
		for( var i = 0; i < sarr.length; i ++ ) {
			var json = sarr[i], numArr = json.salenum2 === -1 ? json.salenum1 : [ json.salenum1, json.salenum2 ];
			
			if( $.inArrayRange( numArr, num ) ) {
				pprice = json.saleprice;
				break;
			}
		}
		
		var tprice = num * ( base.math.float( pprice ) );
		
		fp.attr( "price", base.math.float( tprice ) );
		fp.find( '.smt_price' ).text( resetPrice( fp.attr( "price" ) ) );
		
		$( '#s-price' ).data( "changed", true );
	}
	
	else {}
	
	//resetPackagePrice( fp.attr( 'price' ) );
}






// 鑾峰彇鎻愮ず淇℃伅
function getSkuInfo( optionElem, stockNum, skuAllow ) {
	
	var type = $( optionElem ).parent().attr( 'sku:type' ), box = $( '#selected_' + type + '_box' ), elem = $( '.selected_' + type );

	// 鍒ゆ柇鏄惁鏄剧ず閫夋嫨椤圭殑鎻愮ず淇℃伅
	if( elem && elem.length ) {
		elem.html( $( optionElem ).text() );
		
		if( $.trim( $( optionElem ).val() ) !== '' ) {
			box.fadeIn();
		}
		
		// 鍏ㄩ儴閮介€夋嫨浜嗗垯闅愯棌鏈€夋彁绀轰俊鎭�
		if( !$( '#productLockedTips' ).is( ':hidden' ) && !lockedProductSubmit() ) {
			$( '#productLockedTips' ).fadeOut();
		}
	}
	
	// 杩涜搴撳瓨鏁伴噺鍜岃緭鍏ユ暟閲忕殑鍒ゆ柇
	var isElem = $( '#instock' ), inElem = $( '#instockNum' ), pElem = $( '#proqty' );
	
	// 濡傛灉鏁版嵁涓虹┖鍒欎笉杩涜搴撳瓨鐨�
	if( skuAllow ) {
		if( stockNum == -1 ) {
			isElem.hide();
			return false;
		}
		// 搴撳瓨鎻愮ず
		isElem[ stockNum ? 'show' : 'hide' ]();
		
		if( stockNum ) {
			inElem.text( stockNum ).show();
			
			// 妫€鏌ョ敤鎴疯緭鍏ョ殑搴撳瓨鏁伴噺
			var num = base.math.float( $.trim( pElem.val() ) );
			
			if( num > stockNum ) {
				pElem.val( stockNum );
				
				var fp_p = base.math.float( $( '.final_price' ).attr( 'price' ) );
				var pp_p = base.math.float( $( '#packagePrice' ).attr( 'price' ) );
				var p_p = base.math.float( $.trim( $( '#sale_price' ).val() ) );
				
				$( '.final_price' ).attr( 'price', base.math.float( fp_p - p_p * ( num - stockNum ) ) );
				$( '#packagePrice' ).attr( 'price', base.math.float( pp_p - p_p * ( num - stockNum ) ) );
				
				$( '.final_price' ).text( resetPrice( $( '.final_price' ).attr( 'price' ) ) );
				$( '#packagePrice' ).text( resetPrice( $( '#packagePrice' ).attr( 'price' ) ) );
			}
		} else {
			inElem.hide().empty();
		}
	}
	
	// 褰撻€夋嫨鐨勫€间负please 鏃�
	if( $.trim( $( optionElem ).parent().val() ) === '' ) {
		elem.html( '-/-' );
	}
}

(function($) { 
// Sku method



function isSkuNull() {
	var is_show_tips = false;
	// 循环select
	$( '.skuLinkage' ).each(function() {
		// 如果为不可用的不进循环
		if( !$( this ).is( ':disabled' ) ) {
			var selectedElem = $( this ).find( 'option:selected' );
			
			if( $.trim( $( this ).val() ) === '' || ( selectedElem && selectedElem.hasClass( 'no_stock' ) ) ) {
				is_show_tips = true;
			}
		}
	});
	
	return is_show_tips;
}

// SKU 閫夋嫨灏哄鍜岄鑹叉椂鐨勫垏鎹㈠垽鏂�
// callback
// @param
// 	p1: 褰撳墠閫変腑鐨刼ption
//  p2: 搴撳瓨鏁伴噺, null 涓烘棤娉曞尮閰嶅簱瀛樹俊鎭�
// 	p3: sku 鑱斿姩鏄惁鎵ц
$.fn.sku = function( data, callback ) {
	data = $.isPlainObject( data ) ? data : $.parseJSON( data ), isNull = true, isNullData = true;
	
	for( var key in data ) {
		isNullData = false;
	}
	
	var $select = this;
	
	$select.each(function() {
		// DOM 鍔犺浇瀹屾垚杩涜搴撳瓨鎻愮ず鐨勫洖璋冧互鍙婂凡閫変俊鎭殑鎻愮ず
		var _this = this, cur = getOption( this ), key = $( cur ).attr( 'sku:key' );
			
		if( callback && $.isFunction( callback ) ) {
			callback.call( cur, getStock( cur, this ), 1 );
		}
		
		// select change 浜嬩欢瑙﹀彂鏃�
		$( this ).change(function( event ) {
			event.preventDefault();
			event.stopPropagation();
			
			var cur = getOption( this ), key = $( cur ).attr( 'sku:key' );
			
			// 濡傛灉娌℃湁sku json 鏁版嵁灏变笉杩涜鑱斿姩
			if( isNullData ) {
				callback.call( cur, null, 2 );
				return false;
			}
			
			if( key && !isNullData ) {
				setStyle( matchData( key ), cur );
			}
			
			if( callback && $.isFunction( callback ) ) {
				callback.call( cur, getStock( cur, this ), 1 );
			}
			
			// 鏍规嵁搴撳瓨淇敼褰撳墠select 鏂囨湰棰滆壊
			if( $( this ).find( 'option:selected' ).hasClass( 'no_stock' ) ) {
				$( this ).css( 'color', '#ccc' );
			} else {
				$( this ).css( 'color', '#000' );
			}
			$( this ).find( 'option' ).each(function( i ) {
				$( this ).css( 'color', this._color );
			});
			
			
			if( !isSkuNull() ) {
				$( '#productLockedTips' ).fadeOut();
			}
			
			return false;
		});
	});
	
	// 鑾峰彇搴撳瓨
	function getStock( itemElem, selectElem ) {
		var stock = null, k = $( itemElem ).attr( 'sku:key' );
		
		if( !isNullData && data.products_sku && k ) {
			var arr = data.products_sku[ k ];
			
			if( $.isArray( arr ) ) {
				for( var i = 0; i < $select.length; i ++ ) {
					if( $select[i] !== selectElem ) {
						v = $( $select.eq( i ) ).val();
						
						for( var j = 0; j < arr.length; j ++ ) {
							var arrSplit = arr[j].split('|');
							
							if( v == arrSplit[1] ) {
								stock = arrSplit[2];
								break;
							}
						}
					}
				}
			} else {
				stock = arr;
			}
		}
		
		return stock;
	}
	
	// 鍖归厤鏁版嵁
	function matchData( key ) {
		var sku = data.products_sku;

		if( !sku || !sku[ key ] ) {
			return null;
		}
		
		var map = {}, arr = sku[ key ];
		
		for( var i = 0; i < arr.length; i ++ ) {
			var temp = arr[i].split( '|' ), proKey = temp[0], linkageKey = temp[1];
			
			if( !map[proKey] ) {
				map[ proKey ] = {};
			}
			
			//map[ proKey ][ linkageKey ] = pro[ proKey ][ linkageKey ].name;
			map[ proKey ][ linkageKey ] = linkageKey;
		}
		
		return map;
	}
	
	// Create the html
	//	mdata: matched data
	function setStyle( mdata, cur ) {
		
		var checkExsit = function( id, json ) {
			// 濡傛灉娌℃湁custom 鍒欓殣钘忕幇鏈夌殑鑷畾涔夊脊鍑烘
			// 鍚屾椂鍙湁鍦ㄩ€夋嫨color 鐨勬椂鍊欐墠杩涜璇ラ」鍖归厤
			if( $( '#' + id ).hasClass( 'skusize' ) ) {// 璇ュ厓绱犱负鑱斿姩鍏冪礌锛岃€岄潪褰撳墠鍏冪礌
				if( !json.custom ) {
					$( '#cussize_box' ).hide();
				} else {
					$( '#cussize_box' ).fadeIn();	
				}
			}
			
			var elem = document.getElementById( id );
			
			if( !elem || !elem.length ) return false;
			
			var optionElemList = elem.getElementsByTagName( 'option' );
			
			$( optionElemList ).each(function( i ) {
				if( i > 0 ) {
					var skey = $( this ).attr( 'sku:key' );
					
					// 娌℃湁鍖归厤鍒板緱鍏冪礌娣诲姞鏃犲簱瀛樻牱寮�
					if( !skey || !json[skey] ) {
						$( this ).addClass( 'no_stock'  );
						this._color = '#ccc';
					} else {
						$( this ).removeClass( 'no_stock'  );
						this._color = '#000';
					}
					
					if( skey === 'custom' ) {
						$( this ).hide();
					}
				}
			});
		};
		
		for( var key in mdata ) {
			checkExsit( 'sku_'+ key, mdata[key] );
			
			// 鏍规嵁搴撳瓨淇敼鑱斿姩鐨剆elect 鏂囨湰棰滆壊
			if( $( '#sku_'+ key ).find( 'option:selected' ).hasClass( 'no_stock' ) ) {
				$( '#sku_'+ key ).css( 'color', '#ccc' );
			} else {
				$( '#sku_'+ key ).css( 'color', '#000' );
			}
			$( '#sku_'+ key ).find( 'option' ).each(function( i ) {
				$( this ).css( 'color', this._color );
			});
			
		}
	}
	
	// 鑾峰彇select 琚€変腑鐨刼ption
	function getOption( selectElem ) {
		return $( selectElem ).find( 'option:selected' );
	}
		
};
	

})( jQuery );


(function( $ ){
/**
 * 鎶犳礊浜掓枼鍔熻兘
 *  
 */
$.fn.mutexids = function( json ) {
	if( json == "" || json === undefined ) {
		return;
	}
	
	var list = this;
	
	json = $.parseJSON( json );
	
	this.change(function() {
		
		matchArr( this, list, json );
	});
	
	// 鍖归厤瑕佺鐢ㄦ垨鑰呭惎鐢ㄧ殑鍏崇郴鏁扮粍
	function matchArr( target, list, json ) {
		
		var // 宸茬粡琚鐢ㄧ殑椤�
			disabledIds = [],
			
			id = $( target ).attr( "id" ), 
			// true 鍒欏尮閰嶈繘琛岀鐢ㄦ搷浣�
			is_checked = $( target ).is( ":checked" ),
			
			tempArr = id.split( "_" ), 
			
			key = tempArr[1];
		
		var disableArr = is_checked ? ( json[ key ] ? json[ key ] : [] ) : [];
		
		list.each(function() {
			if( $( this ).is( ":checked" ) ) {
				disabledIds.push( $( this ).attr( "id" ).split( "_" )[1] );
			}
		});
		
		for( var i = 0; i < disabledIds.length; i ++ ) {
			var tempArr = json[ disabledIds[i] ];
			$.merge( disableArr, tempArr ? tempArr : [] );
		}
		
		disableArr = $.unique( disableArr );
		
		// 绂佺敤 鎴栬€� 鍚敤
		if( disableArr && disableArr.length ) {
			list.removeAttr( "disabled" ).removeClass( "disabled" );
			list.parent().removeClass( "mutexids_disabled" );
			
			for( var i = 0; i < disableArr.length; i ++ ) {
				
				var item = $( "#mk_" + disableArr[i] );
				
				// 濡傛灉瀛樺湪鍖归厤鐨勫厓绱犲垯杩涜鐩稿叧鎿嶄綔
				if( item && item.length ) {
					
					// 绂佺敤
					item.attr( "disabled", "disabled" ).removeAttr( "checked" );
					item.parent().addClass( "mutexids_disabled" );
				}
				
			}
		} else {
			list.removeAttr( "disabled" ).removeClass( "disabled" );
			list.parent().removeClass( "mutexids_disabled" );
		}
	}
	
};
})( jQuery );