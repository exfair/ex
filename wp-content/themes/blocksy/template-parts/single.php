<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Blocksy
 */

if (
	blocksy_default_akg(
		'page_structure_type',
		blocksy_get_post_options(),
		'default'
	) !== 'default'
	&&
	is_customize_preview()
) {
	blocksy_add_customizer_preview_cache(
		function () {
			return blocksy_html_tag(
				'div',
				[
					'data-structure-custom' => blocksy_default_akg(
						'page_structure_type',
						blocksy_get_post_options(),
						'default'
					)
				],
				''
			);
		}
	);
}

?>

<?php

if (have_posts()) {
	the_post();
}

?>

	<?php
		/**
		 * Note to code reviewers: This line doesn't need to be escaped.
		 * Function blocksy_output_hero_section() used here escapes the value properly.
		 */
		echo blocksy_output_hero_section( 'type-2' );
	?>

	<div id="primary" class="content-area">

		<div class="<?php echo esc_attr(blocksy_get_page_container_width()) ?>" <?php echo wp_kses_post(blocksy_sidebar_position_attr()); ?>>

			<section>
				<?php
					get_template_part( 'template-parts/content', get_post_type() );
				?>
			</section>

			<?php get_sidebar(); ?>

		</div>

	</div>

<?php

blocksy_display_page_elements('separated');

have_posts();
wp_reset_query();

