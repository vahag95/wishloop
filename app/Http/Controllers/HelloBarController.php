<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\HelloBarServiceInterface;
use App\Contracts\HelloBarClicksServiceInterface;

class HelloBarController extends Controller
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
    public function index(HelloBarServiceInterface $hello_bar_service)
    {
    	$hello_bars = $hello_bar_service->getAllHelloBars();
        return view('campaigns.hello-bar.manage', ['hello_bars' => $hello_bars]);
    }

    /**
     * Display resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, HelloBarServiceInterface $hello_bar_service)
    {
    	$hello_bar = $hello_bar_service->getHelloBarById($id);
    	return view('campaigns.hello-bar.edit', ['hello_bar' => $hello_bar]);
    }

    /**
     * Show create form.
     *
     * @return Response
    */
    public function create()
    {
    	return view('campaigns.hello-bar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
    */
    public function store(Request $request, HelloBarServiceInterface $hello_bar_service)
    {
    	if( null !== $hello_bar_service->create( $request->all() ) )
    	{
    		return redirect('/hello-bar-manage')->withSuccess('Hello Bar successfully created');
    	}
    	return redirect()->back()->withError('Please check your data and try again!');
    }

    /**
     * Update resource in storage.
     *
     * @return Response
    */
    public function update($id, Request $request, HelloBarServiceInterface $hello_bar_service)
    {
    	if( null !== $hello_bar_service->update( $id, $request->all() ) )
    	{
    		return redirect('/hello-bar-manage')->withSuccess('Hello Bar successfully updated');
    	}
    	return redirect()->back()->withError('Please check your data and try again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id, HelloBarServiceInterface $hello_bar_service)
    {    	
    	if( null !== $hello_bar_service->delete( $id ) )
    	{
    		return redirect()->back()->withSuccess('Hello Bar successfully deleted');
    	}
    }

    public function helloBarPreview(Request $request)
    {
    	$data = json_decode($request->get('data'));
    	return view('preview.hello-bar', ['data' => $data]);
    }

    public function helloBarEmbed($token, HelloBarServiceInterface $hello_bar_service)
    {
        $hello_bar = $hello_bar_service->getHelloBarByToken($token);
        return view('preview.hello-bar', ['data' => $hello_bar]);
    }

    public function addClick($token, HelloBarServiceInterface $hello_bar_service, HelloBarClicksServiceInterface $hello_bar_clicks_service)
    {
        $hello_bar_id = $hello_bar_service->getHelloBarByToken($token)->id;
        $ip = $this->getIpAddress();
        $inputs = [
            'hello_bar_id' => $hello_bar_id,
            'ip'           => $ip
        ];
        $hello_bar_clicks_service->addClick( $inputs );
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
