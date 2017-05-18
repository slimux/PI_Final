<?php

namespace MyApp\PIBundle\Controller;

use MyApp\PIBundle\Entity\Serveur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Serveur controller.
 *
 */
class ServeurAdminController extends Controller
{
    /**
     * Lists all serveur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $serveurs = $em->getRepository('MyAppPIBundle:Serveur')->findAll();

        return $this->render('@FOSUser/admin/serveur/index.html.twig', array(
            'serveurs' => $serveurs,
        ));
    }

    /**
     * Creates a new serveur entity.
     *
     */
    public function newAction(Request $request)
    {
        $serveur = new Serveur();
        $form = $this->createForm('MyApp\PIBundle\Form\ServeurType', $serveur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($serveur);
            $em->flush();

            return $this->redirectToRoute('serveur_show', array('idServeur' => $serveur->getIdserveur()));
        }

        return $this->render('@FOSUser/admin/serveur/new.html.twig', array(
            'serveur' => $serveur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a serveur entity.
     *
     */
    public function showAction(Serveur $serveur)
    {
        $deleteForm = $this->createDeleteForm($serveur);

        return $this->render('@FOSUser/admin/serveur/show.html.twig', array(
            'serveur' => $serveur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing serveur entity.
     *
     */
    public function editAction(Request $request, Serveur $serveur)
    {
        $deleteForm = $this->createDeleteForm($serveur);
        $editForm = $this->createForm('MyApp\PIBundle\Form\ServeurType', $serveur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('serveur_edit', array('idServeur' => $serveur->getIdserveur()));
        }

        return $this->render('@FOSUser/admin/serveur/edit.html.twig', array(
            'serveur' => $serveur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a serveur entity.
     *
     */
    public function deleteAction(Request $request, Serveur $serveur)
    {
        $form = $this->createDeleteForm($serveur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($serveur);
            $em->flush();
        }

        return $this->redirectToRoute('serveur_index');
    }

    /**
     * Creates a form to delete a serveur entity.
     *
     * @param Serveur $serveur The serveur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Serveur $serveur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('serveur_delete', array('idServeur' => $serveur->getIdserveur())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
