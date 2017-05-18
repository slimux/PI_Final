<?php

namespace TGSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TGSBundle:Default:index.html.twig');
    }
    public function layoutAction()
    {
        return $this->render('TGSBundle:Default:layout.html.twig');
    }
}
