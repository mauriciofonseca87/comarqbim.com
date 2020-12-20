<?php

if ( ! function_exists( 'diefinnhutte_select_get_header_minimal_full_screen_menu' ) ) {
	/**
	 * Loads fullscreen menu HTML template
	 */
	function diefinnhutte_select_get_header_minimal_full_screen_menu() {
		$parameters = array(
			'fullscreen_menu_in_grid' => diefinnhutte_select_options()->getOptionValue( 'fullscreen_in_grid' ) === 'yes' ? true : false,
            'fullscreen_menu_icon_class' => diefinnhutte_select_get_fullscreen_menu_icon_class()
		);
		
		diefinnhutte_select_get_module_template_part( 'templates/full-screen-menu', 'header/types/header-minimal', '', $parameters );
	}
	
	if ( diefinnhutte_select_check_is_header_type_enabled( 'header-minimal', diefinnhutte_select_get_page_id() ) ) {
		add_action( 'diefinnhutte_select_action_after_wrapper_inner', 'diefinnhutte_select_get_header_minimal_full_screen_menu', 40 );
	}
}

if ( ! function_exists( 'diefinnhutte_select_header_minimal_mobile_menu_module' ) ) {
    /**
     * Function that edits module for mobile menu
     *
     * @param $module - default module value
     *
     * @return string name of module
     */
    function diefinnhutte_select_header_minimal_mobile_menu_module( $module ) {
        return 'header/types/header-minimal';
    }

    if ( diefinnhutte_select_check_is_header_type_enabled( 'header-minimal', diefinnhutte_select_get_page_id() ) ) {
        add_filter('diefinnhutte_select_filter_mobile_menu_module', 'diefinnhutte_select_header_minimal_mobile_menu_module');
    }
}

if ( ! function_exists( 'diefinnhutte_select_header_minimal_mobile_menu_slug' ) ) {
    /**
     * Function that edits slug for mobile menu
     *
     * @param $slug - default slug value
     *
     * @return string name of slug
     */
    function diefinnhutte_select_header_minimal_mobile_menu_slug( $slug ) {
        return 'minimal';
    }

    if ( diefinnhutte_select_check_is_header_type_enabled( 'header-minimal', diefinnhutte_select_get_page_id() ) ) {
        add_filter('diefinnhutte_select_filter_mobile_menu_slug', 'diefinnhutte_select_header_minimal_mobile_menu_slug');
    }
}

if ( ! function_exists( 'diefinnhutte_select_header_minimal_mobile_menu_parameters' ) ) {
    /**
     * Function that edits parameters for mobile menu
     *
     * @param $parameters - default parameters array values
     *
     * @return array of default values and classes for minimal mobile header
     */
    function diefinnhutte_select_header_minimal_mobile_menu_parameters( $parameters ) {

		$parameters['fullscreen_menu_icon_class'] = diefinnhutte_select_get_fullscreen_menu_icon_class();

        return $parameters;
    }

    if ( diefinnhutte_select_check_is_header_type_enabled( 'header-minimal', diefinnhutte_select_get_page_id() ) ) {
        add_filter('diefinnhutte_select_filter_mobile_menu_parameters', 'diefinnhutte_select_header_minimal_mobile_menu_parameters');
    }
}