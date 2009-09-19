<?php

class GalleryController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		// action body
		$service = new Zend_Gdata_Photos();
		$query = new Zend_Gdata_Photos_UserQuery();
		$query->setUser('kthari85');
		try {
			$userFeed = $service->getUserFeed(null, $query);
			$this->view->userFeed = $userFeed;
		} catch (Zend_Gdata_App_Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function albumAction()
	{
		// action body
	}

	public function viewAction()
	{
		// action body
	}

}