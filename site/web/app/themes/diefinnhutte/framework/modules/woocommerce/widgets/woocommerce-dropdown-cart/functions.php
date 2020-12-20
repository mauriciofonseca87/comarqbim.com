<?php

if ( ! function_exists( 'diefinnhutte_select_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function diefinnhutte_select_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'DieFinnhutteSelectClassWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'diefinnhutte_core_filter_register_widgets', 'diefinnhutte_select_register_woocommerce_dropdown_cart_widget' );
}

if ( ! function_exists( 'diefinnhutte_select_get_dropdown_cart_icon_class' ) ) {
	/**
	 * Returns dropdow cart icon class
	 */
	function diefinnhutte_select_get_dropdown_cart_icon_class() {
		$classes = array(
			'qodef-header-cart'
		);
		
		$classes[] = diefinnhutte_select_get_icon_sources_class( 'dropdown_cart', 'qodef-header-cart' );
		
		return $classes;
	}
}