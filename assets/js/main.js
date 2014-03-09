var rescan = function () {
	$.get(base_url+'?a=rescan', function () {
		window.location.reload();
	});
}