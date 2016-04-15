<?php

namespace App\Services;

use App\Models\TrafficGenerationClick;
use App\Contracts\TrafficGenerationClicksServiceInterface;

class TrafficGenerationClicksService implements TrafficGenerationClicksServiceInterface {

	public function __construct(TrafficGenerationClick $traffic_generation_click) {
		$this->traffic_generation_click = $traffic_generation_click;
	}

	public function addClick($inputs)
	{		
		return $this->traffic_generation_click->create($inputs);
	}
}