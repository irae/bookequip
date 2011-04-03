<?php

/**
 * LabEquipmentScheduleTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class LabEquipmentScheduleTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object LabEquipmentScheduleTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('LabEquipmentSchedule');
    }
	
	public function daySchedules($choosenDay = null)
	{
	
		if (is_null($choosenDay)) $choosenDay = date('Y-m-d');
		$query = Doctrine_Query::create()
			->from('LabEquipmentSchedule s')
			->leftJoin('s.LabAppointment a ON (s.id = a.schedule_id) AND (a.appointment_date = \'' . $choosenDay . '\')');
			
		return $query;
		
	}
	
	public function dayAvaiableSchedules($choosenDay = null)
	{
		if (is_null($choosenDay)) $choosenDay = date('Y-m-d');
		return $this->daySchedules($choosenDay)->andWhere('a.id IS NULL');
	}
}