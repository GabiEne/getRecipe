<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Account;
use Application\Entity\UserProfile;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\OneToOne;


/** @ORM\Entity
 * @ORM\Table(name="clients")
 * 
 *  
 */
class User extends Account{
	
	

	
	
	 
	
	 /**
	  * @ORM\OneToOne(targetEntity="Application\Entity\UserProfile", mappedBy="id_profil", cascade={"persist"})
	  */
	


	
	/**
	 * @ORM\Column(type= "string")
	 *
	 */
	protected $firstname;
	
	public function getFirstname(){
		return $this->firstname;
	
	}
	public function setFirstname($firstname){
		$this->firstname =$firstname;
	}
	
	/**
	 * @ORM\Column(type= "string")
	 *
	 */
	protected $lastname;
	
	public function getLastname(){
		return $this->lastname;
	
	}
	public function setLastname($lastname){
		$this->lastname =$lastname;
	}
	

 	public function __get($property){
 		
   		 return $this->$property;
   	}
   	
   	public function __set($property, $value){
   		
   		return $this->$property = $value;
   	}
   	
   	
}
?>