@extends('layouts.app')
@section('content')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="/assets/js/main.js"></script>
	<div class="container create-page">
	    <div class="row">
	        <div class="col-sm-4">
	        	<form class="hello-bar-form" method="post" action="/hello-bar-update/{{$hello_bar->id}}">
	        		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        		<div class="panel panel-success">
			            <div class="panel-heading">Name</div>
			            <div class="panel-body">
			                <input type="text" class="form-control" name="name" value="{{$hello_bar->name}}" required>
			            </div>
		            </div>

	        		<div class="panel panel-success">
			            <div class="panel-heading">Color</div>
			            <div class="panel-body">
			                <input type="color" class="form-control" name="color" value="{{$hello_bar->color}}" required>
			            </div>
		            </div>

		            <div class="panel panel-success">
			            <div class="panel-heading">Position</div>
			            <div class="panel-body">
			                <select class="form-control" name="position" required>
			                	<option value="0">Select Position</option>
			                	<option value="top" @if( $hello_bar->position == "top" ) selected @endif>Top</option>
			                	<option value="bottom" @if( $hello_bar->position == "bottom" ) selected @endif>Bottom</option>
			                </select>
			            </div>
		            </div>

		            <div class="panel panel-success">
			            <div class="panel-heading">CTA Text</div>
			            <div class="panel-body">
			                <textarea class="form-control" required name="cta_text" placeholder="Enter Your Text">{{$hello_bar->cta_text}}</textarea>
			            </div>
		            </div>

		            <div class="panel panel-success">
			            <div class="panel-heading">Button Text</div>
			            <div class="panel-body">
			                <input type="text" class="form-control" name="button_text" placeholder="Enter Your Text" value="{{$hello_bar->button_text}}" required>
			            </div>
		            </div>

		            <div class="panel panel-success">
			            <div class="panel-heading">Button Color</div>
			            <div class="panel-body">
			                <input type="color" class="form-control" name="button_color" value="{{$hello_bar->button_color}}" required>
			            </div>
		            </div>

		            <div class="panel panel-success">
			            <div class="panel-heading">Target URL</div>
			            <div class="panel-body">
			                <input type="text" class="form-control" name="target_url" value="{{$hello_bar->target_url}}" required>
			            </div>
		            </div>

		            <div class="panel panel-success">
			            <div class="panel-body">
			                <a class="btn btn-warning hello-bar-preview-button">Preview</a>
			                <button type="submit" class="btn btn-success">Update</button>
			            </div>
		            </div>
	        	</form>
	        </div>
	        <div class="col-sm-8">
	            <div class="panel panel-info">
		            <div class="panel-heading">Preview</div>
		            <div class="panel-body no-padding preview-content">
		            	<div class="hello-bar-preview-iframe-cont">
		                	<iframe src="/hello-bar-preview?data={{urlencode(json_encode($hello_bar))}}" class="preview-iframe-hello-bar"></iframe>
		                </div>
		            </div>
	            </div>
	        </div>
	    </div>
	</div>
@stop