<?php

class IndexController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		// action body
		$posts = new Model_DbTable_Posts();
		$result = $posts->getPosts();
		$page = $this->_getParam('page',1);
		$paginator = Zend_Paginator::factory($result);
		$paginator->setItemCountPerPage(2);
		$paginator->setCurrentPageNumber($page);
		$this->view->paginator = $paginator;
	}

	public function loginAction()
	{		
		$loginForm = new Form_Login();
		$redirect = $this->getRequest()->getParam('redirect', 'index/index');
		$loginForm->setAttrib('redirect', $redirect );
		$auth = Zend_Auth::getInstance();
		if(Zend_Auth::getInstance()->hasIdentity()) {
			$this->_redirect('/index/hello');
		} else if ($this->getRequest()->isPost()) {
			if ( $loginForm->isValid($this->getRequest()->getPost()) ) {
				$username = $this->getRequest()->getPost('username');
				$pwd = $this->getRequest()->getPost('pass');
				$authAdapter = new Model_AuthAdapter($username, $pwd);
				$result = $auth->authenticate($authAdapter);
				if(!$result->isValid()) {
					switch ($result->getCode()) {
						case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
							$this->view->error = 'user credentials not found';
					}
				} else {
					//Successfully logged in
					$this->_redirect( $redirect );
				}
			}
		}
		$this->view->loginForm = $loginForm;
//		$this->_redirect($redirectUrl);

	}

	public function logoutAction()
	{
		$auth = Zend_Auth::getInstance();
		$auth->clearIdentity();
		$this->_redirect('/');
	}
}

