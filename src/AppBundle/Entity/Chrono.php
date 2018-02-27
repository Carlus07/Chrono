<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Structure\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="chrono")
 */
class Chrono extends BaseEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $start;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $finish;
    /**
     * @ORM\OneToOne(targetEntity="Participation", inversedBy="chrono")
     * @ORM\JoinColumn(name="participation_id", referencedColumnName="id")
     */
    protected $participation;
    /**
     * @ORM\OneToMany(targetEntity="SpecialTime", mappedBy="chrono")
     * @var SpecialTime[]
     */
    protected $specialTimes;

    public function __construct()
    {
        $this->specialTimes = new ArrayCollection();
    }
    
    public function getStart()
    {
        return $this->start;
    }

    public function setStart($start)
    {
        $this->start = $start;
    }

    public function getFinish()
    {
        return $this->finish;
    }

    public function setFinish($finish)
    {
        $this->finish = $finish;
    }

    public function getParticipation()
    {
        return $this->participation;
    }

    public function setParticipation($participation)
    {
        $this->participation = $participation;
    }
    
    public function getSpecialTimes()
    {
        return $this->specialTimes;
    }
    
    public function setSpecialTimes($specialTimes)
    {
        $this->specialTimes = $specialTimes;
    }
}