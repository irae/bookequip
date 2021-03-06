<?php

require_once dirname(__FILE__).'/../lib/equipamentoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/equipamentoGeneratorHelper.class.php';

/**
 * equipamento actions.
 *
 * @package    BookEquip
 * @subpackage equipamento
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class equipamentoActions extends autoEquipamentoActions
{
	public function executeViewSchedules (sfWebRequest $request)
	{
		$this->getUser()->setAttribute(
			'horario.filters',
			array('equipment_id' => $request->getParameter('id')),
			'admin_module');
			
		$this->redirect('horario/index');
	}
}
