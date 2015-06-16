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


class IndexController extends AbstractActionController
{
	public function indexAction(){
			
		$view = new ViewModel();
		$view->setTemplate('application/admin/index/index');
		return $view;
		
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
	 
	 	
	 	//$view = new ViewModel();
	 	//$view->setTemplate('application/admin/index/index');
	 	
		}
		
	public function detailAction(){
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
				
				if (isset($id)) {
					 
					$client = $objectManager->find('Application\Entity\User', $id);
					if (!isset($client)) {
						$this->flashMessenger()->addErrorMessage(sprintf('Could not find client with id %s',$id));
						return $this->redirect()->toRoute('admin/index4',
								                  array ('controller' => 'index',
								                  	    'action'=> 'viewusers')
								                  );
					}
					$form->bind($client);
				}
			}
			
			$view= new ViewModel(array('form' => $form));
			$view->setTemplate('application/client/index/detail');
			return $view;
			 
		}
		
	public function deleteAction(){
			$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
			$id = (int) $this->params()->fromRoute('id');
			$client = $objectManager->find('Application\Entity\User', $id);
			var_dump($this->request->isPost());
		
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
		
	public function viewDoctorsAction(){
			$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
			$user = new \Application\Entity\Doctors();
		    $doctors = $this->getEntityManager()->getRepository('\Application\Entity\Doctors')->findAll();
			$view= new ViewModel(array('doctors' => $doctors));
			$view->setTemplate('application/admin/index/viewdoctors');
			return $view;

		}
		
	public function doctorDetailAction(){
			$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
			$form = new DoctorForm($objectManager);
			//$client = new User();
			//$form->bind($client);
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
		
	public function viewPharmaciesAction(){
			$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
			//$user = new \Application\Entity\Pharmacy();
			$pharmacies = $this->getEntityManager()->getRepository('\Application\Entity\Pharmacy')->findAll();
			$view= new ViewModel(array('pharmacies' => $pharmacies));
			$view->setTemplate('application/admin/index/viewpharmacies');
			return $view;
		
		}
		public function pharmacyDetailAction(){
			$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
			$form = new PharmacyForm($objectManager);
			//$client = new User();
			//$form->bind($client);
			if ($this->request->isPost()) {
				$form->setData($this->request->getPost());
				if($form->isValid()) {
					$pharmacy = $form->getObject();
					var_dump($pharmacy);
					$objectManager->persist($pharmacy);
					$objectManager->flush();
					return $this->redirect()->toRoute('admin/index4',
							array('controller' => 'index', 'action'=> 'viewpharmacies'));
				}
			}
			else{
				$id = $this->params()->fromRoute('id_farmacie');
		
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
}
