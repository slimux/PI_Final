<?php
namespace Esprit\GameBundle\Repository;
use Doctrine\ORM\EntityRepository;
/**
 * Created by PhpStorm.
 * User: slimu
 * Date: 04/04/2017
 * Time: 06:19
 */
class GameRepository extends \Doctrine\ORM\EntityRepository
{
 public function FindByTitre($motcle)
 {
     $query=$this->createQueryBuilder('f')
         ->where('f.titre like :titre')
         ->setParameter('titre',$motcle.'%')
         ->orderBy('f.titre','ASC')
         ->getQuery();
     return $query->getResult();
 }
}