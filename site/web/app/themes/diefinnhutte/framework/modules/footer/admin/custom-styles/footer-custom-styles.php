<?php

if ( ! function_exists( 'diefinnhutte_select_footer_top_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer top area
	 */
	function diefinnhutte_select_footer_top_general_styles() {
		$item_styles      = array();
		$background_color = diefinnhutte_select_options()->getOptionValue( 'footer_top_background_color' );
		$border_color     = diefinnhutte_select_options()->getOptionValue( 'footer_top_border_color' );
		$border_width     = diefinnhutte_select_options()->getOptionValue( 'footer_top_border_width' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $border_color ) ) {
			$item_styles['border-color'] = $border_color;
			
			if ( $border_width === '' ) {
				$item_styles['border-width'] = '1px';
			}
		}
		
		if ( $border_width !== '' ) {
			$item_styles['border-width'] = diefinnhutte_select_filter_px( $border_width ) . 'px';
		}
		
		echo diefinnhutte_select_dynamic_css( '.qodef-page-footer .qodef-footer-top-holder', $item_styles );
	}
	
	add_action( 'diefinnhutte_select_action_style_dynamic', 'diefinnhutte_select_footer_top_general_styles' );
}

if ( ! function_exists( 'diefinnhutte_select_footer_bottom_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer bottom area
	 */
	function diefinnhutte_select_footer_bottom_general_styles() {
		$item_styles      = array();
		$background_color = diefinnhutte_select_options()->getOptionValue( 'footer_bottom_background_color' );
		$border_color     = diefinnhutte_select_options()->getOptionValue( 'footer_bottom_border_color' );
		$border_width     = diefinnhutte_select_options()->getOptionValue( 'footer_bottom_border_width' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $border_color ) ) {
			$item_styles['border-color'] = $border_color;
			
			if ( $border_width === '' ) {
				$item_styles['border-width'] = '1px';
			}
		}
		
		if ( $border_width !== '' ) {
			$item_styles['border-width'] = diefinnhutte_select_filter_px( $border_width ) . 'px';
		}
		
		echo diefinnhutte_select_dynamic_css( '.qodef-page-footer .qodef-footer-bottom-holder', $item_styles );
	}
	
	add_action( 'diefinnhutte_select_action_style_dynamic', 'diefinnhutte_select_footer_bottom_general_styles' );
}