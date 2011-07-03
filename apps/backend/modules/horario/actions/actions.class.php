<?php

/**
 * horario actions.
 *
 * @package    BookEquip
 * @subpackage horario
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class horarioActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->lab_equipment_schedules = Doctrine_Core::getTable('LabEquipmentSchedule')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->lab_equipment_schedule = Doctrine_Core::getTable('LabEquipmentSchedule')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->lab_equipment_schedule);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new LabEquipmentScheduleForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new LabEquipmentScheduleForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($lab_equipment_schedule = Doctrine_Core::getTable('LabEquipmentSchedule')->find(array($request->getParameter('id'))), sprintf('Object lab_equipment_schedule does not exist (%s).', $request->getParameter('id')));
    $this->form = new LabEquipmentScheduleForm($lab_equipment_schedule);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($lab_equipment_schedule = Doctrine_Core::getTable('LabEquipmentSchedule')->find(array($request->getParameter('id'))), sprintf('Object lab_equipment_schedule does not exist (%s).', $request->getParameter('id')));
    $this->form = new LabEquipmentScheduleForm($lab_equipment_schedule);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($lab_equipment_schedule = Doctrine_Core::getTable('LabEquipmentSchedule')->find(array($request->getParameter('id'))), sprintf('Object lab_equipment_schedule does not exist (%s).', $request->getParameter('id')));
    $lab_equipment_schedule->delete();

    $this->redirect('horario/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $lab_equipment_schedule = $form->save();

      $this->redirect('horario/edit?id='.$lab_equipment_schedule->getId());
    }
  }
}
