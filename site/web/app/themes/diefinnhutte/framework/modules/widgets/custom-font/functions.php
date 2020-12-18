<?php

if ( ! function_exists( 'diefinnhutte_select_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function diefinnhutte_select_register_custom_font_widget( $widgets ) {
		$widgets[] = 'DieFinnhutteSelectClassCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'diefinnhutte_core_filter_register_widgets', 'diefinnhutte_select_register_custom_font_widget' );
}