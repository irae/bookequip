<?php
class AdditionalInfoForm extends BaseForm
{
	
	private static $sampleTypes = array('Sólida', 'Líquida', 'Líquida Viscosa', 'Gasosa', 'Higroscópica', 'Risco Biológico', 'Explosiva', 'Corrosiva', 'Sensível à luz', 'Sensível ao ar', 'Tóxica');
	
	public function configure()
	{
		$this->setWidgets(array(
			'sample_type'      => new sfWidgetFormChoice(array('expanded' => true, 'choices' => self::$sampleTypes, 'multiple' => true)),
			'additional_info'  => new sfWidgetFormInputText(array(), array('class' => 'text small'))
			));
		
		$this->setValidators(array(
			'sample_type'     => new sfValidatorChoice(array('required' => true, 'choices' => array_keys(self::$sampleTypes), 'multiple' => true)),
			'additional_info' => new sfValidatorString(array('required' => false))
		));

		$this->widgetSchema->setLabels(array(
			'sample_type'     => 'Tipo de amostra',
			'additional_info' => 'Informações Adicionais',
		));

		$this->widgetSchema->setNameFormat('appointment[%s]'); 
	}

}
?>