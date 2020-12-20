<?php

if ( ! function_exists( 'diefinnhutte_select_get_subscribe_popup' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function diefinnhutte_select_get_subscribe_popup() {
		
		if ( diefinnhutte_select_options()->getOptionValue( 'enable_subscribe_popup' ) === 'yes' && ( diefinnhutte_select_options()->getOptionValue( 'subscribe_popup_contact_form' ) !== '' || diefinnhutte_select_options()->getOptionValue( 'subscribe_popup_title' ) !== '' ) ) {
			diefinnhutte_select_load_subscribe_popup_template();
		}
	}
	
	//Get subscribe popup HTML
	add_action( 'diefinnhutte_select_action_before_page_header', 'diefinnhutte_select_get_subscribe_popup' );
}

if ( ! function_exists( 'diefinnhutte_select_load_subscribe_popup_template' ) ) {
	/**
	 * Loads HTML template with parameters
	 */
	function diefinnhutte_select_load_subscribe_popup_template() {
		$parameters                       = array();
		$parameters['title']              = diefinnhutte_select_options()->getOptionValue( 'subscribe_popup_title' );
		$parameters['subtitle']           = diefinnhutte_select_options()->getOptionValue( 'subscribe_popup_subtitle' );
		$background_image_meta            = diefinnhutte_select_options()->getOptionValue( 'subscribe_popup_background_image' );
		$parameters['background_styles']  = ! empty( $background_image_meta ) ? 'background-image: url(' . esc_url( $background_image_meta ) . ')' : '';
		$parameters['contact_form']       = diefinnhutte_select_options()->getOptionValue( 'subscribe_popup_contact_form' );
		$parameters['contact_form_style'] = diefinnhutte_select_options()->getOptionValue( 'subscribe_popup_contact_form_style' );
		$parameters['enable_prevent']     = diefinnhutte_select_options()->getOptionValue( 'enable_subscribe_popup_prevent' );
		$parameters['prevent_behavior']   = diefinnhutte_select_options()->getOptionValue( 'subscribe_popup_prevent_behavior' );
		
		$holder_classes   = array();
		$holder_classes[] = $parameters['enable_prevent'] === 'yes' ? 'qodef-prevent-enable' : 'qodef-prevent-disable';
		$holder_classes[] = ! empty( $parameters['prevent_behavior'] ) ? 'qodef-prevent-' . $parameters['prevent_behavior'] : 'qodef-prevent-session';
		$holder_classes[] = ! empty( $background_image_meta ) ? 'qodef-sp-has-image' : '';
		
		$parameters['holder_classes'] = implode( ' ', $holder_classes );
		
		diefinnhutte_select_get_module_template_part( 'templates/subscribe-popup', 'subscribe-popup', '', $parameters );
	}
}