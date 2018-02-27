<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Structure\BaseEntity;
/**
 * @ORM\Entity()
 * @ORM\Table(name="locality")
 */
class Locality
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
    protected $locality;
    /**
     * @ORM\Column(type="string")
     */
    protected $postCode;
    /**
     * @ORM\Column(type="string")
     */
    protected $country;

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getLocality()
    {
        return $this->locality;
    }

    public function setLocality($locality)
    {
        $this->locality = $locality;
    }

    public function getPostCode()
    {
        return $this->postCode;
    }

    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;
    }
}