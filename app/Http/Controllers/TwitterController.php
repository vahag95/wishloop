<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Contracts\TwitterServiceInterface;
use Illuminate\Contracts\Auth\Guard;
use GuzzleHttp\Client;
use Twitter;
use Session;
use Config;

class TwitterController extends Controller
{
    public function __construct(Guard $auth)
    {
    	$this->auth = $auth;
    }

    public function index(Request $request)
    {    	
    	$sign_in_twitter = true;
	    $force_login = false;

	    // Make sure we make this request w/o tokens, overwrite the default values in case of login.
	    Twitter::reconfig(['token' => '', 'secret' => '']);
	    $token = Twitter::getRequestToken(url('/').'/twitter/callback');

	    if (isset($token['oauth_token_secret']))
	    {
	        $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

	        Session::put('oauth_state', 'start');
	        Session::put('oauth_request_token', $token['oauth_token']);
	        Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

	        return redirect($url);
	    }

	    return Redirect::route('twitter.error');
    }

    public function callback(Request $request, TwitterServiceInterface $twitterService)
    {    	
    	if (Session::has('oauth_request_token'))
	    {
	        $request_token = [
	            'token'  => Session::get('oauth_request_token'),
	            'secret' => Session::get('oauth_request_token_secret'),
	        ];

	        Twitter::reconfig($request_token);

	        $oauth_verifier = false;

	        if ($request->has('oauth_verifier'))
	        {
	            $oauth_verifier = $request->get('oauth_verifier');
	        }

	        // getAccessToken() will reset the token for you
	        $token = Twitter::getAccessToken($oauth_verifier);    	        
	        if (!isset($token['oauth_token_secret']))
	        {
	            return Redirect::route('twitter.login')->with('flash_error', 'We could not log you in on Twitter.');
	        }

	        $credentials = Twitter::getCredentials();
	        
	        if (is_object($credentials) && !isset($credentials->error))
	        {
	            // $credentials contains the Twitter user object with all the info about the user.
	            // Add here your own user logic, store profiles, create new users on your tables...you name it!
	            // Typically you'll want to store at least, user id, name and access tokens
	            // if you want to be able to call the API on behalf of your users.

	            // This is also the moment to log in your users if you're using Laravel's Auth class
	            // Auth::login($user) should do the trick.    	        	
	            Session::put('access_token', $token);    	            
	            // return Redirect::to('/')->with('flash_notice', 'Congrats! You\'ve successfully signed in!');
	        }

	        $inputs = [
	        	'user_id'             => $this->auth->id(),
	        	'access_token'        => $token['oauth_token'],
	        	'access_token_secret' => $token['oauth_token_secret'],
	        	'tw_user_id'          => $token['user_id'],
	        	'tw_screen_name'      => $token['screen_name']
	        ];
	        if( null!== $twitterService->create( $inputs ) ){
	        	return redirect('/settings')->with('success', 'saved successfully');
	        }
	        return redirect()->back()->withErrors('Crab! Something went wrong while signing you up!');
	    }
    }

    public function postTweet()
    {
    	config([ 'ttwitter.ACCESS_TOKEN' => '702491393919471617-6qubgDae4cLW0FYRBLA7jRenyFFxBuV' ]);
    	config([ 'ttwitter.ACCESS_TOKEN_SECRET' => 'w0AtwXuVmhJjdGwQBBVo3na9453xMkAHhKNqKjIj60Nmz' ]);    	
    	return Twitter::postTweet(['status' => 'asdasdasdasdadasd', 'url' => 'http://google.ru', 'format' => 'json']);
    }

    public function disconnect(TwitterServiceInterface $twitterService)
    {
    	if( $twitterService->disconnect() ){
    		return redirect('/settings')->with('success', 'successfully');
    	}
    	return redirect('/settings')->withErrors('Something went wrong');
    }
}
