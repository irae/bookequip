<div class="block">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>	
		<h2>Agendar para usuário</h2>
	</div>		<!-- .block_head ends -->
	
	<div class="block_content">
	<form action="<?php echo url_for('agendamento/agendarUsuario') ?>" method="post">
	<select name="usuario" class="styled">
		<?php foreach($userList as $user): ?>
			<?php echo '<option value="'. $user->getId() . '">' . $user->getProfileFirstName() . ' (' . $user->getUsername() . ')</option>'; ?>
		<?php endforeach; ?>
	</select>
	<br />
	<input type="submit" class="submit mid" value="Prosseguir" />
	</form>
	
	</div>		<!-- .block_content ends -->
	
	<div class="bendl"></div>
	<div class="bendr"></div>
	
</div>		<!-- .block ends -->