<?php

namespace Application\Controller\Doctor;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class IndexController extends AbstractActionController
{
	public function indexAction()
    {
    	$view = new ViewModel(array(
    			'message' => 'Hello world'
    	));
    	$view->setTemplate('application/doctor/index/index');
    	return $view;
    	
    	//return new ViewModel();
    }
    
    public function listareAction()
    {    var_dump('ASDASDAS');
    	return new ViewModel();
    }
}