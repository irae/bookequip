<?php

/**
 * LabAppointmentInfo form base class.
 *
 * @method LabAppointmentInfo getObject() Returns the current form's model object
 *
 * @package    BookEquip
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLabAppointmentInfoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'appointment_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LabAppointment'), 'add_empty' => false)),
      'form_class'     => new sfWidgetFormInputText(),
      'info_key'       => new sfWidgetFormInputText(),
      'info_value'     => new sfWidgetFormTextarea(),
      'is_json'        => new sfWidgetFormInputCheckbox(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'appointment_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LabAppointment'))),
      'form_class'     => new sfValidatorString(array('max_length' => 255)),
      'info_key'       => new sfValidatorString(array('max_length' => 255)),
      'info_value'     => new sfValidatorString(array('max_length' => 5000)),
      'is_json'        => new sfValidatorBoolean(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('lab_appointment_info[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LabAppointmentInfo';
  }

}
