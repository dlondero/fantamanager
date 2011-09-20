<?php

namespace Fanta\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fanta\ManagerBundle\Entity\FantaTeam
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fanta\ManagerBundle\Entity\FantaTeamRepository")
 */
class FantaTeam
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
     * @ORM\OneToOne(targetEntity="User")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="Player")
     * @ORM\JoinTable(name="FantaTeamsPlayers",
     *      joinColumns={@ORM\JoinColumn(name="fanta_team_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="player_id", referencedColumnName="id")}
     *      )
     * @ORM\OrderBy({"role" = "DESC"})
     */
    private $players;

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
     * Set user
     *
     * @param Fanta\ManagerBundle\Entity\User $user
     */
    public function setUser(\Fanta\ManagerBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Fanta\ManagerBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    public function __construct()
    {
        $this->fanta_team_player = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add players
     *
     * @param Fanta\ManagerBundle\Entity\Player $players
     */
    public function addPlayer(\Fanta\ManagerBundle\Entity\Player $players)
    {
        $this->players[] = $players;
    }

    /**
     * Get players
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPlayers()
    {
        return $this->players;
    }
    
    public function __toString()
    {
        return $this->name;
    }
}