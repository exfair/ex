jQuery(window).scroll(function() {
	"use strict";
	
	//sticky
    if (jQuery(this).scrollTop() > 50){
		jQuery('header#theme-header').addClass('header-sticky');
    }
    else{
		jQuery('header#theme-header').removeClass('header-sticky');
    }
});

(function($){
    "use strict";
	
	var windowWidth = $(window).width();
	
	var loaded = false;
	
	//mobile
	function mobile_menu_offset( windowWidth ){
		if( windowWidth < 1024 ){
			
			var mobile_menu_offset = $("#theme-header").outerHeight(true) - 10;
			$("nav.nav").css("top", mobile_menu_offset + "px");
		}				
	}

	if( windowWidth < 1024 ){

		$("header#theme-header nav a").on('click', function(event){	
			var submenu = $(" > .sub-menu", $(this).parent() );		

			if( submenu.length ){

				event.preventDefault();	
					
				var this_opened_menu = $(this).closest(".menu > li");
				$("header#theme-header .menu > li").not(this_opened_menu).each(function(){
					$(".sub-menu" , this).removeClass("open-menu");
				});
					
				submenu.toggleClass("open-menu");
				$(" > svg",$(this)).toggleClass("rotate");
			}				
		});
	
	}
			
	$(".mobile-trigger").on( "click", function(event) {
		event.preventDefault();

		$(this).toggleClass( "is-active" );
		$("header#theme-header nav").toggleClass( "open" );			
		$(".searchform.active").removeClass("active");
		if( $(this).hasClass("is-active") ){
			$(".overlay").addClass( "visible" );
		}
		else{
			$(".overlay").removeClass( "visible" );
		}
		
	});	
		
	//menu search
	$(".search-trigger").on( "click", function() {
		event.preventDefault();
		$( "#searchform" ).addClass( "active" );
		$( ".overlay" ).addClass( "visible" );
		$( "header#theme-header .nav.open" ).removeClass( "open" );
		$(".mobile-trigger.is-active").removeClass( "is-active" );
	});
			
	function resize_tweaks( windowWidth ){
		
		if( windowWidth < 1024 ){
			//mobile menu
			$("header#theme-header nav").removeClass( "open" );				
			$("header#theme-header nav ul").removeClass( "open-menu" );				
			$("header#theme-header .menu svg").removeClass( "rotate" );	
			
			$(".mobile-trigger").removeClass( "is-active" );						
		}		
	}
	
	function close_overlay( windowWidth ){		
		//close overlay
		$(document).on("click", function (e) {
			if ( $(e.target).closest("#searchform").length === 0 && $(e.target).closest(".search-trigger").length === 0 && 
					$(e.target).closest(".mobile-trigger").length === 0 &&  $(e.target).closest("header#theme-header nav").length === 0 ){
				
				$(".overlay").removeClass("visible");
				$("#searchform").removeClass("active");
				
				if( windowWidth < 1024 ){
					//mobile menu
					$("header#theme-header nav").removeClass( "open" );				
					$("header#theme-header nav ul").removeClass( "open-menu" );				
					$(".mobile-trigger").removeClass( "is-active" );				
				}
			}			
		});					
	}
	
	mobile_menu_offset( windowWidth ); 	
	
	close_overlay( windowWidth );

	$(window).on('resize', function(){
		var windowWidth = $(window).width();
		resize_tweaks( windowWidth );
		close_overlay( windowWidth );
		mobile_menu_offset( windowWidth );
		
	});	
	
	
})(jQuery);


(function($){

	$( ".search-trigger" ).focusin(function() {
		$("#searchform").addClass("active");
		$( ".overlay" ).addClass( "visible" );
	});		
	
	$( '#search-form-holder input[type="submit"]' ).focusout(function() {
		$("#searchform").removeClass("active");
		$( ".overlay" ).removeClass( "visible" );
	});	


	$(document).on('keydown', function(event) {
       if (event.key == 'Escape') {
           $( '.overlay' ).removeClass( 'visible' );
		   $('nav#primary').removeClass('open');
		   $('.mobile-trigger').removeClass('is-active');
		   $('#searchform').removeClass('active');
       }
	});
   
})(jQuery);	


( function() {
    var fasto_nav, fasto_button, fasto_menu, fasto_menu_links, fasto_counter, fasto_menu_len;

    fasto_nav = document.getElementById( 'primary' );
    if ( ! fasto_nav ) {
        return;
    }

    fasto_button = fasto_nav.getElementsByTagName( 'button' )[0];
    if ( 'undefined' === typeof fasto_button ) {
        return;
    }

    fasto_menu = fasto_nav.getElementsByTagName( 'ul' )[0];

    // bail if no menu
    if ( 'undefined' === typeof fasto_menu ) {
        fasto_button.style.display = 'none';
        return;
    }

    fasto_menu.setAttribute( 'aria-expanded', 'false' );
    if ( -1 === fasto_menu.className.indexOf( 'nav-menu' ) ) {
        fasto_menu.className += ' nav-menu';
    }

    fasto_button.onclick = function() {
        if ( -1 !== fasto_nav.className.indexOf( 'toggled' ) ) {
            fasto_nav.className = fasto_nav.className.replace( ' toggled', '' );
            fasto_button.setAttribute( 'aria-expanded', 'false' );
            fasto_menu.setAttribute( 'aria-expanded', 'false' );
        } else {
            fasto_nav.className += ' toggled';
            fasto_button.setAttribute( 'aria-expanded', 'true' );
            fasto_menu.setAttribute( 'aria-expanded', 'true' );
        }
    };

    // Get all the links from menu
    fasto_menu_links    = fasto_menu.getElementsByTagName( 'a' );

    // Each time a menu link is focused or blurred, toggle focus.
    for ( fasto_counter = 0, fasto_menu_len = fasto_menu_links.length; fasto_counter < fasto_menu_len; fasto_counter++ ) {
        fasto_menu_links[fasto_counter].addEventListener( 'focus', fasto_toggleFocus, true );
        fasto_menu_links[fasto_counter].addEventListener( 'blur', fasto_toggleFocus, true );
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function fasto_toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

            // On li elements toggle the class .focus.
            if ( 'li' === self.tagName.toLowerCase() ) {
                if ( -1 !== self.className.indexOf( 'focus' ) ) {
                    self.className = self.className.replace( ' focus', '' );
                } else {
                    self.className += ' focus';
                }
            }

            self = self.parentElement;
        }
    }

    /**
     * Toggles `focus` class to allow submenu access on tablets.
     */
    ( function( fasto_nav ) {
        var touchStartFn, fasto_counter,
            parentLink = fasto_nav.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

        if ( 'ontouchstart' in window ) {
            touchStartFn = function( e ) {
                var menuItem = this.parentNode, fasto_counter;

                if ( ! menuItem.classList.contains( 'focus' ) ) {
                    e.preventDefault();
                    for ( fasto_counter = 0; fasto_counter < menuItem.parentNode.children.length; ++fasto_counter ) {
                        if ( menuItem === menuItem.parentNode.children[fasto_counter] ) {
                            continue;
                        }
                        menuItem.parentNode.children[fasto_counter].classList.remove( 'focus' );
                    }
                    menuItem.classList.add( 'focus' );
                } else {
                    menuItem.classList.remove( 'focus' );
                }
            };

            for ( fasto_counter = 0; fasto_counter < parentLink.length; ++fasto_counter ) {
                parentLink[fasto_counter].addEventListener( 'touchstart', touchStartFn, false );
            }
        }
    }( fasto_nav ) );
} )();

/**
  * Responsive menu
*/
jQuery(document).ready(function($) {

    $(".primary .menu").addClass("responsive-menu");

    $(window).resize(function(){
        if(window.innerWidth > 1024) {
            $(".primary .menu, nav .sub-menu, nav .children").removeAttr("style");
            $(".responsive-menu > li").removeClass("menu-open");
        }
    });

    $(".responsive-menu > li").click(function(event){
        if (event.target !== this)
        return;
        $(this).find(".sub-menu:first").toggleClass('submenu-toggle').parent().toggleClass("menu-open");
        $(this).find(".children:first").toggleClass('submenu-toggle').parent().toggleClass("menu-open");
    });

    $("div.responsive-menu > ul > li").click(function(event) {
        if (event.target !== this)
            return;
        $(this).find("ul:first").toggleClass('submenu-toggle').parent().toggleClass("menu-open");
    });

});