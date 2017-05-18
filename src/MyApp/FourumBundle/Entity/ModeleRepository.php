<?php
/**
 * Created by PhpStorm.
 * User: Khaoula
 * Date: 28/03/2017
 * Time: 15:30
 */

namespace MyApp\FourumBundle\Entity;


use Doctrine\ORM\EntityRepository;

class ModeleRepository extends EntityRepository
{
    public function counter(ForumTopics $forumTopic){

        $query=$this->getEntityManager()->createQuery('SELECT m FROM MyAppFourumBundle:ForumTopics m WHERE m.idTopics = :num ') ->setParameter('num', $forumTopic);
        $topic=$query->getSingleResult();
        $nbvuei=($forumTopic->getNbvue());
        $nbvue=$forumTopic->setNbvue($nbvuei+1);

        $query1= $this->getEntityManager() ->createQuery('UPDATE MyAppFourumBundle:ForumTopics m SET  m.nbvue= :nb WHERE m.idTopics = :idModele');
        $query1->setParameter('nb',$nbvue );
        $query1->setParameter('idModele', $forumTopic); $query->execute();

    }

    public function nbsignaler($commentaire)
    {

        $query= $this->getEntityManager()->createQuery('SELECT COUNT(m.idcommentaire) FROM MyAppFourumBundle:Singaler m WHERE m.idcommentaire = :num')->setParameter('num', $commentaire);
        $nbs= $query->getSingleScalarResult();
        return $nbs;
    }


        public function supp($commentaire){

        $query= $this->getEntityManager()-> createQuery('DELETE MyAppFourumBundle:ForumMessage m WHERE m.idMessage = :idModele');
        $query->setParameter('idModele', '$commentaire');
        $query->execute();
    }
    public function findtopicbysujet($sujet){
        $query=$this->getEntityManager()->createQuery('SELECT m FROM MyAppFourumBundle:ForumTopics m WHERE m.sujet = :num ') ->setParameter('num', $sujet);
        return $query->getResult();
    }
    public function findtopicByPosteur($posteur){
        $query=$this->getEntityManager()->createQuery('SELECT m FROM MyAppFourumBundle:ForumTopics m WHERE m.idPosteur = :num ') ->setParameter('num', $posteur);
        return $query->getResult();
    }

    }

