<?php
namespace Application\Controller\Client;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Zend\Form\Annotation\AnnotationBuilder;
 use Application\Model\Client\Client;
 use Application\Form\Client\ClientForm;
 use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
 use Application\Entity\User;

 

 class IndexController extends AbstractActionController
 {
     public function indexAction(){
     	
     	 return new ViewModel();
	 
     }

     
     public function detailAction(){
     	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
     	$form = new ClientForm($objectManager);
     	$client = new User();
     	$form->bind($client); 
     	
     	  	
     	 if ($this->request->isPost()) {
     		$form->setData($this->request->getPost());
     	     	 if($form->isValid()) {
     				$objectManager->persist($client);
     				$objectManager->flush();
     			}
     		}
         else{
         	
         }
     	$view= new ViewModel(array('form' => $form));
     	$view->setTemplate('application/client/index/detail');
     	return $view;
      	
     }
     
     
    /****** FUNCTIE DE ADAUGARE CARE MERGE */  
      public function addAction (){
      	
      		$form = new \Application\Form\Client\ClientForm();
      		$request = $this->getRequest();
      	
      		if ($request->isPost()) {
      			
      			$form->setData($request->getPost());
      			
      			if ($form->isValid()) {
      				$data = $form->getData();
      				$sl = $this->getServiceLocator();
      				$em = $sl->get('doctrine.entitymanager.orm_default');
      				$client= new \Application\Entity\User;
      				$client->__set("username",$data['username']);
      				$client->__set("password",$data['password']);
      				$client->__set("firstname",$data['firstname']);
      				$client->__set("lastname",$data['lastname']);
      				$client->__set("country",$data['country']);
      				$client->__set("city", $data['city']);
      				$client->__set("email",$data['email']);
      				$em->persist($client);
      				$em->flush();
      				//$this->flashMessenger()->addMessage('Your submission has
             // been accepted as item #' . $client->__get($id));
      			}
      		}
      		
      		$view= new ViewModel(array('form' => $form));
     		$view->setTemplate('application/client/index/detail');
     		return $view;
      	
      }
      
      /**********************************************************************/
      
 }
     

 
 

      
   
 