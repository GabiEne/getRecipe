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
    	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	$id = $this->params()->fromRoute('idpharma');
    	$pharmacy = $objectManager->find('Application\Entity\Pharmacy', $id);
    	$view= new ViewModel(array('id' => $id, 'pharmacy' => $pharmacy));
    	$view->setTemplate('application/pharmacy/index/index');
    	return $view;
    	 
    }
    
    public function viewMedsAction(){
    	
    	$id = $this->params()->fromRoute('idpharma'); //id-ul farmaciei
    	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	$pharmacy = $objectManager->find('Application\Entity\Pharmacy', $id);
    	$drugs= $pharmacy->getDrugs();
    	$view= new ViewModel(array('drugs' => $drugs,'id'=>$id));
    	$view->setTemplate('application/pharmacy/index/viewmeds');
    	return $view;
    
    }
    
    public function addMedsAction(){
    	$idpharma = $this->params()->fromRoute('idpharma');
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
    					array('controller' => 'index', 'action'=> 'viewmeds','idpharma'=>$pharmacy->getId()));
    		}
		}
		else{
			$id = $this->params()->fromRoute('id');
			echo "ba";
			$idpharma = $this->params()->fromRoute('idpharma');
			if ((isset($id))&&(isset($idpharma)) ) {
				$drug = $objectManager->find('Application\Entity\Drugs', $id);
				$pharmacy = $objectManager->find('Application\Entity\Pharmacy', $idpharma);
				//$pharmacy->getDrugs()->remove($drug);
				echo "ba";
				$drug->setName($form->getValue('name'));
				var_dump ($this->request->getPost('name'));
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
			
		
    		$view= new ViewModel(array('form' => $form));
    		$view->setTemplate('application/drugs/index/addmeds');
    		return $view;
    	
    
    	
    }
    
    public function editmedAction(){
    	$id = $this->params()->fromRoute('id');
    	$idpharma = $this->params()->fromRoute('idpharma');
    	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	$form = new DrugsForm($objectManager);
    	if (isset($id)) {
    		$drug = $objectManager->find('Application\Entity\Drugs', $id);
    		$pharmacy = $objectManager->find('Application\Entity\Pharmacy', $idpharma);
    		if ($this->request->isPost()) {
    			$form->setData($this->request->getPost());
    		if($form->isValid()) {
    	    var_dump ($this->request->getPost('name'));
    	    $drug->setName($this->request->getPost('name'));
    	    $drug->setActiveIngredient($this->request->getPost('activeingredient'));
    	    $drug->setProducer($this->request->getPost('producer'));
    	    $drug->setPrice($this->request->getPost('producer'));
    	    $drug->setTherapeutic_action($this->request->getPost('therapeutic_action'));
    	    $drug->setCod_atc($this->request->getPost('cod_atc'));
    	    $objectManager->persist($drug);
    	    $objectManager->flush();
    	    return $this->redirect()->toRoute('pharmacy/index2',
    	    		array('controller' => 'index', 'action'=> 'viewmeds','idpharma'=>$pharmacy->getId()));
    			}
    		
    	
    		
    		}
    		$form->bind($drug);
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
				return $this->redirect()->toRoute('pharmacy/index2',
    					array('controller' => 'index', 'action'=> 'welcome','idpharma'=>$pharmacy->getId()));
    		}
    	}
    	else{
    		$id = $this->params()->fromRoute('id');
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
    
    	$view= new ViewModel(array('form' => $form));
    	$view->setTemplate('application/pharmacy/index/detail');
    	return $view;
    
    }
    
    public function deleteDoctorAction(){
    	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	$id = (int) $this->params()->fromRoute('id');
    	var_dump((int) $this->params()->fromRoute('id'));
    	$doctor= $objectManager->find('Application\Entity\Doctors', $id);
    	var_dump($this->request->isPost());
    
    	if ($this->request->isPost()) {
    
    		$objectManager->remove($doctor);
    		$objectManager->flush();
    
    		return $this->redirect()->toRoute('admin/index4',array('controller' => 'index', 'action'=> 'viewdoctors'));
    	}
    }
 }