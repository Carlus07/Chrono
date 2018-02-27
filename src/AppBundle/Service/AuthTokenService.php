<?php
namespace AppBundle\Service;

use AppBundle\Entity\AuthToken;
use AppBundle\Structure\UnitOfWork;
use DateTime;

class AuthTokenService
{
    private $unitOfWork;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->unitOfWork = $unitOfWork;
    }
    public function getAll()
    {
        $authTokens = $this->unitOfWork->AuthTokens()->getAll();
        return $authTokens;
    }
    public function getById($id)
    {
        $authToken = $this->unitOfWork->AuthTokens()->getById($id);
        return $authToken;
    }
    public function Add($user)
    {
        $authToken = new AuthToken();
        $authToken->setValue(base64_encode(random_bytes(50)));
        $authToken->setCreatedAt(new \DateTime('now'));
        $authToken->setUser($user);
        $authToken  = $this->unitOfWork->AuthTokens()->Add($authToken);
        return $authToken;
    }
    public function Update($authToken)
    {
        $authToken->setModifiedAt(new DateTime("now"));
        $authToken  = $this->unitOfWork->AuthTokens()->Update($authToken);
        return $authToken;
    }
    public function Delete($authToken)
    {
        $this->unitOfWork->AuthTokens()->Delete($authToken);
    }
}