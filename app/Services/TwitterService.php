<?php

namespace App\Services;

use App\Models\TwitterAccount;
use App\Contracts\TwitterServiceInterface;
use Illuminate\Contracts\Auth\Guard;

class TwitterService implements TwitterServiceInterface {

	public function __construct(TwitterAccount $twitterAccount, Guard $auth) {
		$this->twitterAccount = $twitterAccount;
		$this->auth = $auth;
	}	

	public function create($inputs)
	{
		if( null!== $twitterAccount = $this->getTwitterAccountByUserId($inputs['user_id']) ){
			return $twitterAccount->update( $inputs );	
		}
		return $this->twitterAccount->create( $inputs );
	}	

	public function getTwitterAccountByUserId( $user_id )
	{
		return $this->twitterAccount->where( 'user_id', $user_id )->first();
	}

	public function disconnect()
	{
		$account = $this->getTwitterAccountByUserId( $this->auth->id() );
		if( null!== $account){
			return $account->delete();
		} 
		return false;
	}

}