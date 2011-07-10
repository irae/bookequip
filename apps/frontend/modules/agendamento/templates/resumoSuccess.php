<form action="<?php echo url_for('agendamento/submit')  ?>" method="post">
<input type="hidden" name="submission_type" value="new_appointment" />
<?php 

foreach ($resumoAgendamento as $stage) {
	echo '<h2>' . $stage['title'] . '</h2>';
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
<input type="submit" value="Confirmar" />
</form>