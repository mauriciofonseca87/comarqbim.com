<?php

if ( ! function_exists( 'diefinnhutte_select_dropdown_cart_icon_styles' ) ) {
	/**
	 * Generates styles for dropdown cart icon
	 */
	function diefinnhutte_select_dropdown_cart_icon_styles() {
		$icon_color       = diefinnhutte_select_options()->getOptionValue( 'dropdown_cart_icon_color' );
		$icon_hover_color = diefinnhutte_select_options()->getOptionValue( 'dropdown_cart_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo diefinnhutte_select_dynamic_css( '.qodef-shopping-cart-holder .qodef-header-cart a', array( 'color' => $icon_color ) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo diefinnhutte_select_dynamic_css( '.qodef-shopping-cart-holder .qodef-header-cart a:hover', array( 'color' => $icon_hover_color ) );
		}
	}
	
	add_action( 'diefinnhutte_select_action_style_dynamic', 'diefinnhutte_select_dropdown_cart_icon_styles' );
}