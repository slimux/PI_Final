<?php
namespace Esprit\GameBundle\Repository;
use Doctrine\ORM\EntityRepository;
/**
 * Created by PhpStorm.
 * User: slimu
 * Date: 04/04/2017
 * Time: 06:19
 */
class AstuceRepository extends \Doctrine\ORM\EntityRepository
{
    public function FindByTitleAstuce($motcle)
    {
        $query=$this->createQueryBuilder('f')
            ->where('f.title_astuce like :title_astuce')
            ->setParameter('title_astuce',$motcle.'%')
            ->orderBy('f.title_astuce','ASC')
            ->getQuery();
        return $query->getResult();
    }
}