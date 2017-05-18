<?php

namespace MyApp\PIBundle\Repository;

/**
 * CommandesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommandesRepository extends \Doctrine\ORM\EntityRepository
{
    public function byFacture($utilisateur)
    {
        $qb = $this->createQueryBuilder('u')
            ->select('u')
            ->where('u.utilisateur = :utilisateur')
            ->andWhere('u.valider = 1')
            ->andWhere('u.reference != 0')
            ->orderBy('u.id')
            ->setParameter('utilisateur', $utilisateur);

        return $qb->getQuery()->getResult();
    }
}
