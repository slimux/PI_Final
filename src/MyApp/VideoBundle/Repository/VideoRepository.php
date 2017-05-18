<?php
namespace MyApp\VideoBundle\Repository;
use Doctrine\ORM\EntityRepository;

/**
 * Created by PhpStorm.
 * User: SAMSUNG
 * Date: 29/03/2017
 * Time: 23:45
 */
class VideoRepository extends \Doctrine\ORM\EntityRepository
{

public function FindByTitre($motcle)
{
    $query=$this->createQueryBuilder('f')
        ->where('f.titre like :titre')
        ->setParameter('titre', $motcle.'%')
        ->orderBy('f.titre','ASC')
        ->getQuery();
    return $query->getResult();
}
}