<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Pharmacy;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\ManyToMany;

/** @ORM\Entity
 * @ORM\Table(name="drugs")
 * 
 *  
 */
class Drugs{
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
	protected   $activeingredient;
	
	public function getActiveIngredient(){
		return $this->activeingredient;
	
	}
	public function setActiveIngredient($activeingredient){
		$this->activeingredient =$activeingredient;
	}
	
	/**
	 * @ORM\Column(type= "string")
	 *
	 */
	protected $producer;
	
	public function getProducer(){
		return $this->producer;
	
	}
	public function setProducer($producer){
		$this->producer =$producer;
	}
	
	/**
	 * @ORM\Column(type= "string")
	 *
	 */
	protected $therapeutic_action;
	
	public function getTherapeutic_action(){
		return $this->therapeutic_action;
	
	}
	public function setTherapeutic_action($therapeutic_action){
		$this->therapeutic_action =$therapeutic_action;
	}
	
	/**
	 * @ORM\Column(type= "string")
	 *
	 */
	
	protected $cod_atc;
	
	public function getCod_atc(){
		return $this->cod_atc;
	
	}
	public function setCod_atc($cod_atc){
		$this->cod_atc =$cod_atc;
	}

	/**
	 * @ORM\Column(type= "float")
	 *
	 */
	
	protected $price;
	
	public function getPrice(){
		return $this->price;
	
	}
	public function setPrice($price){
		$this->price =$price;
	}
	/**
	 * @ORM\Column(type= "text")
	 *
	 */
	
	protected $leaflet;
	
	public function getLeaflet(){
		return $this->leaflet;
	
	}
	public function setLeaflet($leaflet){
		$this->leaflet =$leaflet;
	}
	/**
	 * @ORM\ManyToMany(targetEntity="Pharmacy", mappedBy="drugs")
	 **/
	private $pharmacy;
	
	public function __construct() {
		$this->pharmacy = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
	/**
	 * Get pharmacy
	 *
	 * @return Pharmacy
	 */
	public function getPharmacy()
	{
		return $this->pharmacy;
	}

	/*/**
	 *@var@ORM\Doctrine\Common\Collections\ArrayCollection
	 *@ORM\ManyToMany(targetEntity="Prescription", inversedBy="drugs")
	 *@ORM\JoinTable(name="prescription_drugs")
	 **/
	/**
	 *@ORM\ManyToMany(targetEntity="Prescription", mappedBy="drugs" ,cascade={"persist"})
	 **/
	private $prescription;
	
	public function __constructprescription() {
		$this->prescription = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
	/**
	 * Get prescription
	 *
	 * @return PdPrescription
	 */
	public function getPrescription()
	{
		return $this->prescription;
	}
	
	public function setPrescription($prescription){
		$this->prescription =$prescription;
	}
	
 	public function __get($property){
 		
   		 return $this->$property;
   	}
   	
   	public function __set($property, $value){
   		
   		return $this->$property = $value;
   	}
   	
   	
}
