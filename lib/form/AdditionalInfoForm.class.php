<?php
class AdditionalInfoForm extends BaseForm
{
	
	private static $otherInfoCase1 = array('A amostra é volátil?', 'A amostra é infectante?', 'É necessário o acessório para leitura de placas?', 'É necessária agitação?', 'É necessário controle de temperatura?');
	private static $otherInfoCase2 = array('É necessário o uso de incubadora?', 'É necessário estabilização de foco?');
	
	public function configure()
	{
		
		switch ($_SESSION['appointment_equipment']) {
			case 1: // Espetrofluorímetro Hitachi F7000
				$this->setWidgets(array(
					'comprimento_ondas' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
					'additional_info'   => new sfWidgetFormChoice(array('expanded' => true, 'choices' => self::$otherInfoCase1, 'multiple' => true))
					));

				$this->setValidators(array(
					'comprimento_ondas' => new sfValidatorString(array('required' => true)),
					'additional_info'   => new sfValidatorChoice(array('required' => false, 'choices' => array_keys(self::$otherInfoCase1), 'multiple' => true))
				));

				$this->widgetSchema->setLabels(array(
					'comprimento_ondas' => 'Quais os comprimentos de ondas utilizados?',
					'additional_info'   => 'Informações Adicionais',
				));
				break;
	
			case 2:
				$this->setWidgets(array(
					'comprimento_ondas' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
					'additional_info'   => new sfWidgetFormChoice(array('expanded' => true, 'choices' => self::$otherInfoCase2, 'multiple' => true)),
					'descricao_experimento' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
					));

				$this->setValidators(array(
					'comprimento_ondas' => new sfValidatorString(array('required' => true)),
					'additional_info'   => new sfValidatorChoice(array('required' => false, 'choices' => array_keys(self::$otherInfoCase2), 'multiple' => true)),
					'descricao_experimento' => new sfValidatorString(array('required' => true))
				));

				$this->widgetSchema->setLabels(array(
					'comprimento_ondas' => 'Quais os comprimentos de ondas utilizados?',
					'additional_info'   => 'Informações Adicionais',
					'descricao_experimento'   => 'Descreva o tipo de experimento (cinética de íons, imunolocalização, acompanhamento de células em cultura)'
				));
				break;
				
			case 3:
				$this->setWidgets(array(
					'tipo_amostra' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
					'tipo_chip' => new sfWidgetFormInputText(array(), array('class' => 'text small'))
					));

				$this->setValidators(array(
					'tipo_amostra' => new sfValidatorString(array('required' => true)),
					'tipo_chip' => new sfValidatorString(array('required' => true))
				));

				$this->widgetSchema->setLabels(array(
					'tipo_amostra' => 'Tipo de amostra',
					'tipo_chip'    => 'Tipo de chip utilizado'
				));
				break;				
			
			/*
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
				
			*/
		}

		$this->widgetSchema->setNameFormat('appointment[%s]'); 
	}

}
?>