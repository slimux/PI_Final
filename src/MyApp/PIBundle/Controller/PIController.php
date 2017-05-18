<?php

namespace MyApp\PIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PIController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppPIBundle:layout:homepage.html.twig');
    }
    public function loginAction()
    {
        return $this->render('MyAppPIBundle:layout:login.html.twig');
    }
    public function registerAction()
    {
        return $this->render('MyAppPIBundle:layout:register.html.twig');
    }
//    public function serveurAction()
//    {
//        return $this->render('MyAppPIBundle:layout:serveur.html.twig');
//    }
    public function storeAction()
    {
        return $this->render('MyAppPIBundle:store:store.html.twig');
    }
    public function infoAction()
    {
        return $this->render('MyAppPIBundle:store:info.html.twig');
    }
//    public function panieraction()
//    {
//        return $this->render('MyAppPIBundle:store:panier.html.twig');
//    }
//    public function livraisonaction()
//    {
//        return $this->render('MyAppPIBundle:store:livraison.html.twig');
//    }

}
