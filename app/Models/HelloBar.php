<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class HelloBar extends Model
{
    protected $table = 'hello_bars';

    protected $fillable = [ 'name', 'color', 'position', 'cta_text', 'button_text', 'button_color', 'target_url', 'embed_code', 'token'];

    public function helloBarClick() {
  		return $this->HasMany('App\\Models\\HelloBarClick')->where('created_at', '>=', Carbon::now()->subMonth());  		
	}

	public function uniqueClicks()
	{
		return $this->hasMany('App\Models\HelloBarClick')->groupBy('ip', 'hello_bar_clicks.id');
	}
}
