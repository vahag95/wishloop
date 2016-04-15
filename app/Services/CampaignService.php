<?php

namespace App\Services;

use App\Models\Campaign;
use App\Contracts\CampaignServiceInterface;

class CampaignService implements CampaignServiceInterface {

	public function __construct(Campaign $campaign) {
		$this->campaign = $campaign;
	}

	public function getAllCampaigns()
	{
		return $this->campaign->get();
	}

	public function create($inputs)
	{
		return $this->campaign->create( $inputs );
	}

	public function getCampaignById( $id )
	{
		return $this->campaign->find( $id );
	}

	public function destroy( $id )
	{
		return $this->getCampaignById( $id )->delete();
	}
}