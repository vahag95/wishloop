<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\EmailServicesServiceInterface;

use App\Services\GetResponseService;
use App\Services\AWeberService;
use App\Services\MailChimpService;
use Illuminate\Contracts\Auth\Guard;
use Config;
use Facebook\Facebook;
use Exception;

class SettingsController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct( Guard $auth )
	{
		$this->auth = $auth;
		session_start();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index( EmailServicesServiceInterface $emailService )
	{
		$config = Config::get('facebook');
		$fb = new Facebook($config);

		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email', 'user_likes', 'publish_pages', 'publish_actions', 'manage_pages']; // optional
				
		$loginUrl = $helper->getLoginUrl(url('/').'/fb-login-callback', $permissions);

		return view('settings.index' , [ 'facebook_login' => $loginUrl, 'emailSettings' => $emailService->getAllEmailServices() ]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly getResponse connection created resource in storage.
	 *
	 * @return Response
	 */

	public function getResponseApiConnect( Request $request , GetResponseService $getResponseService )
	{
		$response = $getResponseService->connect( $request->all() );
		return redirect()->back()->withInput()->with( $response['status'] , $response['message'] );
	}

	public function getResponseList( GetResponseService $getResponseService )
	{
		return  $getResponseService->getList();
	}

	public function aweberList( AWeberService $aweberService )
	{
		return $aweberService->getList();
	}

	public function mailChimpList( MailChimpService $mailChimpService )
	{
		return $mailChimpService->getList();
	}

    /**
	 * Connected to mailChimp api.
	 *
	 * @return Response
	 */
	public function connectMailChimpApi( Request $request , MailChimpService $mailChimpService )
    {
     	$response = $mailChimpService->connect( $request->all() );
     	
    	
		return redirect()->back()->withInput()->with( $response['status'] , $response['message'] );
    }

	/**
	 * Connected to aweber api.
	 *
	 * @return Response
	 */
	public function connectAweberApi( Request $request , AweberService $aweberService )
    {
     	$connect = $aweberService->connect( $request->all());
     	if(gettype($connect) == "array"){
	    	if( $connect['status'] === 'warning' ){
				return redirect()->back()->withInput()->with( $connect['status'] , $connect['message'] );
	    	}
	    }
    	return $connect;
    }

	/**
	 * Store a newly aweber connection created resource in storage.
	 *
	 * @return Response
	 */
    public function connectAweberApiCallback( Request $request , AweberService $aweberService )
    {
    	$response = $aweberService->connectCallback( $request->all() );
    	return redirect('/settings')->with( $response['status'] , $response['message'] );
    }

	/**
	 * Remove the specified email resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function emailApiDisconnect( $id , EmailServicesServiceInterface $emailService )
	{
		if ( $emailService->destroyEmailService( $id ) ) {
			return redirect()->back()->with( 'success' , 'Email Service successfully disconnected.' );
		}
	}

	public function createSubscriber( 	$user_id,
										$email_provider,
	 								  	$email_provider_value,
	  									Request $request,
	   									MailChimpService $mailChimpService,
	   									GetResponseService $getResponseService,
	   									AweberService $aweberService
	   								)
	{
		$this->updateMessage($request->all());

		if( $email_provider == 'MailChimp' ){
			$service = $mailChimpService->add_contact($user_id, $email_provider_value, $request->all());
			if($service['status'] != "error"){
				return view('widgets.templates.popups.design1.step12', ['show' => 1]);	
			}
			return view('widgets.templates.popups.design1.step13', ['provider' => 'MailChimp', 'show' => 1]);
		}elseif( $email_provider == 'GetResponse' ){
			$service = $getResponseService->add_contact($user_id, $email_provider_value, $request->all());
			if($service['status'] != "error"){
				return view('widgets.templates.popups.design1.step12', ['show' => 1]);
			}
			return view('widgets.templates.popups.design1.step13', ['provider' => 'GetResponse', 'show' => 1]);
		}elseif( $email_provider == 'Aweber' ){
			$service = $aweberService->add_contact($user_id, $email_provider_value, $request->all());
			if($service['status'] != "error"){
				return view('widgets.templates.popups.design1.step12', ['show' => 1]);
			}
			return view('widgets.templates.popups.design1.step13', ['provider' => 'Aweber', 'show' => 1]);
		}
	}
}
