<?php namespace App\Contracts;

interface CampaignServiceInterface {

	/**
	 * create resource service.
	 *
	 * @param array $inputs
	 * @return boolean
	 */
	public function create( $inputs );	
}