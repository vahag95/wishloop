<?php

namespace App\Services;

use App\Models\Traffic;
use App\Contracts\TrafficServiceInterface;

class TrafficService implements TrafficServiceInterface {

	public function __construct(Traffic $traffic) {
		$this->traffic = $traffic;
	}

	public function getAllTraffics()
	{
		return $this->traffic->get();
	}
	
	public function getTrafficById($id)
	{
		return $this->traffic->find($id);
	}

	public function getTrafficByToken($token)
	{
		return $this->traffic->where('token', $token)->first();
	}

	private function createInputs($inputs)
	{
		$token = str_random(32);
		$inputs['token'] = $token;
		$logo = $inputs['logo_path'];
		$ext = $logo->getClientOriginalExtension();
		$file_name = str_random(32).'.'.$ext;
		$logo->move(public_path().'/assets/logos', $file_name);
		$inputs['logo_path'] = '/assets/logos/'.$file_name;

		$inputs['embed_code'] = '<link rel="stylesheet" type="text/css" href="'.\URL::to('/').'/assets/css/traffic.css"><script type="text/javascript" src="'.\URL::to('/').'/assets/js/traffic.js"></script><div id="wl-tg-cont" class="wl-tg-cont"><div class="wl-tg-close" onclick="wl_tg_close()">x</div><iframe id="ifrm" src="'.\URL::to('/').'/traffic-preview/'.$token.'" scrolling="no" ></iframe></div>';

		return $inputs;
	}

	public function create($inputs)
	{
		return $this->traffic->create($this->createInputs($inputs));
	}

	private function updateInputs($inputs)
	{
		if (!isset($inputs['logo_path'])) {
			unset($inputs['logo_path']);
		} else {
			$logo = $inputs['logo_path'];
			$ext = $logo->getClientOriginalExtension();
			$file_name = str_random(32).'.'.$ext;
			$logo->move(public_path().'/assets/logos', $file_name);
			$inputs['logo_path'] = '/assets/logos/'.$file_name;
		}
		return $inputs;
	}

	public function update($id, $inputs)
	{
		return $this->getTrafficById($id)->update($this->updateInputs($inputs));
	}

	public function delete($id)
	{
		return $this->getTrafficById($id)->delete();
	}


}