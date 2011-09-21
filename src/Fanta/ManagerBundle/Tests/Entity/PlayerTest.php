<?php

namespace Fanta\ManagerBundle\Tests\Entity;

use Fanta\ManagerBundle\Entity\Player;
use Fanta\ManagerBundle\Entity\PlayerVote;

class PlayerTest extends \PHPUnit_Framework_TestCase
{
    protected $player;
    
    protected function setUp()
    {
        $this->player = new Player();
        
        $this->playerVote1 = new PlayerVote();
        $this->playerVote1->setVote(6);
        $this->playerVote1->setFantavote(9);
        
        $this->playerVote2 = new PlayerVote();
        $this->playerVote2->setVote(5);
        $this->playerVote2->setFantavote(5);
                
        $this->player->addPlayerVote($this->playerVote1);
        $this->player->addPlayerVote($this->playerVote2);
    }
    
    public function testIndexValueWithoutVotes()
    {   
        $playerNoVotes = new Player();
        $this->assertEquals(0, $playerNoVotes->calculateIndexValue());
    }
    
    public function testIndexValue()
    {   
        $this->assertEquals(12.5, $this->player->calculateIndexValue());
    }
    
    public function testIndexValueWithBonus()
    {   
        $this->playerVote3 = new PlayerVote();
        $this->playerVote3->setVote(6.5);
        $this->playerVote3->setFantavote(7.5);
        
        $this->player->addPlayerVote($this->playerVote3);
        
        $this->assertEquals(14.00, $this->player->calculateIndexValue());
    }
    
    public function testIndexValueWithMalus()
    {   
        $this->playerVote3 = new PlayerVote();
        $this->playerVote3->setVote(5.5);
        $this->playerVote3->setFantavote(4.5);
        
        $this->player->addPlayerVote($this->playerVote3);
        
        $this->assertEquals(10.67, $this->player->calculateIndexValue());
    }
}