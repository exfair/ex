<?php

function blocksy_get_product_card_categories() {
	if (
		get_theme_mod('has_product_categories', 'no') === 'yes'
		||
		is_customize_preview()
	) {
		return blocksy_post_meta([
			[
				'id' => 'categories',
				'enabled' => true
			]
		], [
			'attr' => get_theme_mod(
				'has_product_categories', 'no'
			) !== 'yes' ? ['data-customize-hide' => ''] : []
		]);
	}

	return '';
}

add_action('init', function () {
	if (! get_option('woocommerce_thumbnail_cropping', null)) {
		update_option('woocommerce_thumbnail_cropping', 'predefined');
		update_option('woocommerce_thumbnail_cropping_custom_width', 3);
		update_option('woocommerce_thumbnail_cropping_custom_height', 4);
	}

	$products_layout = blocksy_get_products_listing_layout();

	if (
		is_customize_preview()
		&&
		get_theme_mod('has_star_rating', 'yes') !== 'yes'
		&&
		!is_product()
	) {
		add_filter(
			'woocommerce_product_get_rating_html',
			function ($html) {
				return str_replace(
					'class="star-rating"',
					'class="star-rating" data-customize-hide',
					$html
				);
			}
		);
	}

	if (is_customize_preview()) {
		add_filter(
			'woocommerce_sale_flash',
			function ($html) {
				if (is_product()) {
					if (get_theme_mod('has_product_single_onsale', 'yes') !== 'yes') {
						return str_replace(
							'class="onsale"',
							'class="onsale" data-customize-hide',
							$html
						);
					}

					return $html;
				}

				if (get_theme_mod('has_sale_badge', 'yes') !== 'yes') {
					return str_replace(
						'class="onsale"',
						'class="onsale" data-customize-hide',
						$html
					);
				}

				return $html;
			}
		);
	}

	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

	if ($products_layout !== 'type-1') {
		// Products cards
		remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

		remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
		remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

		remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

		remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

		// Category cards
		remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail');
	}

	// Cards type 1
	if ($products_layout === 'type-1') {
		// Products cards
		remove_action(
			'woocommerce_before_shop_loop_item_title',
			'woocommerce_template_loop_product_thumbnail'
		);


		if (
			get_theme_mod('has_sale_badge', 'yes') !== 'yes'
			&&
			!is_customize_preview()
		) {
			remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
		}

		if (
			get_theme_mod('has_star_rating', 'yes') === 'yes'
			||
			is_customize_preview()
		) {
			add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating', 20);
		}

		add_action(
			'woocommerce_before_shop_loop_item_title',
			function () {
				global $product;

				echo blocksy_image([
					'attachment_id' => $product->get_image_id(),
					'size' => 'woocommerce_thumbnail',
					'ratio' => blocksy_get_woocommerce_ratio(),
					'tag_name' => 'span'
				]);
			}
		);

		add_action(
			'woocommerce_after_shop_loop_item',
			function () {
				echo blocksy_get_product_card_categories();
				echo '<div class="ct-woo-card-actions">';
			},
			6
		);

		add_action(
			'woocommerce_after_shop_loop_item',
			function () {
				echo '</div>';

				if (function_exists('blocksy_output_quick_view_link')) {
					echo blocksy_output_quick_view_link();
				}
			},
			20
		);

		// Categories cards
		remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail');

		add_action(
			'woocommerce_before_subcategory_title',
			function ($category) {
				$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );

				echo blocksy_image([
					'attachment_id' => $thumbnail_id,
					'size' => 'woocommerce_thumbnail',
					'ratio' => blocksy_get_woocommerce_ratio(),
					'tag_name' => 'span'
				]);
			}
		);
	}

	// Cards type 2
	if ($products_layout === 'type-2') {
		add_action(
			'woocommerce_before_shop_loop_item',
			function () {
				global $product;

				echo '<figure>';

				woocommerce_show_product_loop_sale_flash();

				if (function_exists('blocksy_output_quick_view_link')) {
					echo blocksy_output_quick_view_link();
				}

				echo blocksy_image([
					'attachment_id' => $product->get_image_id(),
					'size' => 'woocommerce_thumbnail',
					'ratio' => blocksy_get_woocommerce_ratio(),
					'tag_name' => 'a',
					'html_atts' => [
						'href' => apply_filters(
							'woocommerce_loop_product_link',
							get_permalink($product->get_id()),
							$product
						)
					]
				]);

				echo '</figure>';

				woocommerce_template_loop_product_link_open();
				woocommerce_template_loop_product_title();
				woocommerce_template_loop_product_link_close();

				echo blocksy_get_product_card_categories();

				if (
					get_theme_mod('has_star_rating', 'yes') === 'yes'
					||
					is_customize_preview()
				) {
					woocommerce_template_loop_rating();
				}

				echo '<div class="ct-woo-card-actions">';

				woocommerce_template_loop_price();
				woocommerce_template_loop_add_to_cart();

				echo '</div>';
			}
		);

		add_action(
			'woocommerce_before_subcategory',
			function ($category) {
				$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);

				echo '<figure>';

				echo blocksy_image([
					'attachment_id' => $thumbnail_id,
					'size' => 'woocommerce_thumbnail',
					'ratio' => blocksy_get_woocommerce_ratio(),
					'tag_name' => 'a',
					'html_atts' => [
						'href' => get_term_link($category, 'product_cat')
					]
				]);

				echo '</figure>';
			},
			5
		);
	}
});

