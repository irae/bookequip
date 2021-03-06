<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<form action="<?php echo url_for('cadastro/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<h2>Dados da Conta</h2>
<?php foreach ($form->getWidgetSchema()->getFields() as $widgetName => $widgetInfo): ?>
	<?php if ($widgetName != 'LabUser'): ?>
		<?php $widgetOptions = $widgetInfo->getOptions(); ?>
		<?php if ($widgetOptions['type'] == 'hidden'): ?>
			<?php echo $form[$widgetName]->render(); ?>
		<?php else: ?>
			<p>
			<?php echo $form[$widgetName]->renderLabel() ?>
			<?php if (!is_null($form[$widgetName]->getError())) echo '<span>'.$form[$widgetName]->getError().'</span>'; ?>
			<br /> 			
			<?php echo $form[$widgetName]->render(array('class' => 'text small')); ?>
			</p>
		<?php endif; ?>
	<?php else: ?>
	<br />
	<!-- Formulário dos dados pessoais -->
		<h2>Dados Pessoais</h2>
		<?php foreach ($form['LabUser'] as $inputName => $inputInfo): ?>
			<p>
			<?php echo $form['LabUser'][$inputName]->renderLabel(); ?><br />
			<?php echo $form['LabUser'][$inputName]->render(array('class' => 'text small')); ?>
			</p>
		<?php endforeach; ?>
	<?php endif; ?>
<?php endforeach; ?>

<?php if (!$form->getObject()->isNew()): ?>
	<br /><p><input type="submit" class="submit mid" value="Cadastrar" />
      &nbsp;<?php echo link_to('Remover Conta', 'cadastro/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Você tem certeza?')) ?></p>
<?php else: ?>
	<br /><p><input type="submit" class="submit mid" value="Cadastrar" /></p>
<?php endif; ?>

</form>
