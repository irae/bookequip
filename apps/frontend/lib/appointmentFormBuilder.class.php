<?php

class appointmentFormBuilder {

	public static $stages = array(
		'lista-equipamentos' => array(
			'title'     => 'Equipamento',
			'formClass' => 'EquipmentListForm',
			'editable'  => false),
		'informacoes-gerais' => array(
			'title'     => 'Informações Gerais',
			'formClass' => 'AdditionalInfoForm',
			'editable'  => true),
		'horario' => array(
			'title'     => 'Data e Hora',
			'formClass' => 'ScheduleForm',
			'editable'  => true,
			'template'  => 'ScheduleFormTemplate')
	);

	public  $stageIndex;
	public  $stagePosition;
	private $submittedData;
	private $currentStage;
	private $currentPosition;

	public  $redirectTo = null;
	
	public function __construct($currentStage)
	{
		
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
			$this->redirectTo = 'resumo';
		}
	
	}
	
	public static function getStagePosition($stageName) {
		$stageIndex = array();
		foreach (self::$stages as $stage) {
			$stageIndex[] = $stage['formClass'];
		}
		$stagePosition = array_flip($stageIndex);
		return $stagePosition[$stageName];
	}

}

?>