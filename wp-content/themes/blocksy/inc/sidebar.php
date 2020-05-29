<?php
/**
 * Sidebar helpers
 *
 * @copyright 2019-present Creative Themes
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Blocksy
 */

if (! function_exists('blocksy_get_sidebar_prefix')) {
	function blocksy_get_sidebar_prefix() {
		if (function_exists('is_lifterlms') && is_lifterlms()) {
			return 'lms';
		}

		$post_type = blocksy_manager()->post_types->is_supported_post_type();

		if (! is_single()) {
			if ($post_type) {
				return $post_type . '_archive';
			}
		}

		if (function_exists('is_bbpress') && (
			get_post_type() === 'forum'
			||
			get_post_type() === 'topic'
			||
			get_post_type() === 'reply'
		)) {
			return 'post';
		}

		if (is_search()) {
			return 'search';
		}

		if (is_home()) {
			return 'blog';
		}

		if (get_post_type() === 'post') {
			if (is_category() || is_tag()) {
				return 'categories';
			}

			if (is_author()) {
				return 'author';
			}

			if (! is_single()) {
				return 'blog';
			}
		}

		if (get_post_type() === 'product') {
			if (! is_single()) {
				return 'woo_category';
			}

			return 'product';
		}

		if (function_exists('is_woocommerce') && is_woocommerce()) {
			return 'woo_category';
		}

		if (is_tax()) {
			return 'categories';
		}

		if (function_exists('is_buddypress') && (
			is_buddypress()
		)) {
			return 'post';
		}

		if (!is_singular() && !is_page()) {
			return null;
		}

		if (is_singular()) {
			return 'post';
		}

		if (blocksy_is_page()) {
			return 'page';
		}

		return null;
	}
}

if (! function_exists('blocksy_get_sidebar_to_render')) {
	function blocksy_get_sidebar_to_render($prefix = null) {
		if (class_exists('BlocksySidebarsManager')) {
			$manager = new BlocksySidebarsManager();

			$maybe_sidebar = $manager->maybe_get_sidebar_that_matches();

			if ($maybe_sidebar) {
				return $maybe_sidebar;
			}
		}

		if (! $prefix) {
			$prefix = blocksy_get_sidebar_prefix();
		}

		if ($prefix === 'woo_category') {
			return 'sidebar-woocommerce';
		}

		if ($prefix === 'product') {
			return 'sidebar-woocommerce';
		}

		return 'sidebar-1';
	}
}

/**
 * Get sidebar position.
 */
if (! function_exists('blocksy_sidebar_position_attr')) {
	function blocksy_sidebar_position_attr() {
		return (
			blocksy_sidebar_position() === 'none'
		) ? '' : 'data-sidebar="' . blocksy_sidebar_position() . '"';
	}
}

/**
 * Get single page structure.
 */
if (! function_exists('blocksy_get_single_page_structure')) {
	function blocksy_get_single_page_structure() {
		$default_page_structure = blocksy_default_akg(
			'page_structure_type',
			blocksy_get_post_options(),
			'default'
		);

		if ($default_page_structure !== 'default') {
			return $default_page_structure;
		}

		if (blocksy_is_page()) {
			return get_theme_mod('single_page_structure', 'type-4');
		}

		if (function_exists('is_bbpress') && (
			get_post_type() === 'forum'
			||
			get_post_type() === 'topic'
			||
			get_post_type() === 'reply'
		)) {
			return get_theme_mod('bbpress_single_structure', 'type-4');
		}

		if (! is_singular()) {
			return 'none';
		}

		$post_type = blocksy_manager()->post_types->is_supported_post_type();

		if ($post_type) {
			return get_theme_mod($post_type . '_single_structure', 'type-4');
		}

		if (function_exists('is_buddypress') && (
			is_buddypress()
		)) {
			return get_theme_mod('buddypress_single_structure', 'type-4');
		}

		return get_theme_mod('single_blog_post_structure', 'type-3');
	}
}

/**
 * Sidebar position.
 */
if (! function_exists('blocksy_sidebar_position')) {
	function blocksy_sidebar_position($prefix = null) {
		if (! $prefix) {
			$prefix = blocksy_get_sidebar_prefix();
		}

		if ($prefix === 'lms') {
			return 'right';
		}

		$listing_source = blocksy_get_posts_listing_source();

		$blog_post_structure = blocksy_akg_or_customizer(
			'structure',
			$listing_source,
			'grid'
		);

		if (strpos($prefix, '_archive')) {
			if (
				get_theme_mod($prefix . '_has_sidebar', 'no') === 'no'
				||
				$blog_post_structure === 'gutenberg'
			) {
				return 'none';
			}

			return get_theme_mod($prefix . '_sidebar_position', 'right');
		}

		if ($prefix === 'search') {
			if (
				get_theme_mod('search_has_sidebar', 'no') === 'no'
				||
				$blog_post_structure === 'gutenberg'
			) {
				return 'none';
			}

			return get_theme_mod('search_sidebar_position', 'right');
		}

		if ($prefix === 'categories') {
			if (
				get_theme_mod('categories_has_sidebar', 'no') === 'no'
				||
				$blog_post_structure === 'gutenberg'
			) {
				return 'none';
			}

			return get_theme_mod('categories_sidebar_position', 'right');
		}

		if ($prefix === 'author') {
			if (
				get_theme_mod('author_has_sidebar', 'no') === 'no'
				||
				$blog_post_structure === 'gutenberg'
			) {
				return 'none';
			}

			return get_theme_mod('author_sidebar_position', 'right');
		}

		if ($prefix === 'blog') {
			if (
				get_theme_mod('blog_has_sidebar', 'no') === 'no'
				||
				$blog_post_structure === 'gutenberg'
			) {
				return 'none';
			}

			return get_theme_mod('blog_sidebar_position', 'right');
		}

		if ($prefix === 'woo_category') {
			if (get_theme_mod('woo_has_sidebar', 'no') === 'no') {
				return 'none';
			}

			return get_theme_mod('woo_sidebar_position', 'right');
		}

		if ($prefix === 'product') {
			if (get_theme_mod('product_has_sidebar', 'no') === 'no') {
				return 'none';
			}

			return get_theme_mod( 'product_sidebar_position', 'right' );
		}

		if ($prefix !== 'page' && $prefix !== 'post') {
			return 'right';
		}

		$page_structure_type = blocksy_get_single_page_structure();

		if ('type-1' === $page_structure_type) {
			return 'right';
		}

		if ('type-2' === $page_structure_type) {
			return 'left';
		}

		return 'none';
	}
}

/**
 * Get page structure.
 */
if (! function_exists('blocksy_get_page_structure')) {
	function blocksy_get_page_structure() {
		$page_structure_type = blocksy_get_single_page_structure();

		if ('type-3' === $page_structure_type) {
			return 'narrow';
		}

		if ('type-4' === $page_structure_type) {
			return 'normal';
		}

		if ('type-5' === $page_structure_type) {
			return 'normal';
		}

		return 'none';
	}
}

if (! function_exists('blocksy_get_page_container_width')) {
	function blocksy_get_page_container_width() {
		$page_structure_type = blocksy_get_single_page_structure();

		if (blocksy_get_page_structure() === 'narrow') {
			return 'ct-container-narrow';
		}

		return 'ct-container';
	}
}
