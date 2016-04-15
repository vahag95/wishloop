function trafficAddClick (arg) {
	$.get('/traffic-add-click/'+arg.className, function(){});
}

function helloBarAddClick (arg) {
	$.get('/hello-bar-add-click/'+arg.id, function(){});
}