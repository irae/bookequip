
<div class="block small left">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		
		<h2>Editar Perfil</h2>	
	</div>		<!-- .block_head ends -->
	
	
	
	<div class="block_content">
	
<?php include_partial('form', array('form' => $form)) ?>
		
	</div>		<!-- .block_content ends -->
	
	<div class="bendl"></div>
	<div class="bendr"></div>
	
</div>		<!-- .block.small.left ends -->
<?php
	switch ($groupName) {
		case 'admin':
			$accountTitle = 'Conta Administrativa';
			$description = 'Quisque felis nunc, lacinia at, viverra sit amet ligula. Praesent justo risus, suscipit eget volutpat ac, fermentum ac massa. Sed at justo velit. Maecenas dapibus sem nec quam cursus.';
			$upgradeAvaiable = false;
			break;
		case 'cadastro pendente':
			$accountTitle = 'Cadastro Pendente';
			$description = 'Quisque felis nunc, lacinia at, viverra sit amet ligula. Praesent justo risus, suscipit eget volutpat ac, fermentum ac massa. Sed at justo velit. Maecenas dapibus sem nec quam cursus.';
			$upgradeAvaiable = false;
			break;
		case 'básico':
			$accountTitle = 'Conta Nível Básico';
			$description = 'Quisque felis nunc, lacinia at, viverra sit amet ligula. Praesent justo risus, suscipit eget volutpat ac, fermentum ac massa. Sed at justo velit. Maecenas dapibus sem nec quam cursus.';
			$upgradeAvaiable = true;
			break;
		case 'básico':
			$accountTitle = 'Conta Nível Básico';
			$description = 'Quisque felis nunc, lacinia at, viverra sit amet ligula. Praesent justo risus, suscipit eget volutpat ac, fermentum ac massa. Sed at justo velit. Maecenas dapibus sem nec quam cursus.';
			$upgradeAvaiable = true;
			break;
		case 'avançado pendente':
			$accountTitle = 'Solicitação de conta avançada em andamento.';
			$description = 'Quisque felis nunc, lacinia at, viverra sit amet ligula. Praesent justo risus, suscipit eget volutpat ac, fermentum ac massa. Sed at justo velit. Maecenas dapibus sem nec quam cursus.';
			$upgradeAvaiable = false;
			break;
		case 'avançado':
			$accountTitle = 'Conta Nível Avançado';
			$description = 'Quisque felis nunc, lacinia at, viverra sit amet ligula. Praesent justo risus, suscipit eget volutpat ac, fermentum ac massa. Sed at justo velit. Maecenas dapibus sem nec quam cursus.';
			$upgradeAvaiable = false;
			break;
	}
?>


<div class="block small right">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		
		<h2>Status da Conta</h2>
	</div>		<!-- .block_head ends -->
	
	<div class="block_content">
	
		<h2><?php echo $accountTitle ?></h2>
		<p><?php echo $description ?></p>
		<?php if ($upgradeAvaiable): ?>
			<form action="<?php echo url_for('cadastro/upgrade') ?>" method="post">
			<p><input type="submit" value="Solicitar Upgrade" class="submit long" /></p>
			</form>
		<?php endif; ?>
		
	</div>		<!-- .block_content ends -->
	
	<div class="bendl"></div>
	<div class="bendr"></div>
	
</div>		<!-- .block.small.right ends -->



