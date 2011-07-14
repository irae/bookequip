<div class="block">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>	
		<h2>Meus Agendamentos</h2>
		<ul class="tabs">
			<li><a href="<?php echo url_for('agendamento/novo') ?>">Novo agendamento</a></li>
		</ul>
	</div>		<!-- .block_head ends -->
	
	
	<div class="block_content">
		<?php
		if ($lastAppointments->count() > 0) {

			echo '<ul>';
			foreach ($lastAppointments as $appointment) {
				echo '<li>' . $appointment->getEquipment()->getName() . ', dia ' . date('d/m/Y', strtotime($appointment->getAppointmentDate()));
				echo ' às ' . date('H:i', strtotime($appointment->getScheduleInfo()->getStartTime()));
				echo ' <a href="' . url_for('agendamento/resumo?id=' . $appointment->getId()) . '">[veja os detalhes]</a>' . '</li>';
			}
			echo '</ul>';	

		} else {

			echo '<p>Você ainda não possui agendamentos.</p>';

		}
		?>
	</div>		<!-- .block_content ends -->

	
	<div class="bendl"></div>
	<div class="bendr"></div>
	
</div>		<!-- .block ends -->