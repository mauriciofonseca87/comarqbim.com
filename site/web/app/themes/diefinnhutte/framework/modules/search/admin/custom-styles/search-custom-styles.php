<?php

if ( ! function_exists( 'diefinnhutte_select_search_opener_icon_size' ) ) {
	function diefinnhutte_select_search_opener_icon_size() {
		$icon_size = diefinnhutte_select_options()->getOptionValue( 'header_search_icon_size' );
		
		if ( ! empty( $icon_size ) ) {
			echo diefinnhutte_select_dynamic_css( '.qodef-search-opener', array(
				'font-size' => diefinnhutte_select_filter_px( $icon_size ) . 'px'
			) );
		}
	}
	
	add_action( 'diefinnhutte_select_action_style_dynamic', 'diefinnhutte_select_search_opener_icon_size' );
}

if ( ! function_exists( 'diefinnhutte_select_search_opener_icon_colors' ) ) {
	function diefinnhutte_select_search_opener_icon_colors() {
		$icon_color       = diefinnhutte_select_options()->getOptionValue( 'header_search_icon_color' );
		$icon_hover_color = diefinnhutte_select_options()->getOptionValue( 'header_search_icon_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo diefinnhutte_select_dynamic_css( '.qodef-search-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo diefinnhutte_select_dynamic_css( '.qodef-search-opener:hover', array(
				'color' => $icon_hover_color
			) );
		}
	}
	
	add_action( 'diefinnhutte_select_action_style_dynamic', 'diefinnhutte_select_search_opener_icon_colors' );
}

if ( ! function_exists( 'diefinnhutte_select_search_opener_text_styles' ) ) {
	function diefinnhutte_select_search_opener_text_styles() {
		$item_styles = diefinnhutte_select_get_typography_styles( 'search_icon_text' );
		
		$item_selector = array(
			'.qodef-search-icon-text'
		);
		
		echo diefinnhutte_select_dynamic_css( $item_selector, $item_styles );
		
		$text_hover_color = diefinnhutte_select_options()->getOptionValue( 'search_icon_text_color_hover' );
		
		if ( ! empty( $text_hover_color ) ) {
			echo diefinnhutte_select_dynamic_css( '.qodef-search-opener:hover .qodef-search-icon-text', array(
				'color' => $text_hover_color
			) );
		}
	}
	
	add_action( 'diefinnhutte_select_action_style_dynamic', 'diefinnhutte_select_search_opener_text_styles' );
}