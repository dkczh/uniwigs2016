;(function($){

	$.fn.menuTree = function( options ){
		this.each( function() {
			new menuTree( this,options );
		});
	};

	var menuTree = function( elem , opt ){
		this.elem=elem;
		this.opt={
			currentClass : "opened"
		};
		$.extend(this.opt,opt);
		this.bind();
	}

	menuTree.prototype = {
		bind:function(){
			var elem = $( this.elem ), _this = this;
			var classname = _this.opt.currentClass;
			elem.bind( "click" , function(){
				if( $( this ).hasClass( classname ) ){
					$( this ).removeClass( classname );
					$( this ).find("span.menujt").removeClass( "icon-arrow-up3" );
					$( this ).find("span.menujt").addClass( "icon-arrow-down3" );
					$( this ).next("ol").css({"display":"none"});
				}else{
					$( this ).addClass( classname );
					$( this ).find("span.menujt").removeClass( "icon-arrow-down3" );
					$( this ).find("span.menujt").addClass( "icon-arrow-up3" );
					$( this ).next("ol").css({"display":"block"});
				}
			});

		}
	}


})(jQuery);