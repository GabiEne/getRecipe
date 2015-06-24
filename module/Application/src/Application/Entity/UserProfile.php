<?php 
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Application\Entity\User;
use Application\Entity\Doctors;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\ManyToOne;


/** @ORM\Entity
 * @ORM\Table(name="userprofile")
 * 
 *  
 */
class UserProfile{
	 /**
     * @var integer $id
     *
     * @Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
   protected $id;
	
	
	/**
	 * @var User
	 *
	 * @OneToOne(targetEntity="User")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
	 * })
	 */
   
protected $user;
  /**
   * Get id
   *
   * @return integer
   */
  public function getId()
  {
  	return $this->id;
  }

/**
 * Set user
 *
 * @param User $user
 * @return UserProfile
 */
public function setUser(User $user )
{
	$this->user = $user;
	return $this;
}

/**
 * Get user
 *
 * @return User
 */
public function getUser()
{
	return $this->user;
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
	 * @ORM\Column(type= "datetime")
	 *
	 */
	
	protected $dateofbirth;
	
	
	
	public function getDateOfBirth(){
		return $this->dateofbirth;
	
	}
	public function setDateOfBirth($dateofbirth){
		$this->dateofbirth =$dateofbirth;
	}
	
	//other declarations.....
	
	/**
	 * @var Doctors
	 *
	 *  @ORM\ManyToOne(targetEntity="Doctors")
	 *  @ORM\JoinColumns({
	 *  @ORM\JoinColumn(name="id_doctor", referencedColumnName="id")
	 * })
	 */
	private $doctor;
	
	
	
	/**
	 * Set doctor
	 *
	 * @param Doctors $doctor
	 * @return UserProfile
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
	
	public function getLatitude(){
		return $this->latitude;
	
	}
	public function setLatitude($latitude){
	
		$this->latitude =$latitude;
	
	}
	
}