<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\HelloBarServiceInterface;
use App\Contracts\TrafficServiceInterface;
use App\Contracts\UrlServiceInterface;
use App\Contracts\CampaignServiceInterface;

class BookmarkletController extends Controller
{

	public function index(Request $request, HelloBarServiceInterface $hello_bar_service, TrafficServiceInterface $traffic_service)
	{        
		$url = $request->get('url');
		$label = parse_url($url);
		$campaigns = [];
		// if( null !== $hello_bar_service->getAllHelloBars() ) {
		// 	foreach ($hello_bar_service->getAllHelloBars() as $key => $value) {
  //               $value->hello_bar = true;
		// 		array_push($campaigns, $value);
		// 	}
		// }
		// if( null !== $traffic_service->getAllTraffics() ) {
		// 	foreach ($traffic_service->getAllTraffics() as $key => $value) {
  //               $value->traffic = true;
		// 		array_push($campaigns, $value);
		// 	}
		// }            
		return view('bookmarklet.index', ['url' => $url, 'label' => $label['host'].' campaign', 'helloBars' => $hello_bar_service->getAllHelloBars() , 'traffics' => $traffic_service->getAllTraffics()]);
	}
  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store( Request $request , UrlServiceInterface $urlService, CampaignServiceInterface $campaignService ) {        
      $token      = str_random(10);
      $websiteUrl = $request->url;   
      if( $request->has('traffic_id') &&  $request->traffic_id > 0 ){
          $id = $request->traffic_id;
          $type= 'tg';
      }else{
          $id = $request->hellobar_id;
          $type = 'hb';
      }
      $url = url('/').'/pages'.'/'.$type.'/'.$id.'/'.$token;
      $inputs = [
          'label' => $request->label,
          'url'   => $url,
          'type'  => $type,
          'ad_id' => $id
      ];
      if( null!== $campaign = $campaignService->create( $inputs ) ){        
        if( null!== $urlService->create([ 'token' => $token, 'url' => $websiteUrl, 'campaign_id' => $campaign->id ]) ){          
            return view('bookmarklet.showUrl', [ 'url' => $url, 'websiteUrl' => $websiteUrl ]);            
        }
      }      
  }

}
