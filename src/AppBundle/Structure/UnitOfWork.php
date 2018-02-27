<?php
namespace AppBundle\Structure;
use AppBundle\Repository\ParticipantRepository;
use AppBundle\Repository\CourseRepository;
use AppBundle\Repository\EventRepository;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\UserRepository;
use AppBundle\Repository\AuthTokenRepository;

class UnitOfWork
{
    private $context;
    private $participantRepository;
    private $courseRepository;
    private $eventRepository;
    private $categoryRepository;
    private $userRepository;
    private $authTokenRepository;

    function __construct($context)
    {
        $this->context = $context;
    }
    function Participants() {
        $this->participantRepository = (!isset($this->participantRepository)) ? new ParticipantRepository($this->context, 'Participant') : $this->participantRepository;
        return $this->participantRepository;
    }
    function Courses()
    {
        $this->courseRepository = (!isset($this->courseRepository)) ? new CourseRepository($this->context, 'Course') : $this->courseRepository;
        return $this->courseRepository;
    }
    function Events()
    {
        $this->eventRepository = (!isset($this->eventRepository)) ? new EventRepository($this->context, 'Event') : $this->eventRepository;
        return $this->eventRepository;
    }
    function Categories()
    {
        $this->categoryRepository = (!isset($this->categoryRepository)) ? new CategoryRepository($this->context, 'Category') : $this->categoryRepository;
        return $this->categoryRepository;
    }
    function Users()
    {
        $this->userRepository = (!isset($this->userRepository)) ? new UserRepository($this->context, 'User') : $this->userRepository;
        return $this->userRepository;
    }
    function AuthTokens()
    {
        $this->authTokenRepository = (!isset($this->authTokenRepository)) ? new AuthTokenRepository($this->context, 'AuthToken') : $this->authTokenRepository;
        return $this->authTokenRepository;
    }
}