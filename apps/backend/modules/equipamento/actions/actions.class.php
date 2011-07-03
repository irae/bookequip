<?php

/**
 * equipamento actions.
 *
 * @package    BookEquip
 * @subpackage equipamento
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class equipamentoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->lab_equipments = Doctrine_Core::getTable('LabEquipment')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->lab_equipment = Doctrine_Core::getTable('LabEquipment')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->lab_equipment);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new LabEquipmentForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new LabEquipmentForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($lab_equipment = Doctrine_Core::getTable('LabEquipment')->find(array($request->getParameter('id'))), sprintf('Object lab_equipment does not exist (%s).', $request->getParameter('id')));
    $this->form = new LabEquipmentForm($lab_equipment);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($lab_equipment = Doctrine_Core::getTable('LabEquipment')->find(array($request->getParameter('id'))), sprintf('Object lab_equipment does not exist (%s).', $request->getParameter('id')));
    $this->form = new LabEquipmentForm($lab_equipment);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($lab_equipment = Doctrine_Core::getTable('LabEquipment')->find(array($request->getParameter('id'))), sprintf('Object lab_equipment does not exist (%s).', $request->getParameter('id')));
    $lab_equipment->delete();

    $this->redirect('equipamento/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $lab_equipment = $form->save();

      $this->redirect('equipamento/edit?id='.$lab_equipment->getId());
    }
  }
}
