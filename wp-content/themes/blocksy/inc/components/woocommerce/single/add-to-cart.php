<?php

add_action(
	'woocommerce_before_add_to_cart_form',
	function () {
		global $product;
		global $root_product;

		$root_product = $product;
	}
);

add_action(
	'woocommerce_before_add_to_cart_quantity',
	function () {
		global $product;
		global $root_product;

		if (! $root_product) {
			return;
		}

		if (! $root_product->is_type('simple') && ! $root_product->is_type('variable')){
			return;
		}

		echo '<div class="ct-cart-actions">';
	},
	PHP_INT_MAX
);

add_action(
	'woocommerce_after_add_to_cart_button',
	function () {
		global $product;
		global $root_product;

		if (! $root_product) {
			return;
		}

		if (! $root_product->is_type('simple') && ! $root_product->is_type('variable')){
			return;
		}

		echo '</div>';
	},
	100
);

