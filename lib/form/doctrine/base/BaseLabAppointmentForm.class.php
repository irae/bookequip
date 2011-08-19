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
      'user_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'equipment_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Equipment'), 'add_empty' => false)),
      'appointment_date' => new sfWidgetFormDate(),
      'schedule_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ScheduleInfo'), 'add_empty' => false)),
      'appointment_type' => new sfWidgetFormChoice(array('choices' => array('básico' => 'básico', 'avançado' => 'avançado'))),
      'event_status'     => new sfWidgetFormChoice(array('choices' => array('aprovado' => 'aprovado', 'pendente' => 'pendente', 'faturado' => 'faturado', 'cancelado' => 'cancelado', 'ocorrido' => 'ocorrido'))),
      'calendar_url'     => new sfWidgetFormInputText(),
      'is_synched'       => new sfWidgetFormInputCheckbox(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'equipment_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Equipment'))),
      'appointment_date' => new sfValidatorDate(),
      'schedule_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ScheduleInfo'))),
      'appointment_type' => new sfValidatorChoice(array('choices' => array(0 => 'básico', 1 => 'avançado'), 'required' => false)),
      'event_status'     => new sfValidatorChoice(array('choices' => array(0 => 'aprovado', 1 => 'pendente', 2 => 'faturado', 3 => 'cancelado', 4 => 'ocorrido'), 'required' => false)),
      'calendar_url'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
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
