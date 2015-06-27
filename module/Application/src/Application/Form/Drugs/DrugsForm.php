<?php 
namespace Application\Form\Drugs;

use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\Common\Persistence\ObjectManager as ObjectManager;
use Application\Entity\Drugs;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\ValidatorInterface;
	
 class DrugsForm extends Form  implements InputFilterProviderInterface
 { 
 	
   public function __construct(ObjectManager $objectManager){
         parent::__construct('drugs');
         $this->setAttribute('method', 'post');
         $this->setAttribute('class', 'form-vertical');
         $this->setHydrator(new DoctrineHydrator($objectManager,'Application\Entity\Drugs'))
              ->setObject(new Drugs());
        
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
             'name' => 'activeingredient',
             'type' => 'text',
             'options' => array(
                 'label' => 'Active Ingredient',
             ),
         	 'attributes' => array(
         				'class' => 'form-control',
         	 		    
         		),
         ));
    
		  
		   $this->add(array(
             'name' => 'producer',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Producer',
             ),
		   	'attributes' => array(
		   		 'class' => 'form-control',
		   		
		   		),
         ));
		   
		   $this->add(array(
		   		'name' => 'leaflet',
		   		'type' => 'TextArea',
		   		'options' => array(
		   				'label' => 'leaflet',
		   		),
		   		'attributes' => array(
		   				'class' => 'form-control',
		   				 
		   		),
		   ));
		    
		    
		  
		   
		
		   
		   $this->add(array(
		   		'name' => 'therapeutic_action',
		   		'type' => 'Text',
		   		'options' => array(
		   				'label' => 'Therapeutic Action',
		   		),
		   		'attributes' => array(
		   				'class' => 'form-control',
		   				
		   		),
		   ));
		
		   
		   $this->add(array(
		   		'name' => 'cod_atc',
		   		'type' => 'Text',
		   		'options' => array(
		   				'label' => 'Cod Atc',
		   		),
		   		'attributes' => array(
		   				'class' => 'form-control',
		   				
		   		),
		   ));
		   $this->add(array(
		   		'name' => 'price',
		   		'type' => 'number',
		   		'step' =>'any',
		   		'options' => array(
		   				'label' => 'Price',
		   				
		   		),
		   		'attributes' => array(
		   				'class' => 'form-control',
		   		   
		   		),
		   ));
		
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Add Medicine',
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
				
				);
	}
 }