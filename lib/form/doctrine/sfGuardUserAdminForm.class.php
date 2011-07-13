<?php

/**
 * sfGuardUserAdminForm for admin generators
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUserAdminForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardUserAdminForm extends BasesfGuardUserAdminForm
{
	public function configure()
	{
		parent::configure();
		$profileForm = new LabUserForm($this->object->LabUser);
		unset($profileForm['id'], $profileForm['sf_guard_user_id']);
		$this->embedForm('LabUser', $profileForm);
		
	}
}
