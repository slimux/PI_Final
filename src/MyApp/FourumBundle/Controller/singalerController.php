<?php

namespace MyApp\FourumBundle\Controller;

use MyApp\FourumBundle\Entity\ForumMessage;
use MyApp\FourumBundle\Entity\Singaler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Singaler controller.
 *
 */
class singalerController extends Controller
{
    /**
     * Lists all singaler entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $singalers = $em->getRepository('MyAppFourumBundle:singaler')->findAll();

        return $this->render('singaler/index.html.twig', array(
            'singalers' => $singalers,
        ));
    }

    /**
     * Creates a new singaler entity.
     *
     */
    public function newAction(Request $request,ForumMessage $forumMessage) {


       // $forumMessages = $em->getRepository('MyAppFourumBundle:ForumMessage')->find($forumMessage);
        $singaler = new Singaler();
        $form = $this->createForm('MyApp\FourumBundle\Form\singalerType', $singaler);
        $form->handleRequest($request);
        $user = $this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $singaler->setIdmembre($user);
            $singaler->setIdcommentaire($forumMessage);
            $em = $this->getDoctrine()->getManager();
            $em->persist($singaler);
            $em->flush();
        }
        return $this->render('singaler/new.html.twig', array(
            'singaler' => $singaler,
            'form' => $form->createView(),
        ));
    }

    public function nbsignalerAction(Request $request, ForumMessage $forumMessage){
        $em=$this->getDoctrine()->getManager();
        $nbs= $em->getRepository('MyAppFourumBundle:Singaler')->nbsignaler($forumMessage);


        return $this->render('singaler/show.html.twig', array("nbs"=>$nbs));
    }
    public function signalerAction(Request $request, ForumMessage $forumMessage){
        $em=$this->getDoctrine()->getManager();
        $signaler=new Singaler();
        $user = $this->getUser();

        if($request->isMethod('POST')) {
            $likes = $em->getRepository('MyAppFourumBundle:Singaler')->findOneBy(array('idcommentaire'=>$forumMessage->getIdMessage(),'idmembre'=>$user));
            if ($likes==null) {
            $signaler->setIdcommentaire($forumMessage);
            $signaler->setCause($request->get('cause'));

            $signaler->setIdmembre($user);
            $em->persist($signaler);
            $em->flush();}
        }
        $nbs= $em->getRepository('MyAppFourumBundle:Singaler')->nbsignaler($forumMessage);
        if($nbs==2) {$em->remove($forumMessage);
        $em->flush($forumMessage);}
        $forumTopics = $em->getRepository('MyAppFourumBundle:ForumTopics')->find($forumMessage->getIdTopics());
        return $this->redirectToRoute('forumtopics_showt', array('id' => ($forumTopics->getIdTopics())));
    }
    /**
     * Finds and displays a singaler entity.
     *
     */
    public function showAction(singaler $singaler)
    {
        $deleteForm = $this->createDeleteForm($singaler);

        return $this->render('singaler/show.html.twig', array(
            'singaler' => $singaler,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing singaler entity.
     *
     */
    public function editAction(Request $request, singaler $singaler)
    {
        $deleteForm = $this->createDeleteForm($singaler);
        $editForm = $this->createForm('MyApp\FourumBundle\Form\singalerType', $singaler);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('singaler_edit', array('id' => $singaler->getId()));
        }

        return $this->render('singaler/edit.html.twig', array(
            'singaler' => $singaler,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a singaler entity.
     *
     */
    public function deleteAction(Request $request, singaler $singaler)
    {
        $form = $this->createDeleteForm($singaler);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($singaler);
            $em->flush();
        }

        return $this->redirectToRoute('singaler_index');
    }

    /**
     * Creates a form to delete a singaler entity.
     *
     * @param singaler $singaler The singaler entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(singaler $singaler)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('singaler_delete', array('id' => $singaler->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}
