<?php

if ( ! function_exists( 'diefinnhutte_select_register_recent_posts_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function diefinnhutte_select_register_recent_posts_widget( $widgets ) {
		$widgets[] = 'DieFinnhutteSelectClassRecentPosts';
		
		return $widgets;
	}
	
	add_filter( 'diefinnhutte_core_filter_register_widgets', 'diefinnhutte_select_register_recent_posts_widget' );
}