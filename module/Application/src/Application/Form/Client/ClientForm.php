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