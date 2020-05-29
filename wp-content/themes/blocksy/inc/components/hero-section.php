<?php

if (! function_exists('blocksy_is_page_title_default')) {
	function blocksy_is_page_title_default() {
		if (function_exists('is_product_category')) {
			if (is_product_category() || is_product_tag()) {
				$taxonomy_options = blocksy_get_taxonomy_options();

				$mode = blocksy_akg('has_hero_section', $taxonomy_options, 'default');

				if ($mode !== 'default') {
					return false;
				}
			}
		}

		if (blocksy_is_page() || is_single()) {
			$post_options = blocksy_get_post_options();

			$mode = blocksy_akg('has_hero_section', $post_options, 'default');

			if ($mode !== 'default') {
				return false;
			}
		}

		if (is_category() || is_tag() || is_tax() || is_archive()) {
			$taxonomy_options = blocksy_get_taxonomy_options();

			$mode = blocksy_akg('has_hero_section', $taxonomy_options, 'default');

			if ($mode !== 'default') {
				return false;
			}
		}

		return true;
	}
}

if (! function_exists('blocksy_get_page_title_source')) {
	function blocksy_get_page_title_source($allow_even_if_disabled = false) {
		static $result = null;

		if (! is_null($result)) {
			if (! is_customize_preview()) {
				return $result;
			}
		}

		$post_options = false;

		if (function_exists('is_bbpress') && (
			get_post_type() === 'forum'
			||
			get_post_type() === 'topic'
			||
			get_post_type() === 'reply'
		)) {
			if (
				get_theme_mod(
					'bbpress_single_title_enabled',
					'yes'
				) === 'no'
				&&
				!$allow_even_if_disabled
			) {
				$result = false;
				return $result;
			}

			$result = [
				'strategy' => 'customizer',
				'prefix' => 'bbpress_single'
			];

			return $result;
		}

		if (function_exists('is_buddypress') && (
			is_buddypress()
		)) {
			if (
				get_theme_mod(
					'buddypress_single_title_enabled',
					'yes'
				) === 'no'
				&&
				!$allow_even_if_disabled
			) {
				$result = false;
				return $result;
			}

			$result = [
				'strategy' => 'customizer',
				'prefix' => 'buddypress_single'
			];

			return $result;
		}

		if (blocksy_is_page([
			'shop_is_page' => false,
			'blog_is_page' => false
		]) || is_single()) {
			$post_options = blocksy_get_post_options();

			$mode = blocksy_akg('has_hero_section', $post_options, 'default');

			if ($mode === 'default') {
				$prefix = blocksy_is_page() ? 'single_page' : 'single_blog_post';

				if (blocksy_is_page()) {
					if (
						get_theme_mod(
							'single_page_title_enabled', 'yes'
						) === 'no'
						&&
						!$allow_even_if_disabled
					) {
						$result = false;
						return $result;
					}
				}

				if (is_single()) {
					$post_type = blocksy_manager()->post_types->is_supported_post_type();

					if ($post_type) {
						if (
							get_theme_mod(
								$post_type . '_single_title_enabled', 'yes'
							) === 'no'
							&&
							!$allow_even_if_disabled
						) {
							$result = false;
							return $result;
						}

						$result = [
							'strategy' => 'customizer',
							'prefix' => $post_type . '_single'
						];

						return $result;
					}

					if (
						get_theme_mod(
							'single_blog_post_title_enabled', 'yes'
						) === 'no'
						&&
						!$allow_even_if_disabled
					) {
						$result = false;
						return $result;
					}
				}

				$result = [
					'strategy' => 'customizer',
					'prefix' => $prefix
				];

				return $result;
			}

			if ($mode === 'disabled') {
				$result = false;
				return $result;
			}

			$result = [
				'strategy' => $post_options
			];
			return $result;
		}

		if (function_exists('is_product_category')) {
			if (is_product_category() || is_product_tag()) {
				$taxonomy_options = blocksy_get_taxonomy_options();

				$mode = blocksy_akg('has_hero_section', $taxonomy_options, 'default');

				if ($mode === 'default') {
					if (
						get_theme_mod(
							'woo_categories_has_page_title', 'yes'
						) === 'no'
						&&
						!$allow_even_if_disabled
					) {
						$result = false;
						return $result;
					}

					$result = [
						'strategy' => 'customizer',
						'prefix' => 'woo_categories'
					];
					return $result;
				}

				if ($mode === 'disabled') {
					$result = false;
					return $result;
				}

				$result = [
					'strategy' => $taxonomy_options
				];
				return $result;
			}

			if (is_shop()) {
				$post_options = blocksy_get_post_options();
				$mode = blocksy_akg('has_hero_section', $post_options, 'default');

				if ($mode === 'default') {
					$prefix = 'woo_categories';

					if (
						get_theme_mod(
							'woo_categories_has_page_title', 'yes'
						) === 'no'
						&&
						!$allow_even_if_disabled
					) {
						$result = false;
						return $result;
					}

					$result = [
						'strategy' => 'customizer',
						'prefix' => $prefix
					];

					return $result;
				}

				if ($mode === 'disabled') {
					$result = false;
					return $result;
				}

				$result = [
					'strategy' => $post_options
				];
				return $result;
			}
		}

		if (
			(
				is_category()
				||
				is_tag()
				||
				is_tax()
				||
				is_archive()
				||
				is_post_type_archive()
			) && ! is_author()
		) {
			$taxonomy_options = blocksy_get_taxonomy_options();

			$mode = blocksy_akg('has_hero_section', $taxonomy_options, 'default');

			if ($mode === 'default') {
				$post_type = blocksy_manager()->post_types->is_supported_post_type();

				if ($post_type) {
					if (
						get_theme_mod(
							$post_type . '_page_title_enabled',
							'yes'
						) === 'no'
						&&
						!$allow_even_if_disabled
					) {
						$result = false;
						return $result;
					}

					$result = [
						'strategy' => 'customizer',
						'prefix' => $post_type . '_archive'
					];

					return $result;
				}
				if (
					get_theme_mod(
						'categories_has_page_title', 'yes'
					) === 'no'
					&&
					!$allow_even_if_disabled
				) {
					$result = false;
					return $result;
				}

				return [
					'strategy' => 'customizer',
					'prefix' => 'categories'
				];
			}

			if ($mode === 'disabled') {
				$result = false;
				return $result;
			}

			$result = [
				'strategy' => $taxonomy_options
			];
			return $result;
		}

		if (is_search()) {
			if (
				get_theme_mod('search_page_title_enabled', 'yes') === 'no'
				&&
				!$allow_even_if_disabled
			) {
				$result = false;
				return $result;
			}

			return [
				'strategy' => 'customizer',
				'prefix' => 'search'
			];
		}

		if (is_author()) {
			if (
				get_theme_mod('author_page_title', 'yes') === 'no'
				&&
				!$allow_even_if_disabled
			) {
				$result = false;
				return $result;
			}

			$result = [
				'strategy' => 'customizer',
				'prefix' => 'author'
			];

			return $result;
		}

		if (is_home()) {
			if (
				get_theme_mod('blog_page_title_enabled', 'no') === 'no'
				&&
				!$allow_even_if_disabled
			) {
				$result = false;
				return $result;
			}

			$result = [
				'strategy' => 'customizer',
				'prefix' => 'blog'
			];

			return $result;
		}

		$result = false;
		return $result;
	}
}

if (! function_exists('blocksy_hero_get_deep_link')) {
	function blocksy_hero_get_deep_link($source) {
		if (! $source) {
			return null;
		}

		if (! isset($source['prefix'])) {
			return null;
		}

		if ($source['prefix'] === 'blog') {
			return 'blog_posts:blog_page_title_enabled';
		}

		if ($source['prefix'] === 'author') {
			return 'author_page:author_page_title';
		}

		if ($source['prefix'] === 'search') {
			return 'search_page:search_page_title_enabled';
		}

		if ($source['prefix'] === 'woo_categories') {
			return 'woocomerrce_posts_archives:woo_categories_has_page_title';
		}

		if ($source['prefix'] === 'categories') {
			return 'archive_blog_posts_categories:categories_has_page_title';
		}

		if ($source['prefix'] === 'single_page') {
			return 'single_pages:single_page_title_enabled';
		}

		if ($source['prefix'] === 'single_blog_post') {
			return 'single_blog_posts:single_blog_post_title_enabled';
		}

		return null;
	}
}

if (! function_exists('blocksy_output_hero_section')) {
	function blocksy_output_hero_section($type = 'type-1', $is_cache_phase = false) {
		$source = blocksy_get_page_title_source();

		if (is_customize_preview()) {
			if (blocksy_is_page_title_default()) {
				if (! $is_cache_phase) {
					blocksy_add_customizer_preview_cache(
						'<div class="ct-hero-section-cache" data-type="' . $type . '">' .
						blocksy_output_hero_section($type, true) . '</div>'
					);
				}
			} else {
				blocksy_add_customizer_preview_cache('<div data-hero-section-custom></div>');
			}
		}

		if (! $source) {
			if (! $is_cache_phase) {
				return '';
			}
		}

		$default_type = 'type-1';

		if (
			function_exists('is_woocommerce')
			&&
			(
				is_product_category()
				||
				is_product_tag()
				||
				is_shop()
			)
			&&
			blocksy_get_page_title_source()['strategy'] === 'customizer'
		) {
			$default_type = 'type-2';
		}

		$actual_type = blocksy_akg_or_customizer(
			'hero_section',
			blocksy_get_page_title_source(),
			$default_type
		);

		if (!$is_cache_phase && $type !== $actual_type) {
			return '';
		}

		$elements = blocksy_render_view(
			dirname(__FILE__) . '/hero/elements.php',
			[
				'is_cache_phase' => $is_cache_phase,
				'type' => $type
			]
		);

		if ($type !== 'type-1' && $type !== 'type-2') {
			return '';
		}

		ob_start();

		do_action('blocksy:hero:before');

		$attr = [
			'class' => 'hero-section',
			'data-type' => $type
		];

		if (
			is_customize_preview()
			&&
			blocksy_is_page_title_default()
			&&
			blocksy_hero_get_deep_link(blocksy_get_page_title_source())
		) {
			$attr['data-shortcut'] = 'border';
			$attr['data-location'] = blocksy_hero_get_deep_link(blocksy_get_page_title_source());
		}

		echo blocksy_render_view(
			dirname(__FILE__) . '/hero/' . $type . '.php',
			[
				'is_cache_phase' => $is_cache_phase,
				'type' => $type,
				'elements' => $elements,
				'attr' => $attr
			]
		);

		do_action('blocksy:hero:after');

		return ob_get_clean();
	}
}

