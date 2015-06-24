<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Account;
use Application\Entity\Drugs;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\ManyToMany;

/** @ORM\Entity
 * @ORM\Table(name="pharmacy")
 *
 *
 */
class Pharmacy extends Account{
	
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
	 * @ORM\Column(type= "string")
	 *
	 */

	protected $address;

	public function getAddress(){
		return $this->address;

	}
	public function setAddress($address){
		$this->address =$address;
	}

	/**
	 * @ORM\Column(type= "float")
	 *
	 */
	protected $longitude;

	public function getLongitude(){
		return $this->longitude;

	}
	public function setLongitude($longitude){
		$this->longitude =$longitude;
	}


	/**
	 * @ORM\Column(type= "float")
	 *
	 */
	protected $latitude;

	public function geLatitude(){
		return $this->latitude;

	}
	public function setLatitude($latitude){
		
		$this->latitude =$latitude;
		
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

	
	
	/**
	 *@var@ORM\Doctrine\Common\Collections\ArrayCollection
	 *@ORM\ManyToMany(targetEntity="Drugs", inversedBy="pharmacy")
	 *@ORM\JoinTable(name="pharmacy_drugs")
	 **/
	private $drugs;
	
	public function __construct() {
		$this->drugs = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
	/**
	 * Get drugs
	 *
	 * @return PdDrugs
	 */
	public function getDrugs()
	{
		return $this->drugs;
	}
	
	

	public function __get($property){
			
		return $this->$property;
	}

	public function __set($property, $value){
		 
		return $this->$property = $value;
	}


}