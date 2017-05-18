<?php

namespace Esprit\GameBundle\Controller;

use Esprit\GameBundle\Entity\astuce;
use Esprit\GameBundle\Entity\Mail;
use Esprit\GameBundle\Form\AstuceAddForm;
use Esprit\GameBundle\Form\AstuceUpdateForm;
use Esprit\GameBundle\Form\MailType;
use Esprit\GameBundle\Form\rechercheAstuceForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swift_Message;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;

class AstuceController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function AjoutAstuceAction(Request $request)
    {
        $user =$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {throw new AccessDeniedException('this user does not have acces');
        }
        $astuce=new astuce();
        $Form=$this->createForm(AstuceAddForm::class, $astuce);
        $Form->handleRequest($request);
        if ($Form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($astuce);
            $em->flush();
            return $this->redirectToRoute('Afficher_Astuce');
        }
        return $this->render("EspritGameBundle:AstuceBack:AddAstuceBack.html.twig",array('form'=>$Form->createView()));
    }

    public  function  AfficheAstuceBackAction(Request $request){
        $user =$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {throw new AccessDeniedException('this user does not have acces');
        }
        $em = $this->getDoctrine()->getManager();
        $astuces =$em->getRepository("EspritGameBundle:astuce")->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $astuces, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            1/*limit per page*/);

        return $this->render("EspritGameBundle:AstuceBack:AfficherAstuceBack.html.twig",
            array("astuces"=>$pagination)
        );
    }


    public function DeleteAstuceAction($IdAstuce)
    {
        $user =$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {throw new AccessDeniedException('this user does not have acces');
        }
        $em=$this->getDoctrine()->getManager();
        $astuce=$em->getRepository("EspritGameBundle:astuce")->find($IdAstuce);
        $em->remove($astuce);
        $em->flush();
        return $this->redirectToRoute('Afficher_Astuce');

    }

    function UpdateAstuceAction(Request $request,$IdAstuce)
    {
        $user =$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {throw new AccessDeniedException('this user does not have acces');
        }
        $em=$this->getDoctrine()->getManager();
        $astuce=$em->getRepository("EspritGameBundle:astuce")->find($IdAstuce);
        $Form=$this->createForm(AstuceUpdateForm::class, $astuce);

        $Form->handleRequest($request);
        if ($Form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($astuce);
            $em->flush();
            return $this->redirectToRoute('Afficher_Astuce');

        }
        return $this->render("EspritGameBundle:AstuceBack:UpdateAstuceBack.html.twig",array('form'=>$Form->createView()));

    }




    public function detailAstuceAction(Request $request,$IdJeu){

        $em = $this->getDoctrine()->getManager();


        $jeu = $em->getRepository("EspritGameBundle:jeu")->findOneBy(array('id_Jeu' => $IdJeu));
        $astuces= $em->getRepository("EspritGameBundle:astuce")->findByJeu($jeu);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $astuces, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            1/*limit per page*/);

        return $this->render("EspritGameBundle:AstuceFront:AstuceGame.html.twig", array('astuces'=>$pagination,
            'jeu'=>$jeu));
    }


    public function RechercheAstuceAction(Request $request)
    {
        $user =$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {throw new AccessDeniedException('this user does not have acces');
        }
        $em=$this->getDoctrine()->getManager();
        $motcle=$request->get('motcle');

        $astuces =$em->getRepository("EspritGameBundle:astuce")->FindByTitleAstuce($motcle);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $astuces, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            1/*limit per page*/);


        return $this->render('EspritGameBundle:AstuceBack:RechercheAstuceback.html.twig',array('astuces'=>$pagination));
    }


    public function MailAction(Request $request)
    {
        $user =$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {throw new AccessDeniedException('this user does not have acces');
        }
        $mail = new Mail();
        $form= $this->createForm(MailType::class, $mail);
        $form->handleRequest($request) ;
        if ($form->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject('contribution pour les astuces')
                ->setFrom('slim.benyoussef@esprit.tn')
                ->setTo($mail->getEmail())
                ->setBody($mail->getText()
                );
            $this->get('mailer')->send($message);
            return $this->redirect($this->generateUrl('esprit_gamesP'));
        }
        return $this->render('EspritGameBundle:Default:indexMail.html.twig', array('form'=>$form
            ->createView()));
    }


    }