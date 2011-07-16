<div class="block withsidebar">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>	
		<?php
		switch ($this->getActionName()) {
			case 'novo':   echo '<h2>Novo agendamento</h2>'; break;
			case 'editar': echo '<h2>Editar agendamento</h2>'; break;
		}
		?>
	</div>		<!-- .block_head ends -->
	
	
	<div class="block_content">
		
		<div class="sidebar">
			<ul class="sidemenu">
				<?php foreach(appointmentFormBuilder::$stages as $stageAddress => $stageInfo): ?>
					<li<?php if ($stageAddress == $currentStage) echo ' class="active"'; ?>><a href="#"><?php echo $stageInfo['title'] ?></a></li>
				<?php endforeach;?>
				<?php if ($this->getActionName() == 'novo') echo '<li><a href="#">Resumo</a></li>'; ?>
			</ul>
		</div>		<!-- .sidebar ends -->
		
		<div class="pseudo_sidebar_content">
			<?php
			switch ($this->getActionName()) {
				case 'novo':   $formAction = url_for('agendamento/novo') . '/' . $currentStage; break;
				case 'editar': $formAction = url_for('agendamento/editar?id=' . $appointmentId . '&stage=' . $currentStage); break;
			}
			if ($userInfo = $sf_user->getAttribute('agendar_como', false)) echo '<div class="message warning"><p>Agendando como ' . $userInfo['name'] . ' <a class="cancelar_agendamento" href="'.url_for('agendamento/agendarUsuario?mode=cancelar').'">(Cancelar)</a></p></div>';
			?>
			
			<form action="<?php echo $formAction ?>" method="post">
			
			<?php foreach ($form->getWidgetSchema()->getFields() as $inputName => $info): ?>
				<?php if ($inputName != '_csrf_token'): ?>
					<h3><?php echo $form[$inputName]->renderLabel(); ?></h3>
					<?php echo $form[$inputName]->render(); ?>
					<br />
				<?php endif; ?>
			<?php endforeach; ?>
			<?php echo $form['_csrf_token'] ?>
			<br />
			<?php
			switch ($this->getActionName()) {
				case 'novo':   echo '<p><input type="submit" value="Próximo" class="submit mid"/></p>'; break;
				case 'editar': echo '<p><input type="submit" value="Atualizar" class="submit mid"/></p>'; break;
			}
			?>
			</form>		
		</div>		<!-- .sidebar_content ends -->								
	</div>		<!-- .block_content ends -->

	
	<div class="bendl"></div>
	<div class="bendr"></div>
	
</div>		<!-- .block ends -->