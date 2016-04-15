<?php

namespace App\Contracts;

interface HelloBarServiceInterface {	

	/**
	 * Get all resources from storage.
	 *
	 * @return Response
	*/
	public function getAllHelloBars();

	/**
	 * Get a specified resource from storage.
	 *
	 * @return Response
	*/
	public function getHelloBarById($id);

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