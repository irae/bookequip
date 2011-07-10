<h1>Informações do Agendamento</h1>
<?php 

foreach ($resumoAgendamento as $stage) {
	echo '<h2>' . $stage['title'];
	if ($stage['editable']) {
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
