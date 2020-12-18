<?php

if ( ! function_exists( 'diefinnhutte_select_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function diefinnhutte_select_register_icon_widget( $widgets ) {
		$widgets[] = 'DieFinnhutteSelectClassIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'diefinnhutte_core_filter_register_widgets', 'diefinnhutte_select_register_icon_widget' );
}