<?php

/**
 * LabAppointmentTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class LabAppointmentTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object LabAppointmentTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('LabAppointment');
    }
	
	public function createEmptyQuery()
	{
		return Doctrine_Query::create()->from('LabAppointment');
	}
	
	public function userAppointments($userId)
	{
		$query = $this->createEmptyQuery()
			->andWhere('user_id = ?', $userId);
		
		return $this->getFromThisWeek($query);
		
	}
	
	public function currentWeekAppointments(Doctrine_Query $query = null)
	{
		if (is_null($query)) $query = $this->createEmptyQuery();
		$query->andWhere('WEEK(appointment_date) = WEEK(NOW())');
		return $query;
	}
	
	public function weekUserApointments($userId) 
	{
		return $this->weekAppointments($this->userAppointments($userId));
	}
	

	
}