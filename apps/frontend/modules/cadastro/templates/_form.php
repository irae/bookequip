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
			<?php echo '<h3>' . $form[$widgetName]->renderLabel() . '</h3>'; ?>
			<?php echo $form[$widgetName]->render(array('class' => 'text small')); ?>
		<?php endif; ?>
	<?php else: ?>
	<br />
	<br />
	<!-- Formulário dos dados pessoais -->
		<h2>Dados Pessoais</h2>
		<?php foreach ($form['LabUser'] as $inputName => $inputInfo): ?>
			<h3><?php echo $form['LabUser'][$inputName]->renderLabel(); ?></h3>
			<?php echo $form['LabUser'][$inputName]->render(array('class' => 'text small')); ?>
			<br />
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
