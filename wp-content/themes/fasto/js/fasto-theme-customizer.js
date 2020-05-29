( function( $ ) {
	
	//primary color
	wp.customize( 'fasto_primary_color', function( value ) {
		value.bind( function( newval ) {
			$('.post-content a, .page-content a, .breadcrumb.theme a, .comment-form a, .color-1, .widget .color-1, .sub-menu .current-menu-item > a, .menu > .current-menu-item > a, .menu > .current-menu-ancestor > a, .comment-date, .fasto-fallback-menu .current_page_item a,.widget th a,.widget td a').css('color', newval );
			$('.bg-color-1, .pagination li.active a, .single .pagination span.current, .category-count span, input[type="submit"], button, #after-footer .social-and-search, .author-box .social-and-search, .wp-block-quote::before, .wp-block-pullquote::before, blockquote::before, .widget .line,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt').css('background-color', newval );
			$('.social-and-search,.articles .sticky .post-thumb').css('border-color', newval );
			$('.social-and-search svg,.author-date svg').css('fill', newval );
		} );
	} );	
	
    //first color hover
    wp.customize( 'fasto_primary_color', function( value ) {
            value.bind( function( to ) {
 
                var style, el;
 
                style = '<style class="hover-styles">.widget a:hover, .sub-menu a:hover, .menu > .menu-item > a:hover, .menu > .menu-item:hover > a, .menu .page_item:hover > a, ul.tags a:hover{ color: ' + to + '; }    .pagination a:hover{ background-color: ' + to + '; }    .tagcloud a:hover,.tags a:hover{ border-color: ' + to + '; }     header .social-and-search a:hover svg,header .author-date a:hover svg,li.author:hover > a.author-dropdown > svg{ fill: ' + to + '; }                   </style>'; // build the style element
                el =  $( '.hover-styles' );
				
                if ( el.length ) {
                    el.replaceWith( style );
                } else {
                    $( 'head' ).append( style );
                }
            } );
     } );	
	
	//secondary color
	wp.customize( 'fasto_secondary_color', function( value ) {
		value.bind( function( newval ) {
			$('.color-2, .widget .color-2').css('color', newval );
			$('.bg-color-2,.woo-cart-menu').css('background-color', newval );
		} );
	} );	
	
    //secondary color hover
    wp.customize( 'fasto_secondary_color', function( value ) {
            value.bind( function( to ) {
 
                var style, el;
 
                style = '<style class="hover-styles">button:hover,input[type="submit"]:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce input.button:hover,.woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover{ background-color: ' + to + '; } a:hover{ color: ' + to + '; }</style>'; // build the style element
                el =  $( '.hover-styles' );
				
                if ( el.length ) {
                    el.replaceWith( style );
                } else {
                    $( 'head' ).append( style );
                }
            } );
     } );
	 
	//body color
	wp.customize( 'fasto_body_color', function( value ) {
		value.bind( function( newval ) {
			$('body').css('color', newval );
		} );
	} );
	
	//headings color
	wp.customize( 'fasto_headings_color', function( value ) {
		value.bind( function( newval ) {
			$('.site-grid-inner h1, .site-grid-inner h1 a,.site-grid-inner h2, .site-grid-inner h2 a,.site-grid-inner h3, .site-grid-inner h3 a,.site-grid-inner h4, .site-grid-inner h4 a,.site-grid-inner h5, .site-grid-inner h5 a,.site-grid-inner h6, .site-grid-inner h6 a,.site-grid-inner .widget a,.menu > .menu-item > a,.sub-menu a,.site-grid-inner .widget h2,header .logo h1,.comment-reply a,.subscribe p,.price, .menu .page_item > a').css('color', newval );
			$('td, th,input[type="search"],input[type="text"],input[type="email"],input[type="password"],input[type="url"],input[type="number"],input[type=tel],textarea,select,.author-box,body .wp-block-table.is-style-stripes td,.comment-container,.breadcrumb-navigation,#sidebar .widget,.woocommerce-message,.woocommerce .cart-collaterals .cart_totals, .woocommerce-page .cart-collaterals .cart_totals,.product_meta,.tagcloud a,ul.tags a', 'border-color').css('border-color', newval );
		} );
	} );	

	//category background color
	wp.customize( 'fasto_category_color', function( value ) {
		value.bind( function( newval ) {
			$('.category-link,.woocommerce span.onsale,.woocommerce ul.products li.product .onsale,.woocommerce span.onsale, .woocommerce ul.products li.product .onsale').css('background-color', newval );
		} );
	} );	
	
	//category background color
	wp.customize( 'fasto_footer_color', function( value ) {
		value.bind( function( newval ) {
			$('footer#footer').css('background-color', newval );
		} );
	} );
	
	//user copyright
	wp.customize( 'fasto_user_copyright', function( value ) {
		value.bind( function( newval ) {
			$( '.copyright-user' ).html( newval );
		} );
	} );
	
	// Author credit
	wp.customize( 'fasto_developer_credit', function( value ) {
		value.bind( function( to ) {
			if ( '1' === to ) {
				$( '.copyright-fasto' ).css( {
					display: 'block',
				} );
			} else {
				$( '.copyright-fasto' ).css( {
					display: 'none',
				} );
			}
		} );
	} );


	//site title
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title a' ).html( newval );
		} );
	} );		
	
	//site description
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );		
	
	//site logo
	wp.customize( 'custom_logo', function( value ) {
		value.bind( function( newval ) {
			$( '.logo > a' ).html( newval );
		} );
	} );
	
	// header text color
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
				$( '.site-title a, .site-description' ).css( {
					color: to,
				} );
				$( '.site-description' ).css( {
					opacity: 0.8,
				} );
			}
		} );
	} );
	

} )( jQuery );