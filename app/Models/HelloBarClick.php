<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelloBarClick extends Model
{
    protected $table = 'hello_bar_clicks';

    protected $fillable = [ 'hello_bar_id', 'ip' ];
}
