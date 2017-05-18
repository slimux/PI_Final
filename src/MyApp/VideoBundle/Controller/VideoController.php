<?php

namespace MyApp\VideoBundle\Controller;

use DateTime;
use MyApp\VideoBundle\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * Video controller.
 *
 */
class VideoController extends Controller
{
    /**
     * Lists all video entities.
     *
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $em = $this->getDoctrine()->getManager();

        //$videos = $em->getRepository('UserBundle:Video')->findAll();
        $dql   = "SELECT a FROM MyAppVideoBundle:Video a";
        $query = $em->createQuery($dql);

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 3)/*limit per page*/
        );
        return $this->render('video/index.html.twig', array(
            'pagination' => $pagination,
            'user' => $user,
        ));
    }
    public function allAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $em = $this->getDoctrine()->getManager();

        $pagination = $em->getRepository('MyAppVideoBundle:Video')->findAll();


        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $pagination, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 50000)/*limit per page*/
        );
        return $this->render('video/index.html.twig', array(
            'pagination' => $pagination,
            'user' => $user,
        ));
    }
    public function liveAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('video/live.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * Creates a new video entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $video = new Video();
        $form = $this->createForm('MyApp\VideoBundle\Form\VideoType', $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($video);
            $em->flush($video);

            return $this->redirectToRoute('video_show', array('id' => $video->getIdVideo()));
        }


        return $this->render('video/new.html.twig', array(
            'video' => $video,
            'data' => new DateTime('now'),
            'form' => $form->createView(),
            'user' => $user,

        ));
    }

    /**
     * Finds and displays a video entity.
     *
     */
    public function showAction(Video $video)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $deleteForm = $this->createDeleteForm($video);

        return $this->render('video/show.html.twig', array(
            'video' => $video,
            'delete_form' => $deleteForm->createView(),
            'user' => $user,
        ));
    }
    public function chatadminAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('MyAppVideoBundle:admin:chatBack.html.twig', array(
            'user' => $user,
        ));
    }
    public function singleAction(Video $video)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $em = $this->getDoctrine()->getManager();
        $nbVue=$video->getNbVue();
        $video->setNbVue($nbVue+1);
        $em->persist($video);
        $em->flush();
        return $this->render('video/singleVid.html.twig', array(
            'video' => $video,
            'user' => $user,
            'nbVue' => $nbVue,
        ));
    }
    public function homevidAction(Request $request)
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $em = $this->getDoctrine()->getManager();

        //$videos = $em->getRepository('UserBundle:Video')->findAll();
        $dql   = "SELECT a FROM MyAppVideoBundle:Video a";
        $query = $em->createQuery($dql);

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 4)/*limit per page*/
        );
        return $this->render('video/home_video.html.twig', array(
            'pagination' => $pagination,
            'user' => $user,
        ));
    }

    /**
     * Displays a form to edit an existing video entity.
     *
     */
    public function editAction(Request $request, Video $video)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $deleteForm = $this->createDeleteForm($video);
        $editForm = $this->createForm('MyApp\VideoBundle\Form\VideoType', $video);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('video_edit', array('id' => $video->getIdVideo()));
        }

        return $this->render('video/edit.html.twig', array(
            'video' => $video,

            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'user' => $user,
        ));
    }

    /**
     * Deletes a video entity.
     *
     */
    public function deleteAction(Request $request, Video $video)
    {

        $form = $this->createDeleteForm($video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($video);
            $em->flush($video);
        }

        return $this->redirectToRoute('video_index');
    }

    /**
     * Creates a form to delete a video entity.
     *
     * @param Video $video The video entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Video $video)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('video_delete', array('id' => $video->getIdVideo())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function rechercheAction(Request $request)

{

$user = $this->getUser();
if (!is_object($user) || !$user instanceof UserInterface) {
throw new AccessDeniedException('This user does not have access to this section.');
}


$em = $this->getDoctrine()->getManager();
$motcle=$request->get('motcle');
    $videos = $em->getRepository('MyAppVideoBundle:Video')->findByTitre($motcle);

//  $dql   = "SELECT a FROM UserBundle:Video a";
//  $query = $em->createQuery($dql);

/**
 * @var $paginator \Knp\Component\Pager\Paginator
 */
$paginator  = $this->get('knp_paginator');
$pagination = $paginator->paginate(
    $videos, /* query NOT result */
    $request->query->getInt('page', 1)/*page number*/,
    $request->query->getInt('limit', 3)/*limit per page*/
);
return $this->render('video/home_video.html.twig', array(
    'pagination' => $pagination,
    'user' => $user,
));
}
    public function recherchevAction(Request $request)

    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $em = $this->getDoctrine()->getManager();
        $motcle=$request->get('motcle');
        $videos = $em->getRepository('MyAppVideoBundle:Video')->findByTitre($motcle);

//  $dql   = "SELECT a FROM UserBundle:Video a";
//  $query = $em->createQuery($dql);

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $videos, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 3)/*limit per page*/
        );
        return $this->render('video/index.html.twig', array(
            'pagination' => $pagination,
            'user' => $user,
        ));
    }



}
