<?php

/*** Child Theme Function  ***/

if ( ! function_exists( 'diefinnhutte_select_child_theme_enqueue_scripts' ) ) {
	function diefinnhutte_select_child_theme_enqueue_scripts() {
		$parent_style = 'diefinnhutte-select-default-style';
		
		wp_enqueue_style( 'diefinnhutte-select-child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'diefinnhutte_select_child_theme_enqueue_scripts' );
}