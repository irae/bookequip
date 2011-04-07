<?php
class AdditionalInfoForm extends BaseForm
{
	
	public function configure()
	{
		$this->setWidgets(array(
			'experience_description' => new sfWidgetFormInputText(),
			'university_name'        => new sfWidgetFormInputText()
			));
		
		$this->setValidators(array(
			'experience_description' => new sfValidatorString(array('required' => false)),
			'university_name'        => new sfValidatorString(array('required' => false)),
		));
	
		$this->widgetSchema->setNameFormat('appointment[%s]'); 
	}

}
?>