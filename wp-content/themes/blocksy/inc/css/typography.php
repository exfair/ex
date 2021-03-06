<?php

class Blocksy_Fonts_Manager {
	public function get_all_fonts() {
		return apply_filters('blocksy_typography_font_sources', [
			'system' => [
				'type' => 'system',
				'families' => $this->get_system_fonts(),
			],

			'google' => [
				'type' => 'google',
				'families' => $this->get_googgle_fonts()
				// 'families' => []
			]
		]);
	}

	public function get_static_fonts_ids() {
		return array_merge([
			'rootTypography',
			get_theme_mod(
				'h1Typography',
				blocksy_typography_default_values([
					'size' => '40px',
					'variation' => 'n7',
					'line-height' => '1.5'
				])
			),
			get_theme_mod(
				'h2Typography',
				blocksy_typography_default_values([
					'size' => '35px',
					'variation' => 'n7',
					'line-height' => '1.5'
				])
			),
			get_theme_mod(
				'h3Typography',
				blocksy_typography_default_values([
					'size' => '30px',
					'variation' => 'n7',
					'line-height' => '1.5'
				])
			),
			get_theme_mod(
				'h4Typography',
				blocksy_typography_default_values([
					'size' => '25px',
					'variation' => 'n7',
					'line-height' => '1.5'
				])
			),
			get_theme_mod(
				'h5Typography',
				blocksy_typography_default_values([
					'size' => '20px',
					'variation' => 'n7',
					'line-height' => '1.5'
				])
			),
			get_theme_mod(
				'h6Typography',
				blocksy_typography_default_values([
					'size' => '16px',
					'variation' => 'n7',
					'line-height' => '1.5'
				])
			),
			get_theme_mod(
				'blockquote',
				blocksy_typography_default_values([
					'family' => 'Georgia',
					'size' => '25px',
					'variation' => 'n6',
				])
			),
			get_theme_mod(
				'pre',
				blocksy_typography_default_values([
					'family' => 'monospace',
					'size' => '16px',
					'variation' => 'n4',
				])
			),
			get_theme_mod(
				'buttons',
				blocksy_typography_default_values([
					'size' => '15px',
					'variation' => 'n5',
				])
			),
			get_theme_mod(
				'sidebarWidgetsTitleFont',
				blocksy_typography_default_values([
					'size' => '18px',
				])
			),
			get_theme_mod(
				'singleProductTitleFont',
				blocksy_typography_default_values([
					'size' => '30px',
				])
			),
			get_theme_mod(
				'cardProductTitleFont',
				blocksy_typography_default_values([
					'size' => '17px',
					'variation' => 'n6',
				])
			),
		], Blocksy_Manager::instance()->builder->typography_keys());
	}

	public function get_dynamic_fonts_ids() {
		$fonts_ids = array_merge([
			blocksy_get_posts_listing_source()['prefix'] . '_cardTitleFont',
			blocksy_get_posts_listing_source()['prefix'] . '_cardMetaFont',
			blocksy_get_posts_listing_source()['prefix'] . '_pageMetaFont',
		]);

		$page_title_source = blocksy_get_page_title_source();

		if ($page_title_source) {
			$fonts_ids[] = blocksy_akg_or_customizer(
				'pageTitleFont',
				$page_title_source,
				blocksy_typography_default_values([
					'size' => [
						'desktop' => '32px',
						'tablet'  => '30px',
						'mobile'  => '25px'
					],
					'variation' => 'n7',
					'line-height' => '1.3',
				])
			);

			$fonts_ids[] = blocksy_akg_or_customizer(
				'pageMetaFont',
				$page_title_source,
				blocksy_typography_default_values([
					'size' => [
						'desktop' => '12px',
						'tablet' => '12px',
						'mobile' => '12px'
					],
					'variation' => 'n6',
					'line-height' => '1.3',
					'text-transform' => 'uppercase',
				])
			);

			$fonts_ids[] = blocksy_akg_or_customizer(
				'pageExcerptFont',
				$page_title_source,
				blocksy_typography_default_values([
					'variation' => 'n5',
				])
			);
		}

		return $fonts_ids;
	}

	public function load_static_google_fonts() {
		return $this->get_google_fonts_url($this->get_static_fonts_ids());
	}

	public function load_dynamic_google_fonts() {
		$url = $this->get_google_fonts_url($this->get_dynamic_fonts_ids());

		if (! empty($url)) {
			wp_register_style('blocksy-fonts-font-source-google', $url);
			wp_enqueue_style('blocksy-fonts-font-source-google');
		}
	}

	public function load_editor_fonts() {
		$fonts_ids = [
			get_theme_mod(
				'h1Typography',
				blocksy_typography_default_values([
					'size' => '40px',
					'variation' => 'n7',
					'line-height' => '1.5'
				])
			),
			get_theme_mod(
				'h2Typography',
				blocksy_typography_default_values([
					'size' => '35px',
					'variation' => 'n7',
					'line-height' => '1.5'
				])
			),
			get_theme_mod(
				'h3Typography',
				blocksy_typography_default_values([
					'size' => '30px',
					'variation' => 'n7',
					'line-height' => '1.5'
				])
			),
			get_theme_mod(
				'h4Typography',
				blocksy_typography_default_values([
					'size' => '25px',
					'variation' => 'n7',
					'line-height' => '1.5'
				])
			),
			get_theme_mod(
				'h5Typography',
				blocksy_typography_default_values([
					'size' => '20px',
					'variation' => 'n7',
					'line-height' => '1.5'
				])
			),
			get_theme_mod(
				'h6Typography',
				blocksy_typography_default_values([
					'size' => '16px',
					'variation' => 'n7',
					'line-height' => '1.5'
				])
			),
			get_theme_mod(
				'blockquote',
				blocksy_typography_default_values([
					'family' => 'Georgia',
					'size' => '25px',
					'variation' => 'n6',
				])
			),
			get_theme_mod(
				'pre',
				blocksy_typography_default_values([
					'family' => 'monospace',
					'size' => '16px',
					'variation' => 'n4',
				])
			),
			get_theme_mod(
				'buttons',
				blocksy_typography_default_values([
					'size' => '15px',
					'variation' => 'n5',
				])
			),
		];

		$url = $this->get_google_fonts_url($fonts_ids);

		if (! empty($url)) {
			wp_register_style('blocksy-fonts-font-source-google', $url);
			wp_enqueue_style('blocksy-fonts-font-source-google');
		}
	}

	private function get_google_fonts_url($fonts_ids = []) {
		$all_fonts = $this->get_system_fonts();

		$system_fonts_families = [];

		foreach ($all_fonts as $single_google_font) {
			$system_fonts_families[] = $single_google_font['family'];
		}

		$to_enqueue = [];

		$default_family = get_theme_mod(
			'rootTypography',
			blocksy_typography_default_values([
				'family' => 'System Default',
				'variation' => 'n4',
				'size' => '17px',
				'line-height' => '1.65',
				'letter-spacing' => '0em',
				'text-transform' => 'none',
				'text-decoration' => 'none',
			])
		);

		$default_variation = $default_family['variation'];
		$default_family = $default_family['family'];

		foreach ($fonts_ids as $font_id) {
			if (is_array($font_id)) {
				$value = $font_id;
			} else {
				$value = get_theme_mod($font_id, null);
			}

			if ($value && $value['family'] === 'Default') {
				$value['family'] = $default_family;
			}

			if ($value && $value['variation'] === 'Default') {
				$value['variation'] = $default_variation;
			}

			if (
				!$value
				||
				!isset($value['family'])
				||
				in_array($value['family'], $system_fonts_families)
				||
				$value['family'] === 'Default'
				||
				strpos($value['family'], 'ct_font_') !== false
			) {
				continue;
			}

			if (! isset($to_enqueue[$value['family']])) {
				$to_enqueue[$value['family']] = [$value['variation']];
			} else {
				$to_enqueue[$value['family']][] = $value['variation'];
			}

			$to_enqueue[$value['family']] = array_unique(
				$to_enqueue[$value['family']]
			);
		}

		$url = 'https://fonts.googleapis.com/css?family=';

		$families = [];

		foreach ($to_enqueue as $family => $variations) {
			$to_push = $family . ':';

			$vars = [];

			foreach ($variations as $variation) {
				$var_to_push = intval($variation[1]) * 100;
				$var_to_push .= $variation[0] === 'i' ? 'i' : '';
				$vars[] = $var_to_push;
			}

			$to_push .= implode(',', $vars);

			$families[] = $to_push;
		}

		$families = implode('|', $families);

		if (! empty($families)) {
			$subsets = [];

			foreach (get_theme_mod('font_subset', [
				'latin' => true,
				'latin-ext' => false,
				'cyrillic' => false,
				'cyrillic-ext' => false,
				'greek' => false,
				'greek-ext' => false,
				'vietnamese' => false,
			]) as $subset => $enabled) {
				if ($enabled && $subset !== 'latin') {
					$subsets[] = $subset;
				}
			}

			$url .= $families;
			$url .= '&display=swap';

			if (! empty($subsets)) {
				$url .= '&subset=' . implode(',', $subsets);
			}

			return $url;
		}

		return false;
	}

	public function get_system_fonts() {
		$system = [
			'System Default',
			'Arial', 'Verdana', 'Trebuchet', 'Georgia', 'Times New Roman',
			'Palatino', 'Helvetica', 'Calibri', 'Myriad Pro',
			'Lucida', 'Gill Sans', 'Impact', 'Serif', 'monospace'
		];

		$result = [];

		foreach ($system as $font) {
			$result[] = [
				'source' => 'system',
				'family' => $font,
				'variations' => [],
				'all_variations' => $this->get_standard_variations_descriptors()
			];
		}

		return $result;
	}

	public function get_standard_variations_descriptors() {
		return [
			'n1', 'i1', 'n2', 'i2', 'n3', 'i3', 'n4', 'i4', 'n5', 'i5', 'n6',
			'i6', 'n7', 'i7', 'n8', 'i8', 'n9', 'i9'
		];
	}

	public function all_google_fonts() {
		$saved_data = get_option('blocksy_google_fonts', false);
		$ttl = 7 * DAY_IN_SECONDS;

		if (
			false === $saved_data
			||
			(($saved_data['last_update'] + $ttl) < time())
			||
			!is_array($saved_data)
			||
			!isset($saved_data['fonts'])
			||
			empty($saved_data['fonts'])
		) {
			$response = wp_remote_get(
				'https://demo.creativethemes.com/?route=google_fonts'
			);

			$body = wp_remote_retrieve_body($response);

			if (
				200 === wp_remote_retrieve_response_code($response)
				&&
				! is_wp_error($body) && ! empty($body)
			) {
				update_option('blocksy_google_fonts', [
					'last_update' => time(),
					'fonts' => $body
				], false);

				return $body;
			} else {
				if (empty($saved_data['fonts'])) {
					$saved_data['fonts'] = json_encode(['items' => []]);
				}

				update_option(
					'blocksy_google_fonts',
					array(
						'last_update' => time() - $ttl + MINUTE_IN_SECONDS,
						'fonts' => $saved_data['fonts']
					),
					false
				);
			}
		}

		return $saved_data['fonts'];
	}

	public function get_googgle_fonts() {
		$maybe_custom_source = apply_filters(
			'blocksy-typography-google-fonts-source',
			null
		);

		if ($maybe_custom_source) {
			return $maybe_custom_source;
		}

		$response = $this->all_google_fonts();
		$response = json_decode($response, true);

		if (! isset($response['items'])) {
			return false;
		}

		if (! is_array($response['items']) || !count($response['items'])) {
			return false;
		}

		foreach ($response['items'] as $key => $row) {
			$response['items'][$key] = $this->prepare_font_data($row);
		}

		return $response['items'];
	}

	private function prepare_font_data($font) {
		$font['source'] = 'google';

		$font['variations'] = [];

		if (isset($font['variants'])) {
			$font['all_variations'] = $this->change_variations_structure($font['variants']);
		}

		unset($font['variants']);
		return $font;
	}

	private function change_variations_structure( $structure ) {
		$result = [];

		foreach($structure as $weight) {
			$result[] = $this->get_weight_and_style_key($weight);
		}

		return $result;
	}

	private function get_weight_and_style_key($code) {
		$prefix = 'n'; // Font style: italic = `i`, regular = n.
		$sufix = '4';  // Font weight: 1 -> 9.

		$value = strtolower(trim($code));
		$value = str_replace(' ', '', $value);

		# Only number.
		if (is_numeric($value) && isset($value[0])) {
			$sufix = $value[0];
			$prefix = 'n';
		}

		// Italic.
		if (preg_match("#italic#", $value)) {
			if ('italic' === $value) {
				$sufix = 4;
				$prefix = 'i';
			} else {
				$value = trim(str_replace('italic', '', $value));
				if (is_numeric($value) && isset($value[0])) {
					$sufix = $value[0];
					$prefix = 'i';
				}
			}
		}

		// Regular.
		if (preg_match("#regular|normal#", $value)) {
			if ('regular' === $value) {
				$sufix = 4;
				$prefix = 'n';
			} else {
				$value = trim(str_replace(array('regular', 'normal') , '', $value));
				if (is_numeric($value) && isset($value[0])) {
					$sufix = $value[0];
					$prefix = 'n';
				}
			}
		}

		return "{$prefix}{$sufix}";
	}
}

if (! function_exists('blocksy_output_font_css')) {
	function blocksy_output_font_css($args = []) {
		$args = wp_parse_args(
			$args,
			[
				'css' => null,
				'tablet_css' => null,
				'mobile_css' => null,
				'font_value' => null,
				'selector' => ':root',
				'prefix' => ''
			]
		);

		if (! $args['css']) {
			throw new Error('css missing in args!');
		}

		if (! $args['tablet_css']) {
			throw new Error('tablet_css missing in args!');
		}

		if (! $args['mobile_css']) {
			throw new Error('mobile_css missing in args!');
		}

		if ($args['font_value']['family'] === 'System Default') {
			$args['font_value']['family'] = "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'";
		}

		if ($args['font_value']['family'] === 'Default') {
			$args['font_value']['family'] = 'CT_CSS_SKIP_RULE';
		}

		$args['css']->put(
			$args['selector'],
			"--" . blocksy_get_with_prefix('fontFamily', $args['prefix']) . ": {$args['font_value']['family']}"
		);

		$weight_and_style = blocksy_get_css_for_variation(
			$args['font_value']['variation']
		);

		$args['css']->put(
			$args['selector'],
			"--" . blocksy_get_with_prefix('fontWeight', $args['prefix']) . ": {$weight_and_style['weight']}"
		);

		if ($weight_and_style['style'] !== 'normal') {
			$args['css']->put(
				$args['selector'],
				"--" . blocksy_get_with_prefix('fontStyle', $args['prefix']) . ": {$weight_and_style['style']}"
			);
		}

		$args['css']->put(
			$args['selector'],
			"--" . blocksy_get_with_prefix('textTransform', $args['prefix']) . ": {$args['font_value']['text-transform']}"
		);

		$args['css']->put(
			$args['selector'],
			"--" . blocksy_get_with_prefix('textDecoration', $args['prefix']) . ": {$args['font_value']['text-decoration']}"
		);

		blocksy_output_responsive([
			'css' => $args['css'],
			'tablet_css' => $args['tablet_css'],
			'mobile_css' => $args['mobile_css'],
			'selector' => $args['selector'],
			'variableName' => blocksy_get_with_prefix('fontSize', $args['prefix']),
			'unit' => '',
			'value' => $args['font_value']['size']
		]);

		blocksy_output_responsive([
			'css' => $args['css'],
			'tablet_css' => $args['tablet_css'],
			'mobile_css' => $args['mobile_css'],
			'selector' => $args['selector'],
			'variableName' => blocksy_get_with_prefix(
				'lineHeight',
				$args['prefix']
			),
			'unit' => '',
			'value' => $args['font_value']['line-height']
		]);

		blocksy_output_responsive([
			'css' => $args['css'],
			'tablet_css' => $args['tablet_css'],
			'mobile_css' => $args['mobile_css'],
			'selector' => $args['selector'],
			'variableName' => blocksy_get_with_prefix(
				'letterSpacing',
				$args['prefix']
			),
			'unit' => '',
			'value' => $args['font_value']['letter-spacing']
		]);
	}
}

if (! function_exists('blocksy_get_css_for_variation')) {
	function blocksy_get_css_for_variation($variation, $should_output_normals = true) {
		$weight_and_style = [
			'style' => '',
			'weight' => '',
		];

		if ($variation === 'Default') {
			return [
				'style' => 'CT_CSS_SKIP_RULE',
				'weight' => 'CT_CSS_SKIP_RULE'
			];
		}

		if (preg_match(
			"#(n|i)(\d+?)$#",
			$variation,
			$matches
		)) {
			if ('i' === $matches[1]) {
				$weight_and_style['style'] = 'italic';
			} else {
				$weight_and_style['style'] = 'normal';
			}

			$weight_and_style['weight'] = (int) $matches[2] . '00';
		}

		return $weight_and_style;
	}
}

if (! function_exists('blocksy_typography_default_values')) {
	function blocksy_typography_default_values($values = []) {
		return array_merge([
			'family' => 'Default',
			'variation' => 'Default',

			'size' => '17px',
			'line-height' => '1.65',
			'letter-spacing' => '0em',
			'text-transform' => 'none',
			'text-decoration' => 'none',

			'size' => 'CT_CSS_SKIP_RULE',
			'line-height' => 'CT_CSS_SKIP_RULE',
			'letter-spacing' => 'CT_CSS_SKIP_RULE',
			'text-transform' => 'CT_CSS_SKIP_RULE',
			'text-decoration' => 'CT_CSS_SKIP_RULE',
		], $values);
	}
}

add_action( 'wp_ajax_blocksy_get_fonts_list', function () {
	if (! current_user_can('edit_theme_options')) {
		wp_send_json_error();
	}

	$m = new Blocksy_Fonts_Manager();

	wp_send_json_success([
		'fonts' => $m->get_all_fonts()
	]);
});

add_action('blocksy:global-dynamic-css:enqueue', function ($args) {
	if (! blocksy_dynamic_styles_should_call(
		array_merge([
			'chunk' => 'global'
		], $args)
	)) {
		return;
	}

	$typography = new Blocksy_Fonts_Manager();

	$url = $typography->load_static_google_fonts();

	if (empty($url)) {
		return;
	}

	$args['css']->put(
		Blocksy_Css_Injector::get_inline_keyword(),
		"@import url('" . $url . "');\n"
	);
});
