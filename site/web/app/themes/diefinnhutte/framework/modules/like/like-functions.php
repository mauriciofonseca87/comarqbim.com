<?php

if ( ! function_exists( 'diefinnhutte_select_like' ) ) {
	/**
	 * Returns DieFinnhutteSelectClassLike instance
	 *
	 * @return DieFinnhutteSelectClassLike
	 */
	function diefinnhutte_select_like() {
		return DieFinnhutteSelectClassLike::get_instance();
	}
}

function diefinnhutte_select_get_like() {
	
	echo wp_kses( diefinnhutte_select_like()->add_like(), array(
		'span' => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'    => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'    => array(
			'href'  => true,
			'class' => true,
			'id'    => true,
			'title' => true,
			'style' => true
		)
	) );
}