<?php

if ( ! function_exists( 'diefinnhutte_select_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function diefinnhutte_select_register_author_info_widget( $widgets ) {
		$widgets[] = 'DieFinnhutteSelectClassAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'diefinnhutte_core_filter_register_widgets', 'diefinnhutte_select_register_author_info_widget' );
}