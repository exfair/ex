<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
=================================================================================================================
fasto_widgets_init() - add widget areas
=================================================================================================================
*/
function fasto_widgets_init() {

	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2><span class="line"></span>',
	) );	
	
	register_sidebar( array(
		'name'          => 'Footer Widget Area 1',
		'id'            => 'footer-widget-area-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2><span class="line"></span>',
	) );	
	
	register_sidebar( array(
		'name'          => 'Footer Widget Area 2',
		'id'            => 'footer-widget-area-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2><span class="line"></span>',
	) );	
	
	register_sidebar( array(
		'name'          => 'Footer Widget Area 3',
		'id'            => 'footer-widget-area-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2><span class="line"></span>',
	) );

}
add_action( 'widgets_init', 'fasto_widgets_init' );


/**
 * Custom walker class for widget nav
 */
class Fasto_Widget_Custom_Walker extends Walker_Nav_Menu {
 
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu-widget'
        );
        $class_names = implode( ' ', $classes );
 
        // Build HTML for output.
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
 
        // Depth-dependent classes.
        $depth_classes = array( );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
 
        // Passed classes.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
 
		if ( is_object( $args ) ){

			// Build HTML.
			$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
	 
			// Link attributes.
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
	 
			// Build HTML output and pass through the proper filter.
			$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s</a>%5$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ), // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
				$args->after
			);
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
			
		}
    }
}

function fasto_custom_walker_widget( $args ) {
	$args['menu_class'] = 'widget-nav-menu';
    return array_merge( $args, array(
        'walker' => new Fasto_Widget_Custom_Walker(),
    ) );
}
add_filter( 'widget_nav_menu_args', 'fasto_custom_walker_widget' );


/*
=================================================================================================================
fasto_comment() - Template for comments and pingbacks.
=================================================================================================================
*/
function fasto_comment( $comment, $args, $depth ) {
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php esc_html_e( 'Pingback:', 'fasto' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'fasto' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<!-- comment level 1 -->
	<div class="comment-container"><!-- comment-container -->
		<div class="comment-author-img"><!-- comment-author-img -->
			<?php echo get_avatar( $comment, 80 ); ?>
		</div><!--/ comment-author-img -->
		<div class="comment-holder"><!-- comment-holder -->
			<div class="comment-details-holder"><!-- comment-details-holder -->
				<div class="comment-author"><h3><?php comment_author_link(); ?></h3></div>
				<div class="comment-date"><?php comment_date("d M Y"); ?></div>
				<div class="the-comment"><?php comment_text(); ?></div>
				<div class="comment-reply secondary-font"><?php comment_reply_link( array( 'depth' => $depth, 'max_depth' => $args['max_depth'],'reply_text'=>esc_attr__( 'Reply','fasto' ) ) ); ?></div>
			</div><!--/ comment-details-holder -->
		</div><!--/ comment-holder -->
		
	</div><!--/ comment-container -->
	<?php
			break;
	endswitch;
}

/*
=================================================================================================================
fasto_excerpt() - Get excerpt with custom length
=================================================================================================================
*/
function fasto_excerpt( $charlength ) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo esc_attr( mb_substr( $subex, 0, $excut ) );
		} else {
			echo esc_attr( $subex );
		}
	} 
	else {
		echo esc_attr( $excerpt );
	}
}


/*
=================================================================================================================
fasto_the_loop() - Custom theme loop
=================================================================================================================
*/
function fasto_the_loop(){
	$counter = 0;
	if( have_posts() ) {
		while( have_posts() ) {
		the_post();
		
		
			if (  $counter != 0 && ( $counter % fasto_get_grid( true ) == 0 ) ){
				echo '<div class="main-separator"></div>';
			}
			
			if (  $counter != 0 && ( $counter % 2 == 0 ) ){
				echo '<div class="main-separator tablet"></div>';
			}
			
			if (  $counter != 0 && ( $counter % 1 == 0 ) ){
				echo '<div class="main-separator mobile"></div>';
			}
			
			get_template_part( 'templates/post' ); 		
		
			$counter++;
		}
		$args = array( 'prev_text' => __( '&laquo;','fasto' ), 'next_text' => __( '&raquo;','fasto' ) );
		the_posts_pagination( $args );
	}//end if have_posts
}