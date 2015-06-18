<?php 
namespace Application\Form\Doctor;

use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\Common\Persistence\ObjectManager as ObjectManager;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\ValidatorInterface;
	
 class DoctorEmailForm extends Form  implements InputFilterProviderInterface
 { 
   public function __construct(){
         parent::__construct();
         $this->setAttribute('method', 'post');
         $this->setAttribute('class', 'form-vertical');
        
        
         $this->add(array(
             'name' => 'doctoremail',
             'type' => 'email',
         		'attributes' => array(
         				'placeholder' => 'Email Of Your Doctor',
         				'id' => 'submitbutton',
         				'class' => 'form-control inputdoc',
         				
         	),
         ));
         
         
         $this->add(array(
             'name' => 'submitemail',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Send invitation!',
                 'class' => 'btn btn-default invitation',
             		
             ),
         ));
        
	}
	
	public function getInputFilterSpecification()
	{
		
		return array(
				
				'submitemail' => array(
						'required' => true,
						
				 ),
				
			
				);
	}
 }