<?php

remove_action(
	'woocommerce_single_product_summary',
	'woocommerce_template_single_meta',
	40
);

add_action(
	'woocommerce_single_product_summary',
	function () {
		if (get_theme_mod('has_product_single_meta', 'yes') === 'yes') {
			woocommerce_template_single_meta();
		}

		if (is_customize_preview()) {
			blocksy_add_customizer_preview_cache(function () {
				return blocksy_html_tag(
					'div',
					['data-id' => 'single-meta'],
					blocksy_collect_and_return(function () {
						global $product;

						if ($product) {
							woocommerce_template_single_meta();
						}
					})
				);
			});
		}
	},
	39
);

add_action(
	'woocommerce_before_main_content',
	function () {
		if (is_product()) {
			ob_start();
		}
	},
	999999
);

add_action(
	'woocommerce_before_single_product_summary',
	function () {
		$contents = ob_get_clean();

		$content_area_style = get_theme_mod('product_content_style', 'wide');

		echo str_replace(
			'<div id="product-',
			'<div data-structure="' . $content_area_style . '" id="product-',
			$contents
		);
	},
	1
);

add_action(
	'woocommerce_before_single_product_summary',
	function () {
		echo '<div class="product-entry-wrapper">';

		if (
			get_theme_mod('has_product_single_onsale', 'yes') === 'yes'
			||
			is_customize_preview()
		) {
			woocommerce_show_product_sale_flash();
		}
	},
	1
);

add_action(
	'woocommerce_after_single_product_summary',
	function () {
		echo '</div>';
	},
	1
);

remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

add_action(
	'woocommerce_after_main_content',
	function () {
		if (is_product()) {
			woocommerce_upsell_display();
			woocommerce_output_related_products();
		}
	},
	5
);

function blocksy_woo_single_post_class($classes, $product) {
	if (get_theme_mod('gallery_style', 'horizontal') === 'vertical') {
		if (count($product->get_gallery_image_ids()) > 0) {
			$classes[] = 'thumbs-left';
		}
	}

	if (get_theme_mod('has_product_sticky_summary', 'no') === 'yes') {
		$classes[] = 'sticky-summary';
	}

	return $classes;
}

add_filter(
	'woocommerce_post_class',
	'blocksy_woo_single_post_class',
	999,
	2
);

