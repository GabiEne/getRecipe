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
             'name' => 'id_farmacie',
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
             'name' => 'country',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Country',
             ),
		   	'attributes' => array(
		   		 'class' => 'form-control',
		   		  'id'=>'address',
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
		   		'id' =>'city',
		   			
		   	 ),
         ));
		   
		
		   
		   $this->add(array(
		   		'name' => 'street',
		   		'type' => 'Text',
		   		'options' => array(
		   				'label' => 'Street',
		   		),
		   		'attributes' => array(
		   				'class' => 'form-control',
		   				'id' =>'street'
		   		),
		   ));
		
		   
		   $this->add(array(
		   		'name' => 'streetnumber',
		   		'type' => 'Text',
		   		'options' => array(
		   				'label' => 'Street Number',
		   		),
		   		'attributes' => array(
		   				'class' => 'form-control',
		   				'id'=>'streetnumber',
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