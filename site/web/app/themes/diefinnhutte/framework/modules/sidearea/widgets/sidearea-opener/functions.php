<?php

if ( ! function_exists( 'diefinnhutte_select_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function diefinnhutte_select_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'DieFinnhutteSelectClassSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'diefinnhutte_core_filter_register_widgets', 'diefinnhutte_select_register_sidearea_opener_widget' );
}