<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\FacebookServiceInterface;
use Facebook\Facebook;
use Config;
use Illuminate\Contracts\Auth\Guard;

class FacebookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('auth');
        $this->auth = $auth;
        session_start();
    }

    public function getLogin()
    {        
        $config = Config::get('facebook');
        $fb = new Facebook($config);

        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email', 'user_likes', 'publish_pages', 'publish_actions', 'manage_pages']; // optional
        $loginUrl = $helper->getLoginUrl('http://wishloop.dev/fb-login-callback', $permissions);

        echo '<a target="_blank" href="' . $loginUrl . '">Log in with Facebook!</a>';        
        dd( $loginUrl );
    }

    public function getCallback( FacebookServiceInterface $facebookService )
    {                
        $config = Config::get('facebook');
        $fb = new Facebook($config);        
        $helper = $fb->getRedirectLoginHelper();        
        try {
          $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }

        if (isset($accessToken)) {
          // Logged in!
          $_SESSION['facebook_access_token'] = (string) $accessToken;
          $linkData = [
            'link' => 'http://www.hraparak.am',
            'message' => 'User provided message',
            ];
          $fb->setDefaultAccessToken($accessToken);
          try {
            // Returns a `Facebook\FacebookResponse` object
            // $response = $fb->post('/me/feed', $linkData, $accessToken);
            $response = $fb->get('/me', $accessToken);
            $user = $response->getGraphUser();
            // dd( $user, $accessToken->getValue() );
            $inputs = [
              'user_id' => $this->auth->id(),
              'access_token' => $accessToken->getValue(),
              'fb_user_id'   => $user['id']
            ];
            if( null!== $facebookService->create( $inputs ) ){
              return redirect('/settings')->with('success', 'saved successfully');              
            }
            return redirect('/settings')->withErrors('Something went wrong please try again');            
            // user_id = 136127396775271
            // accessToken = CAAI5MSedTBwBAA5yZBoE3pnerECkY5Lt94OuSknuLWnz6VjKqascN4LUhorVq0BX51ZC2qgXfBHyETgiexsesTD6Ea92YsNiuSYjJlB9bT3kDVKGODXOBam1JPsSlevoN19RTL7IQpg5ikgtHVZBigg31ex0CHHFX5kkv711UiY6JVJZAn9jFVLYHwnF51IZD
          } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
          } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
          }
          // Now you can redirect to another page and use the
          // access token from $_SESSION['facebook_access_token']
        }        
    }

    public function disconnect(FacebookServiceInterface $facebookService)
    {
        if( $facebookService->disconnect() ){
            return redirect('/settings')->with('success', '');
        }
        return redirect('/settings')->withErrors('something went wrong please try again');
    }
}
