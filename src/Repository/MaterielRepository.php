<?php

namespace App\Repository;

use App\Entity\Materiel;
use App\Entity\DemandeEmprunt;
use Doctrine\ORM\EntityRepository;

class MaterielRepository extends EntityRepository
{

  public function CheckStatut(bool $statut)
  {
    $qb = $this->createQueryBuilder('q')
        ->andWhere('q.statutemprunt = :statut')
        ->setParameter('statut', $statut)
        ->orderBy('q.id', 'ASC')
        ->getQuery()
        ->getResult();

    return $qb;
  }

  // trier les demande emprunt qui sont refuser
  public function StatById(int $statut)
  {
    $qb = $this->createQueryBuilder('q')
        ->andWhere('q.statut = :statut')
        ->setParameter('statut', $statut)
        ->orderBy('q.id', 'ASC')
        ->getQuery()
        ->getResult();

    return $qb;
  }


  public function MaterielById(string $search, int $idMarque, int $idCategorie)
  {

      if(($idMarque != "-1") && ($idCategorie != "-1")){
        $qb = $this->createQueryBuilder('q')
            ->join('q.categorie', 'c')
            ->join('q.marque', 'm')
            ->andWhere('m.id = :idMarque')
            ->setParameter('idMarque', $idMarque)
            ->andWhere('c.id = :idCategorie')
            ->setParameter('idCategorie', $idCategorie)
            ->andWhere('q.id LIKE :varr OR c.nomcat LIKE :varr OR m.libelle LIKE :varr OR q.description LIKE :varr')
            ->setParameter('varr', '%' . $search . '%')
            ->orderBy('q.id', 'ASC')
            ->getQuery()
            ->getResult();
        return $qb;
      }

      if($idMarque != "-1"){
        $qb = $this->createQueryBuilder('q')
            ->join('q.categorie', 'c')
            ->join('q.marque', 'm')
            ->andWhere('m.id = :idMarque')
            ->setParameter('idMarque', $idMarque)
            ->andWhere('q.id LIKE :varr OR c.nomcat LIKE :varr OR m.libelle LIKE :varr OR q.description LIKE :varr')
            ->setParameter('varr', '%' . $search . '%')
            ->orderBy('q.id', 'ASC')
            ->getQuery()
            ->getResult();
        return $qb;
      }

      if($idCategorie != "-1"){
        $qb = $this->createQueryBuilder('q')
            ->join('q.categorie', 'c')
            ->join('q.marque', 'm')
            ->andWhere('c.id = :idCategorie')
            ->setParameter('idCategorie', $idCategorie)
            ->andWhere('q.id LIKE :varr OR c.nomcat LIKE :varr OR m.libelle LIKE :varr OR q.description LIKE :varr')
            ->setParameter('varr', '%' . $search . '%')
            ->orderBy('q.id', 'ASC')
            ->getQuery()
            ->getResult();
        return $qb;
      }

      $qb = $this->createQueryBuilder('q')
          ->join('q.categorie', 'c')
          ->join('q.marque', 'm')
          ->andWhere('q.id LIKE :varr OR c.nomcat LIKE :varr OR m.libelle LIKE :varr OR q.description LIKE :varr')
          ->setParameter('varr', '%' . $search . '%')
          ->orderBy('q.id', 'ASC')
          ->getQuery()
          ->getResult();
      return $qb;
  }
}
