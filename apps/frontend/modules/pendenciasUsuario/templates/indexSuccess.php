<div class="block">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>	
		<h2>Pendências Cadastrais</h2>
		<ul class="tabs">
			<li<?php if ($groupId == 2) echo ' class="active"' ?>><a href="<?php echo url_for('pendenciasUsuario/index?nivel_usuario=cadastro-pendente') ?>">Cadastro Pendente</a></li>
			<li<?php if ($groupId == 4) echo ' class="active"' ?>><a href="<?php echo url_for('pendenciasUsuario/index?nivel_usuario=avancado-pendente') ?>">Avançado Pendente</a></li>
		</ul>
	</div>		<!-- .block_head ends -->
	
	<div class="block_content">

	<?php if ($userList->count() > 0): ?>
		<form action="<?php echo url_for('pendenciasUsuario/autorizar?nivel_usuario='.$autorizeToGroup) ?>" method="post">
		<table cellpadding="0" cellspacing="0" width="100%"> 

			<thead> 
				<tr> 
					<th width="10"><input type="checkbox" class="check_all" /></th> 
					<th>Nome</th> 
					<th>Status</th>
					<th>Solicitado em</th> 
					<td>&nbsp;</td> 
				</tr> 
			</thead> 

			<tbody>
				<?php foreach ($userList as $user): ?>
				<tr> 
					<td><input type="checkbox" name="allow_user[]" value="<?php echo $user->getUserId() ?>" /></td> 
					<td><a href="#"><?php echo $user->getUser()->getProfileFirstName() ?></a></td> 
					<td><?php echo $listStatusText ?></td> 
					<td><?php echo $user->get('created_at') ?></td> 
					<td><a class="autorizar" href="<?php echo url_for('pendenciasUsuario/autorizar?nivel_usuario='.$autorizeToGroup.'&user_id=' . $user->getUserId()) ?>">Permitir</a></td> 
				</tr>
				<?php endforeach; ?>
			</tbody> 

		</table>
		
		<div class="tableactions"> 
			<select> 
				<option>Permitir</option> 
			</select> 

			<input type="submit" class="submit tiny" value="Aplicar" /> 
		</div>		<!-- .tableactions ends -->
		</form>
		
	<?php else: ?>
		<div class="message info"><p>Não há usuários desse tipo no momento.</p></div>
	<?php endif; ?>
	
	</div>		<!-- .block_content ends -->
	
	<div class="bendl"></div>
	<div class="bendr"></div>
	
</div>		<!-- .block ends -->