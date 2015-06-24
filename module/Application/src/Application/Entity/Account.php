<?php 
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;




/**
 *  @ORM\Entity
 * 
 *  @ORM\Table(name="accounts")
 *  @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="smallint")
 * @ORM\DiscriminatorMap({3 = "Application\Entity\Pharmacy", 2 = "Application\Entity\Doctors",  1 = "Application\Entity\User"})
 *
 */
abstract class Account{
	
	
	
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
	protected $type;
	
	public function getType(){
		return $this->type;
	
	}
	public function setType($type){
		$this->type =$type;
	}
	
	/**
	 * @ORM\Column(type= "smallint")
	 *
	 */
	protected $isActive =0;
	
	public function getisActive(){
		return $this->isActive;
	
	}
	public function setisActive($isActive){
		$this->isActive =$isActive;
	}

}
	?>