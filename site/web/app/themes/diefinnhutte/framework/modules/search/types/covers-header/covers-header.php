<?php

if ( ! function_exists( 'diefinnhutte_select_search_body_class' ) ) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function diefinnhutte_select_search_body_class( $classes ) {
		$classes[] = 'qodef-search-covers-header';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'diefinnhutte_select_search_body_class' );
}

if ( ! function_exists( 'diefinnhutte_select_get_search' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function diefinnhutte_select_get_search() {
		diefinnhutte_select_load_search_template();
	}
	
	add_action( 'diefinnhutte_select_action_before_page_header_html_close', 'diefinnhutte_select_get_search' );
	add_action( 'diefinnhutte_select_action_before_mobile_header_html_close', 'diefinnhutte_select_get_search' );
}

if ( ! function_exists( 'diefinnhutte_select_load_search_template' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function diefinnhutte_select_load_search_template() {

		$search_in_grid   = diefinnhutte_select_options()->getOptionValue( 'search_in_grid' ) == 'yes' ? true : false;
		
		$parameters = array(
			'search_in_grid'    		=> $search_in_grid,
			'search_close_icon_class' 	=> diefinnhutte_select_get_search_close_icon_class()
		);
		
		diefinnhutte_select_get_module_template_part( 'types/covers-header/templates/covers-header', 'search', '', $parameters );
	}
}