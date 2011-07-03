<form action="<?php echo url_for('agendamento/editar?id=' . $appointmentId . '&stage=' . $formStage); ?>" method="post">
<table>
<?php echo $form ?>
<tr>
<td colspan="2"><input type="submit" value="Confirmar" /></td>
</tr>
</table>
</form>
