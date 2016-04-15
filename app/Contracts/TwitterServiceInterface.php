<?php namespace App\Contracts;

interface TwitterServiceInterface {

	/**
	 * create resource service.
	 *
	 * @param array $inputs
	 * @return boolean
	 */
	public function create( $inputs );	
}