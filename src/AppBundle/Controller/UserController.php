<?php
namespace AppBundle\Controller;

use FOS\RestBundle\View\View;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Service\UserService;
use AppBundle\Structure\BaseController;
use AppBundle\Form\Type\UserType;
use AppBundle\Entity\User;

class UserController extends BaseController
{
    private $userService;

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
     * @Rest\View()
     * @Rest\Get("users")
     */
    public function getUsersAction()
    {
        $results = $this->UserService()->getAll();
        return $results;
    }

    /**
     * @Rest\View(serializerGroups={"user"})
     * @Rest\Get("/user/{id}")
     * @param Request $request
     * @return static
     */
    public function getUserAction(Request $request)
    {
        $user = $this->UserService()->getById(intval($request->get('id')));
        if (empty($user)) {
            return $this->userNotFound();
        }
        return $user;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/user")
     * @param Request $request
     * @return User| FormInterface
     */
    public function postUserAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user, ['validation_groups'=>['Default', 'New']]);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $encoder = $this->get('security.password_encoder');
            $encoded =  $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($encoded);

            $user = $this->UserService()->Add($user);
            return $user;
        }
        else return $form;
    }

    /**
     * @Rest\View()
     * @Rest\Put("/user/{id}")
     * @param Request $request
     * @return User|FormInterface
     */
    public function updateUserAction(Request $request)
    {
        return $this->updateUser($request, true);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/user/{id}")
     * @param Request $request
     * @return User|FormInterface
     */
    public function patchUserAction(Request $request)
    {
        return $this->updateUser($request, false);
    }

    private function updateUser(Request $request, $clearMissing)
    {
        $user = $this->UserService()->getById(intval($request->get('id')));

        /* @var $user User */

        if (empty($user)) {
            return $this->userNotFound();
        }

        $options = ($clearMissing) ? ['validation_groups'=>['Default', 'FullUpdate']] :  $options = [];
        $form = $this->createForm(UserType::class, $user, $options);
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {

            if (!empty($user->getPlainPassword())) {
                $encoder = $this->get('security.password_encoder');
                $encoded = $encoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($encoded);
            }
            $user = $this->UserService()->Add($user);
            return $user;

        }
        else  return $form;
    }

    private function userNotFound()
    {
        return View::create(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
    }
}