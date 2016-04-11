(function(a){function b(b,c){this.carouselRoot=a(b);var d=this;this._lockYAxis=false;this._isAnimating=false;this._downEvent="";this._moveEvent="";this._upEvent="";this._totalItemsWidth;this._itemWidths;this._startAccelerationX;this._accelerationX;this._latestDragX;this._startTime=0;this.settings=a.extend({},a.fn.touchCarousel.defaults,c);this._dragContainer=this.carouselRoot.find(".touchcarousel-container");this._windowWidth=a(window).width();this._dragContainerStyle=this._dragContainer[0].style;this._itemsWrapper=this._dragContainer.wrap(a('<div class="touchcarousel-wrapper" />')).parent();var e=this._dragContainer.find(".touchcarousel-item");this.items=[];this.numItems=e.length;this._decelerationAnim;this._successfullyDragged=false;this._startMouseX=0;this._prevMouseX=0;this._moveDist=0;this._blockClickEvents=false;this._wasBlocked=false;this.currentPosX=0;this._useWebkitTransition=false;if("ontouchstart"in window){this.hasTouch=true;this._downEvent="touchstart.rs";this._moveEvent="touchmove.rs";this._upEvent="touchend.rs";this._baseFriction=this.settings.baseTouchFriction}else{this.hasTouch=false;this._baseFriction=this.settings.baseMouseFriction;if(this.settings.dragUsingMouse){this._downEvent="mousedown.rs";this._moveEvent="mousemove.rs";this._upEvent="mouseup.rs";this._grabCursor;this._grabbingCursor;var f=a.browser;if(f.msie||f.opera){this._grabCursor=this._grabbingCursor="move"}else if(f.mozilla){this._grabCursor="-moz-grab";this._grabbingCursor="-moz-grabbing"}this._setGrabCursor()}else{this._itemsWrapper.addClass("auto-cursor")}}if(this.hasTouch||this.settings.useWebkit3d){if("WebKitCSSMatrix"in window&&"m11"in new WebKitCSSMatrix){this._dragContainer.css({"-webkit-transform-origin":"0 0","-webkit-transform":"translateZ(0)"});this._useWebkitTransition=true}}if(this._useWebkitTransition){this._xProp="-webkit-transform";this._xPref="translate3d(";this._xSuf="px, 0, 0)"}else{this._xProp="left";this._xPref="";this._xSuf="px"}if(this.hasTouch){this.settings.directionNavAutoHide=false}if(!this.settings.directionNav){if(this.settings.loopItems){this._arrowLeftBlocked=true;this._arrowRightBlocked=true}else{this._arrowLeftBlocked=false;this._arrowRightBlocked=false}this.settings.loopItems=true}var g,h,i,j,k=0;e.eq(this.numItems-1).addClass("last");e.each(function(b){h=a(this);if(d.settings.itemLikeWindowWidth)h.css("width",d._windowWidth);g={};g.item=h;g.index=b;g.posX=k;g.width=h.outerWidth(true)||d.settings.itemFallbackWidth;k+=g.width;if(!this.hasTouch){h.find("a").bind("click.touchcarousel",function(a){if(d._successfullyDragged){a.preventDefault();return false}})}else{var c=h.find("a");var e;c.each(function(){e=a(this);e.data("tc-href",e.attr("href"));e.data("tc-target",e.attr("target"));e.attr("href","#");e.bind("click",function(b){b.preventDefault();if(d._successfullyDragged){return false}else{var c=a(this).data("tc-href");var e=a(this).data("tc-target");if(!e||e.toLowerCase()==="_self"){window.location.href=c}else{window.open(c)}}})})}h.find(".non-draggable").bind(d._downEvent,function(a){d._successfullyDragged=false;a.stopImmediatePropagation()});d.items.push(g)});this._maxXPos=this._totalItemsWidth=k;if(this.settings.itemsPerMove>0){this._itemsPerMove=this.settings.itemsPerMove}else{this._itemsPerMove=1}if(this.settings.pagingNav){this.settings.snapToItems=true;this._pagingEnabled=true;this._numPages=Math.ceil(this.numItems/this._itemsPerMove);this._currPageId=0;if(this.settings.pagingNavControls){this._pagingNavContainer=a('<div class="tc-paging-container"><div class="tc-paging-centerer"><div class="tc-paging-centerer-inside"></div></div></div>');var l=this._pagingNavContainer.find(".tc-paging-centerer-inside");var m;for(var n=1;n<=this._numPages;n++){m=a('<a class="tc-paging-item" href="#">'+n+"</a>").data("tc-id",n);if(n===this._currPageId+1){m.addClass("current")}l.append(m)}this._pagingItems=l.find(".tc-paging-item").click(function(b){b.preventDefault();d.goTo((a(b.currentTarget).data("tc-id")-1)*d._itemsPerMove)});this._itemsWrapper.after(this._pagingNavContainer)}}else{this._pagingEnabled=false}this._dragContainer.css({width:k});if(this.settings.directionNav){this._itemsWrapper.after("<a href='#' class='arrow-holder left'><span class='arrow-icon left'></span></a> <a href='#' class='arrow-holder right'><span class='arrow-icon right'></span></a>");this.arrowLeft=this.carouselRoot.find(".arrow-holder.left");this.arrowRight=this.carouselRoot.find(".arrow-holder.right");if(this.arrowLeft.length<1||this.arrowRight.length<1){this.settings.directionNav=false}else if(this.settings.directionNavAutoHide){this.arrowLeft.hide();this.arrowRight.hide();this.carouselRoot.one("mousemove.arrowshover",function(){d.arrowLeft.fadeIn("fast");d.arrowRight.fadeIn("fast")});this.carouselRoot.hover(function(){d.arrowLeft.fadeIn("fast");d.arrowRight.fadeIn("fast")},function(){d.arrowLeft.fadeOut("fast");d.arrowRight.fadeOut("fast")})}this._updateDirectionNav(0);if(this.settings.directionNav){this.arrowRight.click(function(a){a.preventDefault();if(d.settings.loopItems&&!d._blockClickEvents||!d._arrowRightBlocked)d.next()});this.arrowLeft.click(function(a){a.preventDefault();if(d.settings.loopItems&&!d._blockClickEvents||!d._arrowLeftBlocked)d.prev()})}}this.carouselWidth;this._resizeEvent="resize";var o;a(window).bind(this._resizeEvent,function(){d.updateCarouselSize(true)});if(this.settings.scrollbar){this._scrollbarHolder=a("<div class='scrollbar-holder'><div class='scrollbar"+(this.settings.scrollbarTheme.toLowerCase()==="light"?" light":" dark")+"'></div></div>");this._scrollbarHolder.appendTo(this.carouselRoot);this.scrollbarJQ=this._scrollbarHolder.find(".scrollbar");this._scrollbarHideTimeout="";this._scrollbarStyle=this.scrollbarJQ[0].style;this._scrollbarDist=0;if(this.settings.scrollbarAutoHide){this._scrollbarVisible=false;this.scrollbarJQ.css("opacity",0)}else{this._scrollbarVisible=true}}else{this.settings.scrollbarAutoHide=false}this.updateCarouselSize(true);this._itemsWrapper.bind(this._downEvent,function(a){d._onDragStart(a)});if(this.settings.autoplay&&this.settings.autoplayDelay>0){this._isHovering=false;this.autoplayTimer="";this.wasAutoplayRunning=true;if(!this.hasTouch){this.carouselRoot.hover(function(){d._isHovering=true;d._stopAutoplay()},function(){d._isHovering=false;d._resumeAutoplay()})}this.autoplay=true;this._releaseAutoplay()}else{this.autoplay=false}if(this.settings.keyboardNav){a(document).bind("keydown.touchcarousel",function(a){if(!d._blockClickEvents){if(a.keyCode===37){d.prev()}else if(a.keyCode===39){d.next()}}})}this.carouselRoot.css("overflow","visible")}b.prototype={goTo:function(a,b){var c=this.items[a];if(c){if(!b&&this.autoplay&&this.settings.autoplayStopAtAction){this.stopAutoplay()}this._updatePagingNav(a);this.endPos=this._getXPos();var d=-c.posX;if(d>0){d=0}else if(d<this.carouselWidth-this._maxXPos){d=this.carouselWidth-this._maxXPos}this.animateTo(d,this.settings.transitionSpeed,"easeInOutSine")}},next:function(a){var b=this._getXPos();var c=this._getItemAtPos(b).index;if(!this._pagingEnabled){c=c+this._itemsPerMove;if(this.settings.loopItems){if(b<=this.carouselWidth-this._maxXPos){c=0}}if(c>this.numItems-1){c=this.numItems-1}}else{var d=this._currPageId+1;if(d>this._numPages-1){if(this.settings.loopItems){c=0}else{c=(this._numPages-1)*this._itemsPerMove}}else{c=d*this._itemsPerMove}}this.goTo(c,a)},prev:function(a){var b=this._getXPos();var c=this._getItemAtPos(b).index;if(!this._pagingEnabled){c=c-this._itemsPerMove;if(c<0){if(this.settings.loopItems){if(b<0){c=0}else{c=this.numItems-1}}else{c=0}}}else{var d=this._currPageId-1;if(d<0){if(this.settings.loopItems){c=(this._numPages-1)*this._itemsPerMove}else{c=0}}else{c=d*this._itemsPerMove}}this.goTo(c,a)},getCurrentId:function(){var a=this._getItemAtPos(this._getXPos()).index;return a},setXPos:function(a,b){this.currentPosX=a;if(!b){this._dragContainerStyle[this._xProp]=this._xPref+a+this._xSuf}else{this._scrollbarStyle[this._xProp]=this._xPref+a+this._xSuf}},stopAutoplay:function(){this._stopAutoplay();this.autoplay=false;this.wasAutoplayRunning=false},resumeAutoplay:function(){this.autoplay=true;if(!this.wasAutoplayRunning){this._resumeAutoplay()}},updateCarouselSize:function(b){var c=this;var d=this._getItemAtPos(this.currentPosX).index;this.carouselWidth=this.carouselRoot.width();this._windowWidth=a(window).width();var e=0;for(k=0;k<this.items.length;k++){if(this.settings.itemLikeWindowWidth)this.items[k].item.css("width",this._windowWidth);this.items[k].posX=e;this.items[k].width=this.items[k].item.outerWidth(true)||this.settings.itemFallbackWidth;e+=this.items[k].width}this._maxXPos=this._totalItemsWidth=e;this._dragContainer.css({width:e});if(this.settings.scrollToLast){var f=0;if(this._pagingEnabled){var g=this.numItems%this._itemsPerMove;if(g>0){for(var h=this.numItems-g;h<this.numItems;h++){f+=this.items[h].width}}else{f=this.carouselWidth}}else{f=this.items[this.numItems-1].width}this._maxXPos=this._totalItemsWidth+this.carouselWidth-f}else{this._maxXPos=this._totalItemsWidth}if(this.settings.scrollbar){var i=Math.round(this._scrollbarHolder.width()/(this._maxXPos/this.carouselWidth));this.scrollbarJQ.css("width",i);this._scrollbarDist=this._scrollbarHolder.width()-i}if(!this.settings.scrollToLast){if(this.carouselWidth>=this._totalItemsWidth){this._wasBlocked=true;if(!this.settings.loopItems){this._arrowRightBlocked=true;this.arrowRight.addClass("disabled");this._arrowLeftBlocked=true;this.arrowLeft.addClass("disabled")}this.setXPos(0);return}else if(this._wasBlocked){this._wasBlocked=false;this._arrowRightBlocked=false;this._arrowLeftBlocked=false;this.arrowRight.removeClass("disabled");this.arrowLeft.removeClass("disabled")}}if(!b){var j=this.endPos=this._getXPos();if(j>0){j=0}else if(j<this.carouselWidth-this._maxXPos){j=this.carouselWidth-this._maxXPos}this.animateTo(j,300,"easeInOutSine")}else{this.goTo(d)}},animateTo:function(b,c,d,e,f,g,h){function t(){i._isAnimating=false;i._releaseAutoplay();if(i.settings.scrollbarAutoHide){i._hideScrollbar()}if(i.settings.onAnimComplete!==null){i.settings.onAnimComplete.call(i)}}this.currentPosX=b;if(this.settings.onAnimStart!==null){this.settings.onAnimStart.call(this)}if(this.autoplay&&this.autoplayTimer){this.wasAutoplayRunning=true;this._stopAutoplay()}this._stopAnimation();var i=this;var j=this.settings.scrollbar,k=i._xProp,l=i._xPref,m=i._xSuf,n={containerPos:this.endPos},o={containerPos:b},p={containerPos:f},f=e?f:b,q=i._dragContainerStyle;i._isAnimating=true;if(j){var r=this._scrollbarStyle;var s=i._maxXPos-i.carouselWidth;if(this.settings.scrollbarAutoHide){if(!this._scrollbarVisible){this._showScrollbar()}}}this._updateDirectionNav(f);this._decelerationAnim=a(n).animate(o,{duration:c,easing:d,step:function(){if(j){r[k]=l+Math.round(i._scrollbarDist*(-this.containerPos/s))+m}q[k]=l+Math.round(this.containerPos)+m},complete:function(){if(e){i._decelerationAnim=a(o).animate(p,{duration:g,easing:h,step:function(){if(j){r[k]=l+Math.round(i._scrollbarDist*(-this.containerPos/s))+m}q[k]=l+Math.round(this.containerPos)+m},complete:function(){if(j){r[k]=l+Math.round(i._scrollbarDist*(-p.containerPos/s))+m}q[k]=l+Math.round(p.containerPos)+m;t()}})}else{if(j){r[k]=l+Math.round(i._scrollbarDist*(-o.containerPos/s))+m}q[k]=l+Math.round(o.containerPos)+m;t()}}})},destroy:function(){this.stopAutoplay();this._itemsWrapper.unbind(this._downEvent);a(document).unbind(this._moveEvent).unbind(this._upEvent);a(window).unbind(this._resizeEvent);if(this.settings.keyboardNav){a(document).unbind("keydown.touchcarousel")}this.carouselRoot.remove()},_updatePagingNav:function(a){if(this._pagingEnabled){var b=this._getPageIdFromItemId(a);this._currPageId=b;if(this.settings.pagingNavControls){this._pagingItems.removeClass("current");this._pagingItems.eq(b).addClass("current")}}},_getPageIdFromItemId:function(a){var b=this._itemsPerMove;for(var c=0;c<this._numPages;c++){if(a>=c*b&&a<c*b+b){return c}}if(a<0){return 0}else if(a>=this._numPages){return this._numPages-1}return false},_enableArrows:function(){if(!this.settings.loopItems){if(this._arrowLeftBlocked){this._arrowLeftBlocked=false;this.arrowLeft.removeClass("disabled")}else if(this._arrowRightBlocked){this._arrowRightBlocked=false;this.arrowRight.removeClass("disabled")}}},_disableLeftArrow:function(){if(!this._arrowLeftBlocked&&!this.settings.loopItems){this._arrowLeftBlocked=true;this.arrowLeft.addClass("disabled");if(this._arrowRightBlocked){this._arrowRightBlocked=false;this.arrowRight.removeClass("disabled")}}},_disableRightArrow:function(){if(!this._arrowRightBlocked&&!this.settings.loopItems){this._arrowRightBlocked=true;this.arrowRight.addClass("disabled");if(this._arrowLeftBlocked){this._arrowLeftBlocked=false;this.arrowLeft.removeClass("disabled")}}},_getItemAtPos:function(a){var b=this;a=-a;var c;for(var d=0;d<b.numItems;d++){c=b.items[d];if(a>=c.posX&&a<c.posX+c.width){return c}}return-1},_releaseAutoplay:function(){if(this.autoplay){if(this.wasAutoplayRunning){if(!this._isHovering){this._resumeAutoplay()}this.wasAutoplayRunning=false}}},_hideScrollbar:function(){var a=this;this._scrollbarVisible=false;if(this._scrollbarHideTimeout){clearTimeout(this._scrollbarHideTimeout)}this._scrollbarHideTimeout=setTimeout(function(){a.scrollbarJQ.animate({opacity:0},150,"linear")},450)},_showScrollbar:function(){this._scrollbarVisible=true;if(this._scrollbarHideTimeout){clearTimeout(this._scrollbarHideTimeout)}this.scrollbarJQ.stop().animate({opacity:1},150,"linear")},_stopAnimation:function(){if(this._decelerationAnim){this._decelerationAnim.stop()}},_resumeAutoplay:function(){if(this.autoplay){var a=this;if(!this.autoplayTimer){this.autoplayTimer=setInterval(function(){if(!a._isDragging&&!a._isAnimating){a.next(true)}},this.settings.autoplayDelay)}}},_stopAutoplay:function(){if(this.autoplayTimer){clearInterval(this.autoplayTimer);this.autoplayTimer=""}},_getXPos:function(a){var b=!a?this._dragContainer:this.scrollbarJQ;if(!this._useWebkitTransition){return Math.round(b.position().left)}else{var c=b.css("-webkit-transform");var d=c.replace(/^matrix\(/i,"").split(/, |\)$/g);return parseInt(d[4],10)}},_onDragStart:function(b){if(!this._isDragging){if(this.autoplay&&this.settings.autoplayStopAtAction){this.stopAutoplay()}this._stopAnimation();if(this.settings.scrollbarAutoHide){this._showScrollbar()}var c;if(this.hasTouch){this._lockYAxis=false;var d=b.originalEvent.touches;if(d&&d.length>0){c=d[0]}else{return false}}else{c=b;b.preventDefault()}this._setGrabbingCursor();this._isDragging=true;var e=this;if(this._useWebkitTransition){e._dragContainer.css({"-webkit-transition-duration":"0","-webkit-transition-property":"none"})}a(document).bind(this._moveEvent,function(a){e._onDragMove(a)});a(document).bind(this._upEvent,function(a){e._onDragRelease(a)});this._startPos=this._getXPos();this._accelerationX=c.clientX;this._successfullyDragged=false;this._startTime=b.timeStamp||Date.now();this._moveDist=0;this._prevMouseX=this._startMouseX=c.clientX;this._startMouseY=c.clientY}},_onDragMove:function(a){var b=a.timeStamp||Date.now();var c;if(this.hasTouch){if(this._lockYAxis){return false}var d=a.originalEvent.touches;if(d.length>1){return false}c=d[0];if(Math.abs(c.clientY-this._startMouseY)>Math.abs(c.clientX-this._startMouseX)+3){if(this.settings.lockAxis){this._lockYAxis=true}return false}a.preventDefault()}else{c=a;a.preventDefault()}this._latestDragX=c.clientX;this._lastDragPosition=this._currentDragPosition;var e=c.clientX-this._prevMouseX;if(this._lastDragPosition!=e){this._currentDragPosition=e}if(e!=0){var f=this._startPos+this._moveDist;if(f>=0){e=e/4;this._disableLeftArrow()}else if(f<=this.carouselWidth-this._maxXPos){this._disableRightArrow();e=e/4}else{this._enableArrows()}this._moveDist+=e;this.setXPos(f);if(this.settings.scrollbar){this.setXPos(this._scrollbarDist*(-f/(this._maxXPos-this.carouselWidth)),true)}}this._prevMouseX=c.clientX;if(b-this._startTime>350){this._startTime=b;this._accelerationX=c.clientX}if(this.settings.onDragStart!==null){this.settings.onDragStart.call(this)}return false},_onDragRelease:function(b){if(this._isDragging){var c=this;this._isDragging=false;this._setGrabCursor();this.endPos=this._getXPos();this.isdrag=false;a(document).unbind(this._moveEvent).unbind(this._upEvent);if(this.endPos==this._startPos){this._successfullyDragged=false;if(this.settings.scrollbarAutoHide){this._hideScrollbar()}return}else{this._successfullyDragged=true}var d=this._latestDragX-this._accelerationX;var e=Math.max(40,(b.timeStamp||Date.now())-this._startTime);var f=.5,g=2,h=Math.abs(d)/e;function i(a){if(a>0){a=0}else if(a<c.carouselWidth-c._maxXPos){a=c.carouselWidth-c._maxXPos}return a}if(!this.settings.snapToItems){var j=0;if(h<=2){f=this._baseFriction*3.5;j=0}else if(h>2&&h<=3){f=this._baseFriction*4;j=200}else if(h>3){j=300;if(h>4){h=4;j=400;f=this._baseFriction*6}f=this._baseFriction*5}var k=h*h*g/(2*f);k=k*(d<0?-1:1);var l=h*g/f+j;if(this.endPos+k>0){if(this.endPos>0){this.animateTo(0,800,"easeOutCubic")}else{this.animateTo(this.carouselWidth/10*((j+200)/1e3),Math.abs(this.endPos)*1.1/h,"easeOutSine",true,0,400,"easeOutCubic")}}else if(this.endPos+k<this.carouselWidth-this._maxXPos){if(this.endPos<this.carouselWidth-this._maxXPos){this.animateTo(this.carouselWidth-this._maxXPos,800,"easeOutCubic")}else{this.animateTo(this.carouselWidth-this._maxXPos-this.carouselWidth/10*((j+200)/1e3),Math.abs(this.carouselWidth-this._maxXPos-this.endPos)*1.1/h,"easeOutSine",true,this.carouselWidth-this._maxXPos,400,"easeOutCubic")}}else{this.animateTo(this.endPos+k,l,"easeOutCubic")}}else{if(this.autoplay&&this.settings.autoplayStopAtAction){this.stopAutoplay()}var m=Boolean(this._startMouseX-this._prevMouseX>0);var n=i(this._getXPos());var o=this._getItemAtPos(n).index;if(!this._pagingEnabled){o=o+(m?this._itemsPerMove:-this._itemsPerMove+1)}else{if(m){n=Math.max(n-this.carouselWidth-1,1-c._maxXPos);o=this._getItemAtPos(n).index;if(o===undefined){o=this.numItems-1}}var p=this._getPageIdFromItemId(o);o=p*this._itemsPerMove}if(m){o=Math.min(o,this.numItems-1)}else{o=Math.max(o,0)}var q=this.items[o];this._updatePagingNav(o);if(q){n=i(-q.posX);var r=Math.abs(this.endPos-n);var s=Math.max(r*1.08/h,150);var t=Boolean(s<180);var u=r*.08;if(m){u=u*-1}this.animateTo(t?n+u:n,Math.min(s,400),"easeOutSine",t,n,300,"easeOutCubic")}}if(this.settings.onDragRelease!==null){this.settings.onDragRelease.call(this)}}return false},_updateDirectionNav:function(a){if(a===undefined){a=this._getXPos()}if(!this.settings.loopItems){if(a>=0){this._disableLeftArrow()}else if(a<=this.carouselWidth-this._maxXPos){this._disableRightArrow()}else{this._enableArrows()}}},_setGrabCursor:function(){if(this._grabCursor){this._itemsWrapper.css("cursor",this._grabCursor)}else{this._itemsWrapper.removeClass("grabbing-cursor");this._itemsWrapper.addClass("grab-cursor")}},_setGrabbingCursor:function(){if(this._grabbingCursor){this._itemsWrapper.css("cursor",this._grabbingCursor)}else{this._itemsWrapper.removeClass("grab-cursor");this._itemsWrapper.addClass("grabbing-cursor")}}};a.fn.touchCarousel=function(c){return this.each(function(){var d=new b(a(this),c);a(this).data("touchCarousel",d)})};a.fn.touchCarousel.defaults={itemsPerMove:1,snapToItems:false,pagingNav:false,pagingNavControls:true,autoplay:false,autoplayDelay:3e3,autoplayStopAtAction:true,scrollbar:true,scrollbarAutoHide:false,scrollbarTheme:"dark",transitionSpeed:600,directionNav:true,directionNavAutoHide:false,loopItems:false,keyboardNav:false,dragUsingMouse:true,itemLikeWindowWidth:false,scrollToLast:false,itemFallbackWidth:500,baseMouseFriction:.0012,baseTouchFriction:8e-4,lockAxis:true,useWebkit3d:false,onAnimStart:null,onAnimComplete:null,onDragStart:null,onDragRelease:null};a.fn.touchCarousel.settings={};a.extend(jQuery.easing,{easeInOutSine:function(a,b,c,d,e){return-d/2*(Math.cos(Math.PI*b/e)-1)+c},easeOutSine:function(a,b,c,d,e){return d*Math.sin(b/e*(Math.PI/2))+c},easeOutCubic:function(a,b,c,d,e){return d*((b=b/e-1)*b*b+1)+c}})})(jQuery);