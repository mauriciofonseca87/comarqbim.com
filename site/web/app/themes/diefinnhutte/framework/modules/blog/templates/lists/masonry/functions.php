<?php

if ( ! function_exists( 'diefinnhutte_select_register_blog_masonry_template_file' ) ) {
	/**
	 * Function that register blog masonry template
	 */
	function diefinnhutte_select_register_blog_masonry_template_file( $templates ) {
		$templates['blog-masonry'] = esc_html__( 'Blog: Masonry', 'diefinnhutte' );
		
		return $templates;
	}
	
	add_filter( 'diefinnhutte_select_filter_register_blog_templates', 'diefinnhutte_select_register_blog_masonry_template_file' );
}

if ( ! function_exists( 'diefinnhutte_select_set_blog_masonry_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function diefinnhutte_select_set_blog_masonry_type_global_option( $options ) {
		$options['masonry'] = esc_html__( 'Blog: Masonry', 'diefinnhutte' );
		
		return $options;
	}
	
	add_filter( 'diefinnhutte_select_filter_blog_list_type_global_option', 'diefinnhutte_select_set_blog_masonry_type_global_option' );
}