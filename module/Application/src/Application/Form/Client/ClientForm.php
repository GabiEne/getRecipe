<?php 
namespace Application\Form\Client;

use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\Common\Persistence\ObjectManager as ObjectManager;
use Application\Entity\User;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\ValidatorInterface;
	
 class ClientForm extends Form  implements InputFilterProviderInterface
 { 
   public function __construct(ObjectManager $objectManager){
         parent::__construct('client');
         $this->setAttribute('method', 'post');
         $this->setAttribute('class', 'form-vertical');
         $this->setHydrator(new DoctrineHydrator($objectManager,'Application\Entity\User'))
              ->setObject(new User());
        
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
         	  'attributes' => array(
         			'class' => 'form-control',
         	  		'placeholder' => 'Choose a username',
         		),
         ));
         
         $this->add(array(
             'name' => 'password',
             'type' => 'Password',
             'options' => array(
                 'label' => 'Password',
             ),
         	 'attributes' => array(
         				'class' => 'form-control',
         	 		    'placeholder' => 'Enter your password',
         		),
         ));
         
		 $this->add(array(
             'name' => 'firstname',
             'type' => 'Text',
             'options' => array(
                 'label' => 'First Name',
             ),
		 	 'attributes' => array(
		 				'class' => 'form-control',
		 	 		    'placeholder' => 'Your Firstname',
		 		),
         ));
		 
		  $this->add(array(
             'name' => 'lastname',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Last Name',
             ),
		  	 'attributes' => array(
		  				'class' => 'form-control',
		  		),
         ));
		  
		
		   
		    $this->add(array(
             'name' => 'email',
             'type' => 'Text',
             'options' => array(
                 'label' => 'E-mail',
             ),
		      'attributes' => array(
		    	 'class' => 'form-control',
		    		),
		    
         ));
		    
		 
		   
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Sign up',
                 'id' => 'submitbutton',
             	  'class' => 'sign btn btn-primary',
             ),
         ));
        
	}
	
	public function getInputFilterSpecification()
	{
		
		return array(
				'username' => array(
						'required' => true
				 ),
				'email' => array(
						'required' => true,
						'validators' => array(
								array('name' => 'EmailAddress')
							),
				 ),
				'username' => array(
						'required' => true
				 ),
				'lastname' => array (
					    'required' => true
				         )
				);
	}
 }