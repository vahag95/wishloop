<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrafficGenerationClick extends Model
{
    protected $table = 'traffic_generation_clicks';

    protected $fillable = [ 'traffic_id', 'ip' ];
}
