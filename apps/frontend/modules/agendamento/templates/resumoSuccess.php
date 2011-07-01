<form action="<?php echo url_for('agendamento/submit')  ?>" method="post">
<input type="hidden" name="submission_type" value="new_appointment" />
<pre><?php print_r($resumoAgendamento); ?></pre>
<input type="submit" value="Confirmar" />
</form>