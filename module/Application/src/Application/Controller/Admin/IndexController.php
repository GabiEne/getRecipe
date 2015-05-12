<?php
namespace Application\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;


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
	 * @return PostController
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
	 	//$user = new \Application\Entity\User();
	 	//$user->__set("userName",'NewUser1');
	 	//$user->__set("password",'NewUser121');
	 	//$user->__set("firstName",'Nume User1');
	 	//$user->__set("lastName",'Prenume User1');
	 	//$user->__set("country",'Romania1 ');
	 	//$user->__set("city",' Bucuresti1');
	 	//$user->__set("email",'alandala1');
	 	//$objectManager->persist($user);
	 	//$objectManager->flush();
	 	//$users = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->getRepository('\Application\Entity\User')->findAll();
	 	$users = $this->getEntityManager()->getRepository('\Application\Entity\User')->findAll();
	 	//var_dump($users);
	 	
	 	$view= new ViewModel(array('users' => $users));
	 	$view->setTemplate('application/admin/index/viewusers');
	 	return $view;
	 
	 	
	 	//$view = new ViewModel();
	 	//$view->setTemplate('application/admin/index/index');
	 	
		}
		
	}
