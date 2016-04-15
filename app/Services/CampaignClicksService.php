<?php

namespace App\Services;

use App\Models\CampaignClick;
use App\Contracts\CampaignClicksServiceInterface;

class CampaignClicksService implements CampaignClicksServiceInterface {

	public function __construct(CampaignClick $campaignClick) {
		$this->campaign_click = $campaignClick;
	}

	public function getAllClicks( $campaign_id )
	{
		return $this->campaign_click->where('campaign_id', $campaign_id)->get();
	}

	public function create($inputs)
	{
		return $this->campaign_click->create( $inputs );
	}	

}