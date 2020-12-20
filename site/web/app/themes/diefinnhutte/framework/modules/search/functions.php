<?php

if ( ! function_exists( 'diefinnhutte_select_include_search_types_before_load' ) ) {
    /**
     * Load's all header types before load files by going through all folders that are placed directly in header types folder.
     * Functions from this files before-load are used to set all hooks and variables before global options map are init
     */
    function diefinnhutte_select_include_search_types_before_load() {
        foreach ( glob( SELECT_FRAMEWORK_SEARCH_ROOT_DIR . '/types/*/before-load.php' ) as $module_load ) {
            include_once $module_load;
        }
    }

    add_action( 'diefinnhutte_select_action_options_map', 'diefinnhutte_select_include_search_types_before_load', 1 ); // 1 is set to just be before header option map init
}

if ( ! function_exists( 'diefinnhutte_select_load_search' ) ) {
	function diefinnhutte_select_load_search() {
		$search_type_meta = diefinnhutte_select_options()->getOptionValue( 'search_type' );
		$search_type      = ! empty( $search_type_meta ) ? $search_type_meta : 'fullscreen';
		
		if ( diefinnhutte_select_active_widget( false, false, 'qodef_search_opener' ) ) {
			include_once SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/search/types/' . $search_type . '/' . $search_type . '.php';
		}
	}
	
	add_action( 'init', 'diefinnhutte_select_load_search' );
}

if ( ! function_exists( 'diefinnhutte_select_get_holder_params_search' ) ) {
	/**
	 * Function which return holder class and holder inner class for blog pages
	 */
	function diefinnhutte_select_get_holder_params_search() {
		$params_list = array();
		
		$layout = diefinnhutte_select_options()->getOptionValue( 'search_page_layout' );
		if ( $layout == 'in-grid' ) {
			$params_list['holder'] = 'qodef-container';
			$params_list['inner']  = 'qodef-container-inner clearfix';
		} else {
			$params_list['holder'] = 'qodef-full-width';
			$params_list['inner']  = 'qodef-full-width-inner';
		}
		
		/**
		 * Available parameters for holder params
		 * -holder
		 * -inner
		 */
		return apply_filters( 'diefinnhutte_select_filter_search_holder_params', $params_list );
	}
}

if ( ! function_exists( 'diefinnhutte_select_get_search_page' ) ) {
	function diefinnhutte_select_get_search_page() {
		$sidebar_layout = diefinnhutte_select_sidebar_layout();
		
		$params = array(
			'sidebar_layout' => $sidebar_layout
		);
		
		diefinnhutte_select_get_module_template_part( 'templates/holder', 'search', '', $params );
	}
}

if ( ! function_exists( 'diefinnhutte_select_get_search_page_layout' ) ) {
	/**
	 * Function which create query for blog lists
	 */
	function diefinnhutte_select_get_search_page_layout() {
		global $wp_query;
		$path   = apply_filters( 'diefinnhutte_select_filter_search_page_path', 'templates/page' );
		$type   = apply_filters( 'diefinnhutte_select_filter_search_page_layout', 'default' );
		$module = apply_filters( 'diefinnhutte_select_filter_search_page_module', 'search' );
		$plugin = apply_filters( 'diefinnhutte_select_filter_search_page_plugin_override', false );
		
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		
		$params = array(
			'type'          => $type,
			'query'         => $wp_query,
			'paged'         => $paged,
			'max_num_pages' => diefinnhutte_select_get_max_number_of_pages(),
		);
		
		$params = apply_filters( 'diefinnhutte_select_filter_search_page_params', $params );
		
		diefinnhutte_select_get_module_template_part( $path . '/' . $type, $module, '', $params, $plugin );
	}
}

if ( ! function_exists( 'diefinnhutte_select_get_search_submit_icon_class' ) ) {
	/**
	 * Loads search submit icon class
	 */
	function diefinnhutte_select_get_search_submit_icon_class() {
		$classes = array(
			'qodef-search-submit'
		);
		
		$classes[] = diefinnhutte_select_get_icon_sources_class( 'search', 'qodef-search-submit' );

		return $classes;
	}
}

if ( ! function_exists( 'diefinnhutte_select_get_search_close_icon_class' ) ) {
	/**
	 * Loads search close icon class
	 */
	function diefinnhutte_select_get_search_close_icon_class() {
		$classes = array(
			'qodef-search-close'
		);
		
		$classes[] = diefinnhutte_select_get_icon_sources_class( 'search', 'qodef-search-close' );

		return $classes;
	}
}