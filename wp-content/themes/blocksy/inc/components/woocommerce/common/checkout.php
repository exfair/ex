<?php


add_action('wp', function () {
	if (! get_theme_mod('blocksy_has_checkout_coupon', false)) {
		remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
	}
});

add_action(
	'woocommerce_checkout_before_order_review_heading',
	function () {
		echo '<div class="ct-order-review">';
	}
);

add_action(
	'woocommerce_checkout_after_order_review',
	function () {
		echo '</div>';
	}
);

