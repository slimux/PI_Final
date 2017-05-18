<?php

namespace MyApp\PIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use MyApp\PIBundle\Form\UtilisateursAdressesType;
use MyApp\PIBundle\Entity\UtilisateursAdresses;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class PanierController extends Controller
{
    public function menuAction(Request $request)
    {
        $session = $request->getSession();
        if (!$session->has('panier'))
            $articles = 0;
        else
            $articles = count($session->get('panier'));

        return $this->render('@MyAppPI/panier/panier.html.twig', array('articles' => $articles));
    }

    public function supprimerAction(Request $request,$id)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');

        if (array_key_exists($id, $panier))
        {
            unset($panier[$id]);
            $session->set('panier',$panier);
            $this->get('session')->getFlashBag()->add('success','Article supprimé avec succès');
        }

        return $this->redirect($this->generateUrl('panier'));
    }

    public function ajouterAction(Request $request,$id)
    {
        $session = $request->getSession();

        if (!$session->has('panier')) $session->set('panier',array());
        $panier = $session->get('panier');

        if (array_key_exists($id, $panier)) {
            if ($request->query->get('qte') != null) $panier[$id] = $request->query->get('qte');
            $this->get('session')->getFlashBag()->add('success','Quantité modifié avec succès');
        } else {
            if ($request->query->get('qte') != null)
                $panier[$id] = $request->query->get('qte');
            else
                $panier[$id] = 1;

            $this->get('session')->getFlashBag()->add('success','Article ajouté avec succès');
        }

        $session->set('panier',$panier);


        return $this->redirect($this->generateUrl('panier'));
    }

    public function panierAction(Request $request)
    {
        $session = $request->getSession();
        if (!$session->has('panier')) $session->set('panier', array());

        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('MyAppPIBundle:Produits')->findArray(array_keys($session->get('panier')));

        return $this->render('@MyAppPI/panier/layout/panier.html.twig', array('produits' => $produits,
            'panier' => $session->get('panier')));
    }

    public function adresseSuppressionAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MyAppPIBundle:UtilisateursAdresses')->find($id);

        if ($this->getUser() != $entity->getUtilisateur() || !$entity)
            return $this->redirect ($this->generateUrl ('livraison'));

        $em->remove($entity);
        $em->flush();

        return $this->redirect ($this->generateUrl ('livraison'));
    }
    public function livraisonAction(Request $request)
    {
        $utilisateur = $this->getUser();
        $entity = new UtilisateursAdresses();
        $form = $this->createForm(UtilisateursAdressesType::class, $entity);

        $form->handleRequest($request);
        if($form->isSubmitted()){
                $em = $this->getDoctrine()->getManager();
                $entity->setUtilisateur($utilisateur);
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('livraison'));
        }
        return $this->render('@MyAppPI/panier/layout/livraison.html.twig', array('utilisateur' => $utilisateur,
            'form' => $form->createView()));
    }

    public function setLivraisonOnSession(Request $request)
    {
        $session = $request->getSession();
        if (!$session->has('adresse')) $session->set('adresse',array());
        $adresse = $session->get('adresse');

        if ($request->get('livraison') != null && $request->get('facturation') != null)
        {
            $adresse['livraison'] = $request->get('livraison');
            $adresse['facturation'] = $request->get('facturation');
        } else {
            return $this->redirect($this->generateUrl('validation'));
        }

        $session->set('adresse',$adresse);
        return $this->redirect($this->generateUrl('validation'));
    }

    public function validationAction(Request $request)
    {
        if ($request->isMethod('POST'))
            $this->setLivraisonOnSession($request);
        $em = $this->getDoctrine()->getManager();
        $prepareCommande = $this->forward('MyAppPIBundle:Commandes:prepareCommande');
        $commande = $em->getRepository('MyAppPIBundle:Commandes')->find($prepareCommande->getContent());

        return $this->render('@MyAppPI/panier/layout/validation.html.twig', array('commande' => $commande));
    }
}
