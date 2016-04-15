<?php namespace App\Contracts;

interface CampaignClicksServiceInterface {

	/**
	 * create resource service.
	 *
	 * @param array $inputs
	 * @return boolean
	 */
	public function create( $inputs );	
}