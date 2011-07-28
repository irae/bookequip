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
		require_once(sfConfig::get("sf_root_dir") . '/apps/frontend/modules/calendario/config/calendar-config.inc.php');
		$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
		try {
		   $client = Zend_Gdata_ClientLogin::getHttpClient(sfConfig::get('calendar_user'), sfConfig::get('calendar_pass'), $service);
		} catch (Zend_Gdata_App_CaptchaRequiredException $cre) {
			$this->getUser()->setAttribute('captcha', array(
				'appointment_id' => $this->appointmentId,
				'image_url' => $cre->getCaptchaUrl(),
				'token' => $cre->getCaptchaToken()));
			$this->redirect('calendario/autenticar');					
		} catch (Zend_Gdata_App_AuthException $ae) {			
		   echo 'Problem authenticating: ' . $ae->exception() . "\n";
		}
		
		return $client;
	}

	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		
		
	}
	
	public function executeAdicionar (sfWebRequest $request)
	{
		$this->forward404Unless($this->getUser()->hasGroup('admin'));
		set_include_path(get_include_path() . PATH_SEPARATOR . sfConfig::get("sf_root_dir") . '/apps/frontend/lib');
		
		$query = Doctrine_Query::create()
			->from('LabAppointment')
			->where('is_synched = ?', 0)
			->andWhere('event_status = ?', 'aprovado')
			->limit(1);
			
		$queryResult = $query->execute();
		
		if ($queryResult->count() > 0) {
			
			$appointmentData = $queryResult[0];
			
			require_once 'Zend/Loader.php';
			Zend_Loader::loadClass('Zend_Gdata');
			Zend_Loader::loadClass('Zend_Gdata_AuthSub');
			Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
			Zend_Loader::loadClass('Zend_Gdata_Calendar');
						
			$gdataCal = new Zend_Gdata_Calendar($this->getClientLogin());

			if ($appointmentData->getCalendarUrl() != '') {
				// Remove a entrada antiga do evento, caso haja alguma.
				try {
				    $event = $gdataCal->getCalendarEventEntry($appointmentData->getCalendarUrl());
				} catch (Zend_Gdata_App_Exception $e) {
				    die("Error: " . $e->getMessage());
				}
				// TODO: Verificar se a remoção de fato ocorreu
				$event->delete();
			}

			$newEvent = $gdataCal->newEventEntry();
			$newEvent->title = $gdataCal->newTitle($appointmentData->getUser()->getProfileFirstName());
			$newEvent->where = array($gdataCal->newWhere('Laboratório UNIFESP'));
			$newEvent->content = $gdataCal->newContent($appointmentData->getEquipment()->getName());
			$when = $gdataCal->newWhen();
			$when->startTime = $appointmentData->getAppointmentDate().'T'.$appointmentData->getScheduleInfo()->getStartTime().'-03:00';
			$when->endTime = $appointmentData->getAppointmentDate().'T'.$appointmentData->getScheduleInfo()->getEndTime().'-03:00';
			$newEvent->when = array($when);
			
			$equipmentInfo = Doctrine::getTable('LabEquipment')->find($appointmentData->getEquipmentId());
			$calendarUrl = str_replace('@', '%40', $equipmentInfo->getCalendarUrl());
		
			// TODO: Verificar se o evento foi ou não adicionado corretamente ao Google Calendar
			$createdEvent = $gdataCal->insertEvent($newEvent, 'http://www.google.com/calendar/feeds/' . $calendarUrl . '/private/full');
		
			// Informa ao sistema que o agendamento foi adicionado ao calendário
			$appointmentData->setCalendarUrl($createdEvent->id->text);
			$appointmentData->setIsSynched(1);
			$appointmentData->save();
			$json = '{"repeat":true}';
		
		} else {
			
			// Todos os eventos estão sincronizados com o calendário
			$json = '{"repeat":false}';
		
		}
		
		$this->getResponse()->setHttpHeader('Content-type', 'application/json');
		$this->renderText($json);
		return sfView::NONE;
		
	}
		
	public function executeSync (sfWebRequest $request) {

		$this->forward404Unless($this->getUser()->hasGroup('admin'));
		// Vide template/syncSuccess.php
	
	}
		
	public function executeAutenticar (sfWebRequest $request) {
		
		$this->$captchaInfo = $this->getUser()->getAttribute('captcha', null);
		if (is_null($captchaInfo)) $this->forward404();
		
	}
	
	private function removeEventFromCalendar($appointmentId)
	{
		set_include_path(get_include_path() . PATH_SEPARATOR . sfConfig::get("sf_root_dir") . '/apps/frontend/lib');
		require_once 'Zend/Loader.php';
		Zend_Loader::loadClass('Zend_Gdata');
		Zend_Loader::loadClass('Zend_Gdata_AuthSub');
		Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
		Zend_Loader::loadClass('Zend_Gdata_Calendar');
		$appointmentObj = Doctrine_Core::getTable('LabAppointment')->find($appointmentId);
		$eventURL = $appointmentObj->getCalendarUrl();
		$service = new Zend_Gdata_Calendar($this->getClientLogin());
		
		try {
		    $event = $service->getCalendarEventEntry($eventURL);
		} catch (Zend_Gdata_App_Exception $e) {
		    die("Error: " . $e->getMessage());
		}
		// TODO: Verificar se a remoção de fato ocorreu
		$event->delete();
		return true;
	
	}
	

}