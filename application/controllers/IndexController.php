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
    	$request = $this->getRequest();
    	if ( $request->isPost()) {
			if ($loginForm->isValid($request->getPost())) {
				
			}
    	}
    	$this->view->loginForm = $loginForm;
    }
}

