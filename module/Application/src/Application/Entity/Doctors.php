<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
 * @ORM\Table(name="doctors")
 * 
 *  
 */
class Doctors{
	/**
	
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy = "AUTO")
	 * @ORM\Column(type="integer")
	 */
	
	protected $id_doctor; 
	
	public function getId_Doctor(){
		return $this->id_doctor; 
		
	}
	
	public function setId_Doctor($id_doctor){
		$this->id_doctor =$id_doctor;
	 }
	 
	/**
	 * @ORM\Column(type= "string")
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
	 * @ORM\Column(type= "string")
	 *
	 */
	
	protected $country;
	
	public function getCountry(){
		return $this->country;
	
	}
	public function setCountry($country){
		$this->country =$country;
	}
	
	/**
	 * @ORM\Column(type= "string")
	 *
	 */
	protected $city;
	
	public function getCity(){
		return $this->city;
	
	}
	public function setCity($city){
		$this->city =$city;
	}
	
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
	 * @ORM\Column(type= "string")
	 *
	 */
	protected $adresa_cabinet;
	
	public function getAdresa_cabinet(){
		return $this->adresa_cabinet;
	
	}
	public function setAdresa_cabinet($adresa_cabinet){
		$this->adresa_cabinet =$adresa_cabinet;
	}
	
	/**
	 * @ORM\Column(type= "string")
	 *
	 */
	protected $specializare;
	
	public function getSpecializare(){
		return $this->specializare;
	
	}
	public function setSpecializare($specializare){
		$this->specializare =$specializare;
	}

 	public function __get($property){
 		
   		 return $this->$property;
   	}
   	
   	public function __set($property, $value){
   		
   		return $this->$property = $value;
   	}
   	
   	
}