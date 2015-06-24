<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\UserProfile;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\OneToOne;


/** @ORM\Entity
 * @ORM\Table(name="clients")
 * 
 *  
 */
class User{
	/**
	
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy = "AUTO")
	 * @ORM\Column(type="integer")
	 */
	
	protected $id; 
	

	
	
	 
	
	 /**
	  * @ORM\OneToOne(targetEntity="Application\Entity\UserProfile", mappedBy="id_profil", cascade={"persist"})
	  */
	


	 public function getId(){
	 	return $this->id;
	 
	 }
	 
	 
	 public function setId($id){
	 	$this->id =$id;
	 }
	
	 /**
	  * @ORM\Column(type= "string",length=30)
	  *
	  */
	protected $username;
	
	public function getUsername(){
		return $this->username;
	
	}
	
	public function setUsername($username){
		$this->username =$username;
	}
	
	/**
	 * @ORM\Column(type= "string",length=30)
	 *
	 */
	protected   $password;
	
	public function getPassword(){
		return $this->password;
	
	}
	public function setPassword($password){
		$this->password =$password;
	}
	
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
	
	/**
	
	/**
	 * @ORM\Column(type= "string")
	 *
	 */
	protected $email;
	
	public function getEmail(){
		return $this->email;
	
	}
	public function setEmail($email){
		$this->email =$email;
	}
	
	/**
	 * @ORM\Column(type= "smallint", length = 6, options={"default":0}))
	 *
	 */
	
	protected $isActive = 0 ;
	
	public function getisActive(){
		return $this->isActive;
	
	}
	public function setisActive($isActive){
		$this->isActive =$isActive;
	}
 	public function __get($property){
 		
   		 return $this->$property;
   	}
   	
   	public function __set($property, $value){
   		
   		return $this->$property = $value;
   	}
   	
   	
}
?>