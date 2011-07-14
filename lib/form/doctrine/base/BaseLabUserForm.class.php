<?php

/**
 * LabUser form base class.
 *
 * @method LabUser getObject() Returns the current form's model object
 *
 * @package    BookEquip
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLabUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'sf_guard_user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'first_name'       => new sfWidgetFormInputText(),
      'last_name'        => new sfWidgetFormInputText(),
      'cpf'              => new sfWidgetFormInputText(),
      'telphone'         => new sfWidgetFormInputText(),
      'celphone'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'sf_guard_user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'first_name'       => new sfValidatorString(array('max_length' => 255)),
      'last_name'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'cpf'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'telphone'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'celphone'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lab_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LabUser';
  }

}
