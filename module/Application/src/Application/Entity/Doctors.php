<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Account;

/** @ORM\Entity
 * @ORM\Table(name="doctors")
 * 
 *  
 */
class Doctors extends Account {

	
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
	/**
	 * @ORM\Column(type= "text")
	 *
	 */
	protected $description;
	
	public function getDescription(){
		return $this->description;
	
	}
	public function setDescription($description){
		$this->description =$description;
	}

 	public function __get($property){
 		
   		 return $this->$property;
   	}
   	
   	public function __set($property, $value){
   		
   		return $this->$property = $value;
   	}
   	
   	
}