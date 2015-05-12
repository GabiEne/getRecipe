<?php 
namespace Application\Form\Client;

 use Zend\Form\Form;

 class ClientForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('client');
         $this->setAttribute('method', 'post');
		
         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'username',
             'type' => 'Text',
             'options' => array(
                 'label' => 'User Name',
             ),
         ));
         $this->add(array(
             'name' => 'password',
             'type' => 'Password',
             'options' => array(
                 'label' => 'Password',
             ),
         ));
		 $this->add(array(
             'name' => 'firstname',
             'type' => 'Text',
             'options' => array(
                 'label' => 'First Name',
             ),
         ));
		  $this->add(array(
             'name' => 'lastname',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Last Name',
             ),
         ));
		   $this->add(array(
             'name' => 'country',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Country',
             ),
         ));
		    $this->add(array(
             'name' => 'email',
             'type' => 'Text',
             'options' => array(
                 'label' => 'E-mail',
             ),
         ));
		   $this->add(array(
             'name' => 'city',
             'type' => 'Text',
             'options' => array(
                 'label' => 'City',
             ),
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
		  
     }
 }