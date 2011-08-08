<?php

require_once dirname(__FILE__).'/../lib/agendamentoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/agendamentoGeneratorHelper.class.php';

/**
 * agendamento actions.
 *
 * @package    BookEquip
 * @subpackage agendamento
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class agendamentoActions extends autoAgendamentoActions
{
	public function executeViewAppointment (sfWebRequest $request)
	{		
		$this->redirect('/agendamento/resumo/' .  $request->getParameter('id'));
	}
	
	public function executeBatchApproveAppointment (sfWebRequest $request)
	{		
		$query = Doctrine_Query::create()
			->update('LabAppointment')
			->set('event_status', '?', 'aprovado')
			->whereIn('id', $request->getParameter('ids'))
			->andWhere('event_status = ? ', 'pendente');
		$query->execute();
	}
	
}
