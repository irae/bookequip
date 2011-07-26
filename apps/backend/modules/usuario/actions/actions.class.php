<?php

require_once dirname(__FILE__).'/../lib/usuarioGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/usuarioGeneratorHelper.class.php';

/**
 * usuario actions.
 *
 * @package    BookEquip
 * @subpackage usuario
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usuarioActions extends autoUsuarioActions
{
	public function executeViewAppointments (sfWebRequest $request) {
		$this->getUser()->setAttribute(
			'agendamento.filters',
			array('user_id' => $request->getParameter('id')),
			'admin_module');
		$this->redirect('agendamento/index');
	}
}
