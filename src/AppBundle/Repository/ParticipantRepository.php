<?php
namespace AppBundle\Repository;
use AppBundle\Structure\BaseRepository;

class ParticipantRepository extends BaseRepository
{
    protected $entity = null;
    protected $context = null;
    function __construct($context, $entity)
    {
        $this->context = $context;
        $this->entity = $entity;
    }
}