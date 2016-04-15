<?php

namespace App\Services;

use App\Models\FacebookAccount;
use App\Contracts\FacebookServiceInterface;
use Illuminate\Contracts\Auth\Guard;

class FacebookService implements FacebookServiceInterface {

	public function __construct(FacebookAccount $facebookAccount, Guard $auth) {
		$this->facebookAccount = $facebookAccount;
		$this->auth = $auth;
	}	

	public function create($inputs)
	{	
		if( null!== $facebookAccount = $this->getFacebookAccountByUserId( $inputs['user_id'] ) ){			
			return $facebookAccount->update( $inputs );
		}		
		return $this->facebookAccount->create( $inputs );
	}	

	public function getFacebookAccountByUserId( $user_id )
	{
		return $this->facebookAccount->where( 'user_id', $user_id )->first();
	}

	public function disconnect()
	{
		$account = $this->getFacebookAccountByUserId( $this->auth->id() );
		if( null!== $account){
			return $account->delete();
		} 
		return false;
	}

}