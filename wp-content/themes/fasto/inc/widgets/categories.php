<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
=================================================================================================================
Recent Posts Widget
=================================================================================================================
*/
add_action( 'widgets_init', 'fasto_categories_widget' );
function fasto_categories_widget() {
	register_widget('fasto_categories_widget');
}

class Fasto_Categories_Widget extends WP_Widget {
	function __construct() {
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'fasto_categories_widget', 'description' => esc_attr__('Display categories and post count','fasto') ); 
		 
		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'fasto_categories_widget' );
		 
		/* Create the widget. */
		parent::__construct( 'fasto_categories_widget', esc_attr__('Fasto categories','fasto'), $widget_ops, $control_ops );
	}
	 
	function widget( $args, $instance ) {
		
		$title   = !empty( $instance['title'] ) ?  strip_tags( $instance['title'] )  : '' ; ?>
		<div class="widget"><!-- widget -->
			<h2><?php echo esc_html( $title ); ?></h2>
			<ul class="category-count">
			<?php $categories = get_categories();
				if ( is_array ( $categories )){
					foreach ( $categories as $cat ){ ?>
				<li><a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"><?php echo esc_html( $cat->cat_name ); ?><span><?php echo esc_html( $cat->category_count ); ?> </span></a></li>		
			<?php 
					}
				}
			?>
			</ul>
		</div>

	<?php 
	
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {
		$title	= isset( $instance['title'] ) ? strip_tags( $instance['title'] ) : esc_attr__( 'Browse by category','fasto' );

		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title','fasto' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
		</p>
		
	<?php
	}
}