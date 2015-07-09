<?php
namespace Application\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Application\Form\Client\ClientForm;
use Application\Form\Doctor\DoctorForm;
use Application\Form\Pharmacy\PharmacyForm;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Application\Entity\User;
use Application\Entity\Doctors;
use Application\Entity\Pharmacy;
use Application\Entity\Admin;



class IndexController extends AbstractActionController
{  
	public function indexAction(){
		if($user = $this->identity()){
			if ($user->getType() == 4) {
	
			$view= new ViewModel();
			$view->setTemplate('application/admin/index/index');
			return $view;

			
		 }
		 else{
			return $this->redirect()->toRoute('admin/index4',
					array('controller' => 'auth', 'action'=> 'login'));
	       }
		
	}
	else{
			return $this->redirect()->toRoute('admin/index4',
					array('controller' => 'auth', 'action'=> 'login'));
	    }
	}
	
	/**
	 * @var EntityManager
	 */
	protected $entityManager;
	
	/**
	 * Sets the EntityManager
	 *
	 * @param EntityManager $em
	 * @access protected
	 * 
	 */
	protected function setEntityManager(EntityManager $em)
	{
		$this->entityManager = $em;
		return $this;
	}
	
	/**
	 * Returns the EntityManager
	 *
	 * Fetches the EntityManager from ServiceLocator if it has not been initiated
	 * and then returns it
	 *
	 * @access protected
	 * @return EntityManager
	 */
	protected function getEntityManager()
	{
		if (null === $this->entityManager) {
			$this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
		}
		return $this->entityManager;
	}
	
	public function viewUsersAction(){
		if($user = $this->identity()){
		   if ($user->getType() == 4) {
			
	 		$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
	 		$user = new \Application\Entity\User();
	 	/*
	 	$user->__set("username",'NewUser1');
	 	$user->__set("password",'NewUser121');
	 	$user->__set("firstname",'Nume User1');
	 	$user->__set("lastname",'Prenume User1');
	 	$user->__set("country",'Romania1 ');
	 	$user->__set("city",' Bucuresti1');
	 	$user->__set("email",'alandala1');
	 	$objectManager->persist($user);
	 	$objectManager->flush();
	 	$users = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->getRepository('\Application\Entity\User')->findAll(); */
	 	
	 		$users = $this->getEntityManager()->getRepository('\Application\Entity\User')->findAll();
	 		$view= new ViewModel(array('users' => $users));
	 		$view->setTemplate('application/admin/index/viewusers');
	 		return $view;
			}
			
		
			else 
			{
				return $this->redirect()->toRoute('admin/index4',
						array('controller' => 'auth', 'action'=> 'login'));
			}
		}else{
			 return $this->redirect()->toRoute('admin/index4',
					array('controller' => 'auth', 'action'=> 'login'));
		 }
	 	//$view = new ViewModel();
	 	//$view->setTemplate('application/admin/index/index');
	 	
	}
		
	public function detailAction(){
		if($user = $this->identity()){
			if ($user->getType() == 4) {
				$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
				$form = new ClientForm($objectManager);
			//$client = new User();
			//$form->bind($client);
				if ($this->request->isPost()) {
				$form->setData($this->request->getPost());
					if($form->isValid()) {
						$client = $form->getObject();
						$objectManager->persist($client);
						$objectManager->flush();
						return $this->redirect()->toRoute('admin/index4',
							     array('controller' => 'index', 'action'=> 'viewusers'));
						}
				}
			else{
				$id = $this->params()->fromRoute('id');
				if(isset($id)) {
					 $client = $objectManager->find('Application\Entity\User', $id);
						if (!isset($client)) {
						$this->flashMessenger()->addErrorMessage(sprintf('Could not find client with id %s',$id));
						return $this->redirect()->toRoute('admin/index4',
								                  array ('controller' => 'index',
								                  	    'action'=> 'viewusers'));
					}
					$form->bind($client);
				}
			}
			
			$view= new ViewModel(array('form' => $form));
			$view->setTemplate('application/client/index/detail');
			return $view;

			
		}
		else{
			return $this->redirect()->toRoute('admin/index4',
					array('controller' => 'auth', 'action'=> 'login'));
	       	}
		
	}
	else{
			return $this->redirect()->toRoute('admin/index4',
					array('controller' => 'auth', 'action'=> 'login'));
	    }
	}
	
	public function deleteAction(){
		if($user = $this->identity()){
			if ($user->getType() == 4) {
					$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
					$id = (int) $this->params()->fromRoute('id');
					$client = $objectManager->find('Application\Entity\User', $id);
					if ($this->request->isPost()) {
						$objectManager->remove($client);
						$objectManager->flush();			
						return $this->redirect()->toRoute('admin/index4',array('controller' => 'index', 'action'=> 'viewusers'));
					}
			
			//$users = $this->getEntityManager()->getRepository('\Application\Entity\User')->findAll();
			//$view= new ViewModel(array('users' => $users));
			//$view->setTemplate('application/admin/index/viewusers');
			//return $view;
			
			
		
			}
		else{
			return $this->redirect()->toRoute('admin/index4',
					array('controller' => 'auth', 'action'=> 'login'));
		}
		}
		else{
			return $this->redirect()->toRoute('admin/index4',
					array('controller' => 'auth', 'action'=> 'login'));
		}
		}
		
	public function viewDoctorsAction(){
		if($user = $this->identity()){
			if ($user->getType() == 4) {
				$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
				$doctors = $this->getEntityManager()->getRepository('\Application\Entity\Doctors')->findAll();
				$view= new ViewModel(array('doctors' => $doctors));
				$view->setTemplate('application/admin/index/viewdoctors');
				return $view;
        
		}
				
		else{
			return $this->redirect()->toRoute('admin/index4',
					array('controller' => 'auth', 'action'=> 'login'));
		}
		
		}
		else{
			return $this->redirect()->toRoute('admin/index4',
					array('controller' => 'auth', 'action'=> 'login'));
		}
    }
		
		
	public function doctorDetailAction(){
		if($user = $this->identity()){
			if ($user->getType() == 4) {
			$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
			$form = new DoctorForm($objectManager);
		    if ($this->request->isPost()) {
				$form->setData($this->request->getPost());
				if($form->isValid()) {
					$doctor = $form->getObject();
					$objectManager->persist($doctor);
					$objectManager->flush();
					return $this->redirect()->toRoute('admin/index4',
							array('controller' => 'index', 'action'=> 'viewdoctors'));
				}
			}
			else{
				$id = $this->params()->fromRoute('id');
		        if (isset($id)) {
		         $doctor = $objectManager->find('Application\Entity\Doctors', $id);
					if (!isset($doctor)) {
						$this->flashMessenger()->addErrorMessage(sprintf('Could not find client with id %s',$id));
						return $this->redirect()->toRoute('admin/index4',
								array ('controller' => 'index',
										'action'=> 'viewdoctors')
						);
					}
					$form->bind($doctor);
				}
			}
				
			$view= new ViewModel(array('form' => $form));
			$view->setTemplate('application/doctor/index/detail');
			return $view;
		
		}
		else{
			return $this->redirect()->toRoute('admin/index4',
					array('controller' => 'auth', 'action'=> 'login'));
		}
		
		}
		else{
			return $this->redirect()->toRoute('admin/index4',
					array('controller' => 'auth', 'action'=> 'login'));
		}
	}
		
	public function deleteDoctorAction(){
		if($user = $this->identity()){
			if ($user->getType() == 4) {
			$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
			$id = (int) $this->params()->fromRoute('id');
			$doctor= $objectManager->find('Application\Entity\Doctors', $id);
			if ($this->request->isPost()) {
		
				$objectManager->remove($doctor);
				$objectManager->flush();
		
				return $this->redirect()->toRoute('admin/index4',array('controller' => 'index', 'action'=> 'viewdoctors'));
			}
			}else 
				{
					return $this->redirect()->toRoute('admin/index4',
							array('controller' => 'auth', 'action'=> 'login'));
				}
		}
		else{
			return $this->redirect()->toRoute('admin/index4',
					array('controller' => 'auth', 'action'=> 'login'));
		}
		}
		
	public function viewPharmaciesAction(){
		if($user = $this->identity()){
			if ($user->getType() == 4) {
			$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
			
			$pharmacies = $this->getEntityManager()->getRepository('\Application\Entity\Pharmacy')->findAll();
			$view= new ViewModel(array('pharmacies' => $pharmacies));
			$view->setTemplate('application/admin/index/viewpharmacies');
			return $view;
		   
		}
		
		else{
			return $this->redirect()->toRoute('admin/index4',
					array('controller' => 'auth', 'action'=> 'login'));
		}
		
	}
		else{
			return $this->redirect()->toRoute('admin/index4',
					array('controller' => 'auth', 'action'=> 'login'));
		}
}
	public function pharmacyDetailAction(){
		if($user = $this->identity()){
			if ($user->getType() == 4) {
			$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
			$form = new PharmacyForm($objectManager);
			
			if ($this->request->isPost()) {
				$form->setData($this->request->getPost());
				if($form->isValid()) {
					$pharmacy = $form->getObject();
					
					$objectManager->persist($pharmacy);
					$objectManager->flush();
					return $this->redirect()->toRoute('admin/index4',
							array('controller' => 'index', 'action'=> 'viewpharmacies'));
				}
			}
			else{
				$id = $this->params()->fromRoute('id');
		
				if (isset($id)) {
		
					$pharmacy = $objectManager->find('Application\Entity\Pharmacy', $id);
					if (!isset($pharmacy)) {
						$this->flashMessenger()->addErrorMessage(sprintf('Could not find client with id %s',$id));
						return $this->redirect()->toRoute('admin/index4',
								array ('controller' => 'index',
										'action'=> 'viewpharmacies')
						);
					}
					$form->bind($pharmacy);
				}
			}
			$view= new ViewModel(array('form' => $form));
			$view->setTemplate('application/pharmacy/index/detail');
			return $view;
			}
			else{
				return $this->redirect()->toRoute('admin/index4',
						array('controller' => 'auth', 'action'=> 'login'));
			}
			
			}
			else{
				return $this->redirect()->toRoute('admin/index4',
						array('controller' => 'auth', 'action'=> 'login'));
			}
		}
      
      public function deletePharmacyAction(){
      	if($user = $this->identity()){
      		if ($user->getType() == 4) {
      		$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
      		$id = (int) $this->params()->fromRoute('id');
      		$pharmacy= $objectManager->find('Application\Entity\Pharmacy', $id);
      		if ($this->request->isPost()) {
      		$objectManager->remove($pharmacy);
      		$objectManager->flush();
      
      		return $this->redirect()->toRoute('admin/index4',array('controller' => 'index', 'action'=> 'viewpharmacies'));
      	}
      		}else 
				{
					return $this->redirect()->toRoute('admin/index4',
							array('controller' => 'auth', 'action'=> 'login'));
				}
		}
		else{
			return $this->redirect()->toRoute('admin/index4',
					array('controller' => 'auth', 'action'=> 'login'));
		}
      }
}
