<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Structure\BaseEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="users_email_unique",columns={"mail"})}
 * )
 */
class User extends BaseEntity implements  UserInterface
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
    protected $firstName;
    /**
     * @ORM\Column(type="date" )
     */
    protected $birthDate;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $gender;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $mail;
    protected $plainPassword;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $password;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $club;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $locality;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $postCode;
    /**
     * @ORM\Column(type="string")
     */
    protected $role;
    /**
     * @ORM\OneToMany(targetEntity="Participation", mappedBy="user")
     * @var Participation[]
     */
    protected $participations;

    public function __construct()
    {
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

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getClub()
    {
        return $this->club;
    }

    public function setClub($club)
    {
        $this->club = $club;
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
    public function getRoles()
    {
        return [$this->role];
    }
    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getSalt()
    {
        return 'p{"Y+}:ekJLV-~LeVs+[D93^xbph\'Fb7>Ps_t[szf&VS9b~T\!RjW,TYg)]"^sn2';
    }

    public function getUsername()
    {
        return $this->mail;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function getParticipations()
    {
        return $this->participations;
    }

    public function setParticipations($participations)
    {
        $this->participations = $participations;
    }
}