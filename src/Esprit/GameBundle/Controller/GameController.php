<?php

namespace Esprit\GameBundle\Controller;

use Esprit\GameBundle\Entity\jeu;
use Esprit\GameBundle\Form\GameAddForm;
use Esprit\GameBundle\Form\GameUpdateForm;
use Esprit\GameBundle\Form\rechercheGameForm;
use Esprit\GameBundle\Form\rechercheJeuForm;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Ob\HighchartsBundle\Highcharts\Highchart;

class GameController extends Controller
{
    public function AffichageJeuAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $jeux=$em->getRepository("EspritGameBundle:jeu")->findAll();
        $dql   = "SELECT a FROM EspritGameBundle:jeu a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/);


        return $this->render('EspritGameBundle:Game:product.html.twig', array(
            'jeux' => $pagination,
        ));
    }



    public function detailGameAction($id_jeu){

        $em = $this->getDoctrine()->getManager();
        $jeu = $em->getRepository("EspritGameBundle:jeu")->findOneBy(array('id_Jeu' => $id_jeu));
        $view= $em->getRepository("EspritGameBundle:Views")->findOneBy(array(
            'jeu' => $id_jeu
        ));
        $views = $view->getView();
        $view->setView($views + 1);
        $em->persist($view);
        $em->flush();
        return$this->render('EspritGameBundle:Game:single.html.twig',array('view'=>$view,"jeux"=>$jeu));
    }

    public function AffichageJeuBackAction(Request $request)

    {
        $em=$this->getDoctrine()->getManager();
        if ($_GET!=null){
            $x=$_GET['x'];

            $jeux=$em->getRepository("EspritGameBundle:jeu")->FindByTitre($x);
            return $this->render('EspritGameBundle:GameBack:ajaxSearch.html.twig', array(
                'jeux' => $jeux,
            ));
        } else
        $jeux=$em->getRepository("EspritGameBundle:jeu")->findAll();


        return $this->render('EspritGameBundle:GameBack:ListGameBack.html.twig', array(
            'jeux' => $jeux,
        ));
    }

    function AddgameBackAction(\Symfony\Component\HttpFoundation\Request $request)
    {   $user =$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {throw new AccessDeniedException('this user does not have acces');
        }
        $jeu=new jeu();
        $Form=$this->createForm(GameAddForm::class, $jeu);
        $Form->handleRequest($request);
        if ($Form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($jeu);
            $em->flush();
            return $this->redirectToRoute('afficheJeu');
        }
        return $this->render("EspritGameBundle:GameBack:AddGameBack.html.twig",array('form'=>$Form->createView()));
    }

    public function DeleteGameAction($IdJeu)
    { $user =$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {throw new AccessDeniedException('this user does not have acces');
        }
        $em=$this->getDoctrine()->getManager();
        $jeu=$em->getRepository("EspritGameBundle:jeu")->find($IdJeu);
        $em->remove($jeu);
        $em->flush();
        return $this->redirectToRoute('afficheJeu');

    }



    function UpdateGameAction(\Symfony\Component\HttpFoundation\Request $request,$IdJeu)
    {  $user =$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {throw new AccessDeniedException('this user does not have acces');
        }
        $em=$this->getDoctrine()->getManager();
        $jeu=$em->getRepository("EspritGameBundle:jeu")->find($IdJeu);
        $Form=$this->createForm(GameUpdateForm::class, $jeu);

        $Form->handleRequest($request);
        if ($Form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($jeu);
            $em->flush();
            return $this->redirectToRoute('afficheJeu');

        }
        return $this->render("EspritGameBundle:GameBack:updateGame.html.twig",array('form'=>$Form->createView()));

    }


    public function RechercheGameAction(\Symfony\Component\HttpFoundation\Request $request)
    {   $user =$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {throw new AccessDeniedException('this user does not have acces');
        }
        $em=$this->getDoctrine()->getManager();
        $motcle=$request->get('motcle');

        $jeux =$em->getRepository("EspritGameBundle:jeu")->FindByTitre($motcle);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $jeux, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/);


        return $this->render("EspritGameBundle:GameBack:RechercheGameback.html.twig",array('jeux'=>$pagination));
    }



    public function chartPieAction()
    {  $user =$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {throw new AccessDeniedException('this user does not have acces');
        }


        $em = $this->getDoctrine()->getManager();

        $genre1 = 0;
        $genre2 = 0;
        $genre3 = 0;
        $genre4 = 0;
        $genre5 = 0;
        $genre6 = 0;
        $genre7 = 0;

        $jeu = $em->getRepository('EspritGameBundle:jeu') ->findAll();
        foreach ($jeu as $j) {
            if ($j->getGenre()=="Action" )

            {
                $genre1++;

            }
            else if ($j->getGenre()=="Combat" )

            {
                $genre2++;
            }
            else if ($j->getGenre()=="Beat them all" )

            {
                $genre3++;
            }
            else if ($j->getGenre()=="Plates-formes" )

            {
                $genre4++;
            }
            else if ($j->getGenre()=="Action-aventure" )

            {
                $genre5++;
            }
            else if ($j->getGenre()=="Jeu de rôle" )

            {
                $genre6++;
            }
            else if ($j->getGenre()=="Aventure" )

            {
                $genre7++;
            }


        }
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('les differents genre de jeu');
        $ob->plotOptions->pie(array(
            'allowPointSelect' => false,
            'cursor' => 'pointer',
            'dataLabels' => array('enabled' => false),
            'showInLegend' => true
        ));
        $data = array(
            array('Action', $genre1),
            array('Combat', $genre2),
            array('Beat them all', $genre3),
            array('Plates-formes', $genre4),
            array('Action-aventure', $genre5),
            array('Jeu de rôle', $genre6),
            array('Aventure', $genre7),

        );
        $ob->series(array(array('type' => 'pie', 'name' =>
            'Nombre de jeux', 'data' => $data)));
        return $this->render('EspritGameBundle:GameBack:pie.html.twig', array(
            'chart' => $ob,
        ));

    }





    public function gamebackAction()
    {
        return $this->render('EspritGameBundle:GameBack:ListGameBack.html.twig');
    }

    public function gamedashAction()
    {
        return $this->render('EspritGameBundle:GameBack:Dashboard.html.twig');
    }



}
