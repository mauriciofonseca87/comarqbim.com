<?php

if ( ! function_exists( 'diefinnhutte_select_register_header_standard_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function diefinnhutte_select_register_header_standard_type( $header_types ) {
		$header_type = array(
			'header-standard' => 'DieFinnhutteSelectNamespace\Modules\Header\Types\HeaderStandard'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'diefinnhutte_select_init_register_header_standard_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function diefinnhutte_select_init_register_header_standard_type() {
		add_filter( 'diefinnhutte_select_filter_register_header_type_class', 'diefinnhutte_select_register_header_standard_type' );
	}
	
	add_action( 'diefinnhutte_select_action_before_header_function_init', 'diefinnhutte_select_init_register_header_standard_type' );
}