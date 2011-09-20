<?php

namespace Fanta\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fanta\ManagerBundle\Entity\PlayerVote
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fanta\ManagerBundle\Entity\PlayerVoteRepository")
 */
class PlayerVote
{
    const MALUS_AMMONIZIONE = 0.5;
    const MALUS_ESPULSIONE = 1;
    const MALUS_GOL_SUBITO = 1;
    const MALUS_AUTORETE = 2;
    const MALUS_RIGORE_SBAGLIATO = 3;
    const BONUS_ASSIST = 1;
    const BONUS_GOL_FATTO = 3;
    const BONUS_RIGORE_PARATO = 3;
    const BONUS_RIGORE_SEGNATO = 3;

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
     * @var float $vote
     *
     * @ORM\Column(name="vote", type="float", nullable="true")
     */
    private $vote;

    /**
     * @var float $fantavote
     *
     * @ORM\Column(name="fantavote", type="float", nullable="true")
     */
    private $fantavote;

    /**
     * @var smallint $golFatto
     *
     * @ORM\Column(name="gol_fatto", type="smallint")
     */
    private $golFatto;
    
    /**
     * @var smallint $golSubito
     *
     * @ORM\Column(name="gol_subito", type="smallint")
     */
    private $golSubito;
    
    /**
     * @var smallint $rigoreParato
     *
     * @ORM\Column(name="rigore_parato", type="smallint")
     */
    private $rigoreParato;
    
    /**
     * @var smallint $rigoreSbagliato
     *
     * @ORM\Column(name="rigore_sbagliato", type="smallint")
     */
    private $rigoreSbagliato;
    
    /**
     * @var smallint $rigoreSegnato
     *
     * @ORM\Column(name="rigore_segnato", type="smallint")
     */
    private $rigoreSegnato;
    
    /**
     * @var smallint $autorete
     *
     * @ORM\Column(name="autorete", type="smallint")
     */
    private $autorete;
    
    /**
     * @var smallint $ammonizione
     *
     * @ORM\Column(name="ammonizione", type="smallint")
     */
    private $ammonizione;
    
    /**
     * @var smallint $espulsione
     *
     * @ORM\Column(name="espulsione", type="smallint")
     */
    private $espulsione;
    
    /**
     * @var smallint $assist
     *
     * @ORM\Column(name="assist", type="smallint")
     */
    private $assist;
    
    
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
     * Set vote
     *
     * @param float $vote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;
    }

    /**
     * Get vote
     *
     * @return float 
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * Set fantavote
     *
     * @param float $fantavote
     */
    public function setFantavote($fantavote)
    {
        $this->fantavote = $fantavote;
    }

    /**
     * Get fantavote
     *
     * @return float 
     */
    public function getFantavote()
    {
        return $this->fantavote;
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
     * Add game
     *
     * @param Fanta\ManagerBundle\Entity\Game $game
     */
    public function addGame(\Fanta\ManagerBundle\Entity\Game $game)
    {
        $this->game[] = $game;
    }

    /**
     * Set golFatto
     *
     * @param smallint $golFatto
     */
    public function setGolFatto($golFatto)
    {
        $this->golFatto = $golFatto;
    }

    /**
     * Get golFatto
     *
     * @return smallint 
     */
    public function getGolFatto()
    {
        return $this->golFatto;
    }

    /**
     * Set golSubito
     *
     * @param smallint $golSubito
     */
    public function setGolSubito($golSubito)
    {
        $this->golSubito = $golSubito;
    }

    /**
     * Get golSubito
     *
     * @return smallint 
     */
    public function getGolSubito()
    {
        return $this->golSubito;
    }

    /**
     * Set rigoreParato
     *
     * @param smallint $rigoreParato
     */
    public function setRigoreParato($rigoreParato)
    {
        $this->rigoreParato = $rigoreParato;
    }

    /**
     * Get rigoreParato
     *
     * @return smallint 
     */
    public function getRigoreParato()
    {
        return $this->rigoreParato;
    }

    /**
     * Set rigoreSbagliato
     *
     * @param smallint $rigoreSbagliato
     */
    public function setRigoreSbagliato($rigoreSbagliato)
    {
        $this->rigoreSbagliato = $rigoreSbagliato;
    }

    /**
     * Get rigoreSbagliato
     *
     * @return smallint 
     */
    public function getRigoreSbagliato()
    {
        return $this->rigoreSbagliato;
    }

    /**
     * Set rigoreSegnato
     *
     * @param smallint $rigoreSegnato
     */
    public function setRigoreSegnato($rigoreSegnato)
    {
        $this->rigoreSegnato = $rigoreSegnato;
    }

    /**
     * Get rigoreSegnato
     *
     * @return smallint 
     */
    public function getRigoreSegnato()
    {
        return $this->rigoreSegnato;
    }

    /**
     * Set autorete
     *
     * @param smallint $autorete
     */
    public function setAutorete($autorete)
    {
        $this->autorete = $autorete;
    }

    /**
     * Get autorete
     *
     * @return smallint 
     */
    public function getAutorete()
    {
        return $this->autorete;
    }

    /**
     * Set ammonizione
     *
     * @param smallint $ammonizione
     */
    public function setAmmonizione($ammonizione)
    {
        $this->ammonizione = $ammonizione;
    }

    /**
     * Get ammonizione
     *
     * @return smallint 
     */
    public function getAmmonizione()
    {
        return $this->ammonizione;
    }

    /**
     * Set espulsione
     *
     * @param smallint $espulsione
     */
    public function setEspulsione($espulsione)
    {
        $this->espulsione = $espulsione;
    }

    /**
     * Get espulsione
     *
     * @return smallint 
     */
    public function getEspulsione()
    {
        return $this->espulsione;
    }

    /**
     * Set assist
     *
     * @param smallint $assist
     */
    public function setAssist($assist)
    {
        $this->assist = $assist;
    }

    /**
     * Get assist
     *
     * @return smallint 
     */
    public function getAssist()
    {
        return $this->assist;
    }
    
    /**
     * Calculate fantaVote
     * 
     * @return float $fantaVote
     */
    public function calculateFantaVote()
    {
        $fantaVote = $this->getVote();
        
        $fantaVote = $fantaVote - (self::MALUS_AMMONIZIONE * $this->getAmmonizione());
        $fantaVote = $fantaVote - (self::MALUS_ESPULSIONE * $this->getEspulsione());
        $fantaVote = $fantaVote - (self::MALUS_GOL_SUBITO * $this->getGolSubito());
        $fantaVote = $fantaVote - (self::MALUS_AUTORETE * $this->getAutorete());
        $fantaVote = $fantaVote - (self::MALUS_RIGORE_SBAGLIATO * $this->getRigoreSbagliato());
        
        $fantaVote = $fantaVote + (self::BONUS_ASSIST * $this->getAssist());
        $fantaVote = $fantaVote + (self::BONUS_GOL_FATTO * $this->getGolFatto());
        $fantaVote = $fantaVote + (self::BONUS_RIGORE_SEGNATO * $this->getRigoreSegnato());
        $fantaVote = $fantaVote + (self::BONUS_RIGORE_PARATO * $this->getRigoreParato());
        
        return $fantaVote;
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