<div id="novo_agendamento" class="block withsidebar">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>	
		<h2>Novo Agendamento</h2>
	</div>		<!-- .block_head ends -->
	
	
	<div class="block_content">
		
		<div class="sidebar">
			<ul class="sidemenu">
				<?php foreach(appointmentFormBuilder::$stages as $stageAddress => $stageInfo): ?>
					<li><a href="#"><?php echo $stageInfo['title'] ?></a></li>
				<?php endforeach;?>
					<li class="active"><a href="#">Resumo</a></li>
			</ul>
		</div>		<!-- .sidebar ends -->
		
		<div class="sidebar_content">
			<h2>Resumo do agendamento</h2>
			<p>Aenean facilisis ligula eget orci adipiscing varius. Curabitur sem ligula, egestas vel bibendum sed, sodales eu nulla. Vestibulum luctus aliquam feugiat. Donec porta interdum placerat. Donec velit enim, porta vitae euismod ut, fermentum eu felis. Morbi aliquet, libero vel gravida facilisis, enim risus consequat tellus, vitae luctus est diam non nisi. Vivamus eget leo sit amet neque ultricies blandit. Sed tristique erat a sem ullamcorper tempor.</p>
			<form action="<?php echo url_for('agendamento/submit')  ?>" method="post">
			<input type="hidden" name="submission_type" value="new_appointment" />
			<?php 

			foreach ($resumoAgendamento as $stage) {
				//echo '<h2>' . $stage['title'] . '</h2>';
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
			<input type="submit" class="submit mid " value="Confirmar" />
			</form>
		</div>		<!-- .sidebar_content ends -->								
	</div>		<!-- .block_content ends -->

	
	<div class="bendl"></div>
	<div class="bendr"></div>
	
</div>		<!-- .block ends -->
