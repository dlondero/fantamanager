<?php

namespace Fanta\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fanta\ManagerBundle\Entity\Round
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fanta\ManagerBundle\Entity\RoundRepository")
 */
class Round
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
    
    public function __toString()
    {
        return 'Giornata ' . $this->id;
    }
}