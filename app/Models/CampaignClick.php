<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignClick extends Model
{
    protected $table = 'campaign_clicks';

    protected $fillable = [ 'campaign_id', 'ip'];
}
