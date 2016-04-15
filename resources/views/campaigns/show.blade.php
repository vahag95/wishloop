@extends('layouts.app')
@section('content')	
	<link rel="stylesheet" type="text/css" href="/assets/js/c3-chart/c3.css">
	<script type="text/javascript" src="/assets/js/c3-chart/c3.js"></script>
	<script type="text/javascript" src="/assets/js/c3-chart/d3/d3.js"></script>
	<script type="text/javascript" src="/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="/assets/js/moment.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css" />
	<!-- Include Date Range Picker -->
	<script type="text/javascript" src="/assets/js/daterangepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="/assets/css/daterangepicker.css" />	
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">	
	<div class="stats">
		<div class="col-md-4 col-md-offset-1">
			<span class="btn btn-primary show_campaign_clicks" style="display:none">show campaigns chart</span>
			<span class="btn btn-primary show_ad_clicks">show 					
			@if( $campaign->type == 'hb' )
				Hello Bar
			@else
				Traffic Generator
			@endif
			chart
			</span>
		</div>
		<div class="campaign_clicks">
			<div class="col-md-10 col-md-offset-1">		
				<h2><b>{{ $campaign->label }}</b> clicks</h2>
			</div>
			
			@foreach( $campaignDays as $day )
				<input type="hidden" value="{{ $day }}" class="campaign_stats">
			@endforeach
			@foreach( $campaignUniqueDays as $day )
				<input type="hidden" value="{{ $day }}" class="campaign_unique_stats">
			@endforeach			
			<div class="pull-right col-md-5">
				<input type="text" name="campaignDaterange">
				<button href="javascript:void(0)" class="btn btn-primary pull-right campaign_month" style="margin-right: 10px;">Last month</button>
				<button class="btn btn-primary pull-right campaign_week" style="margin-right: 10px;">Last week</button>
				<button class="btn btn-primary pull-right campaign_today" style="margin-right: 10px;">Today</button>	
			</div>
			<div class="col-md-10 col-md-offset-1">
				<div id="campaign_chart"></div>
			</div>
			<div class="col-md-10 col-md-offset-1">
				<h2>Total clicks : <span class="total_campaign_clicks">{!! count($campaignDays) !!}</span></h2>
				<h2>Unique clicks : <span class="unique_campaign_clicks">{!! count($campaignUniqueDays) !!}</span></h2>
			</div>			
		</div>
		<br>
		<div class="ad_clicks" style="visibility:hidden">
			<div class="col-md-10 col-md-offset-1 pull-left">		
				<h2>
					@if( $campaign->type == 'hb' )
						Hello Bar
					@else
						Traffic Generator
					@endif Clicks
				</h2>
			</div>

			@foreach( $adDays as $day )		
				<input type="hidden" value="{{ $day }}" class="ad_stats">	    		
			@endforeach
			@foreach( $adUniqueDays as $day )		
				<input type="hidden" value="{{ $day }}" class="ad_unique_stats">	    		
			@endforeach			
			<div class="pull-right col-md-5">
				<input type="text" name="adDaterange">				
				<button type="button" class="btn btn-primary pull-right ad_month" style="margin-right: 10px;">Last month</button>
				<button type="button" class="btn btn-primary pull-right ad_week" style="margin-right: 10px;">Last week</button>
				<button type="button" class="btn btn-primary pull-right ad_today" style="margin-right: 10px;">Today</button>	
			</div>
			<div class="col-md-10 col-md-offset-1">
				<div id="ad_chart"></div>
			</div>
			<div class="col-md-4 col-md-offset-1">
				<h2>Total clicks : <span class="total_ad_clicks">{!! count($adDays) !!}</span></h2>
				<h2>Unique clicks : <span class="unique_ad_clicks">{!! count($adUniqueDays) !!}</span></h2>
			</div>		    				
		</div>		
	</div>
		
	<script type="text/javascript" src="/assets/js/campaignChart.js"></script>
	<script type="text/javascript" src="/assets/js/adChart.js"></script>	
	<script type="text/javascript">
		$(document).on('ready', function(){			
			$('.show_ad_clicks').on('click', function(){
				$('.campaign_clicks').hide();
				$('.ad_clicks').css('visibility', 'visible');
				$('.ad_clicks').show();
				$('.show_ad_clicks').hide();
				$('.show_campaign_clicks').show();
			})
			$('.show_campaign_clicks').on('click', function(){
				$('.campaign_clicks').show();
				$('.ad_clicks').hide();
				$('.show_campaign_clicks').hide();
				$('.show_ad_clicks').show();
			})

		})
	</script>
@stop