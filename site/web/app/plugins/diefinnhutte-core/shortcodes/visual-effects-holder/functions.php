<?php
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Qodef_Visual_Effects_Holder extends WPBakeryShortCodesContainer {}
}

if(!function_exists('diefinnhutte_core_add_visual_effects_holder_shortcodes')) {
	function diefinnhutte_core_add_visual_effects_holder_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'DieFinnhutteCore\CPT\Shortcodes\VisualEffectsHolder\VisualEffectsHolder'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('diefinnhutte_core_filter_add_vc_shortcode', 'diefinnhutte_core_add_visual_effects_holder_shortcodes');
}

if ( ! function_exists( 'diefinnhutte_core_set_visual_effects_holder_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for visual effects holder shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function diefinnhutte_core_set_visual_effects_holder_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-visual-effects-holder';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'diefinnhutte_core_filter_add_vc_shortcodes_custom_icon_class', 'diefinnhutte_core_set_visual_effects_holder_icon_class_name_for_vc_shortcodes' );
}