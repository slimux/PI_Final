<?php

namespace MyApp\FourumBundle\Controller;

use MyApp\FourumBundle\Entity\ForumTopics;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyApp\FourumBundle\Entity\Likedeslike;
/**
 * Forumtopic controller.
 *
 */
class ForumTopicsController extends Controller
{
    /**
     * Lists all forumTopic entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $forumTopics = $em->getRepository('MyAppFourumBundle:ForumTopics')->findAll();

        return $this->render('forumtopics/index.html.twig', array(
            'forumTopics' => $forumTopics,
        ));
    }

    /**
     * Creates a new forumTopic entity.
     *
     */
    public function newAction(Request $request)
    {
        $forumTopic = new Forumtopics();
        $form = $this->createForm('MyApp\FourumBundle\Form\ForumTopicsType', $forumTopic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($forumTopic);
            $em->flush($forumTopic);

            return $this->redirectToRoute('forumtopics_show', array('id' => $forumTopic->getIdTopics()));
        }

        return $this->render('forumtopics/new.html.twig', array(
            'forumTopic' => $forumTopic,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a forumTopic entity.
     *
     */
    public function showAction(Request $request,ForumTopics $forumTopic)
    {
        $deleteForm = $this->createDeleteForm($forumTopic);
        $deleteForm = $this->createDeleteForm($forumTopic);
        $deleteForm->handleRequest($request);
       $messages= $forumTopic->getMessage();
        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            foreach (m as $messages){
                $em->remove(m);
                $em->flush(m);
            }
            $em->remove($forumTopic);
            $em->flush($forumTopic);

            return $this->redirectToRoute('forumtopics_index');
        }

        return $this->render('forumtopics/show.html.twig', array(
            'forumTopic' => $forumTopic,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing forumTopic entity.
     *
     */
    public function editAction(Request $request, ForumTopics $forumTopic)
    {
        $deleteForm = $this->createDeleteForm($forumTopic);
        $editForm = $this->createForm('MyApp\FourumBundle\Form\ForumTopicsType',$forumTopic);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('forumtopics_edit', array('id' => $forumTopic->getIdTopics()));
        }

        return $this->render('forumtopics/edit.html.twig', array(
            'forumTopic' => $forumTopic,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a forumTopic entity.
     *
     */
    public function deleteAction(Request $request, ForumTopics $forumTopic)
    {
        $form = $this->createDeleteForm($forumTopic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($forumTopic);
            $em->flush($forumTopic);
        }

        return $this->redirectToRoute('forumtopics_index');
    }

    /**
     * Creates a form to delete a forumTopic entity.
     *
     * @param ForumTopics $forumTopic The forumTopic entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ForumTopics $forumTopic)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('forumtopics_delete', array('id' => $forumTopic->getIdTopics())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function chercherAction($request){
        $em = $this->getDoctrine()->getManager();
        if($request->isMethod('POST')){

            $forumTopics = $em->getRepository('MyAppFourumBundle:ForumTopics')->findBySujet($request->get('search'));
        }
        elseif($request->get('par')=='posteur'){
            $forumTopics = $em->getRepository('MyAppFourumBundle:ForumTopics')->findByIdCreateur($request->get('search'));
        }



    }
    public function likeAction(Request $request,ForumTopics $forumTopic){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $likes = $em->getRepository('MyAppFourumBundle:Likedeslike')->findOneBy(array('idtopic'=>$forumTopic->getIdTopics(),'idmembre'=>$user,'desliked'=>true));
        $like = new Likedeslike();
        if ($likes==null){
            $like->setIdtopic($forumTopic->getIdTopics());
            $like->setIdmembre($user);
            $like->setLiked(true);

            $em->persist($like);
            $em->flush($like);
            $forumTopic->setNblike($forumTopic->getNblike()+1);
            $em->persist($forumTopic);
            $em->flush($forumTopic);}
        else{
            $em->remove($likes);
            $em->flush($likes);
            $forumTopic->setNblike($forumTopic->getNblike()-1);
            $em->persist($forumTopic);
            $em->flush($forumTopic);
        }

        return $this->redirectToRoute('forumtopics_showt', array('id' => ($forumTopic->getIdTopics())));
    }
    public function deslikeAction(Request $request,ForumTopics $forumTopic){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $likes = $em->getRepository('MyAppFourumBundle:Likedeslike')->findOneBy(array('idtopic'=>$forumTopic->getIdTopics(),'idmembre'=>$user,'desliked'=>true));
        $like = new Likedeslike();
        if ($likes==null) {
            $like->setIdtopic($forumTopic->getIdTopics());
            $like->setIdmembre($user);
            $like->setDesliked(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($like);
            $em->flush($like);
            $forumTopic->setNbdeslike($forumTopic->getNbdeslike() + 1);
            $em->persist($forumTopic);
            $em->flush($forumTopic);
        }else{
            $em->remove($likes);
            $em->flush($likes);
            $forumTopic->setNblike($forumTopic->getNbdeslike()-1);
            $em->persist($forumTopic);
            $em->flush($forumTopic);
        }

        return $this->redirectToRoute('forumtopics_showt', array('id' => ($forumTopic->getIdTopics())));
    }
    public function modifierAction(Request $request, ForumTopics $forumTopic){
        $em=$this->getDoctrine()->getManager();

        $user = $this->getUser();

        if($request->isMethod('POST')) {
            $forumTopic->setContenu($request->get('contenu'));

            $forumTopic->setSujet($request->get('sujet'));
            $em->persist($forumTopic);
            $em->flush();
        }

        return $this->redirectToRoute('forumtopics_showt', array('id' => ($forumTopic->getIdTopics())));
    }
}
