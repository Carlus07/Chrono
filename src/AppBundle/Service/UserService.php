<?php
namespace AppBundle\Service;

use AppBundle\Entity\User;
use AppBundle\Structure\UnitOfWork;
use DateTime;

class UserService
{
    private $unitOfWork;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->unitOfWork = $unitOfWork;
    }
    public function getAll()
    {
        $categories = $this->unitOfWork->Users()->getAll();
        return $categories;
    }
    public function getById($id)
    {
        $user = $this->unitOfWork->Users()->getById($id);
        return $user;
    }
    public function Add(User $user)
    {
        $user->setCreatedAt(new DateTime("now"));
        $user  = $this->unitOfWork->Users()->Add($user);
        return $user;
    }
    public function Update(User $user)
    {
        $user->setModifiedAt(new DateTime("now"));
        $user  = $this->unitOfWork->Users()->Update($user);
        return $user;
    }
    public function Delete($user)
    {
        $this->unitOfWork->Users()->Delete($user);
    }

    public function findOneByMail($mail)
    {
        $user = $this->unitOfWork->Users()->findOneByMail($mail);
        return $user;
    }
}