<?php

namespace App\Repository;

use App\Entity\VueMateriel;
use Doctrine\ORM\EntityRepository;

class MaterielRepository extends EntityRepository
{
      public function MaterielById(string $search)
      {
          $qb = $this->createQueryBuilder('q')
              ->andWhere('q.id LIKE :varr OR q.categorie LIKE :varr OR q.marque LIKE :varr OR q.description LIKE :varr')
              ->setParameter('varr', '%' . $search . '%')
              ->orderBy('q.id', 'ASC')
              ->getQuery()
              ->getResult();
          return $qb;
      }
}
