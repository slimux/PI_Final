<?php

namespace MyApp\PIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function adminAction()
    {
        return $this->render('MyAppPIBundle:admin:modelUsed/dashboard.html.twig');
    }
}
