<?php

if ( ! function_exists( 'diefinnhutte_select_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function diefinnhutte_select_register_button_widget( $widgets ) {
		$widgets[] = 'DieFinnhutteSelectClassButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'diefinnhutte_core_filter_register_widgets', 'diefinnhutte_select_register_button_widget' );
}