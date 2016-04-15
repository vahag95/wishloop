<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\TrafficServiceInterface;
use App\Contracts\TrafficGenerationClicksServiceInterface;

class TrafficGenerationController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TrafficServiceInterface $traffic_service)
    {
    	$traffics = $traffic_service->getAllTraffics();
        return view('campaigns.traffic.manage', ['traffics' => $traffics]);
    }

    /**
     * Display resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, TrafficServiceInterface $traffic_service)
    {        
    	$traffic = $traffic_service->getTrafficById($id);
    	return view('campaigns.traffic.edit', ['traffic' => $traffic]);
    }

    /**
     * Show create form.
     *
     * @return Response
    */
    public function create()
    {
    	return view('campaigns.traffic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
    */
    public function store(Request $request, TrafficServiceInterface $traffic_service)
    {        
    	if( null!== $traffic_service->create( $request->all() ) )
    	{
    		return redirect('/traffic-manage')->withSuccess('Traffic Generation successfully created');
    	}
    	return redirect()->back()->withError('Please check your data and try again!');
    }

    /**
     * Update resource in storage.
     *
     * @return Response
    */
    public function update($id, Request $request, TrafficServiceInterface $traffic_service)
    {
    	if( null !== $traffic_service->update( $id, $request->all() ) )
    	{
    		return redirect('/traffic-manage')->withSuccess('Traffic Generation successfully updated');
    	}
    	return redirect()->back()->withError('Please check your data and try again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id, TrafficServiceInterface $traffic_service)
    {    	
    	if( null!== $traffic_service->delete($id) )
    	{
    		return redirect()->back()->withSuccess('Traffic Generation successfully deleted');
    	}
    }

    public function trafficPreview(Request $request)
    {
        $data = json_decode($request->get('data'));
        if( $data->rss_url !== ""){
            $data->feeds = $this->getRssFeeds( $data->rss_url );            
        }                            
    	return view('preview.traffic', [ 'data' => $data ]);
    }

    public function trafficEmbed($token, TrafficServiceInterface $traffic_service)
    {
        $traffic = $traffic_service->getTrafficByToken($token);
        if( $traffic->rss_url !== "" ){
            $traffic->feeds = $this->getRssFeeds( $traffic->rss_url );
        }
        return view('preview.traffic', ['data' => $traffic]);
    }

    public function addClick($token, TrafficServiceInterface $traffic_service, TrafficGenerationClicksServiceInterface $traffic_generation_clicks_service)
    {
        $traffic_id = $traffic_service->getTrafficByToken($token)->id;
        $ip = $this->getIpAddress();
        $inputs = [
            'traffic_id' => $traffic_id,
            'ip'         => $ip
        ];
        $traffic_generation_clicks_service->addClick( $inputs );
    }

    private function getRssFeeds($url)
    {
        $feed = \Feeds::make($url);
        $feeds = array(
          'title'     => $feed->get_title(),
          'permalink' => $feed->get_permalink(),
          'items'     => $feed->get_items(0,2),
        );  
        return $feeds;
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
