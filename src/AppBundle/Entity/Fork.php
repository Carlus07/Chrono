<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Structure\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="fork")
 */
class Fork extends BaseEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(type="integer")
     */
    protected $lowerFork;
    /**
     * @ORM\Column(type="integer")
     */
    protected $upperFork;
    /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="forks")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id", nullable=false)
     * @var Course
     */
    protected $course;
    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="forks")
     * @ORM\JoinTable(name="categByFork")
     */
    protected $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getLowerFork()
    {
        return $this->lowerFork;
    }

    public function setLowerFork($lowerFork)
    {
        $this->lowerFork = $lowerFork;
    }

    public function getUpperFork()
    {
        return $this->upperFork;
    }

    public function setUpperFork($upperFork)
    {
        $this->upperFork = $upperFork;
    }

    public function getCourse()
    {
        return $this->course;
    }

    public function setCourse($course)
    {
        $this->course = $course;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function setCategories($categories)
    {
        $this->categories = $categories;
    }
}