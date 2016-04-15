@extends('layouts.app')
@section('content')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="/assets/js/main.js"></script>
	<div class="container create-page">
		@include('layouts.alerts.messages')
	    <div class="row">
	        <div class="col-sm-4">
	        	<form class="traffic-form" method="post" action="/traffic-create" enctype="multipart/form-data">
	        		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		            <div class="panel panel-info">
			            <div class="panel-heading">Name</div>
			            <div class="panel-body">
			                <input type="text" class="form-control" name="name" required>
			            </div>
		            </div>

		            <div class="panel panel-info">
			            <div class="panel-heading">Logo</div>
			            <div class="panel-body">
			                <input type="file" class="form-control logo_img" name="logo_path" accept="image/*" required>
			            </div>
		            </div>

		            <div class="panel panel-info">
			            <div class="panel-heading">Color</div>
			            <div class="panel-body">
			                <input type="color" class="form-control" name="color" required>
			            </div>
		            </div>

		            <div class="panel panel-info">
			            <div class="panel-heading">CTA Text</div>
			            <div class="panel-body">
			                <textarea class="form-control" name="cta_text" placeholder="Enter Your Text" required></textarea>
			            </div>
		            </div>

		            <div class="panel panel-info">
			            <div class="panel-heading">URL</div>
			            <div class="panel-body">
			                <input type="text" class="form-control" name="url" placeholder="Enter Your Text" required>
			            </div>
		            </div>

	                <div class="panel panel-info">
	    	            <div class="panel-heading">Rss Feed Url</div>
	    	            <div class="panel-body">
	    	                <input type="text" class="form-control" name="rss_url" placeholder="Enter Your Rss Feed URL" required>
	    	            </div>
	                </div>

		            <div class="panel panel-success">
			            <div class="panel-body">
			                <a class="btn btn-warning traffic-preview-button">Preview</a>
			                <button type="submit" class="btn btn-success">Create</button>
			            </div>
		            </div>
	            </form>
	        </div>

	        <div class="col-sm-8">
	            <div class="panel panel-success">
		            <div class="panel-heading">Preview</div>
		            <div class="panel-body no-padding preview-content">
		            	<div class="traffic-preview-iframe-cont">
		                	<iframe src="" class="preview-iframe-traffic"></iframe>
		                </div>
		            </div>
	            </div>
	        </div>
	    </div>
	</div>
@stop