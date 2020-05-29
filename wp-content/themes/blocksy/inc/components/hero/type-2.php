<?php

$attachment_id = false;

$page_title_bg_type = blocksy_akg_or_customizer(
	'page_title_bg_type',
	blocksy_get_page_title_source(),
	'color'
);

if (
	blocksy_akg_or_customizer(
		'page_title_bg_type',
		blocksy_get_page_title_source(),
		'color'
	) !== 'color' || $is_cache_phase
) {
	if (has_post_thumbnail()) {
		$attachment_id = get_post_thumbnail_id();
	}
}

if ($page_title_bg_type === 'custom_image' && !$is_cache_phase) {
	$custom_background_image = blocksy_akg_or_customizer(
		'custom_hero_background',
		blocksy_get_page_title_source(),
		[
			'attachment_id' => null
		]
	);

	if ($custom_background_image['attachment_id']) {
		$attachment_id = $custom_background_image['attachment_id'];
	}
}

if (
	$page_title_bg_type === 'custom_image'
	||
	$page_title_bg_type === 'featured_image'
) {
	$parallax_result = [];

	$parallax_value = blocksy_akg_or_customizer(
		'parallax',
		blocksy_get_page_title_source(),
		[
			'desktop' => false,
			'tablet' => false,
			'mobile' => false,
		]
	);

	if ($parallax_value['desktop']) {
		$parallax_result[] = 'desktop';
	}

	if ($parallax_value['tablet']) {
		$parallax_result[] = 'tablet';
	}

	if ($parallax_value['mobile']) {
		$parallax_result[] = 'mobile';
	}

	if (count($parallax_result) > 0) {
		$attr['data-parallax'] = implode(':', $parallax_result);
	}
}

?>

<section <?php echo blocksy_attr_to_html($attr) ?>>
	<?php if ( $attachment_id ) { ?>
		<figure>
			<?php
				echo blocksy_image([
					'attachment_id' => $attachment_id,
					'ratio' => '16/9',
					'size' => 'full',
				]);
			?>
		</figure>
	<?php } ?>

	<div class="ct-container">
		<header class="entry-header">
			<?php echo $elements ?>
		</header>
	</div>
</section>


