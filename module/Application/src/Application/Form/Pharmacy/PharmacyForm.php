<?php 
namespace Application\Form\Pharmacy;

use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\Common\Persistence\ObjectManager as ObjectManager;
use Application\Entity\Pharmacy;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\ValidatorInterface;
	
 class PharmacyForm extends Form  implements InputFilterProviderInterface
 { 
 	
   public function __construct(ObjectManager $objectManager){
         parent::__construct('pharmacy');
         $this->setAttribute('method', 'post');
         $this->setAttribute('class', 'form-vertical');
         
         $this->setHydrator(new DoctrineHydrator($objectManager,'Application\Entity\Pharmacy'))
              ->setObject(new Pharmacy());
        
         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         
         $this->add(array(
             'name' => 'name',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Name',
                ),
         	  'attributes' => array(
         			'class' => 'form-control',
         	  		
         		),
         ));
         $this->add(array(
         		'name' => 'username',
         		'type' => 'Text',
         		'options' => array(
         				'label' => 'Username',
         		),
         		'attributes' => array(
         				'class' => 'form-control',
         
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
         		'name' => 'type',
         		'type' => 'hidden',
         		 
         		'attributes' => array(
         				'value' => '3',
         		),
         
         ));
		  
		   $this->add(array(
             'name' => 'address',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Address',
             ),
		   	'attributes' => array(
		   		 'class' => 'form-control',
		   		  'id'=>'address',
		   		),
         ));
		   
		
		    
		  
		   
		
		   
		   $this->add(array(
		   		'name' => 'longitude',
		   		'type' => 'Text',
		   		'options' => array(
		   				'label' => 'Longitude',
		   		),
		   		'attributes' => array(
		   				'class' => 'form-control',
		   				'id' =>'Longitude'
		   		),
		   ));
		
		   
		   $this->add(array(
		   		'name' => 'latitude',
		   		'type' => 'Text',
		   		'options' => array(
		   				'label' => 'Latitude',
		   		),
		   		'attributes' => array(
		   				'class' => 'form-control',
		   				'id'=>'Latitude',
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
		   				'id' => 'email'
		   		),
		   		 
		   ));
		   
		   $this->add(array(
		   		'name' => 'website',
		   		'type' => 'Text',
		   		'options' => array(
		   				'label' => 'Website',
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
				'name' => array(
						'required' => true
				 ),
				'email' => array(
						'required' => true,
						'validators' => array(
								array('name' => 'EmailAddress')
							),
				 ),
				
				);
	}
 }