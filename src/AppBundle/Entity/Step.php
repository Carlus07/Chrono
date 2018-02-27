<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Structure\BaseEntity;
/**
 * @ORM\Entity()
 * @ORM\Table(name="step")
 */
class Step extends BaseEntity
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
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="steps")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id", nullable=false)
     * @var Course
     */
    protected $course;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getCourse()
    {
        return $this->course;
    }
    
    public function setCourse($course)
    {
        $this->course = $course;
    }
}