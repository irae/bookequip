<?php

/**
 * LabAppointment filter form base class.
 *
 * @package    BookEquip
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLabAppointmentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LabUser'), 'add_empty' => true)),
      'equipment_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LabEquipment'), 'add_empty' => true)),
      'appointment_date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'schedule_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LabEquipmentSchedule'), 'add_empty' => true)),
      'appointment_type' => new sfWidgetFormChoice(array('choices' => array('' => '', 'basic' => 'basic', 'advanced' => 'advanced'))),
      'event_status'     => new sfWidgetFormChoice(array('choices' => array('' => '', 'approved' => 'approved', 'pending' => 'pending', 'billed' => 'billed'))),
      'is_synched'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LabUser'), 'column' => 'id')),
      'equipment_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LabEquipment'), 'column' => 'id')),
      'appointment_date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'schedule_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LabEquipmentSchedule'), 'column' => 'id')),
      'appointment_type' => new sfValidatorChoice(array('required' => false, 'choices' => array('basic' => 'basic', 'advanced' => 'advanced'))),
      'event_status'     => new sfValidatorChoice(array('required' => false, 'choices' => array('approved' => 'approved', 'pending' => 'pending', 'billed' => 'billed'))),
      'is_synched'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('lab_appointment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LabAppointment';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'user_id'          => 'ForeignKey',
      'equipment_id'     => 'ForeignKey',
      'appointment_date' => 'Date',
      'schedule_id'      => 'ForeignKey',
      'appointment_type' => 'Enum',
      'event_status'     => 'Enum',
      'is_synched'       => 'Boolean',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
