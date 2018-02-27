<?php
namespace AppBundle\Repository;
use AppBundle\Structure\BaseRepository;

class UserRepository extends BaseRepository
{
    public function findOneByMail($mail)
    {
        return $this->dbRepository->findOneByMail($mail);
    }
}