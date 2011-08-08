<div class="block">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>	
		<h2>Visualizar Agendamento</h2>
		<?php if (!$editMode): ?>
			<ul class="tabs">
				<li><a href="/backend.php/agendamento">Voltar à lista</a></li>
			</ul>
		<?php endif; ?>
	</div>		<!-- .block_head ends -->
		
	<div class="block_content">
		<?php if ($sf_user->hasFlash('success_message')): ?>
		  <div class="message success"><p><?php echo $sf_user->getFlash('success_message') ?></p></div>
		<?php endif; ?>
		<? foreach ($resumoAgendamento as $stage) {
			echo '<h2>' . $stage['title'];
			if ($editMode && $stage['editable']) {
				echo ' <a href="' . url_for('agendamento/editar/?id=' . $appointmentId . '&stage=' . $stage['form-slug']) . '">[editar]</a>';
			}
			echo '</h2>';
			foreach ($stage['fields'] as $field) {
				echo '<h3>' . $field['label'] . '</h3>';
				if (!is_array($field['value']) && !is_object($field['value'])) {
					echo '<p>' . $field['value'] . '</p>';
				} else {
					echo '<ul>';
					foreach ($field['value'] as $option) {
						echo '<li>' . $option . '</li>';
					}
					echo '</ul>';
				}
			}
		}
		?>
		
	</div>		<!-- .block_content ends -->


	<div class="bendl"></div>
	<div class="bendr"></div>

</div>		<!-- .block ends -->
