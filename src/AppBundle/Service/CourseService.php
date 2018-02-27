<?php
namespace AppBundle\Service;

use AppBundle\Structure\UnitOfWork;

class CourseService
{
    private $unitOfWork;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->unitOfWork = $unitOfWork;
    }
    public function getAll()
    {
        $courses = $this->unitOfWork->Courses()->getAll();
        /*$results = [];
        foreach ($participants as $participant) {
            $results[] = [
            'id' => $participant->getId(),
            'name' => $participant->getName(),
            'first_name' => $participant->getFirstName(),
            ];
        }*/
        return $courses;
    }
    public function getById($id)
    {
        $course = $this->unitOfWork->Courses()->getById($id);
        return $course;
    }
    public function Add()
    {
        
    }
    public function Update()
    {

    }
    public function Delete()
    {

    }
}