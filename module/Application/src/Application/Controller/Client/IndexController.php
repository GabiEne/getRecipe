<?php
namespace Application\Controller\Client;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Zend\Form\Annotation\AnnotationBuilder;
 use Application\Model\Client\Client;
 use Application\Form\Client\ClientForm;
 use Application\Form\Client\UserProfileForm;
 use Application\Form\Doctor\DoctorEmailForm;
 use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
 use Application\Entity\User;
 use Application\Entity\UserProfile;
 use Application\Entity\Doctors;
 use Zend\Mail;
 use AcMailer\Service;
 use AcMailer\Service\MailService;
 use AcMailer\Service\Factory\MailServiceFactory;
	
 

 class IndexController extends AbstractActionController
 {
     public function indexAction(){
     	
     	 return new ViewModel();
	 
     }
     public function welcomeAction(){
     	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
     	$id = $this->params()->fromRoute('id');
     	$user = $objectManager->find('Application\Entity\User', $id);
     	$view= new ViewModel(array('id' => $id, 'user' => $user));
     	$view->setTemplate('application/client/index/index');
     	return $view;
     
     }
     
     public function createProfileAction(){
     	
     	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
     	$form = new UserProfileForm($objectManager);
     	$profile = new UserProfile();
     	$form->bind($profile);
     	if ($this->request->isPost()) {
     		$form->setData($this->request->getPost());
     		if($form->isValid()) {
     			$id = $this->params()->fromRoute('id');
     			$firstname= $this->getRequest()->getPost('firstnamedoctor');
     			$lastname = $this->getRequest()->getPost('lastnamedoctor');
     		    $user = $objectManager->find('Application\Entity\User', $id);
     			$doctor = $objectManager->getRepository('Application\Entity\Doctors')->findOneBy(
     					array('firstname' => $firstname, 'lastname' =>$lastname));
     			
     			if($doctor!=NULL){
     				
     				$profile->setDoctor($doctor);
     			}
     		    
     			else{
     				
     				$form = new DoctorEmailForm();
     				
     				if ($this->request->isPost()) {
     					$form->setData($this->request->getPost());
     				
     					if($form->isValid()) {
     						
     					$transport = new \Zend\Mail\Transport\Sendmail();
						$message   = new \Zend\Mail\Message();
						$renderer  = new \Zend\View\Renderer\PhpRenderer();

					$message
        			        ->setTo(array("gabriela.ene02@gmail.com"));
					
                    $service = new \AcMailer\Service\MailService($message, $transport, $renderer);
                    $service->setBody("<p>This is the body</p>")
                       ->setSubject("This is the subject");

               try {
    				 $result = $service->send();
    				 echo $result->isValid() ? "Success!!" : "Error";
				} catch (\Exception $e) {
   						 echo "Exception!! " . $e->getMessage();
			   }
     						
     					}
     				}
     				
     				$view= new ViewModel(array('form' => $form));
     				$view->setTemplate('application/client/index/doctoremail');
     				return $view;
     			}
     			$profile = $form->getObject();
     			$profile->setUser($user);
     		    $objectManager->persist($profile);
     			$objectManager->flush();
     		}
     	}
     		
     		else{
     			if (isset($id)) {
     			
     				$client = $objectManager->find('Application\Entity\UserProfile', $id);
     				if (!isset($client)) {
     					$this->flashMessenger()->addErrorMessage(sprintf('Could not find client with id %s',$id));
     			
     				}
     			}
     		}
     		
     			
     	$view= new ViewModel(array('form' => $form));
     	$view->setTemplate('application/client/index/createprofile');
     	return $view;
     
     
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
     				return $this->redirect()->toRoute('client/index3',
     						array('controller' => 'index', 'action'=> 'welcome','id'=>$client->getId()));
     				/*
     				return $this->redirect()->toRoute('client/index3',
     						array('controller' => 'index', 'action'=> 'createprofile' ,'id'=>$client->getId()));
     			*/}
     		}
         else{
         	
         }
     	$view= new ViewModel(array('form' => $form));
     	$view->setTemplate('application/client/index/detail');
     	return $view;
      	
     }
    
      /**********************************************************************/
      
 }
     

 
 

      
   
 