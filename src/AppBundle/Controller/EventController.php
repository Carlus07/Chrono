<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Service\EventService;
use AppBundle\Structure\BaseController;

class EventController extends BaseController
{
    private $eventService;
    
    private function EventService()
    {
        if(is_null($this->eventService))
        {
            $this->getContext();
            $this->eventService = new EventService($this->unitOfWork);
        }
        return $this->eventService;
    }

    /**
     * @Rest\View(serializerGroups={"event"})
     * @Rest\Get("/events")
     */
    public function getEventsAction()
    {
        $events = $this->EventService()->getAll();
        return $events;
    }

    /**
     * @Rest\View(serializerGroups={"event"})
     * @Rest\Get("/event/{id}")
     * @param Request $request
     */
    public function getEventAction(Request $request)
    {
        $event = $this->EventService()->getById($request->get('id'));
        return $event;
    }
}