<?php

if ( ! function_exists( 'diefinnhutte_core_testimonials_meta_box_functions' ) ) {
	function diefinnhutte_core_testimonials_meta_box_functions( $post_types ) {
		$post_types[] = 'testimonials';
		
		return $post_types;
	}
	
	add_filter( 'diefinnhutte_select_filter_meta_box_post_types_save', 'diefinnhutte_core_testimonials_meta_box_functions' );
	add_filter( 'diefinnhutte_select_filter_meta_box_post_types_remove', 'diefinnhutte_core_testimonials_meta_box_functions' );
}

if ( ! function_exists( 'diefinnhutte_core_register_testimonials_cpt' ) ) {
	function diefinnhutte_core_register_testimonials_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'DieFinnhutteCore\CPT\Testimonials\TestimonialsRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'diefinnhutte_core_filter_register_custom_post_types', 'diefinnhutte_core_register_testimonials_cpt' );
}

// Load testimonials shortcodes
if ( ! function_exists( 'diefinnhutte_core_include_testimonials_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function diefinnhutte_core_include_testimonials_shortcodes_files() {
		foreach ( glob( DIEFINNHUTTE_CORE_CPT_PATH . '/testimonials/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	add_action( 'diefinnhutte_core_action_include_shortcodes_file', 'diefinnhutte_core_include_testimonials_shortcodes_files' );
}