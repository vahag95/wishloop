<?php

namespace App\Contracts;

interface TrafficServiceInterface {	

	/**
	 * Get all resources from storage.
	 *
	 * @return Response
	*/
	public function getAllTraffics();

	/**
	 * Get a specified resource from storage.
	 *
	 * @return Response
	*/
	public function getTrafficById($id);

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	*/
	public function create($inputs);

	/**
	 * Update resource in storage.
	 *
	 * @return Response
	*/
	public function update($id, $inputs);	

	/**
	 * Delete a newly created resource in storage.
	 *
	 * @return Response
	*/
	public function delete($id);
}