<?php

namespace Fanta\ManagerBundle\Tests\Entity;

use Fanta\ManagerBundle\Entity\PlayerVote;

class PlayerVoteTest extends \PHPUnit_Framework_TestCase
{
    protected $playerVote;
    
    protected function setUp()
    {
        $this->playerVote = new PlayerVote();
        $this->playerVote->setVote(6);
    }
    
    public function testVotoNoBonusNoMalus()
    {   
        $this->assertEquals(6, $this->playerVote->calculateFantaVote());
    }
    
    public function testVoto6Con1Ammonizione()
    {
        $this->playerVote->setAmmonizione(1);
        $this->assertEquals(5.5, $this->playerVote->calculateFantaVote());
    }
    
    public function testVoto6Con2Ammonizione()
    {
        $this->playerVote->setAmmonizione(2);
        $this->assertEquals(5, $this->playerVote->calculateFantaVote());
    }
    
    public function testVoto6ConEspulsione()
    {
        $this->playerVote->setEspulsione(1);
        $this->assertEquals(5, $this->playerVote->calculateFantaVote());
    }
    
    public function testVoto6Con1GolSubito()
    {
        $this->playerVote->setGolSubito(1);
        $this->assertEquals(5, $this->playerVote->calculateFantaVote());
    }
    
    public function testVoto6Con7GolSubito()
    {
        $this->playerVote->setGolSubito(7);
        $this->assertEquals(-1, $this->playerVote->calculateFantaVote());
    }
    
    public function testVoto6Con1Autorete()
    {
        $this->playerVote->setAutorete(1);
        $this->assertEquals(4, $this->playerVote->calculateFantaVote());
    }
    
    public function testVoto6Con1RigoreParato()
    {
        $this->playerVote->setRigoreParato(1);
        $this->assertEquals(9, $this->playerVote->calculateFantaVote());
    }
    
    public function testVoto6Con1RigoreSbagliato()
    {
        $this->playerVote->setRigoreSbagliato(1);
        $this->assertEquals(3, $this->playerVote->calculateFantaVote());
    }
    
    public function testVoto6Con1RigoreSegnato()
    {
        $this->playerVote->setRigoreSegnato(1);
        $this->assertEquals(9, $this->playerVote->calculateFantaVote());
    }
    
    public function testVoto6Con1Assist()
    {
        $this->playerVote->setAssist(1);
        $this->assertEquals(7, $this->playerVote->calculateFantaVote());
    }
    
    public function testVoto6Con1GolSegnato()
    {
        $this->playerVote->setGolFatto(1);
        $this->assertEquals(9, $this->playerVote->calculateFantaVote());
    }
}