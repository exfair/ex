<?php

if (! function_exists('blocksy_get_comments_source')) {
	function blocksy_get_comments_source($allow_even_if_disabled = false) {
		static $result = null;

		if (! is_null($result)) {
			if (! is_customize_preview()) {
				return $result;
			}
		}

		if (blocksy_is_page()) {
			if (
				get_theme_mod('page_has_comments', 'yes') === 'no'
				&&
				!$allow_even_if_disabled
			) {
				$result = false;
				return $result;
			}

			$result = [
				'strategy' => 'customizer',
				'prefix' => 'page'
			];

			return $result;
		}

		if (is_single()) {
			if (
				get_theme_mod('post_has_comments', 'yes') === 'no'
				&&
				!$allow_even_if_disabled
			) {
				$result = false;
				return $result;
			}

			$result = [
				'strategy' => 'customizer',
				'prefix' => 'post'
			];

			return $result;
		}

		$result = false;
		return $result;
	}
}

