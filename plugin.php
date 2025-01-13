<?php
namespace ISWT_Widget;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function widget_styles() {
		wp_register_style( 'image-slider-with-tabs-style', plugins_url( '/assets/css/image-slider-with-tabs.css', __FILE__ ), ['swiper'], '1.0.000' );
	}

	public function widget_scripts() {
        wp_register_script('swiper', ELEMENTOR_ASSETS_URL . '/lib/swiper/swiper.min.js', ['jquery'], false, true);

		wp_register_script( 'image-slider-with-tabs-script', plugins_url( '/assets/js/image-slider-with-tabs.js', __FILE__ ), [ 'jquery', 'swiper' ], '1.0.000', true );
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {
		// Its is now safe to include Widgets files
		require_once( __DIR__ . '/widgets/iswt-widget.php' );

		// Register Widgets
		$widgets_manager->register( new Widgets\ISWT_Widget() );
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {
		// Register widget styles
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'widget_styles' ] );

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
	}
}

// Instantiate Plugin Class
Plugin::instance();
