<?php

if ( ! function_exists( 'diefinnhutte_select_register_social_icons_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function diefinnhutte_select_register_social_icons_widget( $widgets ) {
		$widgets[] = 'DieFinnhutteSelectClassClassIconsGroupWidget';
		
		return $widgets;
	}
	
	add_filter( 'diefinnhutte_core_filter_register_widgets', 'diefinnhutte_select_register_social_icons_widget' );
}