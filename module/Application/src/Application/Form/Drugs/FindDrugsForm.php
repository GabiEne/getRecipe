<?php
namespace Application\Form\Drugs;

use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\Common\Persistence\ObjectManager as ObjectManager;
use Application\Entity\Drugs;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\ValidatorInterface;
	
 class FindDrugsForm extends Form  implements InputFilterProviderInterface
 { 
 	
   public function __construct(){
         parent::__construct();
         $this->setAttribute('method', 'post');
         $this->setAttribute('class', 'form-vertical');
         
		$this->add(array(
		'name' => 'drugname',
		'type' => 'Text',
		'options' => array(
				'label' => 'Give the medicine name',
		),
		'attributes' => array(
				'class' => 'form-control',
		),
));
   }
   public function getInputFilterSpecification()
   {
   
   	return array(
   
   			'drugname' => array(
   					'required' => true,
   
   			),
   
   				
   	);
 }
 }
?>