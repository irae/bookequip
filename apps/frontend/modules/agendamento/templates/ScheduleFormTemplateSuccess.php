<div class="block withsidebar">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>	
		<?php
		switch ($this->getActionName()) {
			case 'novo':   echo '<h2>Novo Agendamento</h2>'; break;
			case 'editar': echo '<h2>Editar Agendamento</h2>'; break;
		}
		?>
	</div>		<!-- .block_head ends -->
	
	
	<div class="block_content">
		
		<div class="sidebar">
			<ul class="sidemenu">
				<?php foreach(appointmentFormBuilder::$stages as $stageAddress => $stageInfo): ?>
					<li<?php if ($stageAddress == $currentStage) echo ' class="active"'; ?>><a href="#"><?php echo $stageInfo['title'] ?></a></li>
				<?php endforeach;?>
			</ul>
		</div>		<!-- .sidebar ends -->
		
		<div class="sidebar_content">
			<?php
			switch ($this->getActionName()) {
				case 'novo':   $formAction = url_for('agendamento/novo') . '/' . $currentStage; break;
				case 'editar': $formAction = url_for('agendamento/editar') . '/' . $appointmentId . '/' . $currentStage; break;
			}
			?>
			<form action="<?php echo $formAction; ?>" method="post">
			<table class="schedule-table">
			<thead>
				<th>Data</th>
				<?php foreach($form->equipmentSchedule as $schedule) echo '<th>' . $schedule->getStartTime() . ' - ' . $schedule->getEndTime() . '</th>'; ?>
			</thead>
			<tbody>
				<?php 
				foreach($form->scheduleMatrix as $scheduleDate => $scheduleTime) {
					echo '<tr>';
					echo '<td>' . date('d/m/Y', strtotime($scheduleDate)) . '</td>';
					foreach ($scheduleTime as $scheduleId => $isAvaiable) {
						echo '<td>';
						if ($isAvaiable) {
							if ($form->selectedValue != ($scheduleDate.'.'.$scheduleId)) {
								echo '<input name="appointment[schedule]" type="radio" value="'.$scheduleDate.'.'.$scheduleId.'" />';
							} else {
								echo '<input name="appointment[schedule]" type="radio" value="'.$scheduleDate.'.'.$scheduleId.'" checked />';
							}
						} else {
							echo 'Reservado';
						}
						echo '</td>';
					}
					echo '</tr>';
				}

				echo $form['_csrf_token'];

				?>
			</tbody>
			</table>
			<p><input type="submit" value="Finalizar" class="submit mid"/></p>
			</form>	
		</div>		<!-- .sidebar_content ends -->								
	</div>		<!-- .block_content ends -->

	
	<div class="bendl"></div>
	<div class="bendr"></div>
	
</div>		<!-- .block ends -->