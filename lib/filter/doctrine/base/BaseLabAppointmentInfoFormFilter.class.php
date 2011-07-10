<?php

/**
 * LabAppointmentInfo filter form base class.
 *
 * @package    BookEquip
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLabAppointmentInfoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'appointment_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LabAppointment'), 'add_empty' => true)),
      'form_class'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'info_key'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'info_value'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_json'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'appointment_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LabAppointment'), 'column' => 'id')),
      'form_class'     => new sfValidatorPass(array('required' => false)),
      'info_key'       => new sfValidatorPass(array('required' => false)),
      'info_value'     => new sfValidatorPass(array('required' => false)),
      'is_json'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('lab_appointment_info_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LabAppointmentInfo';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'appointment_id' => 'ForeignKey',
      'form_class'     => 'Text',
      'info_key'       => 'Text',
      'info_value'     => 'Text',
      'is_json'        => 'Boolean',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}
