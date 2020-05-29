<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Upsell customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Travelers_Blog_Customize_Section extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'upsell';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { 

		$pro_link = $this->get_pro_link(); 

		if( !empty( $pro_link ) ){ ?>

			<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand upgrade-to-pro">

				<h3 class="accordion-section-title">
					<?php esc_html_e( 'Travelers Blog PRO', 'travelers-blog' ); ?>

					<a href="<?php echo esc_url( $pro_link ); ?>" class="button button-secondary alignright button-red" target="_blank">
						<?php esc_html_e( 'Upgrade to PRO', 'travelers-blog' ); ?>	
					</a>
				</h3>

			</li>

			<?php 
		
		}

	}

	function get_pro_link(){

		return 'https://holidaysthemes.com/downloads/travelers-blog-pro/';

	}

}
