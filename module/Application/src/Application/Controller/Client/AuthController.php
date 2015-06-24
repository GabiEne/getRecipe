<?php
namespace Application\Controller\Client;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;



class AuthController extends AbstractActionController
{
	public function indexAction(){

		return new ViewModel();

	}
}	 