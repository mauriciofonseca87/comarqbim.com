<?php

if ( ! function_exists( 'diefinnhutte_select_set_header_divided_type_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function diefinnhutte_select_set_header_divided_type_global_option( $header_types ) {
		$header_types['header-divided'] = array(
			'image' => SELECT_FRAMEWORK_HEADER_TYPES_ROOT . '/header-divided/assets/img/header-divided.png',
			'label' => esc_html__( 'Divided', 'diefinnhutte' )
		);
		
		return $header_types;
	}
	
	add_filter( 'diefinnhutte_select_filter_header_type_global_option', 'diefinnhutte_select_set_header_divided_type_global_option' );
}

if ( ! function_exists( 'diefinnhutte_select_set_header_divided_type_meta_boxes_option' ) ) {
	/**
	 * This function set header type value for header meta boxes map
	 */
	function diefinnhutte_select_set_header_divided_type_meta_boxes_option( $header_type_options ) {
		$header_type_options['header-divided'] = esc_html__( 'Divided', 'diefinnhutte' );
		
		return $header_type_options;
	}
	
	add_filter( 'diefinnhutte_select_filter_header_type_meta_boxes', 'diefinnhutte_select_set_header_divided_type_meta_boxes_option' );
}

if ( ! function_exists( 'diefinnhutte_select_set_hide_dep_options_header_divided' ) ) {
	/**
	 * This function is used to hide all containers/panels for admin options when this header type is selected
	 */
	function diefinnhutte_select_set_hide_dep_options_header_divided( $hide_dep_options ) {
		$hide_dep_options[] = 'header-divided';
		
		return $hide_dep_options;
	}
	
	// header global panel options
	add_filter( 'diefinnhutte_select_filter_header_logo_area_hide_global_option', 'diefinnhutte_select_set_hide_dep_options_header_divided' );
	
	// header global panel meta boxes
	add_filter( 'diefinnhutte_select_filter_header_logo_area_hide_meta_boxes', 'diefinnhutte_select_set_hide_dep_options_header_divided' );
	
	// header types panel options
	add_filter( 'diefinnhutte_select_filter_full_screen_menu_hide_global_option', 'diefinnhutte_select_set_hide_dep_options_header_divided' );
	add_filter( 'diefinnhutte_select_filter_header_centered_hide_global_option', 'diefinnhutte_select_set_hide_dep_options_header_divided' );
	add_filter( 'diefinnhutte_select_filter_header_standard_hide_global_option', 'diefinnhutte_select_set_hide_dep_options_header_divided' );
	add_filter( 'diefinnhutte_select_filter_header_vertical_hide_global_option', 'diefinnhutte_select_set_hide_dep_options_header_divided' );
	add_filter( 'diefinnhutte_select_filter_header_vertical_menu_hide_global_option', 'diefinnhutte_select_set_hide_dep_options_header_divided' );

	// header types panel meta boxes
	add_filter( 'diefinnhutte_select_filter_header_centered_hide_meta_boxes', 'diefinnhutte_select_set_hide_dep_options_header_divided' );
	add_filter( 'diefinnhutte_select_filter_header_standard_hide_meta_boxes', 'diefinnhutte_select_set_hide_dep_options_header_divided' );
	add_filter( 'diefinnhutte_select_filter_header_vertical_hide_meta_boxes', 'diefinnhutte_select_set_hide_dep_options_header_divided' );
}