<?php
/**
 * Template for previous & next posts
 *
 * @package Fasto
 * @author fribba
 *
 */
?>
<div class="other-posts fasto-row">
	<div class="col-desktop-12"><h2><?php echo esc_html__( 'Previous &amp; Next posts','fasto' ); ?></h2></div>

	<div class="col-desktop-6">
		<?php 
		//previous post
		$fasto_prev_post = get_adjacent_post( false, '', false );
		if( !empty( $fasto_prev_post ) ) {
			$fasto_image = get_the_post_thumbnail_url( $fasto_prev_post->ID , 'fasto-widget' );
			$fasto_alt_title = get_post( get_post_thumbnail_id( $fasto_prev_post->ID ) )->post_excerpt ? get_post( get_post_thumbnail_id( $fasto_prev_post->ID ) )->post_excerpt : get_post( get_post_thumbnail_id( $fasto_prev_post->ID ) )->post_title;
			if ( $fasto_image ){
				echo '<a href="' . esc_url( get_permalink( $fasto_prev_post->ID ) ) . '" title="' . esc_attr( $fasto_prev_post->post_title ) . '"><img src="'.esc_url( $fasto_image ).'" alt="'.esc_attr( $fasto_alt_title ).'" /></a>';			
			}
			echo '<h3><a href="' . esc_url( get_permalink( $fasto_prev_post->ID ) ) . '" title="' . esc_attr( $fasto_prev_post->post_title ) . '">' . get_the_title( $fasto_prev_post->ID ) . '</a></h3>';// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
			//we need this to allow html tags in post title
		} 
		?>
	</div>
	
	<div class="col-desktop-6">
		<?php
		//next post
		$fasto_next_post = get_adjacent_post( false, '', true );
		if( !empty( $fasto_next_post ) ) {
			$fasto_image = get_the_post_thumbnail_url( $fasto_next_post->ID , 'fasto-widget' );
			$fasto_alt_title = get_post( get_post_thumbnail_id( $fasto_next_post->ID ) )->post_excerpt ? get_post( get_post_thumbnail_id( $fasto_next_post->ID ) )->post_excerpt : get_post( get_post_thumbnail_id( $fasto_next_post->ID ) )->post_title;
			if ( $fasto_image ){	
				echo '<a href="' . esc_url( get_permalink( $fasto_next_post->ID ) ) . '" title="' . esc_attr( $fasto_next_post->post_title ) . '"><img src="'.esc_url( $fasto_image ).'" alt="'.esc_attr( $fasto_alt_title ).'" /></a>';
			}
			echo '<h3><a href="' . esc_url( get_permalink( $fasto_next_post->ID ) ) . '" title="' . esc_attr( $fasto_next_post->post_title ) . '">' . get_the_title( $fasto_next_post->ID ) . '</a></h3>';// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
			//we need this to allow html tags in post title
		} 
		?>
	</div>	
	
</div>