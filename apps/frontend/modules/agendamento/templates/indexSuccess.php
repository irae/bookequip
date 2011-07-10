<?php

echo '<p>Olá, ' . $welcomeName . '.</p>';
echo '<h1>Meus Agendamentos</h1>';

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