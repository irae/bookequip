<?php

class appointmentFormBuilder {

	public static $stages = array(
		'lista-equipamentos' => array(
			'title' => 'Equipamentos',
			'formClass' => 'EquipmentListForm'),
		'informacoes-gerais' => array(
			'title' => 'Informações Gerais',
			'formClass' => 'AdditionalInfoForm'),
		'horario' => array(
			'title' => 'Horário',
			'formClass' => 'SchedulleForm')
	);
	
	private $submittedData;
	private $currentStage;
	private $stageIndex;
	private $stagePosition;
	private $currentPosition;

	public  $redirectTo = null;
	
	public function __construct($currentStage) {
		
		if (!isset($_SESSION['appointmentData']))
			$_SESSION['appointmentData'] = array();
		
		$this->submittedData =& $_SESSION['appointmentData'];
		$this->currentStage = $currentStage;
		$this->stageIndex = array_keys(self::$stages);
		$this->stagePosition = array_flip($this->stageIndex);
		$this->currentPosition = $this->stagePosition[$this->currentStage];
	}
	
	public function checkStageJump()
	{
	
		if ($this->currentPosition > 0) {
			if (empty($this->submittedData)) {
				$this->redirectTo = $this->stageIndex[0];
				return true;
			} elseif (sizeof($this->submittedData) < $this->currentPosition) {
				$correctForm = $this->stageIndex[sizeof($this->submittedData)];
				$this->redirectTo = $correctForm;
				return true;
			}
		}
		
		return false;
		
	}
	
	public function saveToSession($formData)
	{
		$this->submittedData[$this->currentPosition] = array('stageName' => $this->stageIndex[$this->currentPosition]) + $formData;
		$this->whereTo();
	}
	
	public function whereTo()
	{
		
		if (array_key_exists(($this->currentPosition+1), $this->stageIndex)) {
			$nextStage = $this->stageIndex[($this->currentPosition+1)];
			$this->redirectTo = $nextStage;
		} else {
			die('Página de Resumo' . var_dump($this->submittedData));
		}
	
	}

}

?>