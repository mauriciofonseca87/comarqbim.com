<?php

if ( ! function_exists( 'diefinnhutte_core_enqueue_scripts_for_portfolio_list_shortcode' ) ) {
    /**
     * Function that includes all necessary 3rd party scripts for this shortcode
     */
    function diefinnhutte_core_enqueue_scripts_for_portfolio_list_shortcode() {
        wp_enqueue_script( 'justified-gallery', DIEFINNHUTTE_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-list/assets/js/plugins/jquery.justifiedGallery.min.js', array( 'jquery' ), false, true );
    }

    add_action( 'diefinnhutte_select_action_enqueue_third_party_scripts', 'diefinnhutte_core_enqueue_scripts_for_portfolio_list_shortcode' );
}

if ( ! function_exists( 'diefinnhutte_core_add_portfolio_list_shortcode' ) ) {
	function diefinnhutte_core_add_portfolio_list_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'DieFinnhutteCore\CPT\Shortcodes\Portfolio\PortfolioList'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'diefinnhutte_core_filter_add_vc_shortcode', 'diefinnhutte_core_add_portfolio_list_shortcode' );
}

if ( ! function_exists( 'diefinnhutte_core_set_portfolio_list_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for portfolio list shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function diefinnhutte_core_set_portfolio_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-portfolio';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'diefinnhutte_core_filter_add_vc_shortcodes_custom_icon_class', 'diefinnhutte_core_set_portfolio_list_icon_class_name_for_vc_shortcodes' );
}