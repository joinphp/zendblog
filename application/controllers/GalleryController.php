<?php

class GalleryController extends Zend_Controller_Action
{	
	public function init()
	{
		/* Initialize action controller here */
		$this->user = 'kthari85';
	}

	public function indexAction()
	{
		// action body
		/*
		 * Get the various albums of current user .
		 * Only public photos and albums will be shown
		 * Not implemented the authentication
		 * We can show when authenticated. But I am not adding for now .
		 */
		$service = new Zend_Gdata_Photos();
		$query = new Zend_Gdata_Photos_UserQuery();
		$query->setUser($this->user);
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