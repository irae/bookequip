<?php

/**
 * agendamento actions.
 *
 * @package    BookEquip
 * @subpackage agendamento
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class agendamentoActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->foobar = LabEquipmentScheduleTable::getInstance()->dayAvaiableSchedules('2011-04-04')->fetchArray();
  }
}
