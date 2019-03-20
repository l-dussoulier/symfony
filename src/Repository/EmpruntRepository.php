<?php

namespace App\Repository;

use App\Entity\Materiel;
use App\Entity\DemandeEmprunt;
use Doctrine\ORM\EntityRepository;

class EmpruntRepository extends EntityRepository
{

  public function checkIdStatutEmprunt(int $statut)
  {
    $qb = $this->createQueryBuilder('q')
        ->andWhere('q.statut = :statut')
        ->setParameter('statut', $statut)
        ->orderBy('q.id', 'ASC')
        ->getQuery()
        ->getResult();

    return $qb;
  }

}
