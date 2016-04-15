<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Facebook\Facebook;
use Config;
use App\Contracts\CampaignServiceInterface;
use App\Contracts\HelloBarClicksServiceInterface;
use App\Contracts\HelloBarServiceInterface;
use App\Contracts\TrafficServiceInterface;
use Carbon\Carbon;

class CampaignsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');        
    }

    
    public function index(CampaignServiceInterface $campaignService)
    {
        $campaigns = $campaignService->getAllCampaigns();        
        return view('campaigns.index', [ 'campaigns' => $campaigns ]);
    }

    public function show($id, CampaignServiceInterface $campaignService, HelloBarClicksServiceInterface $helloBarClickService, HelloBarServiceInterface $helloBarService, TrafficServiceInterface $trafficService )
    {        
        $campaign = $campaignService->getCampaignById( $id );        
        $campaign_clicks = $campaign->clicks;
        $uniqueCampaignClicks = $campaign->uniqueClicks;
        $campaign_days = $campaign_clicks->lists('created_at');
        $campaign_unique_days = $uniqueCampaignClicks->lists('created_at');
        if( $campaign->type == "hb" ){
            $ad = $helloBarService->getHelloBarById( $campaign->ad_id );                       
            $ad_days = $ad->helloBarClick->lists('created_at'); 
            $ad_unique_days =  $ad->uniqueClicks->lists('created_at');
        }else{
            $ad = $trafficService->getTrafficById($campaign->ad_id);             
            $ad_days = $ad->trafficGenerationClick->lists('created_at');
            $ad_unique_days =  $ad->uniqueClicks->lists('created_at');
        }

        $campaignDays = array();        
        foreach ($campaign_days as $day) {
            $day = Carbon::parse($day)->format('Y-m-d');
            array_push($campaignDays,$day);                            
        }

        $campaignUniqueDays = array();
        foreach ($campaign_unique_days as $day) {
            $day = Carbon::parse($day)->format('Y-m-d');
            array_push($campaignUniqueDays,$day);
        }
        
        $adDays = array();                
        foreach ($ad_days as $day) {
            $day = Carbon::parse($day)->format('Y-m-d');            
            array_push($adDays,$day);                          
        }

        $adUniqueDays = array();        
        foreach ($ad_unique_days as $day) {
            $day = Carbon::parse($day)->format('Y-m-d');
            array_push($adUniqueDays,$day);                            
        }

        return view('campaigns.show', [ 'campaign' => $campaign, 'campaignDays' => $campaignDays, 'campaignUniqueDays' => $campaignUniqueDays, 'adUniqueDays' => $adUniqueDays, 'adDays' => $adDays ]);
    }

    public function destroy(CampaignServiceInterface $campaignService, $id)
    {
        if( $campaignService->destroy( $id ) ){
            return redirect()->back()->with('success', 'Deleted');
        }
    }

    public function update($id, Request $request, CampaignServiceInterface $campaignService)
    {
        $campaign = $campaignService->getCampaignById( $id );
        return view('campaigns.edit', [ 'campaign' => $campaign ]);
    }

    public function getSchedule($id, CampaignServiceInterface $campaignService)
    {
        $campaign = $campaignService->getCampaignById( $id );
        return view('campaigns.schedule', ['campaign' => $campaign]);
    }
}
