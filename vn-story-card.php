<?php
/**
 * Plugin Name: VN Story Card
 * Plugin URI: https://ztavi.com
 * Description: Custom story card shortcode for Flatsome theme - displays success stories with post selection
 * Version: 1.0.2
 * Author: Van Nam
 * Author URI: https://ztavi.com
 * Text Domain: vn-story-card
 * Domain Path: /languages
 *
 * @package vn-story-card
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Initialize plugin.
 *
 * @return void
 */
function vnsc_init() {
	require_once plugin_dir_path( __FILE__ ) . 'inc/class-vn-story-card-plugin.php';
	new VN_Story_Card_Plugin();
}
add_action( 'after_setup_theme', 'vnsc_init' );
