<?php

/**
 * pendenciasUsuario actions.
 *
 * @package    BookEquip
 * @subpackage pendenciasUsuario
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pendenciasUsuarioActions extends sfActions
{
/**
 * Executes index action
 *
 * @param sfRequest $request A request object
 */
	public function executeIndex(sfWebRequest $request)
	{
		
		// TODO: Inserir isto na configuração do módulo
		if (!$this->getUser()->isAuthenticated() ||
			!$this->getUser()->hasGroup('admin')) {
				$this->redirect('sfGuardAuth/signin');
			}
		
		if (is_null($request->getParameter('nivel_usuario')) ||
			$request->getParameter('nivel_usuario') == 'cadastro-pendente') {
			$this->listStatusText = 'Usuário com cadastro pendente. Permitir que se torne básico?';
			$this->groupId = 2; // Cadastro Pendente
			$this->autorizeToGroup = 'basico';		
		} elseif ($request->getParameter('nivel_usuario') == 'avancado-pendente') {
			$this->listStatusText = 'Usuário nível básico. Permitir que se torne avançado?';
			$this->groupId = 4; // Avançado Pendente
			$this->autorizeToGroup = 'avancado';
		} else {
			$this->forward404();
		}
		
		$query = Doctrine_Query::create()
			->from('sfGuardUserGroup')
			->where('group_id = ?', $this->groupId)
			->orderBy('updated_at DESC');
			
		$this->userList = $query->execute();
		
	}
	
	public function executeAutorizar (sfWebRequest $request)
	{
		
		// TODO: Inserir isto na configuração do módulo
		if (!$this->getUser()->isAuthenticated() ||
			!$this->getUser()->hasGroup('admin')) {
				$this->redirect('sfGuardAuth/signin');
			}
			
		if ($request->getParameter('nivel_usuario') == 'basico') {
			$setGroupTo = 3;
			$redirectTo = '?nivel_usuario=cadastro-pendente';
		} elseif ($request->getParameter('nivel_usuario') == 'avancado') {
			$setGroupTo = 5;
			$redirectTo = '?nivel_usuario=avancado-pendente';
		}
		
		if ($request->isMethod('post')) {
			
			// Múltiplos usuários
			if (!is_null($request->getParameter('allow_user'))) {
				$userList = array();
				foreach ($request->getParameter('allow_user') as $userId) $userList[] = $userId;
				$queryLimit = sizeof($userList);
				$query = Doctrine_Query::create()
					->update('sfGuardUserGroup')
					->set('group_id', '?', $setGroupTo)
					->whereIn('user_id', $userList)
					->limit($queryLimit);
			
				$query->execute();
			}
			$this->redirect('pendenciasUsuario/index' . $redirectTo);
			
		} else {
			
			// Apenas um usuário (Request assíncrono)
			$query = Doctrine_Query::create()
				->update('sfGuardUserGroup')
				->set('group_id', '?', $setGroupTo)
				->where('user_id = ?', $request->getParameter('user_id'))
				->limit(1);
			$query->execute();
			exit('Success');
			
		}
	}

}
