<?php

namespace App\Services;

use App\Models\HelloBarClick;
use App\Contracts\HelloBarClicksServiceInterface;

class HelloBarClicksService implements HelloBarClicksServiceInterface {

	public function __construct(HelloBarClick $hello_bar_click) {
		$this->hello_bar_click = $hello_bar_click;
	}

	public function addClick($inputs)
	{		
		return $this->hello_bar_click->create($inputs);
	}
		
}