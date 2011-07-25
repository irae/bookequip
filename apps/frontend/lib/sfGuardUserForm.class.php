<?php

/**
 * sfGuardUser form.
 *
 * @package    BookEquip
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserForm extends PluginsfGuardUserForm
{
  public function configure()
  {

	parent::configure();
	$profileForm = new LabUserForm($this->object->LabUser);
	unset($profileForm['id'], $profileForm['sf_guard_user_id']);
	$this->widgetSchema['password'] = new sfWidgetFormInputPassword();
    $this->validatorSchema['password']->setOption('required', true);
	$this->widgetSchema['password_again'] = new sfWidgetFormInputPassword();
    $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];
	$this->validatorSchema['email_address'] = new sfValidatorEmail();
	$this->embedForm('LabUser', $profileForm);
	unset(
		$this['first_name'],
		$this['last_name'],
		$this['salt'],
		$this['algorithm'],
		$this['is_active'],
		$this['is_super_admin'],
		$this['created_at'],
		$this['updated_at'],
		$this['last_login'],
		$this['groups_list'],
		$this['permissions_list']
		);
	if (!$this->isNew()) {
		unset($this['password'], $this['password_again']);
	}

  }
}
