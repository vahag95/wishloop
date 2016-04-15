<?php

namespace App\Services;

use App\Models\HelloBar;
use App\Contracts\HelloBarServiceInterface;

class HelloBarService implements HelloBarServiceInterface {

	public function __construct(HelloBar $hello_bar) {
		$this->hello_bar = $hello_bar;
	}

	public function getAllHelloBars()
	{
		return $this->hello_bar->get();
	}
	
	public function getHelloBarById($id)
	{
		return $this->hello_bar->find($id);
	}

	public function getHelloBarByToken($token)
	{
		return $this->hello_bar->where('token', $token)->first();
	}

	private function createInputs($inputs)
	{
		$token = str_random(32);
		$inputs['token'] = $token;
		if($inputs['position'] == 'top') {
			$inputs['embed_code'] = '<link rel="stylesheet" type="text/css" href="'.\URL::to('/').'/assets/css/hello-bar.css"><script type="text/javascript" src="'.\URL::to('/').'/assets/js/hello-bar.js"></script><div id="wl-hb-cont" class="wl-hb-cont wl-hb-top"><div class="wl-hb-close" onclick="wl_hb_close()">x</div><iframe src="'.\URL::to('/').'/hello-bar-preview/'.$token.'"></iframe></div>';
		} else {
			$inputs['embed_code'] = '<link rel="stylesheet" type="text/css" href="'.\URL::to('/').'/assets/css/hello-bar.css"><script type="text/javascript" src="'.\URL::to('/').'/assets/js/hello-bar.js"></script><div id="wl-hb-cont" class="wl-hb-cont wl-hb-bottom"><div class="wl-hb-close" onclick="wl_hb_close()">x</div><iframe src="'.\URL::to('/').'/hello-bar-preview/'.$token.'"></iframe></div>';
		}

		return $inputs;
	}

	public function create($inputs)
	{
		return $this->hello_bar->create($this->createInputs($inputs));
	}

	private function updateInputs($id, $inputs)
	{
		$token = $this->getHelloBarById($id)->token;
		if($inputs['position'] == 'top') {
			$inputs['embed_code'] = '<link rel="stylesheet" type="text/css" href="'.\URL::to('/').'/assets/css/hello-bar.css"><script type="text/javascript" src="'.\URL::to('/').'/assets/js/hello-bar.js"></script><div id="wl-hb-cont" class="wl-hb-cont wl-hb-top"><div class="wl-hb-close" onclick="wl_hb_close()">x</div><iframe src="'.\URL::to('/').'/hello-bar-preview/'.$token.'"></iframe></div>';
		} else {
			$inputs['embed_code'] = '<link rel="stylesheet" type="text/css" href="'.\URL::to('/').'/assets/css/hello-bar.css"><script type="text/javascript" src="'.\URL::to('/').'/assets/js/hello-bar.js"></script><div id="wl-hb-cont" class="wl-hb-cont wl-hb-bottom"><div class="wl-hb-close" onclick="wl_hb_close()">x</div><iframe src="'.\URL::to('/').'/hello-bar-preview/'.$token.'"></iframe></div>';
		}
		return $inputs;
	}

	public function update($id, $inputs)
	{
		return $this->getHelloBarById($id)->update($this->updateInputs($id, $inputs));
	}

	public function delete($id)
	{
		return $this->getHelloBarById($id)->delete();
	}


}