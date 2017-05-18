<?php

namespace MyApp\PIBundle\Controller;


use MyApp\PIBundle\Entity\Serveur;
use MyApp\PIBundle\Form\RechercheServeurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyApp\PIBundle\Form\RechercheType;

class ServeurController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $listServeurs = $em->getRepository('MyAppPIBundle:Serveur')->findAll();

        $serveurs = $this->get('knp_paginator')->paginate($listServeurs,$request->query->get('page', 1),8);

        return $this->render('@MyAppPI/layout/serveur.html.twig', array(
            'serveurs' => $serveurs,
        ));
    }

    public function rechercheAction(Request $request)
    {

        $form = $this->createForm(RechercheServeurType::class);
        return $this->render('@MyAppPI/layout/recherche.html.twig', array('form' => $form->createView()));
    }

    public function rechercheTraitementAction(Request $request)
    {

        $form = $this->createForm(RechercheServeurType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $listServeurs = $em->getRepository('MyAppPIBundle:Serveur')->rechercheServeur($form['recherche']->getData());
        } else {
            throw $this->createNotFoundException('La page n\'existe pas.');
        }
        $serveurs = $this->get('knp_paginator')->paginate($listServeurs,$request->query->get('page', 1),8);

        return $this->render('@MyAppPI/layout/serveur.html.twig', array('serveurs' => $serveurs));
    }
}
