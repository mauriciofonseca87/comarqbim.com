<?php

if ( ! function_exists( 'diefinnhutte_select_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function diefinnhutte_select_register_separator_widget( $widgets ) {
		$widgets[] = 'DieFinnhutteSelectClassSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'diefinnhutte_core_filter_register_widgets', 'diefinnhutte_select_register_separator_widget' );
}