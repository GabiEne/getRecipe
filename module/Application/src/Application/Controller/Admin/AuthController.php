<?php
namespace Application\Controller\Admin;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;
use Application\Form\Admin\AdminLoginForm;
use Application\Form\Admin\LoginFilter;


class AuthController extends AbstractActionController
{
	
public function loginAction()
    {
		$form = new AdminLoginForm();
		$form->get('submit')->setValue('Login');
		$messages = null;
		$request = $this->getRequest();
        if ($request->isPost()) {
         
			$form->setInputFilter(new LoginFilter($this->getServiceLocator()));
            $form->setData($request->getPost());
			
            if ($form->isValid()) {
				$data = $form->getData();			
				// $data = $this->getRequest()->getPost();
				
				// If you used another name for the authentication service, change it here
				// it simply returns the Doctrine Auth. This is all it does. lets first create the connection to the DB and the Entity
				$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');		
				// Do the same you did for the ordinar Zend AuthService	
				$adapter = $authService->getAdapter();
				$adapter->setIdentityValue($data['username']); //$data['usr_name']
				$adapter->setCredentialValue($data['password']); // $data['usr_password']
				$authResult = $authService->authenticate();
				// echo "<h1>I am here</h1>";
				if ($authResult->isValid()) {
					$identity = $authResult->getIdentity();
					$authService->getStorage()->write($identity);
					$time = 1209600; // 14 days 1209600/3600 = 336 hours => 336/24 = 14 days
//-					if ($data['rememberme']) $authService->getStorage()->session->getManager()->rememberMe($time); // no way to get the session
					if ($data['rememberme']) {
						$sessionManager = new \Zend\Session\SessionManager();
						$sessionManager->rememberMe($time);
					}
					 return $this->redirect()->toRoute('admin/index4',
							array('controller' => 'index', 'action'=> 'index'));
					 echo"bla";
				}
				foreach ($authResult->getMessages() as $message) {
					$messages .= "$message\n"; 
				}	
	
			}
		}
		
		
		
		$view= new ViewModel(array(
			'error' => 'Your authentication credentials are not valid',
			'form'	=> $form,
			'messages' => $messages,
		));
		$view->setTemplate('application/admin/index/login');
		return $view;
    }
    
    public function logoutAction()
    {
    	
    	$auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
    	// @todo Set up the auth adapter, $authAdapter
    	if ($auth->hasIdentity()) {
    		
    		// Identity exists; get it
    		$identity = $auth->getIdentity();
    		//-			echo '<pre>';
    		//-			print_r($identity);
    		//-			echo '</pre>';
    	}
    	
    	$auth->clearIdentity();
    	//-		$auth->getStorage()->session->getManager()->forgetMe(); // no way to get to the sessionManager from the storage
    	$sessionManager = new \Zend\Session\SessionManager();
    	$sessionManager->forgetMe();
    
    
    	// return $this->redirect()->toRoute('home');
    	return $this->redirect()->toRoute('admin/index4', array('controller' => 'auth', 'action' => 'login'));
    
    }
    
}	 