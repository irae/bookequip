<?php
class SchedulleForm extends BaseForm
{
	
	public function configure()
	{
		
		foreach($_SESSION['appointmentData'] as $stagePosition => $stageData) {
			if ($stageData['stageName'] == 'lista-equipamentos') {
				$equipmentId = $stageData['equipment'];
				break;
			}
		}
		
		$equipmentSchedules = Doctrine_Core::getTable('LabEquipment')->find($equipmentId)->getLabEquipmentSchedule();
		foreach($equipmentSchedules as $scheduleChoice) {
			$allSchedules[] = $scheduleChoice->getId();
		}
		
		$dayAvaiableschedules = Doctrine_Core::getTable('LabEquipmentSchedule')->equipmentDaySchedules($equipmentId, null)->fetchArray();
		
		foreach($dayAvaiableschedules as $schedule) {
			if (empty($schedule['LabAppointment'])) {
				$choices[$schedule['id']] = $schedule['start_time'] . ' - ' . $schedule['end_time'];
			}
		}
		
		$todayTimeStamp = mktime(0, 0, 0, date('n'), date('j'), date('Y'));
	
		$this->setWidgets(array(
			'appointment_date' => new sfWidgetFormJQueryDate(array('culture' => 'en')),
			'schedulle_time'   => new sfWidgetFormChoice(array('expanded' => true, 'choices' => $choices))
		));
		
		$this->setValidators(array(
			'appointment_date' => new sfValidatorDate(array('required' => true, 'max' => $todayTimeStamp, 'min' => $todayTimeStamp, 'date_format_range_error' => 'd/m/Y')),
			'schedulle_time'   => new sfValidatorChoice(array('required' => true, 'choices' => $allSchedules))
		));
		
		$this->widgetSchema->setLabels(array(
			'appointment_date' => 'Data',
			'schedulle_time'   => 'Horários Disponíveis',
		));
		
		$this->widgetSchema->setNameFormat('appointment[%s]');
		
	}
	
}
?>