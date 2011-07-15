<?php

/**
 * cadastro actions.
 *
 * @package    BookEquip
 * @subpackage cadastro
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cadastroActions extends sfActions
{

	public function executeIndex(sfWebRequest $request)
	{
		
		$this->form = new sfGuardUserForm();
	}

	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));
		$this->form = new sfGuardUserForm();
		$this->processForm($request, $this->form);
		$this->setTemplate('index');
	}

	public function executeEdit(sfWebRequest $request)
	{
		$this->forward404Unless($this->getUser()->isAuthenticated());
		$sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find($this->getUser()->getGuardUser()->getId());
		$this->form = new sfGuardUserForm($sf_guard_user);
	}

	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
		$this->form = new sfGuardUserForm($sf_guard_user);

		$this->processForm($request, $this->form);

		$this->setTemplate('edit');
	}

	public function executeDelete(sfWebRequest $request)
	{
		$request->checkCSRFProtection();
		$this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
		$this->getUser()->signOut();
		$sf_guard_user->delete();
		$this->redirect('sfGuardAuth/signin');
	}

	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid()) {
			if ($form->isNew()) {
				$sf_guard_user = $form->save();
				// Vincula o cadastramento ao grupo 'cadastro pendente', para posterior liberação de uso pelo admin
				$sf_guard_user->addGroupByName('cadastro pendente');
				$this->redirect('sfGuardAuth/signin');
			} else {
				$sf_guard_user = $form->save();
				$this->redirect('cadastro/edit');
			}


		}
	}
}
