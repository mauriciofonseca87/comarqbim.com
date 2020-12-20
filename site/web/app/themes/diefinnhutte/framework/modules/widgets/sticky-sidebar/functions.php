<?php

if ( ! function_exists( 'diefinnhutte_select_register_sticky_sidebar_widget' ) ) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function diefinnhutte_select_register_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'DieFinnhutteSelectClassStickySidebar';
		
		return $widgets;
	}
	
	add_filter( 'diefinnhutte_core_filter_register_widgets', 'diefinnhutte_select_register_sticky_sidebar_widget' );
}