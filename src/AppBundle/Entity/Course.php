<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Structure\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="course")
 */
class Course extends BaseEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    /**
     * @ORM\Column(type="integer")
     */
    protected $type;
    /**
     * @ORM\Column(type="time", nullable=true)
     */
    protected $start;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $lap;
    /**
     * @ORM\Column(type="time", nullable=true)
     */
    protected $time;
    /**
     * @ORM\Column(type="integer")
     */
    protected $maxNumberTeamMate;
    /**
     * @ORM\Column(type="integer")
     */
    protected $maxParticipant;
    /**
     * @ORM\Column(type="float")
     */
    protected $distance;
    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="courses")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id", nullable=false)
     * @var Event
     */
    protected $event;
    /**
     * @ORM\OneToMany(targetEntity="Participation", mappedBy="course")
     * @var Participation[]
     */
    protected $participations;

    /**
     * @ORM\OneToMany(targetEntity="Step", mappedBy="course")
     * @var Step[]
     */
    protected $steps;
    /**
     * @ORM\OneToMany(targetEntity="Fork", mappedBy="course")
     * @var Fork[]
     */
    protected $forks;
    
    public function __construct()
    {
        $this->steps = new ArrayCollection();
        $this->forks = new ArrayCollection();
        $this->participations = new ArrayCollection();
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getType()
    {
        switch($this->type)
        {
            case 0 : return "CHRONO";
            case 1 : return "CHRONODIFF";
            case 2 : return "ENDURO";
            default : return "CHRONO";
        }
    }

    public function setType($type)
    {
        switch($type)
        {
            case "CHRONO" : {
                $this->type = 0;
                break;
            }
            case "CHRONODIFF" : {
                $this->type = 1;
                break;
            }
            case "ENDURO" : {
                $this->type = 2;
                break;
            }
        }
    }

    public function getStart()
    {
        return $this->start;
    }

    public function setStart($start)
    {
        $this->start = $start;
    }

    public function getLap()
    {
        return $this->lap;
    }

    public function setLap($lap)
    {
        $this->lap = $lap;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time)
    {
        $this->time = $time;
    }
    public function getDistance()
    {
        return $this->distance;
    }

    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function setEvent($event)
    {
        $this->event = $event;
    }

    public function getSteps()
    {
        return $this->steps;
    }

    public function setSteps($steps)
    {
        $this->steps = $steps;
    }
    
    public function getParticipations()
    {
        return $this->participations;
    }

    public function setParticipations($participations)
    {
        $this->participations = $participations;
    }

    public function getForks()
    {
        return $this->forks;
    }
    
    public function setForks($forks)
    {
        $this->forks = $forks;
    }
}