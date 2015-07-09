<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Account;
/** @ORM\Entity
 *  @ORM\Table(name="admin")
 * */
class Admin extends Account {
	
}