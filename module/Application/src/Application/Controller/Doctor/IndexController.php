<?php

namespace Application\Controller\Doctor;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\Doctor\DoctorForm;
use Application\Entity\Doctors;

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
    
  public function detailAction(){
     	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
     	$form = new DoctorForm($objectManager);
     	$doctor = new Doctors();
     	$form->bind($doctor); 
     	if ($this->request->isPost()) {
     		$form->setData($this->request->getPost());
     	     	 if($form->isValid()) {
     				$objectManager->persist($doctor);
     				$objectManager->flush();
     				return $this->redirect()->toRoute('doctor/index1',
     						array('controller' => 'index', 'action'=> 'welcome','id'=>$doctor->getId()));
     				/*
     				return $this->redirect()->toRoute('client/index3',
     						array('controller' => 'index', 'action'=> 'createprofile' ,'id'=>$client->getId()));
     			*/}
     		}
         else{
         	
         }
        $form->get('type')->setValue(2);
     	$view= new ViewModel(array('form' => $form));
     	$view->setTemplate('application/doctor/index/detail');
     	return $view;
      	
     }
     public function welcomeAction(){
     	
     	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
     	$id = $this->params()->fromRoute('id');
     	$doctor = $objectManager->find('Application\Entity\Doctors', $id);
     	$view= new ViewModel(array('id' => $id, 'doctor' => $doctor));
     	$view->setTemplate('application/doctor/index/index');
     	return $view;
     	 
     }
     
     
     public function seeYourPacients(){
     	
     }
}
