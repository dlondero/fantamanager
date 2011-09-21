<?php

namespace Fanta\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fanta\ManagerBundle\Entity\Player
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fanta\ManagerBundle\Entity\PlayerRepository")
 */
class Player
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $role
     *
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    /**
     * @var integer $team
     * 
     * @ORM\ManyToOne(targetEntity="Team")
     */
    private $team;
    
    /**
     * @var float $indexValue
     * 
     * @ORM\Column(name="index_value", type="float")
     */
    private $indexValue;
    
    /**
     * @ORM\ManyToMany(targetEntity="FantaTeam", mappedBy="players")
     */
    private $fantaTeam;
    
    /**
     * @ORM\OneToMany(targetEntity="PlayerVote", mappedBy="player")
     */
    private $votes;
    

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
     * Set role
     *
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set id
     *
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set team
     *
     * @param Fanta\ManagerBundle\Entity\Team $team
     */
    public function setTeam(\Fanta\ManagerBundle\Entity\Team $team)
    {
        $this->team = $team;
    }

    /**
     * Get team
     *
     * @return Fanta\ManagerBundle\Entity\Team 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set indexValue
     *
     * @param float $indexValue
     */
    public function setIndexValue($indexValue)
    {
        $this->indexValue = $indexValue;
    }

    /**
     * Get indexValue
     *
     * @return float 
     */
    public function getIndexValue()
    {
        return $this->indexValue;
    }
    
    public function __toString()
    {
        return $this->name;
    }
    public function __construct()
    {
        $this->fantaTeam = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add fantaTeam
     *
     * @param Fanta\ManagerBundle\Entity\FantaTeam $fantaTeam
     */
    public function addFantaTeam(\Fanta\ManagerBundle\Entity\FantaTeam $fantaTeam)
    {
        $this->fantaTeam[] = $fantaTeam;
    }

    /**
     * Get fantaTeam
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFantaTeam()
    {
        return $this->fantaTeam;
    }

    /**
     * Add votes
     *
     * @param Fanta\ManagerBundle\Entity\PlayerVote $votes
     */
    public function addPlayerVote(\Fanta\ManagerBundle\Entity\PlayerVote $votes)
    {
        $this->votes[] = $votes;
    }

    /**
     * Get votes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getVotes()
    {
        return $this->votes;
    }
    
    public function calculateIndexValue()
    {
        $indexValue = 0;
        $voteTotal = 0;
        $fantaVoteTotal = 0;
        $bonus = 0;
        $malus = 0;
        
        if (count($this->votes)) {
            foreach ($this->votes as $vote) {
                $voteTotal += $vote->getVote();
                $fantaVoteTotal += $vote->getFantavote();
                if ($vote->getVote() < 6) {
                    $malus += 1;
                } else {
                    $bonus += 1;
                }
            }

            $avgVote = $voteTotal / count($this->votes);
            $avgFantaVote = $fantaVoteTotal / count($this->votes);

            $indexValue = $avgVote + $avgFantaVote;

            if ($bonus > $malus) {
                $indexValue += 1;
            } else if ($malus > $bonus) {
                $indexValue -= 1;
            }
        }
        
        return number_format($indexValue, 2, '.', '');
    }
}