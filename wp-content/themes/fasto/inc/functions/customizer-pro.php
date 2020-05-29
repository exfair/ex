<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
#
# Customizer pro link
#
if ( !class_exists( 'WP_Customize_Section' ) ){
	return;
}

class Fasto_Customize_Section_Pro extends WP_Customize_Section {

	public $type = 'fasto_pro';
	public $pro_text = '';
	public $pro_url = '';

	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}
	
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}

final class Fasto_Customize_Pro {
	
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}
	private function __construct() {}
	
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}
	public function sections( $manager ) {

		// Register custom section types.
		$manager->register_section_type( 'Fasto_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Fasto_Customize_Section_Pro(
				$manager,
				'fasto_pro',
				array(
					'title'    => esc_html__( 'Author Website', 'fasto' ),
					'pro_text' => esc_html__( 'Take a peek',         'fasto' ),
					'pro_url'  => 'https://wowlayers.com/',
					'priority' => 999
				)
			)
		);
		// Register sections.
		$manager->add_section(
			new Fasto_Customize_Section_Pro(
				$manager,
				'fasto_pro1',
				array(
					'title'    => esc_html__( 'Author Website', 'fasto' ),
					'pro_text' => esc_html__( 'Take a peek',         'fasto' ),
					'pro_url'  => 'https://wowlayers.com/',
					'panel' => 'fasto_theme_options'
				)
			)
		);
	}
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'fasto-customize-controls-pro', FASTO_URI. '/js/customize-controls-pro.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'fasto-customize-controls-pro', FASTO_URI. '/css/customize-controls-pro.css' );
	}
}

Fasto_Customize_Pro::get_instance();