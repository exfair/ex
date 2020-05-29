<?php
/**
 * Implement meta boxes
 *
 * @copyright 2019-present Creative Themes
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Blocksy
 */

if (! function_exists('blocksy_get_post_options')) {
	function blocksy_get_post_options($post_id = null) {
		static $post_opts = [];

		if (! $post_id) {
			global $post;

			if ($post) {
				$post_id = $post->ID;
			}

			if (is_home() && !is_front_page()) {
				$post_id = get_option('page_for_posts');
			}

			if (function_exists('is_shop') && is_shop()) {
				$post_id = get_option( 'woocommerce_shop_page_id' );
			}
		}

		if (isset($post_opts[$post_id])) {
			return $post_opts[$post_id];
		}

		$values = get_post_meta($post_id, 'blocksy_post_meta_options');

		if (empty($values)) {
			$values = [[]];
		}

		$post_opts[$post_id] = $values[0];

		return $values[0];
	}
}

if (! function_exists('blocksy_get_taxonomy_options')) {
	function blocksy_get_taxonomy_options($term_id = null) {
		static $taxonomy_opts = [];

		if (! $term_id) {
			$term_id = get_queried_object_id();
		}

		if (isset($taxonomy_opts[$term_id])) {
			return $taxonomy_opts[$term_id];
		}

		$values = get_term_meta(
			$term_id,
			'blocksy_taxonomy_meta_options'
		);

		if ( empty( $values ) ) {
			$values = [ [] ];
		}

		$taxonomy_opts[$term_id] = $values[0];

		return $values[0];
	}
}

