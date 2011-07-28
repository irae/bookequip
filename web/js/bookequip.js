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
	
	$('a.autorizar').click(function(e) {
		e.preventDefault();
		var request_address = $(this).attr('href');
		$('<div id="async_request"></div>').hide().appendTo('body').load(request_address, function() {
			if ($('#async_request').text() == 'Success') {
				if ($('.block_content tbody tr').size() > 1) {
					$(e.target).parents('tr').filter(':first').hide().remove();
				} else {
					$('.block_content table').hide().remove();
					$('.block_content').append('<div class="message info"><p>Não há usuários desse tipo no momento.</p></div>');
				}
			}
		});
	});
	
	if($('#cal_sync').size() > 0) {
		$('<div id="async_request"></div>').hide().appendTo('body').load('adicionar', function() {
			if ($('#async_request').text() == '0') {
				$('#cal_sync').removeClass('info').addClass('warning').text('Refresh');
			} else if ($('#async_request').text() == '1') {
				$('#cal_sync').removeClass('info').addClass('success').text('Calendário sincronizado com sucesso!');
			} else {
				$('#cal_sync').removeClass('info').addClass('errormsg').text('Ocorreu um erro na atualização do calendário.');
			}
		});
	}
	
});