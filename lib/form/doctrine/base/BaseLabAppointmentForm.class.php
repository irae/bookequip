<?php

/**
 * LabAppointment form base class.
 *
 * @method LabAppointment getObject() Returns the current form's model object
 *
 * @package    BookEquip
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLabAppointmentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'equipment_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LabEquipment'), 'add_empty' => false)),
      'user_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LabUser'), 'add_empty' => false)),
      'appointment_date' => new sfWidgetFormDate(),
      'starts_at'        => new sfWidgetFormTime(),
      'ends_at'          => new sfWidgetFormTime(),
      'appointment_type' => new sfWidgetFormChoice(array('choices' => array('basic' => 'basic', 'advanced' => 'advanced'))),
      'event_status'     => new sfWidgetFormChoice(array('choices' => array('approved' => 'approved', 'pending' => 'pending', 'billed' => 'billed'))),
      'is_synched'       => new sfWidgetFormInputCheckbox(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'equipment_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LabEquipment'))),
      'user_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LabUser'))),
      'appointment_date' => new sfValidatorDate(),
      'starts_at'        => new sfValidatorTime(),
      'ends_at'          => new sfValidatorTime(),
      'appointment_type' => new sfValidatorChoice(array('choices' => array(0 => 'basic', 1 => 'advanced'), 'required' => false)),
      'event_status'     => new sfValidatorChoice(array('choices' => array(0 => 'approved', 1 => 'pending', 2 => 'billed'), 'required' => false)),
      'is_synched'       => new sfValidatorBoolean(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('lab_appointment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LabAppointment';
  }

}
