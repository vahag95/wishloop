<?php

namespace App\Services;

use App\Models\Url;
use App\Contracts\UrlServiceInterface;

class UrlService implements UrlServiceInterface {

	public function __construct(Url $url) {
		$this->url = $url;
	}

	public function getUrlByToken($token)
	{
		return $this->url->where('token', $token)->first();
	}
		
	private function createInputs($inputs)
	{
		return $inputs;
	}

	public function create($inputs)
	{
		return $this->url->create($this->createInputs($inputs));
	}

}
