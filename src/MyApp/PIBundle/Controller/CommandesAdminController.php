<?php

namespace MyApp\PIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\PIBundle\Entity\Produits;
use MyApp\PIBundle\Entity\UtilisateursAdresses;
use MyApp\PIBundle\Entity\Commandes;
use Symfony\Component\HttpFoundation\Request;

class CommandesAdminController extends Controller
{
    public function commandesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $commandes = $em->getRepository('MyAppPIBundle:Commandes')->findAll();

        return $this->render('@FOSUser/admin/commandes/index.html.twig', array('commandes' => $commandes));
    }

    public function showFactureAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $facture = $em->getRepository('MyAppPIBundle:Commandes')->find($id);

        if (!$facture) {
            $this->get('session')->getFlashBag()->add('error', 'Une erreur est survenue');
            return $this->redirect($this->generateUrl('adminCommande'));
        }
        $this->container->get('setNewFacture')->facture($facture);
    }
}
