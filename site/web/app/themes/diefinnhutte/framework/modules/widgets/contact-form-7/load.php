<?php

if ( diefinnhutte_select_contact_form_7_installed() ) {
	include_once SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/contact-form-7/contact-form-7.php';
	
	add_filter( 'diefinnhutte_core_filter_register_widgets', 'diefinnhutte_select_register_cf7_widget' );
}

if ( ! function_exists( 'diefinnhutte_select_register_cf7_widget' ) ) {
	/**
	 * Function that register cf7 widget
	 */
	function diefinnhutte_select_register_cf7_widget( $widgets ) {
		$widgets[] = 'DieFinnhutteSelectClassContactForm7Widget';
		
		return $widgets;
	}
}