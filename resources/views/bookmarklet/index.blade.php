<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/assets/css/bookmarklet.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<div class="wl_modal_head">
	Wishloop
</div>
<form method="post" action="/bookmarklet/">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-elementz">
		<div class="form-labelz">
			<label>URL</label>
		</div>
		<div>
			<div class="url">{{$url}}</div>
			<input type="hidden" name="url" value="{{ $url }}">
		</div>
	</div><hr>
	<div class="form-elementz">
		<div class="form-labelz">
			<label>Label</label>
		</div>
		<div>
			<input type="text" name="label" class="form-control pull-right" value="{{$label}}">
		</div>
	</div><hr>
	<div class="form-elementz">
		<div class="form-labelz">
			<label>Type</label>
		</div>
		<div>
			<input type="radio" checked name="type" value="hello_bar"> Hello Bar<Br>
			<input type="radio" name="type" value="traffic"> Traffic<Br>			
		</div>
	</div><hr>	
	<div class="hello_bars form-elementz">
		<div class="form-labelz">
			<label>Hello Bars</label>
		</div>
		<div>	
			<select class="hellobar_select form-control" name="hellobar_id">
				@if(isset($helloBars) && $helloBars->count() > 0 )
					@foreach($helloBars as $helloBar)						
						<option value="{{ $helloBar->id }}">{{$helloBar->name}}</option>						
					@endforeach
				@else
					<option>no hellobars</option>
				@endif
			</select>
		</div>		
		<hr>
	</div>
	<div class="traffics form-elementz" style="display:none">
		<div class="form-labelz">
			<label>Traffics</label>
		</div>
		<div>		
			<select class="traffic_select form-control" name="traffic_id">
				@if(isset($traffics) && $traffics->count() > 0 )
					@foreach($traffics as $traffic)	
						<option value="{{ $traffic->id }}">{{$traffic->name}}</option>						
					@endforeach
				@else					
					<option value="0">no traffics</option>
				@endif
			</select>
		</div>
		<hr>		
	</div>
	<div class="form-elementz wl_form_buttons">
		<button class="wl_save_btn">Save</a>
	</div>
</form>
<script type="text/javascript">
	$(document).on('ready', function(){
		var showChar = 30;
	    var ellipsestext = "...";
	    $('.traffic_select').val(null);
	    $('.url').each(function() {
	        var content = $(this).html();
	 
	        if(content.length > showChar) {
	 
	            var c = content.substr(0, showChar);
	            var h = content.substr(showChar-1, content.length - showChar);
	 
	            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span>';
	 
	            $(this).html(html);
	        }
	 
	    });	
	    $('input[type=radio][name=type]').change(function() {
            if (this.value == 'hello_bar') {
                $('.traffics').hide();
                $('.hello_bars').show();
                $('.traffic_select').val(null);
            }
            else if (this.value == 'traffic') {
                $('.traffics').show();
                $('.hello_bars').hide();
                $('.hellobar_select').val(null);
            }
        });
	})
</script>