
	
var smt = $( 'button[type=submit]' );

var elems = {
	
	data: {
		insur	: $( '#insurance' ),
		ship	: $( '#logistics_key' ),
		sub		: $( '#s_subtotal' ),
		pay		: $( '#worldPay_country' ),
		pmethod	: $( '#paymethod' )
	},
	
	view: {
		posttime	: $( '#posttime' ),
		tips		: $( '#shipping_tips' ),
		s_type		: $( '#s_ship_type' ),
		s_price		: $( '.s_ship_price' ),
		off			: $( '.s_ship_off' ),
		s_old_price	: $( '.s_ship_old_price' ),
		total_view	: $( '#s_subtotal_view' ),
		total_price	: $( '#s_ship_total_price' )
	}
};


var _o_ = elems.data.ship.find( 'option:selected' );

if( _o_.attr( 'price' ) == 0 ) {
	$( '.free_layout' ).show();
	$( '.unfree_layout' ).hide();
} else {
	$( '.unfree_layout' ).show();
	$( '.free_layout' ).hide();
}

var pay_json = {};

if( payJson ) {
	pay_json = $.parseJSON( payJson );
}

function findArrayObject( key ) {
	
	for( var i = 0; i < pay_json.length; i ++ ) {
		var data = pay_json[i];
		
		if( data.key == key ) {
			return data;
		}
	}
	
	return null;
}

function checkPayTypeSelect() {
	var sm = price.shipMethod(), total = base.math.float( sm.new + price.subtotal() - price.free() );
	
	
	elems.data.pmethod.find( 'option' ).each(function() {
		
		var key = $( this ).val(), data = findArrayObject( key );
		
		
		if( data !== null ) {
			
			if( parseInt( data.amount ) > 0 ) {
				if( total > parseInt( data.amount ) ) {
					$( this ).hide();
				} else {
					$( this ).show();
				}
			}
		}
	});
}


var price = {
	
	shipMethod: function() {
		
		var opt = elems.data.ship.find( 'option:selected' ), cked = elems.data.insur.is( ':checked' );
		
		if( !elems.data.insur.length ) {
			var new_p = 0;
			
			if( elems.data.ship.is( 'input' ) ) {
				new_p = elems.data.ship.attr( 'price' );
			} else {
				new_p = opt.attr( 'insurance_pricetotal' )
			}
		
			return {
				editLocked: true,
				new: base.math.float( new_p )
			};
		}
		
		var new_price = base.math.float( opt.attr( cked ? 'insurance_pricetotal' : 'price' ) );

		// 保险勾选，一律隐藏free 的提示
		if( cked ) {
			
			if( opt.attr( 'price' ) == 0 ) {
				$( '.free_layout' ).show();
				$( '.unfree_layout' ).hide();

				$( '.price_info' ).find( '.free_layout' ).hide();
				$( '.price_info' ).find( '.unfree_layout' ).show();
			} else {
				$( '.free_layout' ).hide();
				$( '.unfree_layout' ).show();
			}
		} else {

			// 被选的有free 标示

			if( opt.attr( 'price' ) == 0 ) {
				// $( '.price_info' ).find( '.free_layout' ).show();
				$( '.free_layout' ).show();
				$( '.unfree_layout' ).hide();
			} else {
				// $( '.price_info' ).find( '.free_layout' ).hide();
				$( '.free_layout' ).hide();
				$( '.unfree_layout' ).show();
			}
		}

		// if( opt.attr( 'price' ) == 0 ) {
		// 	//new_price = 0;
		// 	$( '.free_layout' ).show();
		// 	$( '.unfree_layout' ).hide();
		// } else {
		// 	$( '.unfree_layout' ).show();
		//