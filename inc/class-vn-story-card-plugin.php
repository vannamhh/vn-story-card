<?php
/**
 * Main plugin class for VN Story Card.
 *
 * @package vn-story-card
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VN Story Card Plugin bootstrap class.
 *
 * @since 1.0.0
 */
class VN_Story_Card_Plugin {

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * Plugin directory path.
	 *
	 * @var string
	 */
	private $plugin_path;

	/**
	 * Plugin directory URL.
	 *
	 * @var string
	 */
	private $plugin_url;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->plugin_path = plugin_dir_path( __DIR__ );
		$this->plugin_url  = plugin_dir_url( __DIR__ );

		$this->define_constants();
		$this->load_dependencies();
		$this->init_hooks();
	}

	/**
	 * Define plugin constants.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	private function define_constants() {
		define( 'VNSC_PATH', $this->plugin_path );
		define( 'VNSC_URL', $this->plugin_url );
		define( 'VNSC_VERSION', $this->version );
	}

	/**
	 * Load plugin dependencies.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	private function load_dependencies() {
		require_once __DIR__ . '/class-vn-story-card-shortcode.php';
		require_once __DIR__ . '/class-vn-story-cards-shortcode.php';
		require_once VNSC_PATH . 'inc/builder.php';
	}

	/**
	 * Initialize plugin hooks.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	private function init_hooks() {
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
	}

	/**
	 * Load plugin text domain for translations.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'vn-story-card', false, dirname( plugin_basename( $this->plugin_path ) ) . '/languages/' );
	}
}
