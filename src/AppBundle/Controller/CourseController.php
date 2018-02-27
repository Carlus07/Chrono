<?php
namespace AppBundle\Controller;

use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Service\CourseService;
use AppBundle\Structure\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class CourseController extends BaseController
{
    private $courseService;

    private function CourseService()
    {
        if(is_null($this->courseService))
        {
            $this->getContext();
            $this->courseService = new CourseService($this->unitOfWork);
        }
        return $this->courseService;
    }

    /**
     * @Rest\View(serializerGroups={"course"})
     * @Rest\Get("courses")
     */
    public function getCoursesAction()
    {
        $results = $this->CourseService()->getAll();
        return $results;
    }

    /**
     * @Rest\View(serializerGroups={"course"})
     * @Rest\Get("course/{id}")
     * @Security("has_role('ROLE_ADMIN')")
     * @param Request $request
     * @return static
     */
    public function getCourseAction(Request $request)
    {
        $result = $this->CourseService()->getById(intval($request->get('id')));
        if (empty($result)) {
            return $this->courseNotFound();
        }
        return $result;
    }

    private function courseNotFound()
    {
        return View::create(['message' => 'Course not found'], Response::HTTP_NOT_FOUND);
    }
}