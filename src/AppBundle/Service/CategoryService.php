<?php
namespace AppBundle\Service;

use AppBundle\Structure\UnitOfWork;
use DateTime;

class CategoryService
{
    private $unitOfWork;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->unitOfWork = $unitOfWork;
    }
    public function getAll()
    {
        $categories = $this->unitOfWork->Categories()->getAll();
        return $categories;
    }
    public function getById($id)
    {
        $category = $this->unitOfWork->Categories()->getById($id);
        return $category;
    }
    public function Add($category)
    {
        $category->setCreatedAt(new DateTime("now"));
        $category  = $this->unitOfWork->Categories()->Add($category);
        return $category;
    }
    public function Update($category)
    {
        $category->setModifiedAt(new DateTime("now"));
        $category  = $this->unitOfWork->Categories()->Update($category);
        return $category;
    }
    public function Delete($category)
    {
        $this->unitOfWork->Categories()->Delete($category);
    }
}