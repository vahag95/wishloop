<!DOCTYPE html>
<html>
<head>
	<title>Traffic</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/assets/css/traffic-preview.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="/assets/js/add-click.js"></script>
</head>
<body>	
	<div class="traffic-container">
		<div class="panel panel-default">
            <div class="panel-heading" @if(isset($data)) style="background: {{$data->color}}" @endif>
            	<img class="pull-left logo" @if(isset($data)) src="{{$data->logo_path}}" @endif>
            	<div class="pull-left">@if(isset($data)) {{$data->cta_text}} @endif</div>
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            		<span aria-hidden="true">×</span>
            	</button>            	
            </div>
            <div class="panel-body">
	            <div class="link-title">@if(isset($data)) <a href="//{{$data->url}}" target="_blank" style="text-decoration: none;" onclick="trafficAddClick(this)" class="{{isset( $data->token ) ? $data->token : ''}}">{{$data->url}}</a> @endif</div>
	            @if( !empty( $data->feeds['items'] ) )
	            	@foreach( $data->feeds['items'] as $feed )	            		
	            		<a class="feed" href="{{ $feed->get_permalink() }}">
		            		<div>
		            			<b>{!! $feed->get_title() !!}</b>
		            		</div>
	            		</a>
	            		<!--<div class="rss_description">
	            			<span>{!! $feed->get_description() !!}</span>
	            		</div> -->
	            		
	            	@endforeach            		
	            @endif
	            <div class="powered-by-container">
	            	Powered By ??
	            </div>
            </div>
        </div>
	</div>
</body>
</html>