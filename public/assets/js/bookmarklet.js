(function() {
  var script;

  if(!window.jQuery) {

    script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js";
    document.body.appendChild(script);

  }

  (function check_if_loaded() {

    if(!window.jQuery) {

    	setTimeout(check_if_loaded, 50);

    } else {

      (function($) {

        var
        	$dark_bg = $('<div></div>').css({'z-index': '1000', 'background-color': '#000000', 'opacity': '0', 'position': 'fixed', 'width': '100%', 'height': '100%'}),
        	$iframe = $('<iframe></iframe>').css({'width': '100%', 'height': '100%', 'border': 1, 'overflow': 'hidden'}).prop({'src': 'http://sltest.j.layershift.co.uk/bookmarklet?url='+window.location.href, 'width': '100%', 'height': '100%', 'scrolling': 'no'}),
        	$modal = $('<div></div>').css({'z-index': '1010', 'background-color': '#ffffff', 'opacity': '0', 'position': 'fixed', 'top': '10%', 'left': '35%', 'width': '400px', 'height': '500px', 'box-shadow': '7px 7px 5px #333'}).append($iframe);

        $('body').css({'padding': 0, 'margin': 0}).prepend($dark_bg, $modal);

        $dark_bg.animate({'opacity':0.5}, 400);

        $modal.animate({'opacity':1}, 400);

        $('body').on('click', function() {
        	$dark_bg.animate({'opacity': 0}, 400, function(){ $dark_bg.remove(); });
        	$modal.animate({'opacity': 0}, 400, function(){ $modal.remove(); });
        });
      }(window.jQuery));

    }

  }());

}());