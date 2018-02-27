<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Structure\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="event")
 */
class Event extends BaseEntity
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
     * @ORM\Column(type="string")
     */
    protected $description;
    /**
     * @ORM\Column(type="date")
     */
    protected $date;
    /**
     * @ORM\Column(type="integer")
     */
    protected $category;
    /**
     * @ORM\OneToMany(targetEntity="Course", mappedBy="event")
     * @var Courses[]
     */
    protected $courses;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }
    public function getCategory()
    {
        switch($this->category)
        {
            case 0 : return "Trail";
            case 1 : return "CAP";
            case 2 : return "VTT";
            case 3 : return "CycloCross";
            case 4 : return "Run-Bike";
            case 5 : return "Triathlon";
            default : return "CAP";
        }
    }

    public function setCategory($category)
    {
        switch($category)
        {
            case "Trail" : {
                $this->category = 0;
                break;
            }
            case "CAP" : {
                $this->category = 1;
                break;
            }
            case "VTT" : {
                $this->category = 2;
                break;
            }
            case "CycloCross" : {
                $this->category = 3;
                break;
            }
            case "Run-Bike" : {
                $this->category = 4;
                break;
            }
            case "Triathlon" : {
                $this->category = 5;
                break;
            }
        }
    }
    public function getCourses()
    {
        return $this->courses;
    }

    public function setCourses($courses)
    {
        $this->courses = $courses;
    }
}
