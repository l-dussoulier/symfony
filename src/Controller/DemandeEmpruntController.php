<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


use App\Entity\DemandeEmprunt;
use App\Entity\User;
use App\Entity\Materiel;
use App\Entity\StatutDemandeEmprunt;

class DemandeEmpruntController extends Controller
{
    /**
    *
    * @Route("/DemandeEmprunt",name="DemandeEmprunt")
    */


    public function demande(Request $request, $idMat, $idUser)
    {

      $em = $this->getDoctrine()->getManager();
      //$idUser = 2;
      //$idMat = 45;
      $idStatut = 0;

      // récupération User
      $repo = $this->getDoctrine()
                   ->getRepository(User::class);
      $user = $repo->find($idUser);

      // récupération du matériel
      $repoMat = $this->getDoctrine()
                      ->getRepository(Materiel::class);
      $mat = $repoMat->find($idMat);

      // récupération du statut
      $repoSt = $this->getDoctrine()
                      ->getRepository(StatutDemandeEmprunt::class);
      $statut = $repoSt->find($idStatut);



      $demande = new DemandeEmprunt();
      $demande->setIdUser($user);
      $demande->setIdMateriel($mat);
      $demande->setStatut($statut);
      $demande->setDateDemande(new \DateTime());
      $em->flush();

      $em->persist($demande);

     // actually executes the queries (i.e. the INSERT query)
     $em->flush();

     return new Response('Test '.$demande->getId());





    }

}
