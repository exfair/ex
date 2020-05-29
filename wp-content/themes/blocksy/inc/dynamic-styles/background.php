<?php

// Site background
blocksy_output_background_css([
	'selector' => 'body',
	'css' => $css,
	'value' => get_theme_mod(
		'site_background',
		blocksy_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => '#f8f9fb'
				],
			],
		])
	)
]);

blocksy_output_background_css([
	'selector' => '.ct-related-posts-container',
	'css' => $css,
	'value' => get_theme_mod(
		'related_posts_background',
		blocksy_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => '#eff1f5'
				],
			],
		])
	)
]);

// Trending block
blocksy_output_background_css([
	'selector' => '.ct-trending-block',
	'css' => $css,
	'value' => get_theme_mod(
		'trending_block_background',
		blocksy_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => '#e0e3e8'
				],
			],
		])
	)
]);

// Footer
blocksy_output_background_css([
	'selector' => '.footer-widgets-area',
	'css' => $css,
	'value' => get_theme_mod(
		'widgets_area_background',
		blocksy_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => '#f4f5f8'
				],
			],
		])
	)
]);

// Shop
blocksy_output_background_css([
	'selector' => '.single-product .site-main',
	'css' => $css,
	'value' => get_theme_mod(
		'product_page_background',
		blocksy_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => Blocksy_Css_Injector::get_skip_rule_keyword()
				],
			],
		])
	)
]);

blocksy_output_background_css([
	'selector' => '.product[data-structure*="boxed"]',
	'css' => $css,
	'value' => get_theme_mod(
		'product_content_background',
		blocksy_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => '#ffffff',
				],
			],
		])
	)
]);
