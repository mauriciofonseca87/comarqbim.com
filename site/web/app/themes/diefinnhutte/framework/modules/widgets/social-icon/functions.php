<?php

if ( ! function_exists( 'diefinnhutte_select_register_social_icon_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function diefinnhutte_select_register_social_icon_widget( $widgets ) {
		$widgets[] = 'DieFinnhutteSelectClassSocialIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'diefinnhutte_core_filter_register_widgets', 'diefinnhutte_select_register_social_icon_widget' );
}