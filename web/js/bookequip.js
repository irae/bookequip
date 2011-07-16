$(function() {
	$('a.cancelar_agendamento').click(function(e) {
		e.preventDefault();
		var request_address = $(this).attr('href');
		$('<div id="async_request"></div>').hide().appendTo('body').load(request_address, function() {
			if ($('#async_request').text() == 'Success') {
				$(e.target).parent().siblings('span.close').click();
			}
		});
	});
});