<?php

/**
 * LabEquipmentAvailability form base class.
 *
 * @method LabEquipmentAvailability getObject() Returns the current form's model object
 *
 * @package    BookEquip
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLabEquipmentAvailabilityForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'equipment_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LabEquipment'), 'add_empty' => false)),
      'start_time'   => new sfWidgetFormTime(),
      'end_time'     => new sfWidgetFormTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'equipment_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LabEquipment'))),
      'start_time'   => new sfValidatorTime(),
      'end_time'     => new sfValidatorTime(),
    ));

    $this->widgetSchema->setNameFormat('lab_equipment_availability[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LabEquipmentAvailability';
  }

}
