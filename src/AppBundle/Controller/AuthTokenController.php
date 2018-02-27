<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Credential;
use AppBundle\Form\Type\CredentialType;
use AppBundle\Service\AuthTokenService;
use AppBundle\Service\UserService;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\AuthToken;
use AppBundle\Structure\BaseController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AuthTokenController extends BaseController
{
    private $authTokenService;
    private $userService;

    private function AuthTokenService()
    {
        if(is_null($this->authTokenService))
        {
            $this->getContext();
            $this->authTokenService = new AuthTokenService($this->unitOfWork);
        }
        return $this->authTokenService;
    }
    private function UserService()
    {
        if(is_null($this->userService))
        {
            $this->getContext();
            $this->userService = new UserService($this->unitOfWork);
        }
        return $this->userService;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"auth-token"})
     * @Rest\Post("/auth-token")
     * @param Request $request
     * @return AuthToken|static
     */
    public function postAuthTokenAction(Request $request)
    {
        $credential = new Credential();
        $form = $this->createForm(CredentialType::class, $credential);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }
        
        $user  =  $this->UserService()->findOneByMail($credential->getLogin());

        if (!$user) {
            return $this->invalidCredentials();
        }
        
        $encoder = $this->get('security.password_encoder');
        $isPasswordValid =   $encoder->isPasswordValid($user, $credential->getPassword());

        if (!$isPasswordValid) { 
            return $this->invalidCredentials();
        }
        $authToken = $this->AuthTokenService()->Add($user);
        return $authToken;
    }
    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/auth-token/{id}")
     */
    public function removeAuthTokenAction(Request $request)
    {
        $authToken = $this->AuthTokenService()->find($request->get('id'));

        /* @var $authToken AuthToken */
        $connectedUser = $this->get('security.token_storage')->getToken()->getUser();

        if ($authToken && $authToken->getUser()->getId() === $connectedUser->getId()) {
            $this->AuthTokenService()->Delete($authToken);

        } else {
            throw new BadRequestHttpException();
        }
    }
    private function invalidCredentials()
    {
        return View::create(['message' => 'Invalid credentials'], Response::HTTP_BAD_REQUEST);
    }
}