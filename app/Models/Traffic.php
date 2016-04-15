<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Traffic extends Model
{
    protected $table = 'traffic_generations';

    protected $fillable = [ 'name', 'logo_path', 'rss_url', 'color', 'cta_text', 'url', 'embed_code', 'token'];

    public function trafficGenerationClick() {
  		return $this->HasMany('App\\Models\\TrafficGenerationClick');
	}

	public function uniqueClicks()
	{
		return $this->hasMany('App\Models\TrafficGenerationClick')->groupBy('ip', 'traffic_generation_clicks.id');
	}
}