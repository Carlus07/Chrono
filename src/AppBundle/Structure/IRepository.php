<?php
namespace AppBundle\Structure;

interface IRepository
{
    public function getAll();
    public function getById($id);
    public function Add($row);
    public function Update($row);
    public function Delete($row);
}