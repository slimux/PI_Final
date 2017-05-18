<?php

namespace MyApp\PIBundle\Controller;

use MyApp\PIBundle\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Category controller.
 *
 */
class UtilisateursAdminController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $utilisateurs = $em->getRepository('MyAppUserBundle:User')->findAll();

        return $this->render('@FOSUser/admin/utilisateurs/index.html.twig', array('utilisateurs' => $utilisateurs));
    }

    public function utilisateurAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('MyAppUserBundle:User')->find($id);
        $route = $this->container->get('request_stack')->getCurrentRequest()->get('_route');

        if ($route == 'adminAdressesUtilisateurs')
            return $this->render('@FOSUser/admin/utilisateurs/adresses.html.twig', array('utilisateur' => $utilisateur));
        else if ($route == 'adminFacturesUtilisateurs')
            return $this->render('@FOSUser/admin/utilisateurs/factures.html.twig', array('utilisateur' => $utilisateur));
        else
            throw $this->createNotFoundException('La vue n\'existe pas.');
    }
}
