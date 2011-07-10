<h1>Horário do Agendamento</h1>
<?php
switch ($this->getActionName()) {
	case 'novo':   $formAction = url_for('agendamento/novo') . '/' . $currentStage; break;
	case 'editar': $formAction = url_for('agendamento/editar') . '/' . $appointmentId . '/' . $currentStage; break;
}
?>
<form action="<?php echo $formAction; ?>" method="post">
<table>
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

<input type="submit" value="Próximo" />
</form>