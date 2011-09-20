<?php

namespace Fanta\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fanta\ManagerBundle\Entity\FantaLineUp
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fanta\ManagerBundle\Entity\FantaLineUpRepository")
 */
class FantaLineUp
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
     * @var integer $fanta_team
     * 
     * @ORM\ManyToOne(targetEntity="FantaTeam")
     */
    private $fanta_team;
    
    /**
     * @var integer $round
     * 
     * @ORM\ManyToOne(targetEntity="Round")
     */
    private $round;

    /**
     * @var integer $player
     * 
     * @ORM\ManyToOne(targetEntity="Player")
     */
    private $player;
    
    /**
     * @var boolean $is_substitute
     *
     * @ORM\Column(name="is_substitute", type="boolean")
     */
    private $is_substitute;

    /**
     * @var smallint $substitute_priority
     * 
     * @ORM\Column(name="substitute_priority", type="smallint", nullable="true")
     */
    private $substitute_priority;
    
    /**
     * @var string $type
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * Set is_substitute
     *
     * @param boolean $isSubstitute
     */
    public function setIsSubstitute($isSubstitute)
    {
        $this->is_substitute = $isSubstitute;
    }

    /**
     * Get is_substitute
     *
     * @return boolean 
     */
    public function getIsSubstitute()
    {
        return $this->is_substitute;
    }

    /**
     * Set substitute_priority
     *
     * @param smallint $substitutePriority
     */
    public function setSubstitutePriority($substitutePriority)
    {
        $this->substitute_priority = $substitutePriority;
    }

    /**
     * Get substitute_priority
     *
     * @return smallint 
     */
    public function getSubstitutePriority()
    {
        return $this->substitute_priority;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
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
     * Set player
     *
     * @param Fanta\ManagerBundle\Entity\Player $player
     */
    public function setPlayer(\Fanta\ManagerBundle\Entity\Player $player)
    {
        $this->player = $player;
    }

    /**
     * Get player
     *
     * @return Fanta\ManagerBundle\Entity\Player 
     */
    public function getPlayer()
    {
        return $this->player;
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set round
     *
     * @param Fanta\ManagerBundle\Entity\Round $round
     */
    public function setRound(\Fanta\ManagerBundle\Entity\Round $round)
    {
        $this->round = $round;
    }

    /**
     * Get round
     *
     * @return Fanta\ManagerBundle\Entity\Round 
     */
    public function getRound()
    {
        return $this->round;
    }
}