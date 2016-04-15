@extends('layouts.app')
@section('content')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="/assets/js/ZeroClipboard.min.js"></script>
	<script src="/assets/js/main.js"></script>
	@include('layouts.alerts.messages')
	<div class="container">
	    <div class="panel panel-success">
	      	<div class="panel-heading">Hello Bars</div>

	      	<table class="table">
	       		@if(!$hello_bars->isEmpty())
		       		<thead>
		       			<tr>
		       				<th>#</th>
		       				<th>Name</th>
		       				<th>CTA text</th>
		       				<th>Target URL</th>
		       				<th>Schedule</th>
		       				<th>Actions</th>
		       			</tr>
		       		</thead>
		       		<tbody> 
	       				@include('campaigns.hello-bar.parts.list')
	       			</tbody>
       			@else
       				<div class="col-md-12" style="margin-top: 20px">
       					@include('layouts.alerts.noResult')
       				</div>
       			@endif
	      	</table>
	    </div>
	</div>
@stop