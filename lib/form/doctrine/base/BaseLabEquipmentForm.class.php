<?php

/**
 * LabEquipment form base class.
 *
 * @method LabEquipment getObject() Returns the current form's model object
 *
 * @package    BookEquip
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLabEquipmentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInputText(),
      'slug'         => new sfWidgetFormInputText(),
      'wiki_page'    => new sfWidgetFormInputText(),
      'calendar_url' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 255)),
      'slug'         => new sfValidatorString(array('max_length' => 255)),
      'wiki_page'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'calendar_url' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'LabEquipment', 'column' => array('name'))),
        new sfValidatorDoctrineUnique(array('model' => 'LabEquipment', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('lab_equipment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LabEquipment';
  }

}
