<?php
class ScheduleForm extends BaseForm
{
	
	public function configure()
	{
		
		// Especifica o dia a partir do qual será analizado o horário
		$startDay = date('Y-m-d');
		// Especifica quantos dias aparecem na tabela (conta com os fins de semana que são excluidos)
		$dateRange = 14;
		$this->selectedValue = null;
		$appointmentId = null;
		
		
		if (array_key_exists('appointmentId', $this->options)) {
			
			// Appointment Edit
			$appointmentInfo      =  Doctrine_Core::getTable('LabAppointment')->find($this->options['appointmentId']);
			$equipmentId          =  $appointmentInfo->getEquipmentId();
			$editAppoint['date']  =  $appointmentInfo->getAppointmentDate();
			$editAppoint['time']  =  $appointmentInfo->getScheduleId();
			$this->selectedValue  =  $editAppoint['date'] . '.' . $editAppoint['time'];
			$appointmentId        =  $this->options['appointmentId'];
			
			$queryCreatedAt = Doctrine_Query::create()
				->select('created_at')
				->from('LabAppointment')
				->where('id = ?', $this->options['appointmentId']);
			$result = $queryCreatedAt->fetchArray();
			$startDay = $result[0]['created_at'];

		} else {
			
			// New Appointment
			foreach($_SESSION['appointmentData'] as $stagePosition => $stageData) {
				if ($stageData['stageName'] == 'lista-equipamentos') {
					$equipmentId = $stageData['equipment'];
					break;
				}
			}
		
		}
		
		$unavaibleSchedules = Doctrine_Core::getTable('LabAppointment')
			->getUnavaiableAppointments($equipmentId, $startDay, $dateRange, $appointmentId);
		$this->equipmentSchedule = Doctrine_Core::getTable('LabEquipment')->find($equipmentId)->getLabEquipmentSchedule();
		
		// Constroi uma array com valores do tipo YYYY-mm-dd.N, 
		// que representa os datas e os respectivos ID's dos horários disponíveis
		$this->avaiableChoices = array();
		$this->scheduleMatrix = array();
		
		for ($i = 0; $i < $dateRange; $i++) {
			$analyzeDate = date('Y-m-d',(strtotime($startDay)+3600*24*$i));
			if (date('l', strtotime($analyzeDate)) != 'Saturday' && date('l', strtotime($analyzeDate)) != 'Sunday') {
				$this->schedule[$analyzeDate] = array();
				foreach($this->equipmentSchedule as $schedule) {
					if (!array_key_exists($analyzeDate, $unavaibleSchedules) ||
						!in_array($schedule->getId(), $unavaibleSchedules[$analyzeDate])) {
						// Array para validação do formulário
						$this->avaiableChoices[$analyzeDate.'.'.$schedule->getId()] = date('d/m/Y', strtotime($analyzeDate)) . ' das ' . $schedule->getStartTime() . ' às ' . $schedule->getEndTime();
						// Array para construir a tabela de agendamento
						$this->scheduleMatrix[$analyzeDate][$schedule->getId()] = true;
					} else {
						$this->scheduleMatrix[$analyzeDate][$schedule->getId()] = false;
					}
				}			
			}
		}
					
		$this->setWidgets(array(
			'schedule' => new sfWidgetFormChoice(array('expanded' => true, 'choices' => $this->avaiableChoices))
		));
				
		$this->setValidators(array(
			'schedule' => new sfValidatorChoice(array('required' => true, 'choices' => array_keys($this->avaiableChoices)))
		));
		
		$this->widgetSchema->setLabels(array(
			'schedule' => 'Date e Hora',
		));
		
		$this->widgetSchema->setNameFormat('appointment[%s]');
		
		if (array_key_exists('editMode', $this->options)) {
			$this->setDefaults(array(
				'schedule' => $this->selectedValue
			));
		}
		
	}
	
}
?>