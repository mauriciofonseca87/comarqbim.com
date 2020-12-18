<?php

if ( ! function_exists( 'diefinnhutte_select_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function diefinnhutte_select_register_blog_list_widget( $widgets ) {
		$widgets[] = 'DieFinnhutteSelectClassBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'diefinnhutte_core_filter_register_widgets', 'diefinnhutte_select_register_blog_list_widget' );
}