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
	
	$this->currentStage = $request->getParameter('stage');
	$this->forward404Unless(array_key_exists($this->currentStage, appointmentFormBuilder::$stages));
	
	$formBuilder = new appointmentFormBuilder($this->currentStage);
	$didJump = $formBuilder->checkStageJump();
	$this->redirectIf($didJump, $this->generateUrl('novo_agendamento', array('stage'=>$formBuilder->redirectTo)));
	
	$formClassName = appointmentFormBuilder::$stages[$this->currentStage]['formClass'];
	$this->form = new $formClassName(array('stage' => $this->currentStage));
	
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
	if (!isset($_SESSION['appointmentData']) ||
		sizeof($_SESSION['appointmentData']) != sizeof(appointmentFormBuilder::$stages)) {
		die('O formulario nao foi completamente respondido.');
	}

	$content = array();
	
	foreach (appointmentFormBuilder::$stages as $stageSlug => $stage) {
		
		$currentForm           = array();
		$currentForm['title']  = $stage['title'];
		$currentForm['fields'] = array();
		
		// Gets user answers from current form stage
		foreach($_SESSION['appointmentData'] as $stageAnswers) {
			if ($stageAnswers['stageName'] == $stageSlug) {
				$userValues = $stageAnswers;
			}
		}
		
		$formData = new $stage['formClass'];
		
		// Builds up the array containing all the data from all the appointment form stages
		foreach ($formData->getWidgetSchema()->getFields() as $inputName => $info) {
			if ($inputName != '_csrf_token') {
				$currentField = array();
				$options = $info->getOptions();
				$currentField['label'] = $options['label'];
				
				//var_dump($options);
				
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
	
	if (!isset($_SESSION['appointmentData']) ||
		sizeof($_SESSION['appointmentData']) != sizeof(appointmentFormBuilder::$stages)) {
			die('O formulario nao foi completamente respondido.');
	}
	
	// Tempor�rio
	$appointment = new LabAppointment();
	$appointment['user_id']          = $this->getUser()->getGuardUser()->getId();
	$appointment['equipment_id']     = $_SESSION['appointmentData'][0]['equipment'];
	$appointment['appointment_date'] = $_SESSION['appointmentData'][2]['appointment_date'];
	$appointment['schedule_id']      = $_SESSION['appointmentData'][2]['schedule_time'];
	$appointment->save();
	
  }
  
 
 /**
  * Appointment edit action
  *
  * @param sfRequest $request A request object
  */  
  public function executeEditar(sfWebRequest $request)
  {

	$userId = 1; // Temporary!
	$this->appointmentId = $request->getParameter('id');
	$this->formStage     = $request->getParameter('stage');
	$this->forward404Unless(Doctrine_Query::create()->from('LabAppointment')->find($this->appointmentId));  
	$formClassName = appointmentFormBuilder::$stages[$this->formStage]['formClass'];
	$this->form = new $formClassName(array('stage' => $this->currentStage), array('editMode'=>true,'appointmentId'=>$this->appointmentId));
	
  }

}