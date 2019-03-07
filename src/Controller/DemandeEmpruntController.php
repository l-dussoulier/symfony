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
    * @Route("/DemandeEmprunt/{id}",name="DemandeEmprunt")
    */


    public function demande(Request $request, $id)
    {


      $em = $this->getDoctrine()->getManager();
      $usr = $this->get('security.token_storage')->getToken()->getUser()->getId();
      $idUser = $usr;
      $idMat = $id;
      $idStatut = 0;

      // récupération User
      $repo = $this->getDoctrine()
                   ->getRepository(User::class);
      $user = $repo->find($idUser);

      // récupération du matériel
      $repoMat = $this->getDoctrine()
                      ->getRepository(Materiel::class);
      $mat = $repoMat->find($idMat)
                      ->setStatutemprunt(true);


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
      $em->persist($mat);

    // mettre statut emprunt a 1

       return $this->redirectToRoute('bienvenue');





    }

}
