<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwitterAccount extends Model {

	protected $table = 'twitter_accounts';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [ 'user_id' , 'access_token' , 'access_token_secret', 'tw_user_id', 'tw_screen_name' ];

}
