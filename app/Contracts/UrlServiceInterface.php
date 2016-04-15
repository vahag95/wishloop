<?php

namespace App\Contracts;

interface UrlServiceInterface {	

	/**
	 * Get all resources from storage.
	 *
	 * @return Response
	*/
	public function getUrlByToken($token);

	/**
	 * Get a specified resource from storage.
	 *
	 * @return Response
	*/	
	public function create($inputs);	
}