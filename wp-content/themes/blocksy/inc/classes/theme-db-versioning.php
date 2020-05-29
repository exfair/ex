<?php

/**
 * Theme Update
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2019, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.0.0
 */

class Blocksy_Db_Versioning {
	public function __construct() {
		if (is_admin()) {
			add_action('admin_init', [$this, 'init'], 3);
		} else {
			add_action('wp', [$this, 'init'], 3);
		}
	}

	public function init() {
		$saved_version = get_option('blocksy_db_version', '1.0.0');

		$theme = blocksy_get_wp_parent_theme();
		$current_version = $theme->get('Version');

		foreach ($this->get_patches() as $single_patch) {
			if (
				version_compare(
					$saved_version,
					$single_patch['version'],
					'<'
				)
			) {
				call_user_func($single_patch['cb']);
			}
		}

		if (version_compare($saved_version, $current_version, '<')) {
			update_option('blocksy_db_version', $current_version);
		}
	}

	public function get_patches() {
		return [
			[
				'version' => '1.6.5',
				'cb' => [$this, 'v_1_6_5']
			]
		];
	}

	public function v_1_6_5() {
		if (get_theme_mod('narrowContainerWidth', null)) {
			$narrowContainerWidth = get_theme_mod('narrowContainerWidth', null);

			if (
				intval($narrowContainerWidth) <= 100
				&&
				intval($narrowContainerWidth) >= 50
			) {
				remove_theme_mod('narrowContainerWidth');
			}
		}
	}
}

new Blocksy_Db_Versioning();

