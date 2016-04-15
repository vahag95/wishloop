<?php namespace App\Contracts;

interface FacebookServiceInterface {

	/**
	 * create resource service.
	 *
	 * @param array $inputs
	 * @return boolean
	 */
	public function create( $inputs );	
}