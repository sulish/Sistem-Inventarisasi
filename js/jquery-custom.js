jQuery(document).ready(function(){
		// on load parallax element
		jQuery('.parallax').attr('data-stellar-background-ratio','0.5');
		jQuery.stellar({
					horizontalScrolling: false,
					verticalOffset: 40
		});
		jQuery('#navbar .mobile-nav').on('click',function(){
				jQuery('.vbody').toggleClass('onswipe');
				return false;
		});
		jQuery(window).resize(function(){
			if(jQuery(this).width() > 1100){
				jQuery('.vbody').removeClass('onswipe');
			}
		});
		if(jQuery('.slider').length){
			jQuery('.slider').children('.list-slider').carouFredSel({
					auto :true,
					responsive	:true,
					width: '100%',
					height:500,
					items: {
						visible: 1,
						start: 0
						
					},
					scroll: {
						items: 1,
						duration: 3000,
						timeoutDuration: 3000,
						fx:'fade'
						
					},
					prev        : {
					button  : function(){
								return jQuery(this).parent().next().find(".prev");
							},
						key     : "left"
					},
					next        : {
						button  : function(){
									return jQuery(this).parent().next().find(".next");
								},
						key     : "right"
					}
			});
			
			
		}
		jQuery(window).load(function(){
		// vpt-image 
		if ( jQuery('.animate-block.animate').length ) {
			jQuery.fn.animateImage = function(){
				var obj = jQuery(this);
				if ( obj.isOnScreen() ) {
					obj.removeClass('animate from-left from-bottom from-right');
					obj.addClass('no-tranform');
				}
			}

			jQuery('.animate-block.animate').each(function(){

				var img = jQuery(this);
				img.animateImage();
				jQuery(window).scroll(function(){
					img.animateImage();
				});
			});
		}
		});
			/* isOnScreen function */
		jQuery.fn.isOnScreen = function(){
		
			var win = jQuery(window);
			
			var viewport = {
				top : win.scrollTop() - 10,
				left : win.scrollLeft()
			};
			viewport.right = viewport.left + win.width();
			viewport.bottom = viewport.top + win.height();
			
			var bounds = this.offset();
			bounds.right = bounds.left + this.outerWidth();
			bounds.bottom = bounds.top + this.outerHeight();
			
			return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
		};
		var cbpAnimatedHeader = (function() {

			var docElem = document.documentElement,
			header = document.querySelector( '#header' ),
			didScroll = false,
			changeHeaderOn = 10;
			function init() {
				window.addEventListener( 'scroll', function( event ) {
					if( !didScroll ) {
						didScroll = true;
						setTimeout( scrollPage, 2 );
					}
				}, false );
			}

			function scrollPage() {
				var sy = scrollY();

				if ( sy >= changeHeaderOn ) {
					classie.add( header, 'on-scroll' );

				} else {
					classie.remove( header, 'on-scroll' );
				}

				didScroll = false;
			}
			
			function scrollY() {
				return window.pageYOffset || docElem.scrollTop;
			}
			init();
		})();

});

/* External Library */

/*!
 * classie - class helper functions
 * from bonzo https://github.com/ded/bonzo
 * 
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */

/*jshint browser: true, strict: true, undef: true */
/*global define: false */

( function( window ) {

	'use strict';

	// class helper functions from bonzo https://github.com/ded/bonzo

	function classReg( className ) {
		return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
	}

	// classList support for class management
	// altho to be fair, the api sucks because it won't accept multiple classes at once
	var hasClass, addClass, removeClass;

	if ( 'classList' in document.documentElement ) {
		hasClass = function( elem, c ) {
			return elem.classList.contains( c );
		};
			addClass = function( elem, c ) {
			elem.classList.add( c );
		};
		removeClass = function( elem, c ) {
			elem.classList.remove( c );
		};
	}
	else {
		hasClass = function( elem, c ) {
			return classReg( c ).test( elem.className );
		};
		addClass = function( elem, c ) {
			if ( !hasClass( elem, c ) ) {
				elem.className = elem.className + ' ' + c;
			}
		};
		removeClass = function( elem, c ) {
			elem.className = elem.className.replace( classReg( c ), ' ' );
		};
	}

	function toggleClass( elem, c ) {
		var fn = hasClass( elem, c ) ? removeClass : addClass;
		fn( elem, c );
	}

	var classie = {
		// full names
		hasClass: hasClass,
		addClass: addClass,
		removeClass: removeClass,
		toggleClass: toggleClass,
		// short names
		has: hasClass,
		add: addClass,
		remove: removeClass,
		toggle: toggleClass
	};

	// transport
	if ( typeof define === 'function' && define.amd ) {
		// AMD
		define( classie );
	} else {
		// browser global
		window.classie = classie;
	}

	var docElem = window.document.documentElement;

  function getViewportH() {
    var client = docElem['clientHeight'],
    inner = window['innerHeight'];
    
    if( client < inner )
      return inner;
    else
      return client;
  }

  function scrollY() {
    return window.pageYOffset || docElem.scrollTop;
  }

  // http://stackoverflow.com/a/5598797/989439
  function getOffset( el ) {
    var offsetTop = 0, offsetLeft = 0;
    do {
      if ( !isNaN( el.offsetTop ) ) {
        offsetTop += el.offsetTop;
      }
      if ( !isNaN( el.offsetLeft ) ) {
        offsetLeft += el.offsetLeft;
      }
    } while( el = el.offsetParent )

    return {
      top : offsetTop,
      left : offsetLeft
    }
  }

  function inViewport( el, h ) {
    var elH = el.offsetHeight,
    scrolled = scrollY(),
    viewed = scrolled + getViewportH(),
    elTop = getOffset(el).top,
    elBottom = elTop + elH,
      // if 0, the element is considered in the viewport as soon as it enters.
      // if 1, the element is considered in the viewport only when it's fully inside
      // value in percentage (1 >= h >= 0)
      h = h || 0;

      return (elTop + elH * h) <= viewed && (elBottom) >= scrolled;
    }

    function extend( a, b ) {
      for( var key in b ) { 
        if( b.hasOwnProperty( key ) ) {
          a[key] = b[key];
        }
      }
      return a;
    }

    function cbpScroller( el, options ) { 
      this.el = el;
      this.options = extend( this.defaults, options );
      this._init();
    }

    cbpScroller.prototype = {
      defaults : {
      // The viewportFactor defines how much of the appearing item has to be visible in order to trigger the animation
      // if we'd use a value of 0, this would mean that it would add the animation class as soon as the item is in the viewport. 
      // If we were to use the value of 1, the animation would only be triggered when we see all of the item in the viewport (100% of it)
      viewportFactor : 0.2
    },
    _init : function() {
      if( Modernizr.touch ) return;
      //console.log(this.el);
      this.sections = Array.prototype.slice.call( this.el.querySelectorAll( '.animate-block' ) );
      this.didScroll = false;

      var self = this;
      // the sections already shown...
      this.sections.forEach( function( el, i ) {
        if( !inViewport( el ) ) {
          classie.add( el, 'animate-block' );
        }
      } );

      var scrollHandler = function() {
        if( !self.didScroll ) {
          self.didScroll = true;
          setTimeout( function() { self._scrollPage(); }, 60 );
        }
      },
      resizeHandler = function() {
        function delayed() {
          self._scrollPage();
          self.resizeTimeout = null;
        }
        if ( self.resizeTimeout ) {
          clearTimeout( self.resizeTimeout );
        }
        self.resizeTimeout = setTimeout( delayed, 200 );
      };

      window.addEventListener( 'scroll', scrollHandler, false );
      window.addEventListener( 'resize', resizeHandler, false );
    },
    _scrollPage : function() {
      var self = this;

      this.sections.forEach( function( el, i ) {
        if( inViewport( el, self.options.viewportFactor ) ) {
          classie.add( el, 'animate-block' );
        }
        else {
          // this add class init if it doesn't have it. This will ensure that the items initially in the viewport will also animate on scroll
          // classie.add( el, 'col-state' );
          
          // classie.remove( el, 'col-animate' );
        }
      });
      this.didScroll = false;
    }
  }

  // add to global namespace
  window.cbpScroller = cbpScroller;

})( window );

new cbpScroller( document.getElementsByClassName( 'vbody' )[0] );