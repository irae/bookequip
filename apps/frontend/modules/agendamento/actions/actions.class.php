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

  private static $appointmentAddStages = array(
		'lista-equipamentos' => 'EquipmentListForm',
		'informacoes-gerais' => 'AdditionalInfoForm',
		'horario'            => 'SchedulleForm'
	);

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
	
	$this->forward404Unless(array_key_exists($request->getParameter('stage'), self::$appointmentAddStages));
	$this->currentStage = $request->getParameter('stage');
	
	$stageIndex = array_keys(self::$appointmentAddStages);
	$stagePosition = array_flip($stageIndex);
	$currentPosition = $stagePosition[$this->currentStage];
	
	// prevents a user from jumping some stage
	if ($currentPosition > 0) {
		if (!isset($_SESSION['appointment_stages'])) {
			$this->redirect('agendamento/novo/' . $stageIndex[0]);
		} elseif (sizeof($_SESSION['appointment_stages']) < $currentPosition) {
			$correctForm = $stageIndex[sizeof($_SESSION['appointment_stages'])];
			$this->redirect($this->generateUrl('novo_agendamento', array('stage' => $correctForm)));
		}
	}
	
	$formClassName = self::$appointmentAddStages[$this->currentStage];
	$this->form = new $formClassName(array('stage' => $this->currentStage));
	
	if ($request->isMethod('post')) {
		
		$this->form->bind($request->getParameter('appointment'));
		if ($this->form->isValid()) {
			
			$_SESSION['appointment_stages'][$currentPosition] = $this->form->getValues();
			if (array_key_exists(($currentPosition+1), $stageIndex)) {
				$nextStage = $stageIndex[($currentPosition+1)];
				$this->redirect($this->generateUrl('novo_agendamento', array('stage' => $nextStage)));
			} else {
				die('Redirecionar p/ página de resumo' . var_dump($_SESSION['appointment_stages']));
			}
			
		}
		
	}
	
  }
 
 /**
  * Executes submit action
  *
  * @param sfRequest $request A request object
  */ 
  public function executeSubmit(sfWebRequest $request)
  {
    if ($request->getMethod() != 'POST' ||
		!$request->hasParameter('stage') ||
		!in_array($request->getParameter('stage'), self::$appointmentAddStages))	
	{
		$this->forward404();
	}
	
	
	
  }
  
}
