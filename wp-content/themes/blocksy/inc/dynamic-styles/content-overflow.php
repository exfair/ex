<?php

$should_output = false;

if (blocksy_sidebar_position() === 'none') {
	if (is_single() || blocksy_is_page()) {
		$should_output = true;
	}
}

if (function_exists('is_woocommerce')) {
	if (is_checkout()) {
		$should_output = false;
	}

	if (is_cart()) {
		$should_output = false;
	}

	if (is_product()) {
		$should_output = false;
	}
}

if ($should_output) {
	$css->put(
		'.content-area',
		'overflow: hidden'
	);
}

