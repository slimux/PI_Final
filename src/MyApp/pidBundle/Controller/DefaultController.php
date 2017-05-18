<?php

namespace MyApp\pidBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('pidBundle:Default:index.html.twig');
    }
    public function chatAction()
    {
        return $this->render('pidBundle::chat.html.twig');
    }
}
