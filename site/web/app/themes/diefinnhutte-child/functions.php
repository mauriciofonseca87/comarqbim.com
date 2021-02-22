<?php

/*** Child Theme Function  ***/

if ( ! function_exists( 'diefinnhutte_select_child_theme_enqueue_scripts' ) ) {
	function diefinnhutte_select_child_theme_enqueue_scripts() {
		$parent_style = 'diefinnhutte-select-default-style';
		
		wp_enqueue_style( 'diefinnhutte-select-child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'diefinnhutte_select_child_theme_enqueue_scripts' );
}

/**
* @snippet Remove the Postcode Field on the WooCommerce Checkout
* @how-to Get CustomizeWoo.com FREE
* @sourcecode https://businessbloomer.com/?p=461
* @author Rodolfo Melogli
* @testedwith WooCommerce 3.5.1
*/
 
add_filter( 'woocommerce_checkout_fields' , 'bbloomer_remove_billing_postcode_checkout' );
 
function bbloomer_remove_billing_postcode_checkout( $fields ) {
  unset($fields['billing']['billing_postcode']);
  return $fields;
}