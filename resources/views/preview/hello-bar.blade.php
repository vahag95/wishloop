<!DOCTYPE html>
<html>
<head>
	<title>Hello Bar</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/assets/css/hello-bar-preview.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="/assets/js/add-click.js"></script>
</head>
<body>
	<div class="hello-bar-container @if(isset($data)) {{$data->position}} @endif" @if(isset($data)) style="background: {{$data->color}}" @endif>
		<p class="text">@if(isset($data)) {{$data->cta_text}} @endif</p>
		<a class="btn btn-xs" @if(isset($data)) style="text-decoration: none; color: white; background-color: {{$data->button_color}}" href="//{{$data->target_url}}" onclick="helloBarAddClick(this)" id="{{isset( $data->token ) ? $data->token : ''}} " target="_blank" @endif>@if(isset($data)) {{$data->button_text}} @endif</a>
	</div> 
</body>
</html>