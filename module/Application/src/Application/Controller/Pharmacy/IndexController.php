<?php
namespace Application\Controller\Pharmacy;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Doctrine\ORM\EntityManager;
 use Application\Entity\Drugs;
 use Application\Entity\Pharmacy;
use Application\Form\Pharmacy\PharmacyForm;
use Application\Form\Drugs\DrugsForm;

 class IndexController extends AbstractActionController
 {
 	public function indexAction(){
 		
    	$view = new ViewModel();
    	$view->setTemplate('application/pharmacy/index/index');
    	return $view;
    	
    	
    }
    public function welcomeAction(){
    	$user = $this->identity();
    	if($user = $this->identity()){
    		if ($user->getType() == 3) {
    			
    			$id=$user->getId();
    	        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                $pharmacy = $objectManager->find('Application\Entity\Pharmacy', $id);
    	   }
    		else{
    			return $this->redirect()->toRoute('pharmacy/index2',
    					array('controller' => 'auth', 'action'=> 'login'));
    		}
    	}
    	else {
    		return $this->redirect()->toRoute('pharmacy/index2',
    				array('controller' => 'auth', 'action'=> 'login'));
    	}
    	
    	$view= new ViewModel(array('id' => $id, 'pharmacy' => $pharmacy));
    	$view->setTemplate('application/pharmacy/index/index');
    	return $view;
    }
    
    public function viewMedsAction(){
    	$user = $this->identity();
    	if($user = $this->identity()){
    		if ($user->getType() == 3) {
    			$id=$user->getId(); //id-ul farmaciei
    	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	$pharmacy = $objectManager->find('Application\Entity\Pharmacy', $id);
    	$drugs= $pharmacy->getDrugs();
    	
    		}
    		else {
    			return $this->redirect()->toRoute('pharmacy/index2',
    					array('controller' => 'auth', 'action'=> 'login'));
    		}
    }
    else{
    	return $this->redirect()->toRoute('pharmacy/index2',
    			array('controller' => 'auth', 'action'=> 'login'));
    }
    $view= new ViewModel(array('drugs' => $drugs,'id'=>$id));
    $view->setTemplate('application/pharmacy/index/viewmeds');
    return $view;
    }
    
    public function addMedsAction(){
    	$user = $this->identity();
    	if($user = $this->identity()){
    		if ($user->getType() == 3) {
    			$idpharma=$user->getId();
    	
    	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	$pharmacy = $objectManager->find('Application\Entity\Pharmacy', $idpharma);
    	$form = new DrugsForm($objectManager);
		if ($this->request->isPost()) {
    		$form->setData($this->request->getPost());
    		if($form->isValid()) {
    			$drug = $form->getObject();
    			$objectManager->persist($drug);
    			$objectManager->flush();
    			$pharmacy->getDrugs()->add($drug);
    			$objectManager->persist($pharmacy);
    			$objectManager->flush();
    			return $this->redirect()->toRoute('pharmacy/index2',
    					array('controller' => 'index', 'action'=> 'viewmeds'));
    		}
		}
		else{
			$id = $this->params()->fromRoute('id');
			
			$idpharma = $user->getId();;
			if ((isset($id))&&(isset($idpharma)) ) {
				$drug = $objectManager->find('Application\Entity\Drugs', $id);
				$pharmacy = $objectManager->find('Application\Entity\Pharmacy', $idpharma);
				
				$drug->setName($form->getValue('name'));
				
				if (!isset($drug)) {
					$this->flashMessenger()->addErrorMessage(sprintf('Could not find client with id %s',$id));
					return $this->redirect()->toRoute('pharmacy/index2',
					array ('controller' => 'index',
					'action'=> 'viewmeds',
					'idpharma' => $idpharma)
					);
				}
			
				$form->bind($drug);
			
			}
		
			}
			
		
    	
    	}
    		else{
    		return $this->redirect()->toRoute('pharmacy/index2',
    				array('controller' => 'auth', 'action'=> 'login'));
    	}
    	
    	}
    	else{
    		return $this->redirect()->toRoute('pharmacy/index2',
    				array('controller' => 'auth', 'action'=> 'login'));
    	}

    	$view= new ViewModel(array('form' => $form));
    	$view->setTemplate('application/drugs/index/addmeds');
    	return $view;
    }
    
    public function editmedAction(){
    	$user = $this->identity();
    	if($user = $this->identity()){
    		if ($user->getType() == 3) {
    			$idpharma=$user->getId();
    	$id = $this->params()->fromRoute('idpharma');
    	
    	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	$form = new DrugsForm($objectManager);
    	if (isset($id)) {
    		$drug = $objectManager->find('Application\Entity\Drugs', $id);
    		$pharmacy = $objectManager->find('Application\Entity\Pharmacy', $idpharma);
    		if ($this->request->isPost()) {
    			$form->setData($this->request->getPost());
    		if($form->isValid()) {
    	    
    	    $drug->setName($this->request->getPost('name'));
    	    $drug->setActiveIngredient($this->request->getPost('activeingredient'));
    	    $drug->setProducer($this->request->getPost('producer'));
    	    $drug->setPrice($this->request->getPost('price'));
    	    $drug->setTherapeutic_action($this->request->getPost('therapeutic_action'));
    	    $drug->setCod_atc($this->request->getPost('cod_atc'));
    	    $objectManager->persist($drug);
    	    $objectManager->flush();
    	    return $this->redirect()->toRoute('pharmacy/index2',
    	    		array('controller' => 'index', 'action'=> 'viewmeds'));
    			}
    		
    	
    		
    		}
    		$form->bind($drug);
    	}
    		}
    		else{
    			return $this->redirect()->toRoute('pharmacy/index2',
    					array('controller' => 'auth', 'action'=> 'login'));
    		}	
    	}
    	else{
    		return $this->redirect()->toRoute('pharmacy/index2',
    				array('controller' => 'auth', 'action'=> 'login'));
    	}
    
    	$view= new ViewModel(array('form' => $form));
    	$view->setTemplate('application/drugs/index/addmeds');
    	return $view;
    }
    
    public function detailAction(){
    	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	$form = new PharmacyForm($objectManager);
    	if ($this->request->isPost()) {
    		$form->setData($this->request->getPost());
    		if($form->isValid()) {
    			$pharmacy = $form->getObject();
    			$objectManager->persist($pharmacy);
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
    				$authService->getStorage()->write($identity);
    				$time = 1209600;
    			
    			}
    			 else{
    			 	return $this->redirect()->toRoute('pharmacy/index2',
    				array('controller' => 'auth', 'action'=> 'login'));;
    			}
				return $this->redirect()->toRoute('pharmacy/index2',
    					array('controller' => 'index', 'action'=> 'welcome'));
    		}
    	}
    	else{
    		$user = $this->identity();
    		if($user = $this->identity()){
    			if ($user->getType() == 3) {
    				$id=$user->getId();
    	
    		    if (isset($id)) {
    		      $pharmacy = $objectManager->find('Application\Entity\Pharmacy', $id);
    			if (!isset($pharmacy)) {
    				$this->flashMessenger()->addErrorMessage(sprintf('Could not find client with id %s',$id));
    				//return $this->redirect()->toRoute('admin/index4',
    						//array ('controller' => 'index',
    								//'action'=> 'viewdoctors')
    				//);
    			}
    			$form->bind($pharmacy);
    		}
    	}
    	else {
    		return $this->redirect()->toRoute('pharmacy/index2',
    				array('controller' => 'auth', 'action'=> 'login'));;
    	}
    		}
    	}
    	$view= new ViewModel(array('form' => $form));
    	$view->setTemplate('application/pharmacy/index/detail');
    	return $view;
    
    }
    

    
    public function seeDetailAction(){
    	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	$id = $this->params()->fromRoute('idpharma');
    	$drug = $objectManager->find('Application\Entity\Drugs', $id);
    	$view= new ViewModel(array('drug' => $drug));
    	$view->setTemplate('application/drugs/index/viewmedicinedetail');
    	return $view;
    }
 }