<?php
namespace Application\Controller\Client;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Zend\Form\Annotation\AnnotationBuilder;
 use Application\Model\Client\Client;
 use Application\Form\Client\ClientForm;
 use Application\Form\Client\UserProfileForm;
 use Application\Form\Doctor\DoctorEmailForm;
 use Application\Form\Drugs\FindDrugsForm;
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
     	if($user = $this->identity()){
     	
     	if ($user->getType() == 1) {
     	$id=$user->getId();
     	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
     	//$id = $this->params()->fromRoute('id');
     	$user = $objectManager->find('Application\Entity\User', $id);
     	$view= new ViewModel(array('id' => $id, 'user' => $user));
     	$view->setTemplate('application/client/index/index');
     	return $view;
     	}
     	
     	else{
     		return $this->redirect()->toRoute('client/index3',
     				array('controller' => 'auth', 'action'=> 'login'));
     	}
     }
     	else
     	return $this->redirect()->toRoute('home');
     	
     }
    
     public function sendMailAction(){
     
     	$formdoc = new DoctorEmailForm();
     	if ($this->request->isPost()) {
     		$formdoc->setData($this->request->getPost());
     		if($formdoc->isValid()) {
     			
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
     						array('controller' => 'index', 'action'=> 'viewprofile'));
     	
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
     	if($user = $this->identity()){
     	if ($user->getType() == 1) {
     		$id=$user->getId();
     	if ($this->request->isPost()) {
     		$form->setData($this->request->getPost());
     		if($form->isValid()) {
     	
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
     						array('controller' => 'index', 'action'=> 'viewprofile'));
     			}
     		    
     			else{
     				$objectManager->persist($profile);
     				$objectManager->flush();
     				return $this->redirect()->toRoute('client/index3',
     						array('controller' => 'index', 'action'=> 'sendmail'));
     		    }
     		}
     	}
     		
     		else{
     			$id=$user->getId();
     			$client  = $objectManager->getRepository('Application\Entity\UserProfile')->findOneBy(
     					array('user' => $id));
				
				if (isset($client)) {
					 
					
					if (!isset($client)) {
						$this->flashMessenger()->addErrorMessage(sprintf('Could not find client with id %s',$id));
						//return $this->redirect()->toRoute('admin/index4',
								                 // array ('controller' => 'index',
								                 // 	    'action'=> 'viewusers')
								                 /// );
					}
					$form->bind($client);
     			}
     		}	   
     		
     	$view= new ViewModel(array('form' => $form));
     	$view->setTemplate('application/client/index/createprofile');
     	return $view;
     	}
       }
       return $this->redirect()->toRoute('home');
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
     					$time = 1209600; // 14 days 1209600/3600 = 336 hours => 336/24 = 14 days
     					//-					if ($data['rememberme']) $authService->getStorage()->session->getManager()->rememberMe($time); // no way to get the session
     					
     					//- return $this->redirect()->toRoute('home');
     					return $this->redirect()->toRoute('client/index3',
     							array('controller' => 'index', 'action'=> 'welcome'));
     				}
     				else{return $this->redirect()->toRoute('client/index3',
     				array('controller' => 'auth', 'action'=> 'login'));}
     				
     				/*return $this->redirect()->toRoute('client/index3',
     				array('controller' => 'auth', 'action'=> 'login'));
     				/*
     				return $this->redirect()->toRoute('client/index3',
     						array('controller' => 'index', 'action'=> 'createprofile' ,'id'=>$client->getId()));
     			*/}
     		}
     		
         else{
         	
         }
         
        $form->get('type')->setValue('1');
     	$view= new ViewModel(array('form' => $form));
     	$view->setTemplate('application/client/index/detail');
     	return $view;
      	
     }
    
     public function viewProfileAction(){
     	
     	if($user = $this->identity()){
     	if ($user->getType() == 1) {
     		$id=$user->getId();
     	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
     	//$id = $this->params()->fromRoute('id');
     	$user = $objectManager->find('Application\Entity\UserProfile', $id);
     	$view= new ViewModel(array('id' => $id, 'user' => $user));
     	$view->setTemplate('application/client/index/viewprofile');
     	return $view;
     	}
     	else
     		{
     			return $this->redirect()->toRoute('client/index3',
     					array('controller' => 'auth', 'action'=> 'login'));
     		}
     }
     else
     	return $this->redirect()->toRoute('client/index3',
     			array('controller' => 'auth', 'action'=> 'login'));
     }
     
     public function findPharmacyAction(){
     	$id = $this->params()->fromRoute('id'); 
     	if($user = $this->identity()){
     		if ($user->getType() == 1) {
     		
     
     		$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
     		$userfound = $objectManager->getRepository('Application\Entity\UserProfile')->findOneBy(
     					array('user' => $id));
     			if(isset ($userfound)){
     				$userLongitude = $userfound->getLongitude();
     				$userLatitude = $userfound->getLatitude();
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
     				 $pharmacies = $qb->getQuery()->getResult();
     	           
     	            $i=0;
     	            foreach($pharmacies as $pharmacy){
     	            	$accountfound = $objectManager->getRepository('Application\Entity\Account')->findOneBy(
     	            			array('id' => $pharmacy['id']));
     	            	$i++; 
     	            	$pharmaciesnearby[$i] = $accountfound;
     	            	
     	            }
     
     		}	
     		else{
     			return $this->redirect()->toRoute('client/index3',
     				array('controller' => 'index', 'action'=> 'welcome'));
     			}
     	}
     	else{
     		return $this->redirect()->toRoute('client/index3',
     				array('controller' => 'auth', 'action'=> 'login'));
     }
       		$view= new ViewModel(array('pharmacies' => $pharmaciesnearby));
			$view->setTemplate('application/client/index/viewpharmacies');
			return $view;
   }
     else {
     	return $this->redirect()->toRoute('client/index3',
     		array('controller' => 'index', 'action'=> 'welcome'));
     	}
     }
     
     
      /**********************************************************************/
      public function findMedsAction(){
      	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
      	/*
      	$medicine = new FindDrugsForm();
      	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
      	if ($this->request->isPost()) {
     		$medicine->setData($this->request->getPost());
     		if($medicine->isValid()) {
     			$drugname= $this->getRequest()->getPost('drugname');
     		
     			$medicinefound = $objectManager->getRepository('Application\Entity\Drugs')->findOneBy(
     					
     					array('drugname' => $drugname));
     			var_dump($medicinefound);
      }
 }
		 $view= new ViewModel(array('form' => $medicine));
		 $view->setTemplate('application/client/index/viewmeds');
		 return $view;
      }*/
      	
      	
      	$drugs = $objectManager->getRepository('\Application\Entity\Drugs')->findAll();
      	$view= new ViewModel(array('drugs' => $drugs));
      	$view->setTemplate('application/client/index/viewmeds');
      	return $view;
 }
 public function findDoctorAction(){
 	
 		if($user = $this->identity()){
 			if ($user->getType() == 1) {
 				$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
 				$doctors = $objectManager->getRepository('\Application\Entity\Doctors')->findAll();
 				$view= new ViewModel(array('doctors' => $doctors));
 				$view->setTemplate('application/client/index/viewdoctors');
 				return $view;
 	
 			}
 	
 			else{
 				return $this->redirect()->toRoute('client/index3',
 						array('controller' => 'auth', 'action'=> 'login'));
 			}
 	
 		}
 		else{
 			return $this->redirect()->toRoute('client/index3',
 					array('controller' => 'auth', 'action'=> 'login'));
 		}
 	}
 
 
     public function seePrescriptionAction(){
     	$user = $this->identity();
     	if($user = $this->identity()){
     	if ($user->getType() == 1) {
     		$id=$user->getId();
     		$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
     		$prescriptionfound = $objectManager->getRepository('Application\Entity\Prescription')->findBy(
     				array('user' => $id));
     		//foreach($prescriptionfound as $p){
     		//	 var_dump($p->getUser());
     	///
     		/////$drugs = $p->getDrugs();
     		//foreach($drugs as $drug){
     		// var_dump($drug->getName());
     		//}
     	//}
     }
     else{
     	return $this->redirect()->toRoute('client/index3',
     			array('controller' => 'index', 'action'=> 'welcome'));
     }
     	}
     else{
     	return $this->redirect()->toRoute('client/index3',
     			array('controller' => 'auth', 'action'=> 'login'));
   }
 
   $view= new ViewModel(array('prescriptions'=>$prescriptionfound));
   $view->setTemplate('application/client/index/viewprescription');
   return $view;
 
 }

 } 
   
 