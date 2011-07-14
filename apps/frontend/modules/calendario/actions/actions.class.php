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
		try {
		   $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
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
	
	private function addAppointmentToCalendar($appointmentId)
	{
		
		// TODO: Checar se agendamento existe, se o evento no calendário existe etc.
		$appointmentData = Doctrine_Core::getTable('LabAppointment')->find($appointmentId); 
		$gdataCal = new Zend_Gdata_Calendar($this->getClientLogin());
		
		$newEvent = $gdataCal->newEventEntry();
		$newEvent->title = $gdataCal->newTitle($appointmentData->getEquipment()->getName());
		$newEvent->where = array($gdataCal->newWhere('Laboratório UNIFESP'));
		$newEvent->content = $gdataCal->newContent('Agendamento realizado por ' . $appointmentData->getUser()->getFirstName());
		
		$when = $gdataCal->newWhen();
		$when->startTime = $appointmentData->getAppointmentDate().'T'.$appointmentData->getScheduleInfo()->getStartTime().'-03:00';
		$when->endTime = $appointmentData->getAppointmentDate().'T'.$appointmentData->getScheduleInfo()->getEndTime().'-03:00';
		$newEvent->when = array($when);
		$createdEvent = $gdataCal->insertEvent($newEvent);
		// TODO: Verificar se o evento foi ou não adicionado corretamente ao Google Calendar
		$appointmentData->setCalendarUrl($createdEvent->id->text);
		$appointmentData->setIsSynched(1);
		$appointmentData->save();
		
		return true;
		
	}
	
	private function removeEventFromCalendar($appointmentId)
	{
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
	
	public function executeAdicionar (sfWebRequest $request) {
		set_include_path(get_include_path() . PATH_SEPARATOR . sfConfig::get("sf_root_dir") . '/apps/frontend/lib');
		require_once 'Zend/Loader.php';
		Zend_Loader::loadClass('Zend_Gdata');
		Zend_Loader::loadClass('Zend_Gdata_AuthSub');
		Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
		Zend_Loader::loadClass('Zend_Gdata_Calendar');
		if (is_null($request->getParameter('id'))) {
			die('TODO: Implementar modo rajada na adição de eventos ao calendário!');
		} else {
			$userId = $this->getUser()->getGuardUser()->getId();
			$appointmentId = $request->getParameter('id');
			$this->forward404Unless(Doctrine_Core::getTable('LabAppointment')->checkOwnership($appointmentId, $userId));
			if ($this->addAppointmentToCalendar($appointmentId)) {
				$this->redirect('agendamento/index');
			} else {
				die('Erro na adição do evento.');
			}
		
		}
		
	}
	
	public function executeAtualizar (sfWebRequest $request) {
		require_once 'Zend/Loader.php';
		Zend_Loader::loadClass('Zend_Gdata');
		Zend_Loader::loadClass('Zend_Gdata_AuthSub');
		Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
		Zend_Loader::loadClass('Zend_Gdata_Calendar');
		if (is_null($request->getParameter('id'))) {
			die('TODO: Implementar modo rajada na adição de eventos ao calendário!');
		} else {
			$userId = $this->getUser()->getGuardUser()->getId();
			$this->appointmentId = $request->getParameter('id');
			$this->forward404Unless(Doctrine_Core::getTable('LabAppointment')->checkOwnership($this->appointmentId, $userId));

			if ($this->removeEventFromCalendar($this->appointmentId)) {
				if ($this->addAppointmentToCalendar($this->appointmentId)) {
					$this->redirect('agendamento/resumo?id=' . $this->appointmentId);
				} else {
					die('Erro na atualização do evento.');
				}
			}
		
		}
		
	}
	
	public function executeAutenticar (sfWebRequest $request) {
		
		$this->$captchaInfo = $this->getUser()->getAttribute('captcha', null);
		if (is_null($captchaInfo)) $this->forward404();
		
	}

}