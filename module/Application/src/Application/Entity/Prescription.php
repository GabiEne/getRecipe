<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use Application\Entity\User;
use Application\Entity\Doctors;
use Application\Entity\Drugs;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\ManyToMany;

/** @ORM\Entity
 *  @ORM\Table(name="prescription")
 *
 *
 */
class Prescription{
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
	 *  @ORM\ManyToOne(targetEntity="Doctors")
	 *  @ORM\JoinColumn(name="doctor_id", referencedColumnName="id")
	 **/
	private $doctor;
	
	//other getter/setter declarations.....
	
	/**
	 * Set doctor
	 *
	 * @param Doctors $doctor
	 * @return Doctors
	 */
	public function setDoctor(Doctors $doctor = null)
	{
		$this->doctor = $doctor;
		return $this;
	}
	
	/**
	 * Get doctor
	 *
	 * @return Doctors
	 */
	public function getDoctor()
	{
		return $this->doctor;
	}
	
	
		
	/** 
	 *  @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 **/
	private $user;
	
	//other getter/setter declarations.....
	
	/**
	 * Set user
	 *
	 * @param User $user
	 * @return User
	 */
	public function setUser(User $user = null)
	{
		$this->user = $user;
		return $this;
	}
	
	/**
	 * Get user
	 *
	 * @return Users
	 */
	public function getUser()
	{
		return $this->user;
	}
	
	/**
	 *@var@ORM\Doctrine\Common\Collections\ArrayCollection
	 *@ORM\ManyToMany(targetEntity="Drugs", inversedBy="prescription")
	 *@ORM\JoinTable(name="prescription_drugs")
	 **/
	/*
	/**
	 *@ORM\ManyToMany(targetEntity="Drugs", mappedBy="prescription" ,cascade={"persist"})
	 **/
	
	private $drugs;
	
	
	public function __construct() {
		$this->drugs = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
	/**
	 * @param Collection $drugs
	 */
	public function addDrugs($drugs)
	{
		foreach ($drugs as $drug) {
			//$drug->setPrescription($this);
			$this->drugs->add($drug);
		}
	}

	/**
	 * @param Collection $drugs
	 */

	public function removeDrugs( $drugs)
	{
		foreach ($drugs as $drug) {
			$drug->setPrescription(null);
			$this->drugs->removeElement($drug);
		}
	}
	/**
	 * Get drugs
	 *
	 * @return Drugs
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