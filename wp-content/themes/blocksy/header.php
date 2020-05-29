<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blocksy
 */

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<?php do_action('blocksy:head:start') ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<?php do_action('blocksy:head:end') ?>
</head>

<body <?php body_class(); ?> <?php echo blocksy_body_attr() ?>>

<?php
	if (function_exists('wp_body_open')) {
		wp_body_open();
	}
?>

<div id="main-container">
	<?php
		do_action('blocksy:header:before');

		if (
			! function_exists('elementor_theme_do_location')
			||
			! elementor_theme_do_location('header')
		) {
			echo Blocksy_Manager::instance()->header_builder->render();
		}

		do_action('blocksy:header:after');

		$site_main_class = 'site-main';

		if (blocksy_has_schema_org_markup()) {
			$site_main_class .= ' hfeed';
		}
	?>

	<main
		id="main" class="<?php echo $site_main_class ?>"
		<?php echo blocksy_schema_org_definitions('creative_work') ?>>

		<?php if (function_exists('blc_output_read_progress_bar')) { ?>
			<?php
				/**
				 * Note to code reviewers: This line doesn't need to be escaped.
				 * Function blc_output_read_progress_bar() used here escapes the value properly.
				 */
				echo blc_output_read_progress_bar()
			?>
		<?php } ?>
