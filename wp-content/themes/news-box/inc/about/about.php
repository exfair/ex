<?php
/**
 * About setup
 *
 * @package news box
 */

if ( ! function_exists( 'news_box_about_setup' ) ) :

	/**
	 * About setup.
	 *
	 * @since 1.0.0
	 */
	function news_box_about_setup() {
		$theme = wp_get_theme();
		$config = array(
		// Menu name under Appearance.
		'menu_name'               => esc_html__( 'News Box Info', 'news-box' ),
		// Page title.
		'page_name'               => esc_html__( 'News Box Info', 'news-box' ),
		/* translators: Main welcome title */
		'welcome_title'         => sprintf( esc_html__( 'Welcome to %s! - Version ', 'news-box' ), $theme['Name'] ),
		// Main welcome content
			// Welcome content.
			'welcome_content' => sprintf( esc_html__( '%1$s is now installed and ready to use. We want to make sure you have the best experience using the theme and that is why we gathered here all the necessary information for you. Thanks for using our theme!', 'news-box' ), $theme['Name'] ),

			// Tabs.
			'tabs' => array(
				'getting_started' => esc_html__( 'Getting Started', 'news-box' ),
				'recommended_actions' => esc_html__( 'Recommended Actions', 'news-box' ),
				'useful_plugins'  => esc_html__( 'Useful Plugins', 'news-box' ),
				'free_pro'  => esc_html__( 'Free Vs Pro', 'news-box' ),
				),

			// Quick links.
			'quick_links' => array(
                'theme_url' => array(
                    'text' => esc_html__( 'Theme Details', 'news-box' ),
                    'url'  => 'https://wpthemespace.com/product/news-box/',
                ),
                'demo_url' => array(
                    'text' => esc_html__( 'View Demo', 'news-box' ),
                    'url'  => 'http://wpthemespace.com/theme/news-box/',
                ),
                'update_url' => array(
                    'text'   => esc_html__( 'UPGRADE PRO', 'news-box' ),
                    'url'    => 'https://wpthemespace.com/product/news-box/?add-to-cart=148',
                    'button' => 'danger',
                ),
            ),

			// Getting started.
			'getting_started' => array(
				'one' => array(
					'title'       => esc_html__( 'Theme Documentation', 'news-box' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'news-box' ),
					'button_text' => esc_html__( 'Documentation coming soon', 'news-box' ),
					'button_url'  => '#',
					'button_type' => 'primary',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Theme Options', 'news-box' ),
					'icon'        => 'dashicons dashicons-admin-customizer',
					'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'news-box' ),
					'button_text' => esc_html__( 'Customize', 'news-box' ),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
					),
				'three' => array(
					'title'       => esc_html__( 'Demo Content', 'news-box' ),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf( esc_html__( 'Demo content is pro feature. To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'news-box' ), esc_html__( 'One Click Demo Import', 'news-box' ) ),
					),
				'four' => array(
				    'title'       => esc_html__( 'Set Widgets', 'news-box' ),
				    'icon'        => 'dashicons dashicons-tagcloud',
				    'description' => esc_html__( 'Set widgets in your sidebar, Offcanvas as well as footer.', 'news-box' ),
				    'button_text' => esc_html__( 'Add Widgets', 'news-box' ),
				    'button_url'  => admin_url().'/widgets.php',
				    'button_type' => 'link',
				    'is_new_tab'  => true,
				),
				'five' => array(
					'title'       => esc_html__( 'Theme Preview', 'news-box' ),
					'icon'        => 'dashicons dashicons-welcome-view-site',
					'description' => esc_html__( 'You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized. Theme demo only work in pro theme', 'news-box' ),
					'button_text' => esc_html__( 'View Demo', 'news-box' ),
					'button_url'  => 'http://wpthemespace.com/theme/news-box/',
					'button_type' => 'link',
					'is_new_tab'  => true,
					),
                'six' => array(
                    'title'       => esc_html__( 'Contact Support', 'news-box' ),
                    'icon'        => 'dashicons dashicons-sos',
                    'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'news-box' ),
                    'button_text' => esc_html__( 'Contact Support', 'news-box' ),
                    'button_url'  => 'https://wpthemespace.com/support/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
				),

					'useful_plugins'        => array(
						'description' => esc_html__( 'Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'news-box' ),
						'already_activated_message' => esc_html__( 'Already activated', 'news-box' ),
						'version_label' => esc_html__( 'Version: ', 'news-box' ),
						'install_label' => esc_html__( 'Install and Activate', 'news-box' ),
						'activate_label' => esc_html__( 'Activate', 'news-box' ),
						'deactivate_label' => esc_html__( 'Deactivate', 'news-box' ),
						'content'                   => array(
							array(
								'slug' => 'gallery-box',
								'icon' => 'svg',
							),
							array(
								'slug' => 'click-to-top',
								'icon' => 'svg',
							),
							array(
								'slug' => 'magical-posts-display',
								'icon' => 'svg',
							)
						),
					),
					// Required actions array.
					'recommended_actions'        => array(
						'install_label' => esc_html__( 'Install and Activate', 'news-box' ),
						'activate_label' => esc_html__( 'Activate', 'news-box' ),
						'deactivate_label' => esc_html__( 'Deactivate', 'news-box' ),
						'content'            => array(
							'gallery-box' => array(
								'title'       => __('Gallery Box', 'news-box' ),
								'description' => __( 'These recommended plugin is the best image and video gallery plugin. You may show your image, video and portfolio by this gallery plugin.', 'news-box' ),
								'plugin_slug' => 'gallery-box',
								'id' => 'gallery-box'
							),
							'go-pro' => array(
								'title'       => '<a target="_blank" class="activate-now button button-danger" href="https://wpthemespace.com/product/news-box/">'.__('UPGRADE TO PRO','news-box').'</a>',
								'description' => __( 'Buy One time and get lifetime update, Advnced feature, SEO advantage, high quality performance and support. So why late?', 'news-box' ),
								//'plugin_slug' => 'x-instafeed',
								'id' => 'go-pro'
							),
						),
					),
			// Free vs pro array.
			'free_pro'                => array(
				'free_theme_name'     => __('news-box','news-box'),
				'pro_theme_name'      => __('News Box Pro','news-box'),
				'pro_theme_link'      => 'https://wpthemespace.com/product/news-box/',
				/* translators: View link */
				'get_pro_theme_label' => sprintf( __( 'Get %s', 'news-box' ), 'News Box Pro' ),
				'features'            => array(
					array(
						'title'       => esc_html__( 'Daring Design for Devoted Readers', 'news-box' ),
						'description' => esc_html__( 'news box\'s design helps you stand out from the crowd and create an experience that your readers will love and talk about. With a flexible home page you have the chance to easily showcase appealing content with ease.', 'news-box' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Mobile-Ready For All Devices', 'news-box' ),
						'description' => esc_html__( 'News Box makes room for your readers to enjoy your articles on the go, no matter the device their using. We shaped everything to look amazing to your audience.', 'news-box' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Home slider', 'news-box' ),
						'description' => esc_html__( 'News Box gives you extra slider feature. You can create awesome home slider in this theme.', 'news-box' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Widgetized Sidebars To Keep Attention', 'news-box' ),
						'description' => esc_html__( 'News Box comes with a widget-based flexible system which allows you to add your favorite widgets over the Sidebar as well as on offcanvas too.', 'news-box' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Multiple Header Layout', 'news-box' ),
						'description' => esc_html__( 'News Box gives you extra ways to showcase your header with miltiple layout option you can change it on the basis of your requirement', 'news-box' ),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Banner Slider Options', 'news-box' ),
						'description' => esc_html__( 'news box\'s PRO version comes with more Slider options to display and filter posts. For instance, you can have far more control on setting the source of the posts or how they are displayed, everything to push the content to the right people and promote it by the blink of an eye.', 'news-box' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Flexible Home Page Design', 'news-box' ),
						'description' => esc_html__( 'news box\'s PRO version has more controll available to enable you to place widgets on Footer or Below the Post at the end of your articles.', 'news-box' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Masonry grid layout', 'news-box' ),
						'description' => esc_html__( 'News Box PRO verison has masonry grid layout so you can show your blog with awesome masonry grid layout with all devices supporte.', 'news-box' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Advance Customizer Options', 'news-box' ),
						'description' => esc_html__( 'Advance control for each element gives you different way of customization and maintained you site as you like and makes you feel different.', 'news-box' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Advance Pagination', 'news-box' ),
						'description' => esc_html__( 'Multiple Option of pagination via customizer can be obtained on your site like Infinite scroll, Ajax Button On Click, Number as well as classical option are available.','news-box' ),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Flexible Color Scheme', 'news-box' ),
						'description' => esc_html__( 'Match your unique style in an easy and smart way by using an intuitive interface that you can fine-tune it until it fully represents you and matches your particular blogging needs.','news-box' ),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Advance custom widget', 'news-box' ),
						'description' => esc_html__( 'You can show your news, blog content beautifully by advanced custom widget. It\'s an awesome feature in the news box theme','news-box' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'Premium Support and Assistance', 'news-box' ),
						'description' => esc_html__( 'We offer ongoing customer support to help you get things done in due time. This way, you save energy and time, and focus on what brings you happiness. We know our products inside-out and we can lend a hand to help you save resources of all kinds.','news-box' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__( 'No Credit Footer Link', 'news-box' ),
						'description' => esc_html__( 'You can easily remove the Theme: News Box by News Box copyright from the footer area and make the theme yours from start to finish.', 'news-box' ),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
				),
			),

			);

		news_box_About::init( $config );
	}

endif;

add_action( 'after_setup_theme', 'news_box_about_setup' );

