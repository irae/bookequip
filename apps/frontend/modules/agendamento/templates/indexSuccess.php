<div class="block">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>	
		<h2>Meus Agendamentos</h2>
		<ul class="tabs">
			<li><a href="<?php echo url_for('agendamento/novo') ?>">Novo agendamento</a></li>
		</ul>
	</div>		<!-- .block_head ends -->
	
	
	<div class="block_content">
		<?php if ($sf_user->hasFlash('success_message')): ?>
		  <div class="message success"><p><?php echo $sf_user->getFlash('success_message') ?></p></div>
		<?php endif; ?>
		<?php if ($lastAppointments->count() > 0):  ?>
			
			<table cellpadding="0" cellspacing="0" width="100%"> 

				<thead> 
					<tr> 
						<th>Equipamento</th> 
						<th>Data</th>
						<th>Horário Agendado</th>
						<th>Status do Agendamento</th> 
						<th>Opções</th> 
					</tr> 
				</thead>
				
				<tbody>
			
			<?php foreach ($lastAppointments as $appointment): ?>
					<tr>
						<td><?php echo $appointment->getEquipment()->getName() ?></td>
						<td><?php echo date('d/m/Y', strtotime($appointment->getAppointmentDate())) ?></td>
						<td><?php echo date('H:i', strtotime($appointment->getScheduleInfo()->getStartTime())) . ' às ' . date('H:i', strtotime($appointment->getScheduleInfo()->getEndTime())); ?></td>
						<td><?php echo ucfirst($appointment->getEventStatus()) ?></td>
						<td><a href="<?php echo url_for('agendamento/resumo?id=' . $appointment->getId()) ?>">Mais Informações</a></td>
					</tr>
			<?php endforeach; ?>
				</tbody>
				</table>

		<?php else: ?>
			
			<div class="message info"><p>Você ainda não possui agendamentos.</p></div>

		<?php endif; ?> 
	</div>		<!-- .block_content ends -->

	
	<div class="bendl"></div>
	<div class="bendr"></div>
	
</div>		<!-- .block ends -->