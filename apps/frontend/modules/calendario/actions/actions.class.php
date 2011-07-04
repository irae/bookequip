<?php

/**
 * calendario actions.
 *
 * @package    BookEquip
 * @subpackage calendario
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class calendarioActions extends sfActions
{

	private function getClientLogin()
	{
		$user = 'bookequip@gmail.com';
		$pass = 'bookequip123';
		$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
		return $client = Zend_Gdata_ClientLogin::getHttpClient($user,$pass,$service);
	}

	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		require_once 'Zend/Loader.php';
		Zend_Loader::loadClass('Zend_Gdata');
		Zend_Loader::loadClass('Zend_Gdata_AuthSub');
		Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
		Zend_Loader::loadClass('Zend_Gdata_Calendar');
		$this->addAppointmentToCalendar(1);
	}
	
	private function addAppointmentToCalendar($appointmentId)
	{
		// TODO: Checar se agendamento existe
		$appointmentData = Doctrine_Core::getTable('LabAppointment')->find($appointmentId); 
		echo $appointmentData->getLabEquipment()->getName();
		exit;	
		$gdataCal = new Zend_Gdata_Calendar($this->getClientLogin());
		$newEvent = $gdataCal->newEventEntry();
		$newEvent->title = $gdataCal->newTitle($title);
		$newEvent->where = array($gdataCal->newWhere($where));
		$newEvent->content = $gdataCal->newContent("$desc");

		$when = $gdataCal->newWhen();
		$when->startTime = "{$startDate}T{$startTime}:00.000{$tzOffset}:00";
		$when->endTime = "{$endDate}T{$endTime}:00.000{$tzOffset}:00";
		$newEvent->when = array($when);

		// Upload the event to the calendar server
		// A copy of the event as it is recorded on the server is returned
		$createdEvent = $gdataCal->insertEvent($newEvent);
		return $createdEvent->id->text;
	}

}