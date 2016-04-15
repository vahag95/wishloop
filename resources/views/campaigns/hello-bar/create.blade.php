@extends('layouts.app')
@section('content')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="/assets/js/main.js"></script>
	<div class="container create-page">
	    <div class="row">
	        <div class="col-sm-4">
	        	<form class="hello-bar-form" method="post" action="/hello-bar-create">
	        		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        		<div class="panel panel-success">
			            <div class="panel-heading">Name</div>
			            <div class="panel-body">
			                <input type="text" class="form-control" name="name" required>
			            </div>
		            </div>

	        		<div class="panel panel-success">
			            <div class="panel-heading">Color</div>
			            <div class="panel-body">
			                <input type="color" class="form-control" name="color" required>
			            </div>
		            </div>

		            <div class="panel panel-success">
			            <div class="panel-heading">Position</div>
			            <div class="panel-body">
			                <select class="form-control" name="position" required>
			                	<option value="top">Select Position</option>
			                	<option value="top">Top</option>
			                	<option value="bottom">Bottom</option>
			                </select>
			            </div>
		            </div>

		            <div class="panel panel-success">
			            <div class="panel-heading">CTA Text</div>
			            <div class="panel-body">
			                <textarea class="form-control" name="cta_text" placeholder="Enter Your Text" required></textarea>
			            </div>
		            </div>

		            <div class="panel panel-success">
			            <div class="panel-heading">Button Text</div>
			            <div class="panel-body">
			                <input type="text" class="form-control" name="button_text" placeholder="Enter Your Text" required>
			            </div>
		            </div>

		            <div class="panel panel-success">
			            <div class="panel-heading">Button Color</div>
			            <div class="panel-body">
			                <input type="color" class="form-control" name="button_color" required>
			            </div>
		            </div>

		            <div class="panel panel-success">
			            <div class="panel-heading">Target URL</div>
			            <div class="panel-body">
			                <input type="text" class="form-control" name="target_url" required>
			            </div>
		            </div>

		            <div class="panel panel-success">
			            <div class="panel-body">
			                <a class="btn btn-warning hello-bar-preview-button">Preview</a>
			                <button type="submit" class="btn btn-success">Create</button>
			            </div>
		            </div>
	        	</form>
	        </div>
	        <div class="col-sm-8">
	            <div class="panel panel-info">
		            <div class="panel-heading">Preview</div>
		            <div class="panel-body no-padding preview-content">
		            	<div class="hello-bar-preview-iframe-cont">
		                	<iframe src="" class="preview-iframe-hello-bar"></iframe>
		                </div>
		            </div>
	            </div>
	        </div>
	    </div>
	</div>
@stop