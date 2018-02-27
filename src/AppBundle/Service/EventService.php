<?php
namespace AppBundle\Service;

use AppBundle\Structure\UnitOfWork;

class EventService
{
    private $unitOfWork;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->unitOfWork = $unitOfWork;
    }
    public function getAll()
    {
        $events = $this->unitOfWork->Events()->getAll();
        return $events;
    }
    public function getById($id)
    {
        $event = $this->unitOfWork->Events()->getById($id);
        return $event;
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