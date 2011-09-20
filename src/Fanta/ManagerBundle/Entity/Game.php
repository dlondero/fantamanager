<?php

namespace Fanta\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fanta\ManagerBundle\Entity\Game
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fanta\ManagerBundle\Entity\GameRepository")
 */
class Game
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
     * @var string $home_team
     *
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="home_team_id", referencedColumnName="id")
     */
    private $home_team;

    /**
     * @var string $away_team
     *
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="away_team_id", referencedColumnName="id")
     */
    private $away_team;
    
    /**
     * @var smallint $home_score
     *
     * @ORM\Column(name="home_score", type="smallint")
     */
    private $home_score;

    /**
     * @var smallint $away_score
     *
     * @ORM\Column(name="away_score", type="smallint")
     */
    private $away_score;

    /**
     * @var datetime $datetime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    private $datetime;

    /**
     * @var boolean $is_played
     *
     * @ORM\Column(name="is_played", type="boolean")
     */
    private $is_played;
    
    /**
     * @var integer $game
     * 
     * @ORM\ManyToOne(targetEntity="Round")
     */
    private $round;
    
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
     * Set home_score
     *
     * @param smallint $homeScore
     */
    public function setHomeScore($homeScore)
    {
        $this->home_score = $homeScore;
    }

    /**
     * Get home_score
     *
     * @return smallint 
     */
    public function getHomeScore()
    {
        return $this->home_score;
    }

    /**
     * Set away_score
     *
     * @param smallint $awayScore
     */
    public function setAwayScore($awayScore)
    {
        $this->away_score = $awayScore;
    }

    /**
     * Get away_score
     *
     * @return smallint 
     */
    public function getAwayScore()
    {
        return $this->away_score;
    }

    /**
     * Set datetime
     *
     * @param datetime $datetime
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * Get datetime
     *
     * @return datetime 
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set is_played
     *
     * @param boolean $isPlayed
     */
    public function setIsPlayed($isPlayed)
    {
        $this->is_played = $isPlayed;
    }

    /**
     * Get is_played
     *
     * @return boolean 
     */
    public function getIsPlayed()
    {
        return $this->is_played;
    }

    /**
     * Set home_team
     *
     * @param Fanta\ManagerBundle\Entity\Team $homeTeam
     */
    public function setHomeTeam(\Fanta\ManagerBundle\Entity\Team $homeTeam)
    {
        $this->home_team = $homeTeam;
    }

    /**
     * Get home_team
     *
     * @return Fanta\ManagerBundle\Entity\Team 
     */
    public function getHomeTeam()
    {
        return $this->home_team;
    }

    /**
     * Set away_team
     *
     * @param Fanta\ManagerBundle\Entity\Team $awayTeam
     */
    public function setAwayTeam(\Fanta\ManagerBundle\Entity\Team $awayTeam)
    {
        $this->away_team = $awayTeam;
    }

    /**
     * Get away_team
     *
     * @return Fanta\ManagerBundle\Entity\Team 
     */
    public function getAwayTeam()
    {
        return $this->away_team;
    }
    
    public function __toString()
    {
        return $this->home_team . ' - ' . $this->away_team;
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