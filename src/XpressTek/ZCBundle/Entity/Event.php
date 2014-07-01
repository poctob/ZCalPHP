<?php

namespace XpressTek\ZCBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Event {

    /**
     *  Weekday mask 
     * @var array
     */
    private $weekDays = array(
        "None" => 0x00,
        "Monday" => 0x01,
        "Tuesday" => 0x02,
        "Wednesday" => 0x04,
        "Thursday" => 0x08,
        "Friday" => 0x10,
        "Saturday" => 0x20,
        "Sunday" => 0x40,
        "EveryDay" => 0x7f
    );

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Calendar", inversedBy="events")    
     */
    private $calendar;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="valid_from", type="date")
     */
    private $validFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="valid_to", type="date")
     */
    private $validTo;

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
     * @ORM\Column(name="weekday_mask", type="integer")
     */
    private $weekdayMask;
    
    public function cloneEntity(Event $source)
    {
        $this->calendar = $source->calendar;
        $this->title = $source->title;
        $this->validFrom = $source->validFrom;
        $this->validTo = $source->validTo;
        $this->startTime = $source->startTime;
        $this->endTime = $source->endTime;
        $this->isAllDay = $source->isAllDay;
        $this->weekdayMask = $source->weekdayMask;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set title
     *
     * @param string $title
     * @return Event
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set validFrom
     *
     * @param \DateTime $validFrom
     * @return Event
     */
    public function setValidFrom($validFrom) {
        $this->validFrom = $validFrom;

        return $this;
    }

    /**
     * Get validFrom
     *
     * @return \DateTime 
     */
    public function getValidFrom() {
        return $this->validFrom;
    }

    /**
     * Set validTo
     *
     * @param \DateTime $validTo
     * @return Event
     */
    public function setValidTo($validTo) {
        $this->validTo = $validTo;

        return $this;
    }

    /**
     * Get validTo
     *
     * @return \DateTime 
     */
    public function getValidTo() {
        return $this->validTo;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     * @return Event
     */
    public function setStartTime($startTime) {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime 
     */
    public function getStartTime() {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     * @return Event
     */
    public function setEndTime($endTime) {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime 
     */
    public function getEndTime() {
        return $this->endTime;
    }

    /**
     * Set isAllDay
     *
     * @param boolean $isAllDay
     * @return Event
     */
    public function setIsAllDay($isAllDay) {
        $this->isAllDay = $isAllDay;

        return $this;
    }

    /**
     * Get isAllDay
     *
     * @return boolean 
     */
    public function getIsAllDay() {
        return $this->isAllDay;
    }

    /**
     * Set weekdayMask
     *
     * @param integer $weekdayMask
     * @return Event
     */
    public function setWeekdayMask($weekdayMask) {

        if (is_array($weekdayMask)) {
            $mask = 0;
            foreach ($weekdayMask as $day => $value) {
                if (in_array($day, $this->weekDays) && $value==1) {
                    $mask = $mask | $this->weekDays[$day];
                }
            }
            $this->weekdayMask = $mask;
        } else {
            $this->weekdayMask = $weekdayMask;
        }

        return $this;
    }

    /**
     * Get weekdayMask
     *
     * @return integer 
     */
    public function getWeekdayMaskRaw() {
        return $this->weekdayMask;
    }
    
    /**
     *  @return array 
     */
    public function getWeekdayMask()
    {
        $retval = array();
        foreach($this->weekDays as $day => $mask)
        {
            $value = $this->weekdayMask & $mask;
            if($value == $this->weekdayMask)
            {
                array_push($retval, $day);
            }
        }
        return $retval;
    }
    
    public function getWeekDayKeys()
    {
        return $this->weekDays;
    }
    
    public function setCalendar($calendar)
    {
        $this->calendar=$calendar;
    }

}
