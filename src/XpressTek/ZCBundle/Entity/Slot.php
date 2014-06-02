<?php

namespace XpressTek\ZCBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Slot
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Slot
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

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

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_time", type="time")
     */
    private $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_time", type="time")
     */
    private $endTime;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_all_day", type="boolean")
     */
    private $isAllDay;

    /**
     * @var integer
     *
     * @ORM\Column(name="week_days_mask", type="smallint")
     */
    private $weekDaysMask;

    /**
     * @var integer
     *
     * @ORM\Column(name="calendar_id", type="integer")
     */
    private $calendarId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="text")
     */
    private $comments;


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
     * Set title
     *
     * @param string $title
     * @return Slot
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Slot
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
     * @return Slot
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
     * Set startTime
     *
     * @param \DateTime $startTime
     * @return Slot
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime 
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     * @return Slot
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime 
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set isAllDay
     *
     * @param boolean $isAllDay
     * @return Slot
     */
    public function setIsAllDay($isAllDay)
    {
        $this->isAllDay = $isAllDay;

        return $this;
    }

    /**
     * Get isAllDay
     *
     * @return boolean 
     */
    public function getIsAllDay()
    {
        return $this->isAllDay;
    }

    /**
     * Set weekDaysMask
     *
     * @param integer $weekDaysMask
     * @return Slot
     */
    public function setWeekDaysMask($weekDaysMask)
    {
        $this->weekDaysMask = $weekDaysMask;

        return $this;
    }

    /**
     * Get weekDaysMask
     *
     * @return integer 
     */
    public function getWeekDaysMask()
    {
        return $this->weekDaysMask;
    }

    /**
     * Set calendarId
     *
     * @param integer $calendarId
     * @return Slot
     */
    public function setCalendarId($calendarId)
    {
        $this->calendarId = $calendarId;

        return $this;
    }

    /**
     * Get calendarId
     *
     * @return integer 
     */
    public function getCalendarId()
    {
        return $this->calendarId;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Slot
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
     * Set comments
     *
     * @param string $comments
     * @return Slot
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
    }
}
