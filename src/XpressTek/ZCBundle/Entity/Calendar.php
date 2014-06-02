<?php

namespace XpressTek\ZCBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use XpressTek\ZCBundle\Entity\Event;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Calendar
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="XpressTek\ZCBundle\Entity\CalendarRepository")
 */
class Calendar
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="calendarId")
     */
    protected $events;
    
    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime")
     */
    private $endDate;


    
    public function cloneEntity(Calendar $source)
    {
        $this->name = $source->name;
        $this->startDate = $source->startDate;
        $this->endDate = $source->endDate;
        $this->isActive = $source->isActive;
        $this->events = $source->events;
    }
    
    /**
     * Set id
     * 
     * @param integer $name
     * @return Calendar
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * Set name
     *
     * @param string $name
     * @return Calendar
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set isActive
     *
     * @param boolean $isActive
     * @return Calendar
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }
 
    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Calendar
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Calendar
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Add events
     *
     * @param \XpressTek\ZCBundle\Entity\Event $events
     * @return Calendar
     */
    public function addEvent(\XpressTek\ZCBundle\Entity\Event $events)
    {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param \XpressTek\ZCBundle\Entity\Event $events
     */
    public function removeEvent(\XpressTek\ZCBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }
}
