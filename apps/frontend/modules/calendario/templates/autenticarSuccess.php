<div class="block">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>	
		<h2>Concluir Agendamento</h2>
	</div>		<!-- .block_head ends -->
	
	<div class="block_content">

	<p>Para concluir o agendamento, por favor digite no campo abaixo o texto correspondente à imagem:</p>
	<form action="<?php echo url_for('calendario/adicionar?id=' . $captchaInfo['appointment_id']) ?>" method="post">
	<input type="text" class="text small" name="user_response" value="" />
	<input type="submit" class="submit mid" value="Concluir" />
	</form>
	
	<img src="<?php echo $captchaInfo['image_url'] ?>" alt="" />
	
	</div>		<!-- .block_content ends -->
	
	<div class="bendl"></div>
	<div class="bendr"></div>
	
</div>		<!-- .block ends -->