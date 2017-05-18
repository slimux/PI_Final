<?php

namespace MyApp\FourumBundle\Controller;

use MyApp\FourumBundle\Entity\ForumSousCategorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Forumsouscategorie controller.
 *
 */
class ForumSousCategorieController extends Controller
{
    /**
     * Lists all forumSousCategorie entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $forumSousCategorie = new Forumsouscategorie();
        $form = $this->createForm('MyApp\FourumBundle\Form\ForumSousCategorieType', $forumSousCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($forumSousCategorie);
            $em->flush($forumSousCategorie);

            return $this->redirectToRoute('forumsouscategorie_index', array('id' => $forumSousCategorie->getIdSousCategorie()));
        }

        $forumSousCategories = $em->getRepository('MyAppFourumBundle:ForumSousCategorie')->findAll();

        return $this->render('forumSouscategorie/index.html.twig', array(
            'forumSousCategories' => $forumSousCategories,'form' => $form->createView()
        ));
    }

    /**
     * Creates a new forumSousCategorie entity.
     *
     */
    public function newAction(Request $request)
    {
        $forumSousCategorie = new Forumsouscategorie();
        $form = $this->createForm('MyApp\FourumBundle\Form\ForumSousCategorieType', $forumSousCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($forumSousCategorie);
            $em->flush($forumSousCategorie);

            return $this->redirectToRoute('forumsouscategorie_index');
        }

        return $this->render('forumsouscategorie/new.html.twig', array(
            'forumSousCategorie' => $forumSousCategorie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a forumSousCategorie entity.
     *
     */
    public function showAction(Request $request, ForumSousCategorie $forumSousCategorie)
    {$deleteForm = $this->createDeleteForm($forumSousCategorie);
        $editForm = $this->createForm('MyApp\FourumBundle\Form\ForumSousCategorieType', $forumSousCategorie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('forumsouscategorie_show', array('id' => $forumSousCategorie->getIdSousCategorie()));
        }

        $deleteForm = $this->createDeleteForm($forumSousCategorie);

        return $this->render('forumsouscategorie/show.html.twig', array(
            'forumSousCategorie' => $forumSousCategorie,
            'delete_form' => $deleteForm->createView(), 'edit_form' => $editForm->createView(),

        ));
    }

    /**
     * Displays a form to edit an existing forumSousCategorie entity.
     *
     */
    public function editAction(Request $request, ForumSousCategorie $forumSousCategorie)
    {
        $deleteForm = $this->createDeleteForm($forumSousCategorie);
        $editForm = $this->createForm('MyApp\FourumBundle\Form\ForumSousCategorieType', $forumSousCategorie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('forumsouscategorie_edit', array('id' => $forumSousCategorie->getIdSousCategorie()));
        }

        return $this->render('forumsouscategorie/edit.html.twig', array(
            'forumSousCategorie' => $forumSousCategorie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a forumSousCategorie entity.
     *
     */
    public function deleteAction(Request $request, ForumSousCategorie $forumSousCategorie)
    {
        $form = $this->createDeleteForm($forumSousCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($forumSousCategorie);
            $em->flush($forumSousCategorie);
        }

        return $this->redirectToRoute('forumsouscategorie_index');
    }

    /**
     * Creates a form to delete a forumSousCategorie entity.
     *
     * @param ForumSousCategorie $forumSousCategorie The forumSousCategorie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ForumSousCategorie $forumSousCategorie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('forumsouscategorie_delete', array('id' => $forumSousCategorie->getIdSousCategorie())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
