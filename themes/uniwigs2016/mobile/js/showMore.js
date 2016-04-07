;(function($){

$.fn.showMore = function( options ){
	this.each( function() {
		new showMore( this,options );
	});
};

var showMore = function( elem , opt ){
	this.elem=elem;
	this.opt={
		 items : ".justify_item"
	};
	$.extend(this.opt,opt);
	this.bind();
}

showMore.prototype = {
	bind:function(){
		var elem = $( this.elem ), _this = this;

		var _items = $( _this.opt.items );

		elem.bind( "click" , function(){
			if( _items.hasClass( "hide_1" ) ){
				_items.removeClass( "hide_1" );
				if($(".hide_2").length<=0){
					_this.hideBtn();
				}
				return;
			}else if( _items.hasClass( "hide_2" ) ){
				_items.removeClass( "hide_2" );
				_this.hideBtn();
			}else{
				_this.hideBtn();
			}
		
			
		});

	},
	hideBtn:function(){
		var elem = $( this.elem ), _this = this;
		elem.hide();
		$(".control_bar").show();
	}
}

})(jQuery);	