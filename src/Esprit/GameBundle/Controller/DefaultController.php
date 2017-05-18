<?php

namespace Esprit\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EspritGameBundle:Default:index.html.twig');
    }
}
