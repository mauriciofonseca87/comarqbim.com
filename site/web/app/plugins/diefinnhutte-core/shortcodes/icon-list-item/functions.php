<?php

if ( ! function_exists( 'diefinnhutte_core_add_icon_list_item_shortcodes' ) ) {
	function diefinnhutte_core_add_icon_list_item_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'DieFinnhutteCore\CPT\Shortcodes\IconListItem\IconListItem'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'diefinnhutte_core_filter_add_vc_shortcode', 'diefinnhutte_core_add_icon_list_item_shortcodes' );
}

if ( ! function_exists( 'diefinnhutte_core_set_icon_list_item_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for icon list item shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function diefinnhutte_core_set_icon_list_item_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-icon-list-item';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'diefinnhutte_core_filter_add_vc_shortcodes_custom_icon_class', 'diefinnhutte_core_set_icon_list_item_icon_class_name_for_vc_shortcodes' );
}