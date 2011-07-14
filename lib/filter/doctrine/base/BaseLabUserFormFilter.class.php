<?php

/**
 * LabUser filter form base class.
 *
 * @package    BookEquip
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLabUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'sf_guard_user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'first_name'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'last_name'        => new sfWidgetFormFilterInput(),
      'cpf'              => new sfWidgetFormFilterInput(),
      'telphone'         => new sfWidgetFormFilterInput(),
      'celphone'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'sf_guard_user_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'first_name'       => new sfValidatorPass(array('required' => false)),
      'last_name'        => new sfValidatorPass(array('required' => false)),
      'cpf'              => new sfValidatorPass(array('required' => false)),
      'telphone'         => new sfValidatorPass(array('required' => false)),
      'celphone'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lab_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LabUser';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'sf_guard_user_id' => 'ForeignKey',
      'first_name'       => 'Text',
      'last_name'        => 'Text',
      'cpf'              => 'Text',
      'telphone'         => 'Text',
      'celphone'         => 'Text',
    );
  }
}
