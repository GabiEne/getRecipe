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
 use Application\Entity\Pharmacy;
 use Zend\Mail;
 use AcMailer\Service;
 use AcMailer\Service\MailService;
 use AcMailer\Service\Factory\MailServiceFactory;
 use Zend\Db;
 use Zend\Db\Sql\Expression;
 use Zend\Db\Sql\Sql;
 use Zend\Db\Sql\Select;
 use Zend\Db\Sql\Where;	
 use Zend\Db\Adapter\Adapter;
 use Zend\Mvc\MvcEvent;


 class IndexController extends AbstractActionController
 {
 
 	
     public function indexAction(){
     	
     	 return new ViewModel();
	 
     }
     
     
     public function welcomeAction(){
     	$this->layout("layout/layoutuser");
     	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
     	$id = $this->params()->fromRoute('id');
     	$user = $objectManager->find('Application\Entity\User', $id);
     	$view= new ViewModel(array('id' => $id, 'user' => $user));
     	$view->setTemplate('application/client/index/index');
     	return $view;
     
     }
    
     public function sendMailAction(){
     
     	$formdoc = new DoctorEmailForm();
     	if ($this->request->isPost()) {
     		$formdoc->setData($this->request->getPost());
     		if($formdoc->isValid()) {
     			$id = $this->params()->fromRoute('id');
     			$transport = new \Zend\Mail\Transport\Sendmail();
     			$message   = new \Zend\Mail\Message();
     			$renderer  = new \Zend\View\Renderer\PhpRenderer();
     			$message->setTo(array("gabriela.ene02@gmail.com"));
     			$service = new \AcMailer\Service\MailService($message, $transport, $renderer);
     			$service->setBody("<p>This is the body</p>")
     			        ->setSubject("This is the subject");
     	
     			try {
     				$result = $service->send();
     				echo $result->isValid() ? "Success!!" : "Error";
     				return $this->redirect()->toRoute('client/index3',
     						array('controller' => 'index', 'action'=> 'viewprofile', 'id'=>$id));
     	
     			}
     			catch (\Exception $e) {
     				echo "Exception!! " . $e->getMessage();
     			}
     				
     		}
     	}
     	 
     	$view= new ViewModel(array('form' => $formdoc));
     	$view->setTemplate('application/client/index/doctoremail');
     	return $view;
     	}
     	 
     	
     
     public function createProfileAction(){
     	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
     	$form = new UserProfileForm($objectManager);
     	$profile = new UserProfile();
    
     	if ($this->request->isPost()) {
     		$form->setData($this->request->getPost());
     		if($form->isValid()) {
     			$id = $this->params()->fromRoute('id');
     			$firstname= $this->getRequest()->getPost('firstnamedoctor');
     			$lastname = $this->getRequest()->getPost('lastnamedoctor');
     		    $user = $objectManager->find('Application\Entity\User', $id);
     			$doctor = $objectManager->getRepository('Application\Entity\Doctors')->findOneBy(
     					array('firstname' => $firstname, 'lastname' =>$lastname));
     			$profile = $form->getObject();
     			$profile->setUser($user);
     			
     			
     			if($doctor!=NULL){
     				$profile->setDoctor($doctor);
     				$profile = $form->getObject();
     				$profile->setUser($user);
     				$objectManager->persist($profile);
     				$objectManager->flush();
     				return $this->redirect()->toRoute('client/index3',
     						array('controller' => 'index', 'action'=> 'viewprofile', 'id'=>$id));
     			}
     		    
     			else{
     				$objectManager->persist($profile);
     				$objectManager->flush();
     				return $this->redirect()->toRoute('client/index3',
     						array('controller' => 'index', 'action'=> 'sendmail','id'=>$id));
     		    }
     		}
     	}
     		
     		else{
     			if (isset($id)) {
     			    $client = $objectManager->find('Application\Entity\UserProfile', $id);
     				if (!isset($client)) {
     					$this->flashMessenger()->addErrorMessage(sprintf('Could not find client with id %s',$id));
     			
     				}
     			
     				$form->bind($profile);
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
    
     public function viewProfileAction(){
     	
     	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
     	$id = $this->params()->fromRoute('id');
     	$user = $objectManager->find('Application\Entity\UserProfile', $id);
     	$view= new ViewModel(array('id' => $id, 'user' => $user));
     	$view->setTemplate('application/client/index/viewprofile');
     	return $view;
          
     }
     
     public function findPharmacyAction(){
     	$id = $this->params()->fromRoute('id'); 
     	var_dump($id);
     	
     	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
     	$user = $objectManager->getRepository('Application\Entity\UserProfile')->findOneBy(
     			array('user' => $id));
     	$userLongitude = $user->getLongitude();
     	$userLatitude = $user->getLatitude();
     	
        $pharmacyTable = $objectManager->getRepository('\Application\Entity\Pharmacy');
     	
     	
        $pharmacy = new \Application\Entity\Pharmacy();
        $userLongitude1 = $userLongitude - 0.1;
        $userLongitude2 = $userLongitude +0.1;
        $userLatitude1  =  $userLatitude -0.1;
        $userLatitude2  =  $userLatitude + 0.1;
        
     	 $qb= $objectManager
     	->createQueryBuilder()
     	->select('et.id','et.address','et.longitude','et.latitude' )
     	->from('\Application\Entity\Pharmacy','et')
		->where('et.latitude != 0')
		->andwhere('et.latitude > =' . $userLatitude1)
     	->andwhere('et.latitude < =' . $userLatitude2)
     	->andwhere('et.longitude != 0')
     	->andwhere('et.longitude >= '. $userLongitude1)
     	->andwhere('et.longitude <=' . $userLatitude2 );

     	 
     	var_dump( $result = $qb->getQuery()->getResult());
     	
     
     	
     	
     	//$pharmacyTable  =  new \Application\Entity\Pharmacy();
     	//$select = $pharmacyTable->select()->from(array('et' => $tableName), array(
     		//	'id',
     		///	'address',
     		///	'location_latitude',
     		////	'location_longtitude',
     		///	'distance' => $distanceExpression
     //	));
     	
     ///	$select->where("et.location_latitude != 0");
     	///$select->where("et.location_longtitude != 0");
     	//$select->having("distance <= ?", $milesradius);
     	
     	// paginator if there are lot of stores.
     	//$page = $this->getRequest()->getParam('page',1);
     //	$paginator = Zend_Paginator::factory($select);
     //	$paginator->setItemCountPerPage(10);
     //	$paginator->setCurrentPageNumber($page);
     	
     //	if ($paginator && count($paginator) > 0) {
     //		$this->view->paginator = $paginator;
     //	}
        $view= new ViewModel(array('id'=>$id));
     	$view->setTemplate('application/client/index/viewprofile');
     	return $view;
     
     }
      /**********************************************************************/
      
 }
     

 
 

      
   
 