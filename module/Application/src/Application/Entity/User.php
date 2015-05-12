<?php
namespace  Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class User{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy = "AUTO")
	 * @ORM\Column(type="integer")
	 */
	protected $id; 
	/**
	 * @ORM\Column(type= "string")
	 * 
	 */
	protected $username;
	/**
	 * @ORM\Column(type= "string",length=30)
	 *
	 */
	private   $password;
	/**
	 * @ORM\Column(type= "string")
	 *
	 */
	protected $firstname;
	/**
	 * @ORM\Column(type= "string")
	 *
	 */
	protected $lastname;
	/**
	 * @ORM\Column(type= "string")
	 *
	 */
	protected $country;
	/**
	 * @ORM\Column(type= "string")
	 *
	 */
	protected $city;
	/**
	 * @ORM\Column(type= "string")
	 *
	 */
	protected $email;
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