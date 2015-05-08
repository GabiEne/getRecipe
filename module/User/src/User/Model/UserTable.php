<?php
namespace User\Model;

 use Zend\Db\TableGateway\TableGateway;

 class UserTable
 {
     protected $tableGateway;
	 protected $userTable;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
		 //var_dump($this->tableGateway);
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getUser($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }
  // Inserting User input data via Form Submission
  
     public function saveUser(User $user)
     {
         $data = array(
		 
		     'username' => $user->username,
             'password'  => $user->password,
             'firstname' => $user->firstname,
             'lastname'  => $user->lastname,
			 'country' => $user->country,
             'email'  => $user->email,
			 'city'  => $user->city,
 
         );

      
             $this->tableGateway->insert($data);
	
     }

     public function deleteUser($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }