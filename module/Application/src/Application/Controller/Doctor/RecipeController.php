<?php

namespace Application\Controller\Doctor;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RecipeController extends AbstractActionController
{
	
  public function listAction()
    {
    	$view = new ViewModel(array(
    			'message' => 'Hello world',
    	));
    	//$view->setTemplate('application/doctor/index/index');
    	return $view;
    	
    	//return new ViewModel();
    }
    
}