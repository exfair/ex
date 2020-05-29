<?php

if (! function_exists('blocksy_compute_box_shadow_var_for')) {
	function blocksy_compute_box_shadow_var_for($value) {
		if (
			! isset($value['enable'])
			||
			! $value['enable']
		) {
			return 'CT_CSS_SKIP_RULE';
		}

		if (
			$value['blur'] === 0
			&&
			$value['spread'] === 0
			&&
			$value['v_offset'] === 0
			&&
			$value['h_offset'] === 0
		) {
			return 'CT_CSS_SKIP_RULE';
		}

		$color = blocksy_get_colors([
			'default' => $value['color']
		], [
			'default' => $value['color']
		]);

		$box_shadow_components = [];

		if (isset($value['inset']) && $value['inset']) {
			$box_shadow_components[] = 'inset';
		}

		$box_shadow_components[] = $value['h_offset'] . 'px';
		$box_shadow_components[] = $value['v_offset'] . 'px';

		if (intval($value['blur']) !== 0) {
			$box_shadow_components[] = $value['blur'] . 'px';

			if (intval($value['spread']) !== 0) {
				$box_shadow_components[] = $value['spread'] . 'px';
			}
		}

		if (
			intval($value['blur']) === 0
			&&
			intval($value['spread']) !== 0
		) {
			$box_shadow_components[] = $value['blur'] . 'px';
			$box_shadow_components[] = $value['spread'] . 'px';
		}

		$box_shadow_components[] = $color['default'];

		return implode(' ', $box_shadow_components);
	}
}

if (! function_exists('blocksy_box_shadow_value')) {
	function blocksy_box_shadow_value($args = []) {
		return wp_parse_args(
			$args,
			[
				'blur' => 0,
				'spread' => 0,
				'v_offset' => 0,
				'h_offset' => 0,
				'inset' => false,
				'enable' => true,
				'color' => [
					'color' => 'rgba(44,62,80,0.2)',
				],
			]
		);
	}
}

if (! function_exists('blocksy_output_box_shadow')) {
	function blocksy_output_box_shadow($args = []) {
		$args = wp_parse_args(
			$args,
			[
				'css' => null,
				'tablet_css' => null,
				'mobile_css' => null,

				'selector' => null,

				'variableName' => 'boxShadow',
				'value' => null,

				'responsive' => false
			]
		);

		$value = blocksy_expand_responsive_value($args['value']);

		if (! $args['responsive']) {
			$args['css']->put(
				$args['selector'],
				'--' . $args['variableName'] .
				': ' . blocksy_compute_box_shadow_var_for($args['value'])
			);

			return;
		}

        $responsive = blocksy_expand_responsive_value($args['responsive']);

		$args['css']->put(
			$args['selector'],
			'--' . $args['variableName'] .
			': ' . ($responsive['desktop'] ? blocksy_compute_box_shadow_var_for(
				$value['desktop']
			) : 'none')
		);

		$args['tablet_css']->put(
			$args['selector'],
			'--' . $args['variableName'] .
			': ' . ($responsive['tablet'] ? blocksy_compute_box_shadow_var_for(
				$value['tablet']
			) : 'none')
		);

		$args['mobile_css']->put(
			$args['selector'],
			'--' . $args['variableName'] .
			': ' . ($responsive['mobile'] ? blocksy_compute_box_shadow_var_for(
				$value['mobile']
			) : 'none')
		);
	}
}
