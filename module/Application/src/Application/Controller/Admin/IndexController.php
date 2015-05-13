<?php
namespace Application\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

use Application\Form\Client\ClientForm;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Application\Entity\User;


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
						return $this->redirect()->toRoute('admin/index4',array('controller' => 'index', 'action'=> 'viewusers'));
					}
					$form->bind($client);
				}
			}
			$view= new ViewModel(array('form' => $form));
			$view->setTemplate('application/client/index/detail');
			return $view;
			 
		}
	}
