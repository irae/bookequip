<?php
class SchedulleForm extends BaseForm
{
	
	public function configure()
	{
		
		if (array_key_exists('editMode', $this->options)) {
			
			// Appointment Edit
			
			$appointmentInfo      =  Doctrine_Core::getTable('LabAppointment')->find($this->options['appointmentId']);
			$equipmentId          =  $appointmentInfo->getEquipmentId();
			$editAppoint['date']  =  $appointmentInfo->getAppointmentDate();
			$editAppoint['time']  =  $appointmentInfo->getScheduleId();

		} else {
		
			// New Appointment
		
			foreach($_SESSION['appointmentData'] as $stagePosition => $stageData) {
				if ($stageData['stageName'] == 'lista-equipamentos') {
					$equipmentId = $stageData['equipment'];
					break;
				}
			}
		
		}
		
		$dayAvaiableschedules = Doctrine_Core::getTable('LabEquipmentSchedule')->equipmentDaySchedules($equipmentId, null)->fetchArray();
		
		foreach($dayAvaiableschedules as $schedule) {
			if (empty($schedule['LabAppointment']) || (array_key_exists('editMode', $this->options) && $schedule['id'] == $editAppoint['time'])) {
				$choices[$schedule['id']] = $schedule['start_time'] . ' - ' . $schedule['end_time'];
			}
		}
		
		$todayTimeStamp = mktime(0, 0, 0, date('n'), date('j'), date('Y'));
	
		$this->setWidgets(array(
			'appointment_date' =>  new sfWidgetFormJQueryDate(array('culture' => 'en')),
			'schedule_time'    =>  new sfWidgetFormChoice(array('expanded' => true, 'choices' => $choices))
		));
		
		
		// Just defines the set of all schedule times for a primary validation.
		// After form submission, a "post-validation" is made to check if the schedule is avaiable.
		$equipmentSchedules = Doctrine_Core::getTable('LabEquipment')->find($equipmentId)->getLabEquipmentSchedule();
		foreach($equipmentSchedules as $scheduleChoice) {
			$allSchedules[] = $scheduleChoice->getId();
		}
		
		$this->setValidators(array(
			'appointment_date'  => new sfValidatorDate(array('required' => true, 'max' => $todayTimeStamp, 'min' => $todayTimeStamp, 'date_format_range_error' => 'd/m/Y')),
			'schedule_time'     => new sfValidatorChoice(array('required' => true, 'choices' => $allSchedules))
		));
		
		$this->widgetSchema->setLabels(array(
			'appointment_date' => 'Data',
			'schedule_time'    => 'Horários Disponíveis',
		));
		
		$this->widgetSchema->setNameFormat('appointment[%s]');
		
		if (array_key_exists('editMode', $this->options)) {
			$this->setDefaults(array(
				'appointment_date' => $editAppoint['date'],
				'schedule_time'    => $editAppoint['time']
			));
		} else {
			$this->setDefault('appointment_date', date('j-n-Y'));
		}
		
		
		
	}
	
}
?>