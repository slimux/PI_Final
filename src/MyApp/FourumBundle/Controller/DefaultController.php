<?php

namespace MyApp\FourumBundle\Controller;
use MyApp\FourumBundle\Entity\ForumCategorie;
use MyApp\FourumBundle\Entity\ForumSousCategorie;
use MyApp\FourumBundle\Entity\ForumTopics;
use MyApp\FourumBundle\Entity\ForumMessage;
use MyApp\FourumBundle\Entity\Singaler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Zend\Json\Expr;

class DefaultController extends Controller
{public function FOAction()
{

    return $this->render('MyAppFourumBundle:ForumFO:FO.html.twig');

}
    public function BOAction()
    {

        return $this->render('MyAppFourumBundle:ForumFO:BO.html.twig');

    }

    public function chartLineAction()     {
        $em = $this->container->get('doctrine')->getEntityManager();
        $topics = $em->getRepository('MyAppFourumBundle:ForumTopics')->findBy(array(),array('nbvue'=>'desc'),20,0);
        $tab = array();
        $categories = array();
        foreach ($topics as $topic) {array_push($tab, $topic->getNbVue());
            array_push($categories, $topic->getIdTopics());
        }

        // Chart
        $series = array(array("name" => "topic", "data" => $tab));
        $ob = new Highchart();
        $ob->chart->renderTo('linechart');#id du div où afficher le graphe
        $ob->title->text('Nombre de vue');
        $ob->xAxis->title(array('text' => "sujets"));
        $ob->yAxis->title(array('text' => "Nbs vues "));
        $ob->xAxis->categories($categories);
        $ob->series($series);

        return $this->render('MyAppFourumBundle:ForumFO:LineChart.html.twig', array( 'chart' => $ob ));
    }
    public function indexBOAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $forumCategories = $em->getRepository('MyAppFourumBundle:ForumCategorie')->findBy(array(),array('idCategorie'=>'desc'),5,0);
        $forumSousCategories = $em->getRepository('MyAppFourumBundle:ForumSousCategorie')->findBy(array(),array('idSousCategorie'=>'desc'),5,0);
        $forumTopics = $em->getRepository('MyAppFourumBundle:ForumTopics')->findAll(array(),array('idTpics'=>'asc'),2,1);

        return $this->render(':default:index.html.twig', array(
            'forumCategories' => $forumCategories,   'forumSousCategories' => $forumSousCategories,
            'forumTopics' => $forumTopics));
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $forumTopics = $em->getRepository('MyAppFourumBundle:ForumTopics')->findAll();
        $forumSousCategories = $em->getRepository('MyAppFourumBundle:ForumSousCategorie')->findAll();
        return $this->render('MyAppFourumBundle:ForumFO:Topics.html.twig', array(
            'forumTopics' => $forumTopics, 'forumSousCategories' => $forumSousCategories));

    }

    public function CategorieAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $forumTopics = $em->getRepository('MyAppFourumBundle:ForumTopics')->findAll();
        $forumSousCategories = $em->getRepository('MyAppFourumBundle:ForumSousCategorie')->findAll();
        $forumCategories = $em->getRepository('MyAppFourumBundle:ForumCategorie')->findAll();
        $nb = count($forumTopics);$result=$em->getRepository('MyAppFourumBundle:ForumTopics')->findBy( array(),array('nbvue'=>'desc'),10,0);

        return $this->render('MyAppFourumBundle:ForumFO:Categorie.html.twig', array('forumCategories' => $forumCategories,
            'forumSousCategories' => $forumSousCategories, 'n' => $nb,'topic'=>$result));

    }
    public function topicAction(ForumTopics $forumTopic, Request $request)
    {  $em = $this->getDoctrine()->getManager();
        $nbvuei=$forumTopic->getNbvue();
        $forumTopic->setNbvue($nbvuei+1);
        $em->persist($forumTopic);
        $em->flush();
        $forumMessage = new Forummessage();
        $form = $this->createForm('MyApp\FourumBundle\Form\ForumMessageType', $forumMessage);
        $form->handleRequest($request);
        $user = $this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $forumMessage->setDateHeureCreation(new \DateTime("now"));
            $forumMessage->setIdPosteur($user);
            $forumMessage->setIdTopics($forumTopic);
            $em->persist($forumMessage);
            $em->flush($forumMessage);
            return $this->redirectToRoute('forumtopics_showt', array('id' => $forumTopic->getIdTopics()));
        }

        $editForm = $this->createForm('MyApp\FourumBundle\Form\ForumMessageType', $forumMessage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('forummessage_edit', array('id' => $forumMessage->getIdMessage()));
        }




        $forumSousCategories = $em->getRepository('MyAppFourumBundle:ForumSousCategorie')->findAll();
        $forumCategories = $em->getRepository('MyAppFourumBundle:ForumCategorie')->findAll();
       $forumMessages = $em->getRepository('MyAppFourumBundle:ForumMessage')->findByIdTopics($forumTopic);

        return $this->render('MyAppFourumBundle:ForumFO:topic.html.twig', array(
            'forumTopic' => $forumTopic, 'forumCategories' => $forumCategories,
            'forumSousCategories' => $forumSousCategories, 'forumMessage' => $forumMessages,
            'form' => $form->createView(),'edit_form' => $editForm->createView(),
            ));
    }

    public function topicscAction(ForumSousCategorie $forumSousCategorie, Request $request)
    {

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $forumTopics = $em->getRepository('MyAppFourumBundle:ForumTopics')->findByidSousCategorie($forumSousCategorie);
        $forumSousCategories = $em->getRepository('MyAppFourumBundle:ForumSousCategorie')->find($forumSousCategorie);

        $forumTopic = new Forumtopics();
        $form = $this->createForm('MyApp\FourumBundle\Form\ForumTopicsType', $forumTopic);
        $form->handleRequest($request);
if($request->isMethod('POST')) {

    $forumTopics = $em->getRepository('MyAppFourumBundle:ForumTopics')->findBySujet($request->get('search'));


}
        if ($form->isSubmitted() && $form->isValid()) {
            $forumTopic->setIdSousCategorie($forumSousCategorie);
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
        $pagination = $paginator->paginate($forumTopics, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/);

        return $this->render('MyAppFourumBundle:ForumFO:topicsc.html.twig', array(
            'forumTopics' => $pagination, 'forumSousCategories' => $forumSousCategories, 'forumTopic' => $forumTopic,
            'form' => $form->createView()));

    }

    private function createDeleteForm(ForumMessage $forumMessage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('forummessage_delete', array('id' => $forumMessage->getIdMessage())))
            ->setMethod('DELETE')
            ->getForm();
    }

    public function deleteAction(Request $request, ForumMessage $forumMessage)
    {
        $form = $this->createDeleteForm($forumMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($forumMessage);
            $em->flush($forumMessage);
        }
        return $this->redirectToRoute('forumtopics_showt', array('id' => $forumMessage->getIdTopics()));

    }

    public function supprimerAction(ForumMessage $forumMessage)
    {
        $em = $this->getDoctrine()->getManager();
        $model = $em->getRepository('MyAppFourumBundle:ForumMessage')->find($forumMessage);
        $em->remove($forumMessage);
        $em->flush();
        $forumTopics = $em->getRepository('MyAppFourumBundle:ForumTopics')->find($model->getIdTopics());
        return $this->redirectToRoute('forumtopics_showt', array('id' => ($forumTopics->getIdTopics())));
    }

    public function editAction(Request $request, ForumMessage $forumMessage)
    {
        $deleteForm = $this->createDeleteForm($forumMessage);
        $editForm = $this->createForm('MyApp\FourumBundle\Form\ForumMessageType', $forumMessage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('forummessage_edit', array('id' => $forumMessage->getIdMessage()));
        }
    }
}