<?php
namespace Application\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class IndexController extends AbstractActionController
{
	public function indexAction(){
			
		$view = new ViewModel();
		$view->setTemplate('application/admin/index/index');
		return $view;
		 
		
	}
}