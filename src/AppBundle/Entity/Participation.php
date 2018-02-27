<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Structure\BaseEntity;
/**
 * @ORM\Entity()
 * @ORM\Table(name="participation")
 */
class Participation extends BaseEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $dossard;
    /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="participations")
     */
    protected $course;
    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="participations")
     */
    protected $category;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="participations")
     */
    protected $user;
    /**
     * @ORM\OneToOne(targetEntity="Chrono", mappedBy="participation")
     */
    protected $chrono;

    public function getDossard()
    {
        return $this->dossard;
    }

    public function setDossard($dossard)
    {
        $this->dossard = $dossard;
    }

    public function getCourse()
    {
        return $this->course;
    }

    public function setCourse($course)
    {
        $this->course = $course;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getChrono()
    {
        return $this->chrono;
    }

    public function setChrono($chrono)
    {
        $this->chrono = $chrono;
    }
}