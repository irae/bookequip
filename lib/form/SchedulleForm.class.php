<?php
class SchedulleForm extends BaseForm
{
	
	public function configure()
	{
		$this->setWidgets(array(
			'appointment_date' => new sfWidgetInputTextChoice()
			))
		));
		
		$this->widgetSchema->setNameFormat('appointment[%s]');
		
	}

}
?>