<?php

if ( ! function_exists( 'diefinnhutte_select_set_hide_dep_options_title_centered' ) ) {
	/**
	 * This function is used to hide all containers/panels for admin options when this title type is selected
	 */
	function diefinnhutte_select_set_hide_dep_options_title_centered( $hide_dep_options ) {
		return $hide_dep_options;
	}
	
	// hide breadcrumbs meta
	add_filter( 'diefinnhutte_select_filter_breadcrumbs_title_hide_meta_boxes', 'diefinnhutte_select_set_hide_dep_options_title_centered' );
}