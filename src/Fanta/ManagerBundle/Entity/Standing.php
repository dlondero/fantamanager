<?php

namespace Fanta\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fanta\ManagerBundle\Entity\Standing
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fanta\ManagerBundle\Entity\StandingRepository")
 */
class Standing
{
    /**
     * @var integer $team
     * 
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Team")
     */
    private $team;
    
    /**
     * @var integer $round
     * 
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Round")
     */
    private $round;
    
    /**
     * @var smallint $points
     *
     * @ORM\Column(name="points", type="smallint")
     */
    private $points;

    /**
     * @var smallint $matches_home_played
     *
     * @ORM\Column(name="matches_home_played", type="smallint")
     */
    private $matches_home_played;

    /**
     * @var smallint $matches_home_win
     *
     * @ORM\Column(name="matches_home_win", type="smallint")
     */
    private $matches_home_win;

    /**
     * @var smallint $matches_home_draw
     *
     * @ORM\Column(name="matches_home_draw", type="smallint")
     */
    private $matches_home_draw;

    /**
     * @var smallint $matches_home_loss
     *
     * @ORM\Column(name="matches_home_loss", type="smallint")
     */
    private $matches_home_loss;

    /**
     * @var smallint $matches_away_played
     *
     * @ORM\Column(name="matches_away_played", type="smallint")
     */
    private $matches_away_played;

    /**
     * @var smallint $matches_away_win
     *
     * @ORM\Column(name="matches_away_win", type="smallint")
     */
    private $matches_away_win;

    /**
     * @var smallint $matches_away_draw
     *
     * @ORM\Column(name="matches_away_draw", type="smallint")
     */
    private $matches_away_draw;

    /**
     * @var smallint $matches_away_loss
     *
     * @ORM\Column(name="matches_away_loss", type="smallint")
     */
    private $matches_away_loss;

    /**
     * Set team
     *
     * @param integer $team
     */
    public function setTeam($team)
    {
        $this->team = $team;
    }

    /**
     * Get team
     *
     * @return integer 
     */
    public function getTeam()
    {
        return $this->team;
    }
    
    /**
     * Set points
     *
     * @param smallint $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }

    /**
     * Get points
     *
     * @return smallint 
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set matches_home_played
     *
     * @param smallint $matchesHomePlayed
     */
    public function setMatchesHomePlayed($matchesHomePlayed)
    {
        $this->matches_home_played = $matchesHomePlayed;
    }

    /**
     * Get matches_home_played
     *
     * @return smallint 
     */
    public function getMatchesHomePlayed()
    {
        return $this->matches_home_played;
    }

    /**
     * Set matches_home_win
     *
     * @param smallint $matchesHomeWin
     */
    public function setMatchesHomeWin($matchesHomeWin)
    {
        $this->matches_home_win = $matchesHomeWin;
    }

    /**
     * Get matches_home_win
     *
     * @return smallint 
     */
    public function getMatchesHomeWin()
    {
        return $this->matches_home_win;
    }

    /**
     * Set matches_home_draw
     *
     * @param smallint $matchesHomeDraw
     */
    public function setMatchesHomeDraw($matchesHomeDraw)
    {
        $this->matches_home_draw = $matchesHomeDraw;
    }

    /**
     * Get matches_home_draw
     *
     * @return smallint 
     */
    public function getMatchesHomeDraw()
    {
        return $this->matches_home_draw;
    }

    /**
     * Set matches_home_loss
     *
     * @param smallint $matchesHomeLoss
     */
    public function setMatchesHomeLoss($matchesHomeLoss)
    {
        $this->matches_home_loss = $matchesHomeLoss;
    }

    /**
     * Get matches_home_loss
     *
     * @return smallint 
     */
    public function getMatchesHomeLoss()
    {
        return $this->matches_home_loss;
    }

    /**
     * Set matches_away_played
     *
     * @param smallint $matchesAwayPlayed
     */
    public function setMatchesAwayPlayed($matchesAwayPlayed)
    {
        $this->matches_away_played = $matchesAwayPlayed;
    }

    /**
     * Get matches_away_played
     *
     * @return smallint 
     */
    public function getMatchesAwayPlayed()
    {
        return $this->matches_away_played;
    }

    /**
     * Set matches_away_win
     *
     * @param smallint $matchesAwayWin
     */
    public function setMatchesAwayWin($matchesAwayWin)
    {
        $this->matches_away_win = $matchesAwayWin;
    }

    /**
     * Get matches_away_win
     *
     * @return smallint 
     */
    public function getMatchesAwayWin()
    {
        return $this->matches_away_win;
    }

    /**
     * Set matches_away_draw
     *
     * @param smallint $matchesAwayDraw
     */
    public function setMatchesAwayDraw($matchesAwayDraw)
    {
        $this->matches_away_draw = $matchesAwayDraw;
    }

    /**
     * Get matches_away_draw
     *
     * @return smallint 
     */
    public function getMatchesAwayDraw()
    {
        return $this->matches_away_draw;
    }

    /**
     * Set matches_away_loss
     *
     * @param smallint $matchesAwayLoss
     */
    public function setMatchesAwayLoss($matchesAwayLoss)
    {
        $this->matches_away_loss = $matchesAwayLoss;
    }

    /**
     * Get matches_away_loss
     *
     * @return smallint 
     */
    public function getMatchesAwayLoss()
    {
        return $this->matches_away_loss;
    }
    public function __construct()
    {
        $this->team = new \Doctrine\Common\Collections\ArrayCollection();
    $this->game = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add team
     *
     * @param Fanta\ManagerBundle\Entity\Team $team
     */
    public function addTeam(\Fanta\ManagerBundle\Entity\Team $team)
    {
        $this->team[] = $team;
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