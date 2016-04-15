@extends('layouts.app')

@section('content')
<div class="container home-page">
    <div class="row">
        <div class="col-sm-6 text-center left-box">
            <h3>Wishloop Browser Integration</h3>
            <p>Our powerful bookmarklet lets you create RemoteCommander links on the fly, without even leaving your current page, it is compatible with all browsers</p>
            <h4>Just drag & drop the button below to your bookmarks bar and that's all!</h4>
            <div>
                {{-- <a 
                href="javascript:(function(){ var script = document.createElement('script');
									    script.type = 'text/javascript';
									    script.src = '{{url('/assets/js/bookmarklet.js')}}'; 
									    document.getElementsByTagName('head')[0].appendChild(script);
									    return false; })()"
				class="btn btn-default">Bookmarklet</a> --}}
				<a href="javascript:(function (d) {
    var s = d.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = 'http://sltest.j.layershift.co.uk/assets/js/bookmarklet.js';
    d.body.appendChild(s);
    var c = d.createElement('link');
    c.type = 'text/css';
    c.rel = 'stylesheet';
    c.href = 'http://sltest.j.layershift.co.uk/assets/css/bookmarklet.css';
    d.body.appendChild(c);
}(document));" class="btn btn-default">Bookmarklet</a>
            </div>
        </div>
    </div>
</div>
@endsection