<?php
namespace User\Model;
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

 class User implements InputFilterAwareInterface
 {
     public $id;
     public $username;
     public $password;
	 public $firstname; 
	 public $lastname; 
	 public $country;
	 public $email; 
	 public $city; 
	 protected $inputFilter; 

     public  function exchangeArray($data)
     {
         $this->id     = (isset($data['id'])) ? $data['id'] : null;
         $this->username = (isset($data['username'])) ? $data['username'] : null;
		 //var_dump($this->username);
         $this->password  = (isset($data['password'])) ? $data['password'] : null;
		 $this->firstname     = (isset($data['firstname'])) ? $data['firstname'] : null;
         $this->lastname = (isset($data['lastname'])) ? $data['lastname'] : null;
         $this->country  = (isset($data['country'])) ? $data['country'] : null;
		 $this->email = (isset($data['email'])) ? $data['email'] : null;
         $this->city  = (isset($data['city'])) ? $data['city'] : null;
     }


 
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }

     public function getInputFilter()
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             $inputFilter->add(array(
                 'name'     => 'id',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));

           
             $inputFilter->add(array(
                 'name'     => 'password',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));

			   $inputFilter->add(array(
                 'name'     => 'firstname',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
			 
			   $inputFilter->add(array(
                 'name'     => 'lastname',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
			    $inputFilter->add(array(
                 'name'     => 'country',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
			  $inputFilter->add(array(
                 'name'     => 'email',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
			   $inputFilter->add(array(
                 'name'     => 'city',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }
 
 
 ?>