<?php
/**
 * Search form
 *
 * @package Fasto
 * @author fribba
 *
 */
?>
<form role="search"  method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div id="search-form-holder">
		<label for="s" class="screen-reader-text"><?php esc_html_e( 'Search', 'fasto' ); ?></label> 
		<input type="text" value="<?php echo get_search_query(); ?>" aria-label="<?php esc_attr_e( 'Search query','fasto' ); ?>" placeholder="<?php esc_attr_e( 'Type your search...','fasto' ); ?>" name="s" id="s" />
		<input type="submit" value="<?php esc_attr_e( 'Search','fasto' ); ?>" aria-label="<?php esc_attr_e( 'Submit search','fasto' ); ?>" placeholder="<?php esc_attr_e( 'Type your search...','fasto' ); ?>" />
	</div>
</form>