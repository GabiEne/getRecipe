<?php 
namespace Application\Form\Client;

use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\Common\Persistence\ObjectManager as ObjectManager;
use Application\Entity\UserProfile;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\ValidatorInterface;
	
 class UserProfileForm extends Form 
 { 
   public function __construct(ObjectManager $objectManager){
         parent::__construct('userprofile');
         $this->setAttribute('method', 'post');
         $this->setAttribute('class', 'form-vertical');
         $this->setHydrator(new DoctrineHydrator($objectManager,'Application\Entity\UserProfile'))
              ->setObject(new UserProfile());
        
         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         
         $this->add(array(
             'name' => 'address',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Adress',
                ),
         	  'attributes' => array(
         			'class' => 'form-control',
         	  		'id' =>'address',
         	  		'placeholder' => 'Type you address',
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
         				'id'=> 'Longitude',
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
         				'id'=> 'Latitude',
         		),
         ));
         $this->add(array(
         		'name' => 'dateofbirth',
         		'type' => 'Text',
         		'options' => array(
         				'label' => 'Date of Birth',
         		),
         		'attributes' => array(
         				'class' => 'form-control',
         				
         		),
         ));
         $this->add(array(
         		'name' => 'firstnamedoctor',
         		'type' => 'Text',
         		'options' => array(
         				'label' => 'First Name Of Your Doctor',
         		),
         		'attributes' => array(
         				'class' => 'form-control',
         				 
         		),
         ));
         $this->add(array(
         		'name' => 'lastnamedoctor',
         		'type' => 'Text',
         		'options' => array(
         				'label' => 'Last Name Of Your Doctor',
         		),
         		'attributes' => array(
         				'class' => 'form-control',
         
         		),
         ));
      
         $this->add(array(
         		'name' => 'submit',
         		'type' => 'Submit',
         		'attributes' => array(
         				'value' => 'Set Adress',
         				'id' => 'submitbutton',
         				'class' => 'sign btn btn-primary',
         		),
         ));
   }
 }