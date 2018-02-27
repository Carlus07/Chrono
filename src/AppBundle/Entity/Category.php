<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Structure\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="category")
 */
class Category extends BaseEntity
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $gender;
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $upperFork;
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $lowerFork;
    /**
     * @ORM\ManyToMany(targetEntity="Fork", mappedBy="categories")
     */
    protected $forks;
    /**
     * @ORM\OneToMany(targetEntity="Participation", mappedBy="category")
     * @var Participation[]
     */
    protected $participations;
    
    public function __construct()
    {
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

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getUpperFork()
    {
        return $this->upperFork;
    }

    public function setUpperFork($upperFork)
    {
        $this->upperFork = $upperFork;
    }

    public function getLowerFork()
    {
        return $this->lowerFork;
    }

    public function setLowerFork($lowerFork)
    {
        $this->lowerFork = $lowerFork;
    }
}