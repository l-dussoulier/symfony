<?php

namespace App\Repository;

use App\Entity\Materiel;
use App\Entity\DemandeEmprunt;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Emprunt;

class EmpruntRepository extends EntityRepository
{
 // verifie l'état de statut
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

  // verifie si dateRetoruEffectif est non Nul
  public function DateEffectifNull(bool $b)
  {
    if($b){
      $qb = $this->createQueryBuilder('q')
          ->andWhere('q.dateretoureffectif IS NULL')
          ->orderBy('q.idemprunt', 'ASC')
          ->getQuery()
          ->getResult();

      return $qb;
    }

    $qb = $this->createQueryBuilder('q')
        ->andWhere('q.dateretoureffectif IS NOT NULL')
        ->orderBy('q.idemprunt', 'ASC')
        ->getQuery()
        ->getResult();

    return $qb;
    // a finir

}

    // verifie si dateRetoruEffectif est non Nul et id d'utilisateur
    public function DateEffectifNull_IdUser(bool $b, int $id)
    {
      if($b){
        $qb = $this->createQueryBuilder('q')
            ->andWhere('q.dateretoureffectif IS NULL')
            ->andWhere('q.idUser = :id')
            ->setParameter('id', $id)
            ->orderBy('q.idemprunt', 'ASC')
            ->getQuery()
            ->getResult();

        return $qb;
      }

      $qb = $this->createQueryBuilder('q')
          ->andWhere('q.dateretoureffectif IS NOT NULL')
          ->andWhere('q.idUser = :id')
          ->setParameter('id', $id)
          ->orderBy('q.idemprunt', 'ASC')
          ->getQuery()
          ->getResult();

      return $qb;
      // a finir
    }

}
