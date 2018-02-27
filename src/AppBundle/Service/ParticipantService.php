<?php
namespace AppBundle\Service;

use AppBundle\Structure\UnitOfWork;

class ParticipantService
{
    private $_participantRepository;
    private $_unitOfWork;
    
    public function __construct($unitOfWork)
    {
        $this->_unitOfWork = $unitOfWork;
    }
    public function getAll()
    {
       $participants = $this->_unitOfWork->Participants()->getAll();
       /*$results = [];
       foreach ($participants as $participant) {
           $results[] = [
           'id' => $participant->getId(),
           'name' => $participant->getName(),
           'first_name' => $participant->getFirstName(),
           ];
       }*/
       return $participants;
    }
    public function getById($id)
    {
        $participant = $this->_unitOfWork->Participants()->getById($id);
        return $participant;
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