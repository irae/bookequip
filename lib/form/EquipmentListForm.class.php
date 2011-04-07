<?php
class EquipmentListForm extends BaseForm
{
	
	private static $equipChoices;
	
	public function configure()
	{
	
		$equipmentList = Doctrine_Core::getTable('LabEquipment');
		
		foreach($equipmentList->findAll() as $equipment) {
			self::$equipChoices[$equipment->getId()] = $equipment->getName();
		}
	
		$this->setWidgets(array(
			'equipment' => new sfWidgetFormChoice(array('expanded' => true, 'choices' => self::$equipChoices))
		));
		
		$this->widgetSchema->setNameFormat('appointment[%s]');
		
		$this->setValidators(array(
			'equipment' => new sfValidatorChoice(array('required' => true, 'choices' => array_keys(self::$equipChoices)))
		));
		
	}
	
}
?>