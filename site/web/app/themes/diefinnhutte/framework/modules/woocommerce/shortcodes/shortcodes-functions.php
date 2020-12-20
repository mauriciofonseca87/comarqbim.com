<?php

if ( ! function_exists( 'diefinnhutte_select_include_woocommerce_shortcodes' ) ) {
	function diefinnhutte_select_include_woocommerce_shortcodes() {
		foreach ( glob( SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	if ( diefinnhutte_select_core_plugin_installed() ) {
		add_action( 'diefinnhutte_core_action_include_shortcodes_file', 'diefinnhutte_select_include_woocommerce_shortcodes' );
	}
}
