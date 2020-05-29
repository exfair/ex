function get_sticky_header(){

    if ( jQuery(window).scrollTop() > 50 ) {
        jQuery('nav.navbar-default').addClass('sticky');
    } 
    else {
        jQuery('nav.navbar-default').removeClass('sticky');
    }

}

(function($){ 

	"use strict";

    var $window = $(window);
    $window.on( 'load', function () {
        
        $("#status").fadeOut();
        $("#preloader").delay(350).fadeOut("slow");
        $("body").delay(350).css({ "overflow": "visible" });

        /* Preloader */
        
        $("#status").fadeOut();
        $("#preloader").delay(350).fadeOut("slow");

        /* END of Preloader */

    });

    var $main_header = $('.main_h');

    // If parent menu has submenu then add down arrow
    jQuery('#responsive-menu > li').each(function(){
        if( jQuery(this).find('ul').hasClass('sub-menu') ){
            jQuery(this).find('ul:first').prev('a').find('.eb_menu_title').append('<i class="has_sub_menu_parent fa fa-angle-down"></i>');
        }
    });

    $(window).on( 'scroll' , function(event) {
        event.preventDefault();

        // IF page template is sticky
        get_sticky_header();
    });

    // Mobile Navigation
    $('.mobile-toggle').on( 'click' , function(event) {
        event.preventDefault();
        if ($main_header.hasClass('open-nav')) {
            $main_header.removeClass('open-nav');
        } 
        else {
            $main_header.addClass('open-nav');
        }
    });

    $('.main_h li a').on( 'click' , function(event) {
        event.preventDefault();
        if ($main_header.hasClass('open-nav')) {
            $('.navigation').removeClass('open-nav');
            $main_header.removeClass('open-nav');
        }
    });

    $(' #da-thumbs > li ').each( function() { 
        $(this).hoverdir(); 
    });

    /**
    * Slicknav - a Mobile Menu
    */
    var $slicknav_label;
    $('#responsive-menu').slicknav({
        duration: 500,
        closedSymbol: '<i class="fa fa-plus"></i>',
        openedSymbol: '<i class="fa fa-minus"></i>',
        prependTo: '#slicknav-mobile',
        allowParentLinks: true,
        label:"" 
    });

        // Mouse-enter dropdown
    $('#navbar li').on("mouseenter focusin", function() {
        $(this).find('ul').first().stop(true, true).delay(50).slideDown(200);
    });
    // Mouse-leave dropdown
    $('#navbar li').on("mouseleave focusout", function() {
        $(this).find('ul').first().stop(true, true).delay(50).slideUp(200);
    });

    /**
     *  Arrow for Menu has sub-menu
     */
    if ($(window).width() > 992) {
        $(".navbar-arrow ul ul > li").has("ul").children("a").append("<i class='arrow-indicator fa fa-angle-right'></i>");
    }

    $(document).ready(function() {
        $('.progress .progress-bar').css("width",
            function() {
                return $(this).attr("aria-valuenow") + "%";
            }
        )
    });

    $(window).on( 'scroll' , function(){
        if($(window).scrollTop() > 500){
            $("#back-to-top").fadeIn(200);
        } else{
            $("#back-to-top").fadeOut(200);
        }
    });

    $(document).on("click",'#back-to-top a',function() {
        $('html, body').animate({ scrollTop:0 },'slow');
        return false;
    }); 

    var interleaveOffset = 0.5;
    var swiperOptions = {
        loop: true,
        speed: 3000,
        grabCursor: true,
        watchSlidesProgress: true,
        mousewheelControl: true,
        keyboardControl: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        },
        autoplay: {
            delay: 3000,
        },
        fadeEffect: {
            crossFade: true
        },
        on: {
            progress: function() {                
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    var slideProgress = swiper.slides[i].progress;
                    var innerOffset = swiper.width * interleaveOffset;
                    var innerTranslate = (travelers_blog_object.is_rtl == '1' ? '-' : '') + slideProgress * innerOffset;
                    swiper.slides[i].querySelector(".slide-inner").style.transform = "translate3d(" + innerTranslate + "px, 0, 0)";
                } 
            },
            touchStart: function() {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = "";
                }
            },
            setTransition: function(speed) {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = speed + "ms";
                    swiper.slides[i].querySelector(".slide-inner").style.transition = speed + "ms";
                }
            }
        }
    };

    var swiper = new Swiper(".swiper-container", swiperOptions);

    $('.comment-reply-link').addClass('btn-sm btn btn-primary');

    jQuery(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();

        jQuery('html, body').animate({
            scrollTop: jQuery(jQuery.attr(this, 'href')).offset().top - 170
        }, 500 );
    });

    $("body").prognroll({
        color: "#f75691"
    });

    tb_error_page_height();

})(jQuery);

function tb_error_page_height(){
    var header = jQuery('.navbar').outerHeight();
    var footer = jQuery('footer.footer').outerHeight();
    var content = jQuery('.breadcrumb-wrapper.error-section .section-title').outerHeight();
    var screen_height = jQuery(window).height();

    jQuery('.breadcrumb-wrapper.error-section').css({
        'padding' : ( ( screen_height - header - footer - content ) / 2.3) + 'px 0' 
    });
}

function tb_prognroll(){

    var screen_width = jQuery(window).width();

    if( travelers_blog_object.enable_desktop_sticky_menu_status == 1 && screen_width >= 1025 && screen_width <= 2000 ){
        var nav_bar_height = jQuery('.logo').closest('.navbar').height();
        jQuery('.prognroll-bar').css({
            'top' : nav_bar_height + 'px'
        });
    }

    if( travelers_blog_object.enable_mobile_sticky_menu_status == 1 && screen_width >= 320 && screen_width <= 1024 ){
        var nav_bar_height = jQuery('.logo').closest('.navbar').height();
        jQuery('.prognroll-bar').css({
            'top' : nav_bar_height + 'px'
        });
    }
    
}

// Search in header.
jQuery(document).on('click','.search-icon', function(e){
    e.preventDefault();
    jQuery('.full-screen-search-box-wrap').show();
});

jQuery(document).on('click','.hide_full_search',function(e){
    e.preventDefault();
    jQuery('.full-screen-search-box-wrap').hide();
});

jQuery(document).on('keyup',function(evt) {
    if (evt.keyCode == 27) {
       jQuery('.full-screen-search-box-wrap').hide();
    }
});

jQuery(window).on('resize load scroll', function(){
     resize_title_tagline();
     tb_prognroll();
});

function resize_title_tagline(){

    // Fix title height
    var nav_bar_height = jQuery('.logo').closest('.navbar').height();
    jQuery('.logo.no_tagline a h3').css({
        'height' : nav_bar_height - 20 + 'px',
        'display': 'table-cell',
        'vertical-align': 'middle'
    });

    // Fix mobile menu
    var btn_height = jQuery('.navbar.sticky .slicknav_btn').height();
    jQuery('.navbar.sticky .slicknav_btn').css({
        'top' : ( nav_bar_height - btn_height ) / 1.9 + 'px'
    });

}