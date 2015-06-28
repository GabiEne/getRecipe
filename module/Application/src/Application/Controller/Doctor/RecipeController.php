<?php

namespace Application\Controller\Doctor;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\Doctor\CreatePrescriptionForm;

class RecipeController extends AbstractActionController
{
	
  public function listAction()
    {
    	$view = new ViewModel(array(
    			'message' => 'Hello world',
    	));
    	$view->setTemplate('application/doctor/index/index');
    	return $view;
    	
    	//return new ViewModel();
    }
    public function createPrescriptionAction(){
    	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	
    	
    	if($user = $this->identity()){
    		if ($user->getType() == 2) {
    			$id_doctor = $user->getId();
    			
    			$form = new CreatePrescriptionForm($objectManager, $id_doctor);
    			if ($this->request->isPost()) {
    				$form->setData($this->request->getPost());
    				if($form->isValid()) {
    					$prescription = $form->getObject();
    					$userId =$form->get('prescription')->getValue();
    					$relatedUser = $objectManager->find('Application\Entity\UserProfile', $userId);
    				    $idClient = $relatedUser->getUser();
    					//var_dump($idClient);
    					$userWithPrescr = $objectManager->find('Application\Entity\User', $idClient);
    					$prescription->setUser($userWithPrescr);
    					$prescription->setDoctor($user);
    					//$prescription->setDrugs($drugs);
    					$objectManager->persist($prescription);
    					$objectManager->flush();
    					//return $this->redirect()->toRoute('admin/index4',
    							//array('controller' => 'index', 'action'=> 'viewusers'));
    				}
    			}
    			else{
    				//$id = $this->params()->fromRoute('id');
    			
    				//if (isset($id)) {
    			//
    				//	$client = $objectManager->find('Application\Entity\User', $id);
    				//	if (!isset($client)) {
    				//		$this->flashMessenger()->addErrorMessage(sprintf('Could not find client with id %s',$id));
    					//	return $this->redirect()->toRoute('admin/index4',
    					///			array ('controller' => 'index',
    					//					'action'=> 'viewusers')
    					//	);
    					//}
    					//$form->bind($client);
    				
    			}
    		}
    		else{
    			return $this->redirect()->toRoute('doctor/index1',
    					array('controller' => 'auth', 'action'=> 'login'));
    		}
    	}
    
    	/*
    		$qb= $objectManager
    		->createQueryBuilder()
    		->select('u.id','u.firstname','u.lastname' )
    		->from('\Application\Entity\User','u')
    		->leftJoin('\Application\Entity\UserProfile', 'up', \Doctrine\ORM\Query\Expr\Join::WITH, 'up.id = u.id')
    		->where('up.doctor = '.$id_doctor);
    		
    		$result = $qb->getQuery()->getResult();
    		
    	*/
    	else{
    		return $this->redirect()->toRoute('doctor/index1',
    				array('controller' => 'auth', 'action'=> 'login'));
    	}
    	
    	$view= new ViewModel(array('form' => $form));//, 'clients' => $result));
    	$view->setTemplate('application/doctor/prescription/prescription');
    	return $view;
    }
}