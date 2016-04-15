<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacebookAccount extends Model {

	protected $table = 'facebook_accounts';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [ 'user_id' , 'access_token' , 'fb_user_id' ];
}
