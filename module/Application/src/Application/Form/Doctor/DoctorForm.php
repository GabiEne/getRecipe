<?php 
namespace Application\Form\Doctor;

use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\Common\Persistence\ObjectManager as ObjectManager;
use Application\Entity\Doctors;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\ValidatorInterface;
	
 class DoctorForm extends Form  implements InputFilterProviderInterface
 { 
   public function __construct(ObjectManager $objectManager){
         parent::__construct('doctor');
         $this->setAttribute('method', 'post');
         $this->setAttribute('class', 'form-vertical');
         $this->setHydrator(new DoctrineHydrator($objectManager,'Application\Entity\Doctors'))
              ->setObject(new Doctors());
        
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
             'name' => 'country',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Country',
             ),
		   	'attributes' => array(
		   		 'class' => 'form-control',
		   		),
         ));
		   
		
		    
		   $this->add(array(
             'name' => 'city',
             'type' => 'Text',
             'options' => array(
                 'label' => 'City',
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
		   		'name' => 'type',
		   		'type' => 'hidden',
		   		
		   		'attributes' => array(
		   				'value' => '2',
		   		),
		   		 
		   ));
		   
		   $this->add(array(
		   		'name' => 'adresa_cabinet',
		   		'type' => 'Text',
		   		'options' => array(
		   				'label' => 'Cabinet Address',
		   		),
		   		'attributes' => array(
		   				'class' => 'form-control',
		   		),
		   ));
		   
		   $this->add(array(
		   		'name' => 'specializare',
		   		'type' => 'Text',
		   		'options' => array(
		   				'label' => 'Specialization',
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
				
				'lastname' => array (
					    'required' => true
				         )
				);
	}
 }