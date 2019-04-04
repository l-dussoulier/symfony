<?php

namespace App\Repository;

use App\Entity\Materiel;
use App\Entity\DemandeEmprunt;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Emprunt;

class MobileRepository extends EntityRepository
{
 // verifie l'état de statut
  public function checkConnexion(string $identifiant, string $password)
  {


    $qb = $this->createQueryBuilder('q')
        ->andWhere('q.email = :identifiant')
        ->setParameter('identifiant', $identifiant)
        ->andWhere('q.password = :pass')
        ->setParameter('pass', $password)
        ->getQuery()
        ->getResult();

    return $qb;
  }


  public function checkUser(string $identifiant)
  {
    $qb = $this->createQueryBuilder('q')
        ->andWhere('q.email = :identifiant')
        ->setParameter('identifiant', $identifiant)
        ->getQuery()
        ->getResult();

    return $qb;
  }



}
