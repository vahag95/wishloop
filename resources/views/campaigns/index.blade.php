@extends('layouts.app')
@section('content')	
	<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
	<script src="/assets/js/ZeroClipboard.min.js"></script>
	<script src="/assets/js/main.js"></script>
	@include('layouts.alerts.messages')
	<div class="container">
	    <div class="panel panel-success">
	      	<div class="panel-heading">Campaigns</div>

	      	<table class="table">
	       		@if(!$campaigns->isEmpty())
		       		<thead>
		       			<tr>
		       				<th>#</th>
		       				<th>Label</th>
		       				<th>Url</th>		       				
		       				<th>Type</th>		       				
		       				<th>Actions</th>
		       			</tr>
		       		</thead>
		       		<tbody> 
	       				@include('campaigns.parts.list')
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