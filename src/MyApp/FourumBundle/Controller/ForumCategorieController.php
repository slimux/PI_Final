<?php

namespace MyApp\FourumBundle\Controller;

use MyApp\FourumBundle\Entity\ForumCategorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ObHighchartsBundleHighchartsHighchart;
use Ob\HighchartsBundle\Highcharts\Highchart;

use MyApp\FourumBundle\Entity\ForumTopics;
/**
 * Forumcategorie controller.
 *
 */
class ForumCategorieController extends Controller
{
    /**
     * Lists all forumCategorie entities.
     *
     */
    public function indexAction(Request $request )
    {$forumCategorie = new Forumcategorie();
        $form = $this->createForm('MyApp\FourumBundle\Form\ForumCategorieType', $forumCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($forumCategorie);
            $em->flush($forumCategorie);
            return $this->redirectToRoute('forumcategorie_index');
        }
        $em = $this->getDoctrine()->getManager();
        $forumCategories = $em->getRepository('MyAppFourumBundle:ForumCategorie')->findAll();
        return $this->render('forumcategorie/index.html.twig', array(
            'forumCategories' => $forumCategories,'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new forumCategorie entity.
     *
     */
    public function newAction(Request $request)
    {
        $forumCategorie = new Forumcategorie();
        $form = $this->createForm('MyApp\FourumBundle\Form\ForumCategorieType', $forumCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($forumCategorie);
            $em->flush($forumCategorie);

          return $this->redirectToRoute('forumcategorie/index.html.twig', array('id' => $forumCategorie->getIdCategorie()));
        }
        return $this->render('forumcategorie/new.html.twig', array('form' => $form->createView(),));
    }

    /**
     * Finds and displays a forumCategorie entity.
     *
     */
    public function FOCategorieAction(Request $request, ForumCategorie $forumCategorie)
    {    $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $categorie= $em->getRepository('MyAppFourumBundle:ForumCategorie')->find($forumCategorie);

        $forumTopic = new Forumtopics();
        $form = $this->createForm('MyApp\FourumBundle\Form\ForumTopicsType', $forumTopic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $forumTopic->setIdSousCategorie($categorie->getSouscategories()->getIdSousCategorie());
            $forumTopic->setDateHeureCreation(new \DateTime("now"));
            $forumTopic->setIdCreateur($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($forumTopic);
            $em->flush($forumTopic);

            return $this->redirectToRoute('forumtopics_showt', array('id' => $forumTopic->getIdTopics()));
        }
        /**
         * *@var $paginator /Knp/Component/Pager/Paginator
         */
        $paginator = $this->get('knp_paginator');
        dump(get_class($paginator));
        $pagination = $paginator->paginate($categorie->getSouscategories(), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/);

        return $this->render('MyAppFourumBundle:ForumFO:topics.html.twig', array(
            'forumTopics' => $pagination,  'categorie' => $categorie,
            'form' => $form->createView(),));

    }
    public function showAction(Request$request, ForumCategorie $forumCategorie)
    {
        $editForm = $this->createForm('MyApp\FourumBundle\Form\ForumCategorieType', $forumCategorie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('forumcategorie_show', array('id' => $forumCategorie->getIdCategorie()));
        }
        $deleteForm = $this->createDeleteForm($forumCategorie);

        return $this->render('forumcategorie/show.html.twig', array(
            'forumCategorie' => $forumCategorie,
            'delete_form' => $deleteForm->createView(),'forumCategorie' => $forumCategorie,
            'edit_form' => $editForm->createView(),
        ));
    }
    public function showSAction(ForumCategorie $forumCategorie)
    {
        $em = $this->getDoctrine()->getManager();
        $forumSousCategories = $em->getRepository('MyAppFourumBundle:ForumSousCategorie')->findByIdCategorie($forumCategorie);

        return $this->render('forumcategorie/index.html.twig', array(
            'forumSousCategories' => $forumSousCategories,

        ));
    }


    /**
     * Displays a form to edit an existing forumCategorie entity.
     *
     */
    public function editAction(Request $request, ForumCategorie $forumCategorie)
    {

        $editForm = $this->createForm('MyApp\FourumBundle\Form\ForumCategorieType', $forumCategorie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('forumcategorie_show', array('id' => $forumCategorie->getIdCategorie()));
        }

        return $this->render('forumcategorie/edit.html.twig', array(
            'forumCategorie' => $forumCategorie,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a forumCategorie entity.
     *
     */
    public function deleteAction(Request $request, ForumCategorie $forumCategorie)
    {
        $form = $this->createDeleteForm($forumCategorie);
        $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            $em->remove($forumCategorie);
            $em->flush($forumCategorie);
        return $this->redirectToRoute('forumcategorie_index');
    }

    /**
     * Creates a form to delete a forumCategorie entity.
     *
     * @param ForumCategorie $forumCategorie The forumCategorie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ForumCategorie $forumCategorie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('forumcategorie_delete', array('id' => $forumCategorie->getIdCategorie())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}