<?php
namespace Application\Controller\Pharmacy;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 

 class IndexController extends AbstractActionController
 {
 	public function indexAction(){
 		
    	$view = new ViewModel();
    	$view->setTemplate('application/pharmacy/index/index');
    	return $view;
    	
    	
    }
 }