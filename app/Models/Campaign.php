<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Campaign extends Model
{
    protected $table = 'campaigns';

    protected $fillable = [ 'label', 'url', 'type', 'ad_id'];

    public function clicks()
    {
    	return $this->hasMany('App\Models\CampaignClick')->where('created_at', '>=', Carbon::now()->subMonth());
    }

    public function uniqueClicks()
    {
    	return $this->hasMany('App\Models\CampaignClick')->groupBy('ip', 'campaign_clicks.id');
    }
}
