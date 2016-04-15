<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\HelloBarServiceInterface;
use App\Contracts\TrafficServiceInterface;
use App\Contracts\UrlServiceInterface;
use App\Contracts\CampaignClicksServiceInterface;

class PagesController extends Controller
{

	public function index(Request $request, HelloBarServiceInterface $hello_bar_service, TrafficServiceInterface $traffic_service)
	{      
        $feed = \Feeds::make(
                'http://www.armsport.am/hy/news/rss');
            $data = array(
              'title'     => $feed->get_title(),
              'permalink' => $feed->get_permalink(),
              'items'     => $feed->get_items(0,2),
            );

            foreach ($data['items'] as $key) {
                var_dump($key->get_permalink());
                echo "<br>";
                var_dump($key->get_title());
                echo "<br>";
                var_dump($key->get_description());
            }        
	}
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store( RemoteCampaignRequest $request ) 
    {
        
    }

    public function showPage($type, $campaign_id, $token, UrlServiceInterface $urlService, HelloBarServiceInterface $helloBarService, TrafficServiceInterface $trafficService, CampaignClicksServiceInterface $campaignClicksService )
    {
        if( $type == "hb" ){
            $campaign = $helloBarService->getHelloBarById( $campaign_id );
        }elseif( $type == "tg" ){
            $campaign = $trafficService->getTrafficById( $campaign_id );
        }

        $url = $urlService->getUrlByToken($token);
        $campaignClicksService->create( [
          'campaign_id' => $url->campaign_id,
          'ip'          => $this->getIpAddress()
        ] );
        $url = $url->url;        
        return view('pages.index', [ 'campaign' => $campaign , 'iframeUrl' => $url]);
    }

    private function getIpAddress()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
