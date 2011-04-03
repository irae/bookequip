<?php

/**
 * LabEquipmentSchedule filter form base class.
 *
 * @package    BookEquip
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLabEquipmentScheduleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'equipment_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LabEquipment'), 'add_empty' => true)),
      'start_time'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'end_time'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'equipment_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LabEquipment'), 'column' => 'id')),
      'start_time'   => new sfValidatorPass(array('required' => false)),
      'end_time'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lab_equipment_schedule_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LabEquipmentSchedule';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'equipment_id' => 'ForeignKey',
      'start_time'   => 'Text',
      'end_time'     => 'Text',
    );
  }
}
