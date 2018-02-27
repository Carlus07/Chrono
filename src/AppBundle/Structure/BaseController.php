<?php
namespace AppBundle\Structure;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends Controller
{
    protected  $unitOfWork;

    protected function getContext()
    {
        if(!isset($this->unitOfWork)){
            $context = $this->get('doctrine.orm.entity_manager');
            $this->unitOfWork = new UnitOfWork($context);
        }
    }
}