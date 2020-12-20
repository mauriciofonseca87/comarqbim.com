<?php

if ( ! function_exists( 'diefinnhutte_core_register_widgets' ) ) {
	function diefinnhutte_core_register_widgets() {
		$widgets = apply_filters( 'diefinnhutte_core_filter_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'diefinnhutte_core_register_widgets' );
}