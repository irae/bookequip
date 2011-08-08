<?php

/**
 * agendamento actions.
 *
 * @package    BookEquip
 * @subpackage agendamento
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class agendamentoActions extends sfActions
{

	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		
		$userInfo = $this->getUser()->getGuardUser();
		if ($userInfo->hasGroup('admin')) {
			$this->redirect('/pendencias-cadastrais');
		}
		$this->lastAppointments = Doctrine_Core::getTable('LabAppointment')->queryLastUserAppointments($userInfo->getId(), 10);
		
	}
 

	/**
	 * Chooses which formulary will be displayed,
	 * handles the submited user data and stores the information
	 * on a session variable for further addition at the database
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeNovo(sfWebRequest $request)
	{
		
		if (is_null($request->getParameter('stage'))) {
			$stagesList = array_keys(appointmentFormBuilder::$stages);
			$this->currentStage = $stagesList[0];
		} else {
			$this->currentStage = $request->getParameter('stage');
			$this->forward404Unless(array_key_exists($this->currentStage, appointmentFormBuilder::$stages));	
		}
		
		$formBuilder = new appointmentFormBuilder($this->currentStage);
		$didJump = $formBuilder->checkStageJump();
		$this->redirectIf($didJump, $this->generateUrl('novo_agendamento', array('stage'=>$formBuilder->redirectTo)));
		
		$formClassName = appointmentFormBuilder::$stages[$this->currentStage]['formClass'];
		$this->form = new $formClassName(array('stage' => $this->currentStage));
		if (array_key_exists('template', appointmentFormBuilder::$stages[$this->currentStage])) {
			$this->setTemplate(appointmentFormBuilder::$stages[$this->currentStage]['template']);
		}
		
		if ($request->isMethod('post')) {
	
			$this->form->bind($request->getParameter('appointment'));
			if ($this->form->isValid()) {
				$formBuilder->saveToSession($this->form->getValues());
				if ($formBuilder->redirectTo != 'resumo') {
					$this->redirect($this->generateUrl('novo_agendamento', array('stage'=>$formBuilder->redirectTo)));
				} else {
					$this->redirect($this->generateUrl('default', array('module'=>'agendamento','action'=>'resumo')));
				}
			}
	
		}

	}
  
  
	public function executeResumo(sfWebRequest $request)
	{
		
		if (is_null($request->getParameter('id'))) {
			$appointmentData = $this->getAppointmentInfo();
			$constructorParams = array();
		} else {
			$this->appointmentId = $request->getParameter('id');
			$userId = $this->getUser()->getGuardUser()->getId();
			$this->editMode = true;
			if (!$this->getUser()->hasGroup('admin')) {
				$this->forward404Unless(Doctrine_Core::getTable('LabAppointment')->checkOwnership($request->getParameter('id'), $userId));
			} else {
				if (!Doctrine_Core::getTable('LabAppointment')->checkOwnership($request->getParameter('id'), $userId)) {
					$this->editMode = false;
				}
			}
			
			$appointmentData = $this->getAppointmentInfo(array('mode' => 'edit', 'appointment_id' => $request->getParameter('id')));
			$constructorParams = array('appointmentId' => $request->getParameter('id'));
			$this->setTemplate('resumoExistente');
		}

		$content = array();
		foreach (appointmentFormBuilder::$stages as $stageSlug => $stage) {
	
			$currentForm = array();
			$currentForm['title'] = $stage['title'];
			$currentForm['form-slug'] = $stageSlug;
			$currentForm['editable'] = $stage['editable'];
			$currentForm['fields'] = array();
	
			// Gets user answers from current form stage
			foreach($appointmentData as $stageAnswers) {
				if ($stageAnswers['stageName'] == $stageSlug) {
					$userValues = $stageAnswers;
				}
			}
	
			$formData = new $stage['formClass'](array(), $constructorParams);
	
			// Builds up the array containing all the data from all the appointment form stages
			foreach ($formData->getWidgetSchema()->getFields() as $inputName => $info) {
				if ($inputName != '_csrf_token') {
					$currentField = array();
					$options = $info->getOptions();
					// Aqui o str_replace foi realizado para remover os asteriscos de obrigatoriedade de preenchimento
					$currentField['label'] = str_replace('<span>&nbsp;*</span>', '', $options['label']);
			
					if (!array_key_exists('choices', $options)) {
						$currentField['value'] = $userValues[$inputName];
					} else {
						if (is_array($userValues[$inputName])) {
							$currentField['value'] = array();
							foreach($userValues[$inputName] as $userChoice) {
								$currentField['value'][] = $options['choices'][$userChoice];
							}
						} else {
							$currentField['value'] = $options['choices'][$userValues[$inputName]];
						}
					}

					$currentForm['fields'][$inputName] = $currentField;
				}
			}
	
			$content[] = $currentForm;
	
		}

		$this->resumoAgendamento = $content;
		
	}
  
 
	/**
	 * Executes submit action
	 *
	 * @param sfRequest $request A request object
	 */ 
	public function executeSubmit(sfWebRequest $request)
	{
	
		$this->forward404Unless($request->isMethod('post'));
	
		if (!isset($_SESSION['appointmentData']) || sizeof($_SESSION['appointmentData']) != sizeof(appointmentFormBuilder::$stages)) {
			die('Formulário de agendamento incompleto.');
		}
		
		// Appointment Key Information (goes to LabAppointment Table)
		$appointment = new LabAppointment();
		if (is_null($this->getUser()->getAttribute('agendar_como', null))) {
			$appointment['user_id'] = $this->getUser()->getGuardUser()->getId();
		} else {
			// Se o administrador estiver agendando para algum usuário
			$doAppointmentAs = $this->getUser()->getAttribute('agendar_como');
			$appointment['user_id'] = $doAppointmentAs['id'];
		}
		$appointment['equipment_id'] = $_SESSION['appointmentData'][appointmentFormBuilder::getStagePosition('EquipmentListForm')]['equipment'];
		
		$selectedSchedule = explode('.', $_SESSION['appointmentData'][appointmentFormBuilder::getStagePosition('ScheduleForm')]['schedule']);
		$appointment['appointment_date'] = $selectedSchedule[0];
		$appointment['schedule_id'] = $selectedSchedule[1];
		$appointment->save();
		
		// Removes already used data
		unset($_SESSION['appointmentData'][appointmentFormBuilder::getStagePosition('EquipmentListForm')]);
		unset($_SESSION['appointmentData'][appointmentFormBuilder::getStagePosition('ScheduleForm')]);
	
		// Additional Appointment Information (goes to LabAppointmentInfo)
		foreach ($_SESSION['appointmentData'] as $additionalStage) {
			$formClassName = appointmentFormBuilder::$stages[$additionalStage['stageName']]['formClass'];
			unset($additionalStage['stageName']);
			foreach ($additionalStage as $inputName => $inputValue ) {
				$appointmentInfo = new LabAppointmentInfo();
				$appointmentInfo['appointment_id'] = $appointment->getId();
				$appointmentInfo['info_key'] = $inputName;
				$appointmentInfo['form_class'] = $formClassName;
				if (is_array($inputValue)) {
					$appointmentInfo['info_value'] = json_encode($inputValue);
					$appointmentInfo['is_json'] = true;
				} else {
					$appointmentInfo['info_value'] = $inputValue;
				}
				$appointmentInfo->save();
			}
		}
	
		unset($_SESSION['appointmentData']);
		//$this->redirect('calendario/adicionar?id=' . $appointment->getId());
		$this->getUser()->setFlash('success_message', 'Agendamento efetuado com sucesso.');
		$this->redirect('agendamento/index');
	}

  
 
	/**
	 * Appointment edit action
	 *
	 * @param sfRequest $request A request object
	 */  
	public function executeEditar(sfWebRequest $request)
	{

		$userId = $this->getUser()->getGuardUser()->getId();
		$this->appointmentId = $request->getParameter('id');
		$this->currentStage = $request->getParameter('stage');

		$this->forward404Unless(Doctrine_Core::getTable('LabAppointment')->checkOwnership($this->appointmentId, $userId));  
		if (array_key_exists($this->currentStage, appointmentFormBuilder::$stages) &&
			appointmentFormBuilder::$stages[$this->currentStage]['editable'] === true) {

			$stageConfigArray = appointmentFormBuilder::$stages[$this->currentStage];
			// Retrieves user submitted data to populate the form
			$populateValues = $this->getAppointmentInfo(array(
				'mode' => 'edit',
				'appointment_id' => $this->appointmentId,
				'stages' => array($this->currentStage => $stageConfigArray)));
			
			$formClassName = $stageConfigArray['formClass'];
			$this->form = new $formClassName(
				$populateValues[0], // Populate form with user data
				array('editMode'=>true,'appointmentId'=>$this->appointmentId));

			if (array_key_exists('template', $stageConfigArray)) {
				$this->setTemplate($stageConfigArray['template']);
			} else {
				$this->setTemplate('novo');
			}
			
			if ($request->isMethod('post')) {
				$this->form->bind($request->getParameter('appointment'));
				if ($this->form->isValid()) {

					$formValues = $this->form->getValues();
					switch ($this->currentStage) {

						case 'horario':
							$selectedSchedule = explode('.', $formValues['schedule']);
							Doctrine_Core::getTable('LabAppointment')
								->updateSchedule($this->appointmentId, $selectedSchedule[0], $selectedSchedule[1]);
							// $this->redirect('calendario/atualizar?id=' . $this->appointmentId);
							break;

						default:
							Doctrine_Core::getTable('LabAppointmentInfo')
								->updateAppointmentInfo($formValues, $this->appointmentId);
							break;

					}
					
					$this->getUser()->setFlash('success_message', 'Edição realizada com sucesso.');
					$this->redirect('agendamento/resumo?id=' . $this->appointmentId);

				}
			}

		} else {
			$this->forward404();
		}
	
	}
	
	/**
	 * Obtém da sessão (se estiver no processo de adição de novo agendamento)
	 * ou da database (em caso de edição ou visualização) todas as informações sobre um determinado agendamento
	 * retornando uma array que segue a mesma estrutura dos formulários de agendamento.
	 *
	 * @param array $options
	 */
	private function getAppointmentInfo($options = array('mode' => 'session', 'appointment_id' => null, 'stages' => null)) {
		
		if ($options['mode'] == 'session') {
			
			if (!isset($_SESSION['appointmentData']) ||
				sizeof($_SESSION['appointmentData']) != sizeof(appointmentFormBuilder::$stages)) {
				die('O formulario não foi completamente respondido.');
			} else {			
				$appointmentData = $_SESSION['appointmentData'];
			}
			
		} elseif ($options['mode'] == 'edit') {
			
			if(is_null($options['appointment_id'])) {
				die('ID de agendamento não especificado.');
			}
			
			$appointmentData = array();
			$appointmentObj  = Doctrine_Core::getTable('LabAppointment')->find($options['appointment_id']);
			
			if (!array_key_exists('stages', $options) || is_null($options['stages'])) {
				$stageCollection = appointmentFormBuilder::$stages;
			} else {
				$stageCollection = $options['stages'];
			}
			
			foreach ($stageCollection as $stageName => $stageInfo) {
				$formData = array();
				$formData['stageName'] = $stageName;
				switch ($stageInfo['formClass']) {
					case 'EquipmentListForm':
						$formData['equipment'] = $appointmentObj->getEquipmentId();
						break;
					case 'ScheduleForm':
						$formData['schedule'] = $appointmentObj->getAppointmentDate() . '.' . $appointmentObj->getScheduleId();
						break;
					default:
						// TODO: Colocar esse query em local mais apropriado
						$query = Doctrine_Query::create()->from('LabAppointmentInfo')
							->where('appointment_id = ?', $options['appointment_id'])->andWhere('form_class = ?' , $stageInfo['formClass']);
						$infos = $query->execute();
						if ($infos->count() > 0) {
							foreach($infos as $infoObj) {
								if (!$infoObj->getIsJson()) {
									$formData[$infoObj->getInfoKey()] = $infoObj->getInfoValue();
								} else {
									$formData[$infoObj->getInfoKey()] = json_decode($infoObj->getInfoValue());
								}
							}
						}
				}
				
				$appointmentData[] = $formData;
			
			}
				
		}

		return $appointmentData;
		
	}
	
	public function executeAgendarUsuario (sfWebRequest $request) {
		if (!$this->getUser()->isAuthenticated() || 
			!$this->getUser()->hasGroup('admin')) {
				$this->forward404();
			}
		
		if (!$request->isMethod('post')) {
			
			// Quando a requisição for GET, há duas possibilidades:
			// 1) Administrador deseja obter uma lista de usuários para efetuar um agendamento;
			// 2) Administrador quer cancelar o modo "agendar para usuário"
			
			if ($request->getParameter('mode') != 'cancelar') {	
				$query = Doctrine_Query::create()
					->select('s.id, s.username, l.first_name')
					->from('sfGuardUser s')
					->leftJoin('s.LabUser l')
					->orderBy('l.first_name ASC');
				$this->userList = $query->execute();
			} else {
				$this->getUser()->setAttribute('agendar_como', null);
				exit('Success');
			}
			
		} else {
			
			// Salva na sessão os atributos do usuário para o qual se deseja fazer um agendamento
			$userInfo = Doctrine::getTable('sfGuardUser')->find($request->getParameter('usuario'));
			$this->getUser()->setAttribute('agendar_como', array('id' => $userInfo->getId(), 'name' => $userInfo->getLabUser()->getFirstName()));
			$this->redirect('agendamento/novo');
			
		}
	
	}
	

}
