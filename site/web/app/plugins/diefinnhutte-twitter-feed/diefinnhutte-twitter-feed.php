<?php
/*
Plugin Name: DieFinnhutte Twitter Feed
Description: Plugin that adds Twitter feed functionality to our theme
Author: Select Themes
Version: 1.0.2
*/

define( 'DIEFINNHUTTE_TWITTER_FEED_VERSION', '1.0.2' );
define( 'DIEFINNHUTTE_TWITTER_ABS_PATH', dirname( __FILE__ ) );
define( 'DIEFINNHUTTE_TWITTER_REL_PATH', dirname( plugin_basename( __FILE__ ) ) );
define( 'DIEFINNHUTTE_TWITTER_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'DIEFINNHUTTE_TWITTER_ASSETS_PATH', DIEFINNHUTTE_TWITTER_ABS_PATH . '/assets' );
define( 'DIEFINNHUTTE_TWITTER_ASSETS_URL_PATH', DIEFINNHUTTE_TWITTER_URL_PATH . 'assets' );
define( 'DIEFINNHUTTE_TWITTER_SHORTCODES_PATH', DIEFINNHUTTE_TWITTER_ABS_PATH . '/shortcodes' );
define( 'DIEFINNHUTTE_TWITTER_SHORTCODES_URL_PATH', DIEFINNHUTTE_TWITTER_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'diefinnhutte_twitter_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function diefinnhutte_twitter_theme_installed() {
		return defined( 'SELECT_ROOT' );
	}
}

if ( ! function_exists( 'diefinnhutte_twitter_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function diefinnhutte_twitter_feed_text_domain() {
		load_plugin_textdomain( 'diefinnhutte-twitter-feed', false, DIEFINNHUTTE_TWITTER_REL_PATH . '/languages' );
	}

	add_action( 'plugins_loaded', 'diefinnhutte_twitter_feed_text_domain' );
}