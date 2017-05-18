<?php

namespace MyApp\FourumBundle\Controller;

use MyApp\FourumBundle\Entity\Likedeslike;
use MyApp\FourumBundle\Entity\ForumMessage;
use MyApp\FourumBundle\Entity\Singaler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Forummessage controller.
 *
 */
class ForumMessageController extends Controller
{
    /**
     * Lists all forumMessage entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $forumMessages = $em->getRepository('MyAppFourumBundle:ForumMessage')->findAll();

        return $this->render('forummessage/index.html.twig', array(
            'forumMessages' => $forumMessages,
        ));
    }

    /**
     * Creates a new forumMessage entity.
     *
     */
    public function newAction(Request $request)
    {
        $forumMessage = new Forummessage();
        $form = $this->createForm('MyApp\FourumBundle\Form\ForumMessageType', $forumMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($forumMessage);
            $em->flush($forumMessage);

            return $this->redirectToRoute('forummessage_show', array('id' => $forumMessage->getIdMessage()));
        }

        return $this->render('forummessage/new.html.twig', array(
            'forumMessage' => $forumMessage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a forumMessage entity.
     *
     */
    public function showAction(ForumMessage $forumMessage)
    {
        $deleteForm = $this->createDeleteForm($forumMessage);

        return $this->render('forummessage/show.html.twig', array(
            'forumMessage' => $forumMessage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing forumMessage entity.
     *
     */
    public function editAction(Request $request, ForumMessage $forumMessage)
    {



        $editForm = $this->createForm('MyApp\FourumBundle\Form\ForumMessageType', $forumMessage);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($forumMessage);
            $em->flush($forumMessage);
        }
        return $this->render('forummessage/edit.html.twig', array('edit_form' => $editForm->createView()));
    }
    public function modifierAction(Request $request, ForumMessage $forumMessage){
        $em=$this->getDoctrine()->getManager();
        $signaler=new Singaler();
        $user = $this->getUser();

        if($request->isMethod('POST')) {
            $forumMessage->setContenu($request->get('message'));


            $em->persist($forumMessage);
            $em->flush();
        }

        $forumTopics = $em->getRepository('MyAppFourumBundle:ForumTopics')->find($forumMessage->getIdTopics());
        return $this->redirectToRoute('forumtopics_showt', array('id' => ($forumTopics->getIdTopics())));
    }



    /**
     * Deletes a forumMessage entity.
     *
     */
    public function deleteAction(Request $request, ForumMessage $forumMessage)
    {
        $form = $this->createDeleteForm($forumMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($forumMessage);
            $em->flush($forumMessage);
        }

        return $this->redirectToRoute('forummessage_index');
    }

    /**
     * Creates a form to delete a forumMessage entity.
     *
     * @param ForumMessage $forumMessage The forumMessage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ForumMessage $forumMessage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('forummessage_delete', array('id' => $forumMessage->getIdMessage())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function likeAction(Request $request,ForumMessage $forumMessage){
         $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $likes = $em->getRepository('MyAppFourumBundle:Likedeslike')->findOneBy(array('idcommentaire'=>$forumMessage->getIdMessage(),'idmembre'=>$user,'liked'=>true));
        $like = new Likedeslike();
if ($likes==null){
        $like->setIdcommentaire($forumMessage->getIdMessage());
        $like->setIdmembre($user);
        $like->setLiked(true);

        $em->persist($like);
        $em->flush($like);
        $forumMessage->setNblike($forumMessage->getNblike()+1);
        $em->persist($forumMessage);
        $em->flush($forumMessage);}
        else{
            $em->remove($likes);
            $em->flush($likes);
            $forumMessage->setNblike($forumMessage->getNblike()-1);
            $em->persist($forumMessage);
            $em->flush($forumMessage);
        }
        $forumTopics = $em->getRepository('MyAppFourumBundle:ForumTopics')->find($forumMessage->getIdTopics());
        return $this->redirectToRoute('forumtopics_showt', array('id' => ($forumTopics->getIdTopics())));
    }
    public function deslikeAction(Request $request,ForumMessage $forumMessage){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $likes = $em->getRepository('MyAppFourumBundle:Likedeslike')->findOneBy(array('idcommentaire'=>$forumMessage->getIdMessage(),'idmembre'=>$user,'desliked'=>true));
        $like = new Likedeslike();
        if ($likes==null) {
            $like->setIdcommentaire($forumMessage->getIdMessage());
            $like->setIdmembre($user);
            $like->setDesliked(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($like);
            $em->flush($like);
            $forumMessage->setNbdeslike($forumMessage->getNbdeslike() + 1);
            $em->persist($forumMessage);
            $em->flush($forumMessage);
        }else{
            $em->remove($likes);
            $em->flush($likes);
            $forumMessage->setNblike($forumMessage->getNbdeslike()-1);
            $em->persist($forumMessage);
            $em->flush($forumMessage);
        }
        $forumTopics = $em->getRepository('MyAppFourumBundle:ForumTopics')->find($forumMessage->getIdTopics());
        return $this->redirectToRoute('forumtopics_showt', array('id' => ($forumTopics->getIdTopics())));
    }

}
