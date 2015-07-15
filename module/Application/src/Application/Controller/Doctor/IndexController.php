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
     				$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
     				$adapter = $authService->getAdapter();
     				$adapter->setIdentityValue($form->get('username')->getValue());
     				//var_dump($form->get('username')->getValue()); //$data['usr_name']
     				$adapter->setCredentialValue($form->get('password')->getValue());
     				 
     				$authResult = $authService->authenticate();
     				// echo "<h1>I am here</h1>";
     				if ($authResult->isValid()) {
     					$identity = $authResult->getIdentity();
     				return $this->redirect()->toRoute('doctor/index1',
     						array('controller' => 'index', 'action'=> 'welcome','id'=>$doctor->getId()));
     				}
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
     
     
     public function seePatientsAction(){
     	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
     	$user = $this->identity();
     	if($user = $this->identity()){
     		if ($user->getType() == 2) {
     			$id=$user->getId();
     			
     			$patientsfound = $objectManager->getRepository('Application\Entity\UserProfile')->findBy(
     					array('doctor' => $id));
     			
     			
     		}
     		else{
     			return $this->redirect()->toRoute('doctor/index1',
     					array('controller' => 'auth', 'action'=> 'login'));
     		}
     	}else 
     	{
     		return $this->redirect()->toRoute('doctor/index1',
     				array('controller' => 'index', 'action'=> 'detail'));
     	}
     	$view= new ViewModel(array('patients' => $patientsfound));
	 	$view->setTemplate('application/doctor/index/viewpatients');
	 	return $view;
     }
     public function seeDetailAction(){
     	
     	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
     	$id = $this->params()->fromRoute('id');
     	$doctor = $objectManager->find('Application\Entity\Doctors', $id);
     	$view= new ViewModel(array('doctor' => $doctor));
     	$view->setTemplate('application/doctor/index/viewprogram');
     	return $view;
     }
}
