<?php

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );


$thumb_id = get_post_thumbnail_id();

$gallery_images = $product->get_gallery_image_ids();

if ($thumb_id) {
	array_unshift($gallery_images, intval($thumb_id));
} else {
	$gallery_images = [null];
}

$ratio = '3/4';
$single_ratio = get_theme_mod('product_gallery_ratio', '3/4');

echo '<div class="ct-product-view">';

$default_ratio = apply_filters('blocksy:woocommerce:default_product_ratio', '3/4');

if (count($gallery_images) === 1) {
	$attachment_id = $gallery_images[0];

	$image_href = wp_get_attachment_image_src(
		$attachment_id,
		'full'
	);

	$width = null;
	$height = null;

	if ($image_href) {
		$width = $image_href[1];
		$height = $image_href[2];

		$image_href = $image_href[0];
	}

	echo blocksy_image([
		'attachment_id' => $gallery_images[0],
		'size' => 'woocommerce_single',
		'ratio' => is_single() ? $single_ratio : $default_ratio,
		'tag_name' => 'a',
		'size' => 'woocommerce_single',
		'html_atts' => array_merge([
			'href' => $image_href
		], $width ? [
			'data-width' => $width,
			'data-height' => $height
		] : []),
	]);
}

if (count($gallery_images) > 1) {
	echo blocksy_flexy([
		'images' => $gallery_images,
		'size' => 'woocommerce_single',
		'pills_images' => is_single() ? $gallery_images : null,
		'images_ratio' => is_single() ? $single_ratio : $default_ratio
	]);
}

echo '</div>';


