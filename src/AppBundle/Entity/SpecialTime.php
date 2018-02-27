<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Structure\BaseEntity;
/**
 * @ORM\Entity()
 * @ORM\Table(name="specialTime")
 */
class SpecialTime extends BaseEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $stepTime;
    /**
     * @ORM\ManyToOne(targetEntity="Chrono", inversedBy="specialTimes")
     * @ORM\JoinColumn(name="chrono_id", referencedColumnName="id", nullable=false)
     */
    protected $chrono;

    public function getChrono()
    {
        return $this->chrono;
    }

    public function setChrono($chrono)
    {
        $this->chrono = $chrono;
    }

    public function getStepTime()
    {
        return $this->stepTime;
    }

    public function setStepTime($stepTime)
    {
        $this->stepTime = $stepTime;
    }
}