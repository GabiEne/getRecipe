<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
 * @ORM\Table(name="pharmacy")
 *
 *
 */
class Pharmacy{
	/**

	* @ORM\Id
	* @ORM\GeneratedValue(strategy = "AUTO")
	* @ORM\Column(type="integer")
	*/

	protected $id_farmacie;

	public function getId_Farmacie(){
		return $this->id_farmacie;

	}

	public function setId_Farmacie($id_farmacie){
		$this->id_farmacie =$id_farmacie;
	}

	/**
	 * @ORM\Column(type= "string")
	 *
	 */

	protected $name;

	public function getName(){
		return $this->name;

	}

	public function setName($name){
		$this->name =$name;
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
	protected $street;

	public function getStreet(){
		return $this->street;

	}
	public function setStreet($street){
		$this->street =$street;
	}
	
	
	/**
	 * @ORM\Column(type= "integer")
	 *
	 */
	protected $streetnumber;

	public function getStreetNumbere(){
		return $this->streetnumber;

	}
	public function setStreetNumber($streetnumber){
		$this->streetnumber =$streetnumber;
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
	
	protected $website;
	
	public function getWebsite(){
		return $this->website;
	
	}
	public function setWebsite($website){
		$this->website =$website;
	
	}
	

	public function __get($property){
			
		return $this->$property;
	}

	public function __set($property, $value){
		 
		return $this->$property = $value;
	}


}