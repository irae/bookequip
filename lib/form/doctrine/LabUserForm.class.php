<?php

/**
 * LabUser form.
 *
 * @package    BookEquip
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LabUserForm extends BaseLabUserForm
{
  public function configure()
  {
		$this->widgetSchema->setLabels(array(
			'first_name'     => 'Nome',
			'last_name' => 'Sobrenome',
			'cpf' => 'CPF',
			'telphone' => '(DDD) Telefone',
			'celphone' => '(DDD) Celular' 
			
		));
  }
}
