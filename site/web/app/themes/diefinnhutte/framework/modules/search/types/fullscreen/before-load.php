<?php

if ( ! function_exists( 'diefinnhutte_select_set_search_fullscreen_global_option' ) ) {
    /**
     * This function set search type value for search options map
     */
    function diefinnhutte_select_set_search_fullscreen_global_option( $search_type_options ) {
        $search_type_options['fullscreen'] = esc_html__( 'Fullscreen', 'diefinnhutte' );

        return $search_type_options;
    }

    add_filter( 'diefinnhutte_select_filter_search_type_global_option', 'diefinnhutte_select_set_search_fullscreen_global_option' );
}