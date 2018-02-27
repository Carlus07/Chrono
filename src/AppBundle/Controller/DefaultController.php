<?php
namespace AppBundle\Controller;

use AppBundle\Structure\BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends BaseController
{
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
}
