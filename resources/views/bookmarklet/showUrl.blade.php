<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/assets/css/bookmarklet.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<div class="wl_modal_head">
	Wishloop
</div>
<style type="text/css">
	.twitter-share-button, .fb-share-button{
		margin:10px;
	}	
</style>
<form method="post" action="/bookmarklet/">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-elementz">
		<div class="form-labelz">
			<label>Your Link</label>
		</div>
		<div>
			<a href="{{$url}}" target="_blank">link</a>			
		</div><hr>
		<div class="form-labelz">
			<label>URL</label>
		</div>
		<div>
			<input type="text" value="{{ $url }}">			
		</div>
		<button>copy</button>

	</div><hr>	
</form>

<div class="fb-share-button" data-href="{{ $url }}" data-layout="button_count"></div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.5&appId=625833234222108";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<a href="https://twitter.com/share" class="twitter-share-button" data-url="{{ $url }}">Tweet</a>
<script>
	!function(d,s,id){
		var js,fjs=d.getElementsByTagName(s)[0],
		p=/^http:/.test(d.location)?'http':'https';
		if(!d.getElementById(id)){
			js=d.createElement(s);js.id=id;
			js.src=p+'://platform.twitter.com/widgets.js';
			fjs.parentNode.insertBefore(js,fjs);
		}
	}(document, 'script', 'twitter-wjs');
</script>