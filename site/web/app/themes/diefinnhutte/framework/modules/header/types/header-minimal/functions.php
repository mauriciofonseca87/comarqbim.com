<?php

if ( ! function_exists( 'diefinnhutte_select_register_header_minimal_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function diefinnhutte_select_register_header_minimal_type( $header_types ) {
		$header_type = array(
			'header-minimal' => 'DieFinnhutteSelectNamespace\Modules\Header\Types\HeaderMinimal'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'diefinnhutte_select_init_register_header_minimal_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function diefinnhutte_select_init_register_header_minimal_type() {
		add_filter( 'diefinnhutte_select_filter_register_header_type_class', 'diefinnhutte_select_register_header_minimal_type' );
	}
	
	add_action( 'diefinnhutte_select_action_before_header_function_init', 'diefinnhutte_select_init_register_header_minimal_type' );
}

if ( ! function_exists( 'diefinnhutte_select_include_header_minimal_full_screen_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function diefinnhutte_select_include_header_minimal_full_screen_menu( $menus ) {
		$menus['popup-navigation'] = esc_html__( 'Full Screen Navigation', 'diefinnhutte' );
		
		return $menus;
	}
	
	if ( diefinnhutte_select_check_is_header_type_enabled( 'header-minimal' ) ) {
		add_filter( 'diefinnhutte_select_filter_register_headers_menu', 'diefinnhutte_select_include_header_minimal_full_screen_menu' );
	}
}

if ( ! function_exists( 'diefinnhutte_select_get_fullscreen_menu_icon_class' ) ) {
	/**
	 * Loads full screen menu icon class
	 */
	function diefinnhutte_select_get_fullscreen_menu_icon_class() {
		$classes = array(
			'qodef-fullscreen-menu-opener'
		);
		
		$classes[] = diefinnhutte_select_get_icon_sources_class( 'fullscreen_menu', 'qodef-fullscreen-menu-opener' );
		
		return $classes;
	}
}