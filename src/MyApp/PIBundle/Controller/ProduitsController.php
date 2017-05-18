<?php

namespace MyApp\PIBundle\Controller;

use MyApp\PIBundle\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\PIBundle\Form\RechercheType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use MyApp\PIBundle\Entity\Categories;

class ProduitsController extends Controller
{
    public function produitsAction(Request $request,Categories $categorie = null)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

        if ($categorie != null)
            $findProduits = $em->getRepository('MyAppPIBundle:Produits')->byCategorie($categorie);
        else
            $findProduits = $em->getRepository('MyAppPIBundle:Produits')->findBy(array('disponible' => 1));

        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier = false;

        $produits = $this->get('knp_paginator')->paginate($findProduits,$request->query->get('page', 1),6);

        return $this->render('@MyAppPI/store/store.html.twig',  array('produits' => $produits,
                                                                      'panier' => $panier));
    }

    public function presentationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('MyAppPIBundle:Produits')->find($id);
        if (!$produit) throw $this->createNotFoundException('La page n\'existe pas.');

        return $this->render('@MyAppPI/store/info.html.twig', array('produit' => $produit));
    }

    public function rechercheAction(Request $request)
    {

        $form = $this->createForm(RechercheType::class);
        return $this->render('@MyAppPI/recherche/recherche.html.twig', array('form' => $form->createView()));
    }

    public function rechercheTraitementAction(Request $request)
    {

        $form = $this->createForm(RechercheType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $findProduits = $em->getRepository('MyAppPIBundle:Produits')->recherche($form['recherche']->getData());
        } else {
            throw $this->createNotFoundException('La page n\'existe pas.');
        }
        $produits = $this->get('knp_paginator')->paginate($findProduits,$request->query->get('page', 1),6);

        return $this->render('@MyAppPI/store/store.html.twig', array('produits' => $produits));
    }

}
