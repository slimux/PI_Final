<?php

namespace MyApp\PIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PaiementController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
