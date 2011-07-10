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

	public function weekAppointments(Doctrine_Query $query = null)
	{
		if (is_null($query)) $query = $this->createEmptyQuery();
		$query->andWhere('WEEK(appointment_date) = WEEK(NOW())');
		return $query;
	}
	
	public function userAppointments($userId)
	{
		$query = $this->createEmptyQuery()
			->Where('user_id = ?', $userId);
		
		return $query;
		
	}

	public function weekUserApointments($userId) 
	{
		return $this->weekAppointments($this->userAppointments($userId));
	}
	
	public function userAppointmentsByStatus($userId, $status)
	{
		$this->userAppointments($userId)->andWhere('event_status = ?', $status);
	}
	
	public function checkOwnership($appointmentId, $userId)
	{
		$query = $this->createEmptyQuery()->where('id = ?', $appointmentId)->andWhere('user_id = ?', $userId);
		
		if ($query->count() > 0) {
			return true;
		} else {
			return false;
		}
	
	}
	
	public function updateSchedule($appointmentId, $appointmentDate, $scheduleTimeId)
	{

		$query = Doctrine_Query::create()
		->update('LabAppointment')
		->set('schedule_id', '?', $scheduleTimeId)
		->set('appointment_date', '?', $appointmentDate)
		->where('id = ?', $appointmentId)
		->limit(1);
		
		$query->execute();
		
	}
	
	public function queryLastUserAppointments($userId, $queryLimit = 15)
	{
	
		$query = $this->userAppointments($userId)->orderBy('appointment_date DESC')->limit($queryLimit);
		return $query->execute();
		
	}
	
	/**
     * Shows unavaible appointment schedules for the next 2 weeks, excluding weekends
     *
     * @return object Doctrine_Collection
     */
	public function getUnavaiableAppointments($equipment, $choosenDay = null, $daysRange = 14, $excludeAppointment = null) {
		
		if (is_null($choosenDay)) $choosenDay = date('Y-m-d');
		$endTimestamp = strtotime($choosenDay)+(3600*24*$daysRange);
		$endDate = date('Y-m-d', $endTimestamp);
		$query = Doctrine_Query::create()
			->select('a.id, a.appointment_date, a.schedule_id')
			->from('LabAppointment a')
			->leftJoin('a.ScheduleInfo s ON (a.schedule_id = s.id AND a.appointment_date >= \'' . $choosenDay . '\' AND a.appointment_date <= \'' . $endDate . '\')')
			->andWhere('s.equipment_id = \'' . $equipment . '\'');
			
		if (!is_null($excludeAppointment)) {
			$query->andWhere('a.id != \'' . $excludeAppointment . '\'');
		}
		
		$query->orderBy('a.appointment_date ASC');
		
		$result = $query->fetchArray();
		$unavaiableSchedule = array();
		foreach ($result as $appointment) {
			if (!array_key_exists($appointment['appointment_date'], $unavaiableSchedule)) {
				$unavaiableSchedule[$appointment['appointment_date']] = array();
			}
			$unavaiableSchedule[$appointment['appointment_date']][] = $appointment['schedule_id'];
		}
		
		return $unavaiableSchedule;
		
	}
	
}