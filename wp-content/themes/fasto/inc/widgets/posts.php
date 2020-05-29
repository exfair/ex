<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
=================================================================================================================
Recent Posts Widget
=================================================================================================================
*/
add_action( 'widgets_init', 'fasto_recent_posts_widget' );
function fasto_recent_posts_widget() {
	register_widget( 'fasto_recent_posts_widget' );
}

class Fasto_Recent_Posts_Widget extends WP_Widget {
	function __construct() {
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'fasto_recent_posts_widget', 'description' => esc_attr__('Display Recent Posts in a nice style','fasto') );
		 
		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'fasto_recent_posts_widget' );
		 
		/* Create the widget. */
		parent::__construct( 'fasto_recent_posts_widget', esc_attr__('Fasto Recent Posts','fasto'), $widget_ops, $control_ops );
	}
	 
	function widget( $args, $instance ) {
		
		$post_no 	=  !empty( $instance['post_no'] ) ?  strip_tags( absint( $instance['post_no'] ) )  : 2 ;
		$title   	=  !empty( $instance['title'] )   ?  strip_tags( $instance['title'] )  : '' ;
		
		$query_args = array( 'posts_per_page' => $post_no ); 
		$query = new WP_Query( $query_args );
		
		extract( $args );

	?>
	<div class="widget"><!-- widget -->
		<h2><?php echo esc_html( $title ); ?></h2><span class="line"></span>
			<div class="sidebar-posts">
				
				<?php while ( $query->have_posts() ) { $query->the_post(); ?>			
				
					<article <?php post_class(); ?>>
						<div class="post-widget">
							<div class="fasto-row">
								<div class="col-desktop-4 col-tablet-4 col-small-tablet-12 col-mobile-12 thumb">
								<?php fasto_post_thumb( false,  false , true , false , true ); ?>
								</div>
								<div class="col-desktop-8 col-tablet-8 col-small-tablet-12 col-mobile-12">
									<h3 class="post-title"><a href="<?php the_permalink(); ?>" class="widget-title"><?php the_title(); ?></a></h3>
								</div>
							</div>
						</div>
					</article>					
				
				<?php } wp_reset_postdata(); ?>
			</div>
	</div><!--/ widget -->
<?php	
}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		 
		$instance['title']   	=   sanitize_text_field( $new_instance['title'] );
		$instance['post_no'] 	=   is_integer( intval( $new_instance['post_no'] ) ) ? intval( $new_instance['post_no'] ) : 2;
		
		return $instance;
	}

	function form( $instance ) {
		
		$title	  			= isset( $instance['title'] )   ? strip_tags( esc_attr( $instance['title'] ) ) : esc_attr__( 'Latest news','fasto' );
		$post_no  			= isset( $instance['post_no'] ) ? strip_tags( absint( $instance['post_no'] ) ) : 2;
	
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title','fasto' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
		</p>
		
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>"><?php esc_html_e( 'Number of posts','fasto' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $post_no ); ?>">
		</p>
		
	<?php
	}
}