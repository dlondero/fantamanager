<?php

namespace Fanta\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fanta\ManagerBundle\Entity\PlayerValue
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fanta\ManagerBundle\Entity\PlayerValueRepository")
 */
class PlayerValue
{
    /**
     * @var integer $player
     * 
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Player")
     */
    private $player;

    /**
     * @var integer $round
     * 
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Round")
     */
    private $round;
    
    /**
     * @var smallint $value
     *
     * @ORM\Column(name="value", type="smallint")
     */
    private $value;


    /**
     * Set player
     *
     * @param integer $player
     */
    public function setPlayer($player)
    {
        $this->player = $player;
    }

    /**
     * Get player
     *
     * @return integer 
     */
    public function getPlayer()
    {
        return $this->player;
    }
    
    /**
     * Set game
     *
     * @param integer $game
     */
    public function setGame($game)
    {
        $this->game = $game;
    }

    /**
     * Get game
     *
     * @return integer 
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set value
     *
     * @param smallint $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return smallint 
     */
    public function getValue()
    {
        return $this->value;
    }
    public function __construct()
    {
        $this->player = new \Doctrine\Common\Collections\ArrayCollection();
    $this->game = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add player
     *
     * @param Fanta\ManagerBundle\Entity\Player $player
     */
    public function addPlayer(\Fanta\ManagerBundle\Entity\Player $player)
    {
        $this->player[] = $player;
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