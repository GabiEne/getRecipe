<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

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
	
	public function getId(){
		return $this->id; 
		
	}
	
	public function setId($id){
		$this->id =$id;
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

 	public function __get($property){
 		
   		 return $this->$property;
   	}
   	
   	public function __set($property, $value){
   		
   		return $this->$property = $value;
   	}
   	
   	
}
?>