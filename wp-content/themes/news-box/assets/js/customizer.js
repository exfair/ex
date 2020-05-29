/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	wp.customize( 'header_bgcolor', function( value ) {
		value.bind( function( to ) {
			$( 'header.site-header' ).css( {
					'background-color': to
				} );
		} );
	} );
	wp.customize( 'content_bg_color', function( value ) {
		value.bind( function( to ) {
			$( '.hentry, .comments-area, .site-main section, .site-main .post-navigation, .site-main .posts-navigation, .paging-navigation, .widget,.content-area, .news-box-sidebar' ).css( {
					'background-color': to
				} );
		} );
	} );
	wp.customize( 'content_text_color', function( value ) {
		value.bind( function( to ) {
			$( 'html body' ).css( {
					'color': to
				} );
		} );
	} );
	wp.customize( 'link_color', function( value ) {
		value.bind( function( to ) {
			$( 'body a' ).css( {
					'color': to
				} );
		} );
	} );
	wp.customize( 'link_hover_color', function( value ) {
		value.bind( function( to ) {
			$( 'body a:hover' ).css( {
					'color': to
				} );
		} );
	} );
	wp.customize( 'feature_background_color', function( value ) {
		value.bind( function( to ) {
			$('body .header-feature-section').css( {
					'background': to
				} );
		} );
	} );
	wp.customize( 'news_box_feature_show', function( value ) {
		value.bind( function( to ) {
			$('body .header-feature-section').css( {
					'display': to 
				} );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
} )( jQuery );
