<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Materiel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use App\Entity\Emprunt;
use App\Entity\DemandeEmprunt;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\User;
use App\Entity\StatutDemandeEmprunt;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MobileController extends Controller
{


  /**
  * @Route("/connexionMobile", name="security_login_mobile")
  */
  public function loginMobile(Request $request,UserPasswordEncoderInterface $encoder) {

    $em = $this->getDoctrine()->getManager();

    $Reponse = [];


    if ($content = $request->getContent()) {
        $Reponse = json_decode($content, true);
    }


    $identifiant = "";
    $identifiant= $Reponse['identifiant'];
    $password = $Reponse['mdp'];

    $test = $this->getDoctrine()->getRepository(User::class)->checkUser($identifiant);
    if ($test) {

        $encoderService = $this->container->get('security.password_encoder');
        $match = $encoderService->isPasswordValid($test[0], $password);

        if ($match)
        {
          $retour = [];
          $retour['id'] = $test[0]->getId();
          $retour['email'] = $test[0]->getEmail();
          $retour['nom'] = $test[0]->getNom();
          $retour['prenom'] = $test[0]->getPrenom();
          $retour['formation'] = $test[0]->getFormation();
          $retour['username'] = $test[0]->getUsername();

          return new JsonResponse($retour);
        }
  }
    $tabvide = [];
    return new JsonResponse($tabvide);

  }


  /**
  *
  * @Route("/listeUserMobile",name="listeUserMobile")
  */
  public function userMobile()
  {
        $tabMateriel = $this->getDoctrine()->getRepository(Materiel::class)->findAll();
        $data = [];

        foreach ($tabMateriel as $unMat) {
              $ligne = [];
              $ligne['ID'] = $unMat->getId();
              $ligne['Categorie'] = $unMat->getCategorie()->getNomcat();
              $ligne['Marque'] = $unMat->getMarque()->getLibelle();
              $ligne['Description'] = $unMat->getDescription();
              $ligne['Etat'] = $unMat->getEtat()->getLibelle();
              $ligne['Provenance'] = $unMat->getProvenance();

              $data[] = $ligne;
        }

        return new JsonResponse($data);
    }


    /**
    *
    * @Route("/TestUser",name="TestUser")
    */
    public function TestUser(Request $request)
    {
          $em = $this->getDoctrine()->getManager();

          $Reponse = [];
          if ($content = $request->getContent()) {
              $Reponse = json_decode($content, true);
          }

          $idMat = $Reponse['idMateriel'];
          $idUser = $Reponse['idUser'];

          $idStatut = 0;

          // récupération User
          $repo = $this->getDoctrine()
          ->getRepository(User::class);
          $user = $repo->find($idUser);

          // récupération du matériel
          $repoMat = $this->getDoctrine()
          ->getRepository(Materiel::class);
          $mat = $repoMat->find($idMat)
          ->setStatutemprunt(true); // affectation true

          // récupération du statut
          $repoSt = $this->getDoctrine()
          ->getRepository(StatutDemandeEmprunt::class);
          $statut = $repoSt->find($idStatut);

          $demande = new DemandeEmprunt();
          $demande->setIdUser($user);
          $demande->setIdMateriel($mat);
          $demande->setStatut($statut);
          $demande->setDateDemande(new \DateTime());

          $em->persist($demande);
          $em->persist($mat);
          $em->flush();

          return new JsonResponse($Reponse);
      }
  }
