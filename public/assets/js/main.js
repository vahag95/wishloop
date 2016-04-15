$(document).ready(function() {
	var image = '';
	$('.hello-bar-preview-button').on('click', function() {
		$("html, body").animate({ scrollTop: 0 }, 600);
		var $inputs = $('.hello-bar-form :input');

	    var values = {};
	    $inputs.each(function() {
	        values[this.name] = $(this).val();
	    });		

		$('.hello-bar-preview-iframe-cont').children('iframe').fadeOut(500, function(){
		    $('.hello-bar-preview-iframe-cont').html('<iframe class="preview-iframe-hello-bar" src="/hello-bar-preview?data='+encodeURIComponent(JSON.stringify(values))+'"></iframe>');
		});
	})

	$('.traffic-preview-button').on('click', function() {
		$("html, body").animate({ scrollTop: 0 }, 600);
		var $inputs = $('.traffic-form :input');

	    var values = {};
	    $inputs.each(function() {
	        values[this.name] = $(this).val();
	    });
		$('.traffic-preview-iframe-cont').children('iframe').fadeOut(500, function(){
		    $('.traffic-preview-iframe-cont').html('<iframe class="preview-iframe-traffic" src="/traffic-preview?data='+encodeURIComponent(JSON.stringify(values))+'"></iframe>');
		});
		setTimeout(function(){
			readURL(image);
		}, 600);
	})
	function readURL(input) {

	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('.preview-iframe-traffic').contents().find('.logo').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$(".logo_img").change(function(){
		image = this;
	});

	var client = new ZeroClipboard( $(".copy_embed") );
	client.on( "beforecopy", function( event ) {
	    var getClientText = function( event ,  func ) {
	        text = $( event.target ).parents('.modal').find('.embed_code').val();
	        return func( text );
	    };
	    getClientText( event ,function( text ) {
	        client.setText( text );
	    });
	} );

	$('.copy_embed').click(function() {
	    $(this).parents('.modal-footer').siblings('.modal-body').children('textarea').select();
	});

})