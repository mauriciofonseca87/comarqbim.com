<?php

if ( ! function_exists( 'diefinnhutte_select_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function diefinnhutte_select_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'DieFinnhutteSelectClassImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'diefinnhutte_core_filter_register_widgets', 'diefinnhutte_select_register_image_gallery_widget' );
}