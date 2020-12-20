<?php

namespace DieFinnhutteCore\Lib;

/**
 * interface PostTypeInterface
 * @package DieFinnhutteCore\Lib;
 */
interface PostTypeInterface {
	/**
	 * @return string
	 */
	public function getBase();
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register();
}