<?php
namespace Application\Form\Doctor;

use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\Common\Persistence\ObjectManager as ObjectManager;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\ValidatorInterface;
use Application\Entity\Prescription;

class CreatePrescriptionForm extends Form  
{
	

	public function __construct(ObjectManager $objectManager,$id_doctor){
		parent::__construct('prescription');
		$this->setAttribute('method', 'post');
		$this->setAttribute('class', 'form-vertical');
		$this->setHydrator(new DoctrineHydrator($objectManager,'\Application\Entity\Prescription'))
		     ->setObject(new Prescription());
	
		
		
		$this->add(array(
				'name' => 'id',
				'type' => 'Hidden',
		));
		
		$this->add(array(
				'name' => 'prescription',
				'type' => 'DoctrineModule\Form\Element\ObjectSelect',
				'options' => array(
						'label' => 'Pacient',
						'target_class' => 'Application\Entity\UserProfile',
						'object_manager' => $objectManager,
						'required' => true,
						'property' => 'firstname',
						
						'is_method' => true,
						'find_method'        => array(
								'name'   => 'findBy',
								'params' => array(
										'criteria' => array(
												'doctor' => $id_doctor,
										),
								),
						),
				),
				'attributes' => array(
						'class' => 'form-control',
						
						'id' => 'doctors-pacient'
				),
		));
		
		$this->add(array(
				'name' => 'drugs',
				'type' => 'DoctrineModule\Form\Element\ObjectSelect',
				'options' => array(
						'label' => 'Add drugs',
						'target_class' => 'Application\Entity\Drugs',
						'object_manager' => $objectManager,
						'required' => false,
						'allow_empty' => true,
						'continue_if_empty' => true,
						'property' => 'name',
						'is_method' => true,
				),
				'attributes' => array(
						'class' => 'form-control chosen-select',
						'multiple' => 'multiple',
						'id' => 'drugs-prescription'
				),
		
		));
		
		$this->add(array(
				'name' => 'diagnostic',
				'type' => 'Text',
				'options' => array(
						'label' => 'Diagnostic',
				),
				'attributes' => array(
						'class' => 'form-control diagnostic',
				),
		));

		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'Send prescription',
						'id' => 'submitbutton',
						'class' => 'usersignup btn btn-primary',
				),
		));
		}
		
	
	

	
	public function init(){
		//parent::init();
	}
}