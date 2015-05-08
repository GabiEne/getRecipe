<?php
namespace User\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use User\Model\User;         
 use User\Form\UserForm; 

 class UserController extends AbstractActionController
 {
     public function indexAction()
     {
         return new ViewModel(array(
             'users' => $this->getUserTable()->fetchAll(),
         ));
     }

     public function addAction()
     {
		$form = new UserForm();
        $form->get('submit')->setValue('Add');
		$request = $this->getRequest();

         if ($request->isPost()) {
             $user = new User();
             $form->setInputFilter($user->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
			    //if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			    // var_dump($form->getData());
                 $user->exchangeArray($form->getData());
				// var_dump($user);

                 $this->getUserTable()->saveUser($user);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('user');
             }
         }
         return array('form' => $form);
     }

     public function editAction()
     {
     }

     public function deleteAction()
     {
     }
	  public function getUserTable()
     {
         //if (!$this->userTable) {
		 //var_dump($this);
             $sm = $this->getServiceLocator();
             $this->userTable = $sm->get('User\Model\UserTable');
        return $this->userTable;
         
     }
	
 }
 ?>