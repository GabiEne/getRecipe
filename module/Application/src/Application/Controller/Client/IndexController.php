<?php
namespace Application\Controller\Client;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Application\Model\Client;
 use Application\Form\Client\ClientForm;
 use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
 use DoctrineORMModule\Form\Annotation\AnnotationBuilder;
 

 class IndexController extends AbstractActionController
 {
     public function indexAction()
     {
      return new ViewModel();

     }
     
     public function detailAction(){
     	
     	$entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
     	$repository = $entityManager()->getRepository('Application\Entity\User');
     	$id = (int)$this->params()->fromQuery('id');
     	$user = $repository->find($id);
     	 
     	/* here comes the magic */
     	//$builder = new AnnotationBuilder( $entityManager);
     	//$form = $builder->createForm( $user );
     	$form = new ClientForm();
     	$form->setHydrator(new DoctrineHydrator($entityManager,'Application\Entity\User'));
     	$form->bind($user);
     	 
     	$view= new ViewModel(array('form' => $form));
     	$view->setTemplate('application/client/index/detail');
     	return $view;
     	 
      }
 }
     
     

      
   
 