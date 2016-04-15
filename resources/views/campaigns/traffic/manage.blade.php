@extends('layouts.app')
@section('content')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="/assets/js/ZeroClipboard.min.js"></script>
	<script src="/assets/js/main.js"></script>
	@include('layouts.alerts.messages')
	<div class="container">
	    <div class="panel panel-info">
	      	<div class="panel-heading">Traffic Generations</div>

		    <table class="table">
	   			@if(!$traffics->isEmpty())
		       		<thead>
		       			<tr>
		       				<th>#</th>
		       				<th>Name</th>
		       				<th>Logo</th>
		       				<th>CTA text</th>
		       				<th>URL</th>
		       				<th>Schedule</th>
		       				<th>Actions</th>
		       			</tr>
		       		</thead>
		       		<tbody>
	       				@include('campaigns.traffic.parts.list')	       			
		       		</tbody>	       		
		      	@else
		      		<div class="col-md-12" style="margin-top: 20px">
		      			@include('layouts.alerts.noResult')
		      		</div>	
		      	@endif
	      	</table>
	    </div>
	</div>
	<link rel="stylesheet" type="text/css" href="http://wishloop.dev/assets/css/hello-bar.css"><div class="wl-hb-cont wl-hb-bottom"><div class="wl-hb-close">x</div><iframe src="http://wishloop.dev/hello-bar-preview/u4hVYbf4bOqbMEO7pI3JhtggcywkxqPK"></iframe></div>
	{{-- <link rel="stylesheet" type="text/css" href="http://wishloop.dev/assets/css/traffic.css"><script type="text/javascript" src="http://wishloop.dev/assets/js/traffic.js"></script><div id="wl-tg-cont" class="wl-tg-cont" onclick="add_click()"><div class="wl-tg-close" onclick="wl_tg_close()">x</div><iframe id="ifrm" src="http://wishloop.dev/traffic-preview/BWK3tfSe2iQLpQsihODBJYphangnO3ce" scrolling="no"></iframe></div> --}}
@stop