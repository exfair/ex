<?php

add_action('parse_tax_query', function ($query) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if (! (
		is_home() || is_archive() || is_search()
	)) {
		return;
	}

	if (function_exists('is_woocommerce')) {
		if (is_woocommerce()) {
			return;
		}
	}

	$listing_source = blocksy_get_posts_listing_source();

	$query->set(
		'posts_per_page',
		intval(blocksy_akg_or_customizer(
			'archive_per_page',
			$listing_source,
			10
		))
	);
});

if (! function_exists('blocksy_get_posts_listing_source')) {
	function blocksy_get_posts_listing_source() {
		static $result = null;

		if (! is_null($result)) {
			return $result;
		}

		$post_type = blocksy_manager()->post_types->is_supported_post_type();

		if ($post_type) {
			$result = [
				'strategy' => 'customizer',
				'prefix' => $post_type . '_archive'
			];

			return $result;
		}

		if (is_category() || is_tag() || is_tax()) {
			$result = [
				'strategy' => 'customizer',
				'prefix' => 'categories'
			];

			return $result;
		}

		if (is_search()) {
			$result = [
				'strategy' => 'customizer',
				'prefix' => 'search'
			];

			return $result;
		}

		if (is_author()) {
			$result = [
				'strategy' => 'customizer',
				'prefix' => 'author'
			];

			return $result;
		}

		$result = [
			'strategy' => 'customizer',
			'prefix' => 'blog'
		];

		return $result;
	}
}


if (! function_exists('blocksy_get_listing_card_type')) {
	function blocksy_get_listing_card_type() {
		$cards_type_output = '';

		$listing_source = blocksy_get_posts_listing_source();

		$blog_post_structure = blocksy_akg_or_customizer(
			'structure',
			$listing_source,
			'grid'
		);

		if ($blog_post_structure === 'gutenberg') {
			return $cards_type_output;
		}

		$card_type = blocksy_akg_or_customizer(
			'card_type',
			$listing_source,
			'boxed'
		);

		return 'data-cards="' . $card_type . '"';
	}
}

if (! function_exists('blocksy_listing_page_structure')) {
	function blocksy_listing_page_structure() {
		$listing_source = blocksy_get_posts_listing_source();

		$blog_post_structure = blocksy_akg_or_customizer(
			'structure',
			$listing_source,
			'grid'
		);

		if ($blog_post_structure === 'gutenberg') {
			// return 'data-structure="narrow"';
		}

		return '';
	}
}

