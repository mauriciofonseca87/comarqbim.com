<?php

if ( ! function_exists( 'diefinnhutte_core_add_dropcaps_shortcodes' ) ) {
	function diefinnhutte_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'DieFinnhutteCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'diefinnhutte_core_filter_add_vc_shortcode', 'diefinnhutte_core_add_dropcaps_shortcodes' );
}