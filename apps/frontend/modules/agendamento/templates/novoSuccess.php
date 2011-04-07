<form action="<?php echo url_for('agendamento/novo') . '/' . $currentStage ?>" method="post">
<table>
<?php echo $form ?>
<tr>
<td colspan="2"><input type="submit" value="Enviar" /></td>
</tr>
</table>
</form>

<?php echo nl2br(@var_dump($_SESSION['appointment_stages'])); ?>