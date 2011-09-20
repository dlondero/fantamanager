<?php

namespace Fanta\ManagerBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Fanta\ManagerBundle\Entity\User
 *
 * @ORM\Table(name="`User`")
 * @ORM\Entity(repositoryClass="Fanta\ManagerBundle\Entity\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;
    
    /**
     * @ORM\OneToOne(targetEntity="FantaTeam", mappedBy="user")
     */
    private $fanta_team;

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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set fanta_team
     *
     * @param Fanta\ManagerBundle\Entity\FantaTeam $fantaTeam
     */
    public function setFantaTeam(\Fanta\ManagerBundle\Entity\FantaTeam $fantaTeam)
    {
        $this->fanta_team = $fantaTeam;
    }

    /**
     * Get fanta_team
     *
     * @return Fanta\ManagerBundle\Entity\FantaTeam 
     */
    public function getFantaTeam()
    {
        return $this->fanta_team;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    public function getUsername()
    {
        return $this->name;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials() {}

    public function equals(UserInterface $user)
    {
        if (!$user instanceof User) {
            return false;
        }

        if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->getSalt() !== $user->getSalt()) {
            return false;
        }

        if ($this->name !== $user->getUsername()) {
            return false;
        }

        return true;
    }
    
}