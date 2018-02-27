<?php
namespace AppBundle\Structure;

class BaseRepository implements IRepository
{
    protected $dbRepository;
    protected $dbContext;
    
    public function __construct( $context, $entity)
    {
        $this->dbRepository = $context->getRepository('AppBundle:'.$entity);
        $this->dbContext = $context;
    }
    public function getAll()
    {
        return $this->dbRepository->findAll();
    }
    public function getById($id)
    {
        return $this->dbRepository->find($id);
    }
    public function Add($row)
    {
        $this->dbContext->persist($row);
        $this->dbContext->flush();
        return $row;
    }
    public function Update($row)
    {
        $this->dbContext->persist($row);
        $this->dbContext->flush();
        return $row;
    }
    public function Delete($row)
    {
        $this->dbContext->remove($row);
        $this->dbContext->flush();
    }
}