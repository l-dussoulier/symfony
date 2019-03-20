<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Materiel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use App\Entity\Emprunt;
use App\Entity\DemandeEmprunt;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\User;
use App\Entity\StatutDemandeEmprunt;


class EmpruntController extends Controller
{


/**
*
* @Route("/listeDemandeEmprunt",name="listeDemandeEmprunt")
*/
public function listeDemandeEmprunt()
{
  $objStatut = $this->getDoctrine()->getRepository(DemandeEmprunt::class)->checkIdStatutEmprunt(0);
  //$tabEmprunt = $this->getDoctrine()->getRepository(DemandeEmprunt::class)->Find($objStatut);

  return $this->render('AfficherListeDemandeEmprunt.html.twig',
  array(
    "message" => "liste des demande d'emprunt",
    "listeDemande" => $objStatut
  ));
}

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




  // mettre statut emprunt a 1

  return $this->redirectToRoute('bienvenue');





}

/**
*
* @Route("/refuser/{id}",name="refuser")
*/
public function refuser(Request $request, $id)
{
  $idStatut = 2;

  $em = $this->getDoctrine()->getManager();

  $repoSt = $this->getDoctrine()
                 ->getRepository(StatutDemandeEmprunt::class);
  $statut = $repoSt->find($idStatut);


  $action = $this->getDoctrine()
                 ->getRepository(DemandeEmprunt::class);
  $emprunt = $action->find($id)
                ->setStatut($statut);


                $mat = $emprunt->getIdMateriel()
                                ->setStatutemprunt(false);


  $em->persist($mat);
  $em->persist($emprunt);

  $em->flush();
  // mise statutEmprunt à 0


  return $this->redirectToRoute('listeDemandeEmprunt');

}
/**
* @Route("/retourEmprunt/{idEmprunt}", name="retourEmprunt")
*/
public function retourEmprunt(Request $request,$idEmprunt) // paramètre qui donnera accès aux données saisies
{
  // On crée une instance, associée au formulaire
  $emp = $this->getDoctrine()->getRepository(Emprunt::class)->find($idEmprunt);
  $idMat = $emp->getId($emp);
  $unMat = $this->getDoctrine()->getRepository(Materiel::class)->find($idMat);
  // partie "création"
  $formulaire = $this->createFormBuilder($unMat)
  ->add("etat", TextType::class, array("label"=> "Etat : ", "required"=>true))
  ->add("valider", SubmitType::class,array("label"=> "Retourner"))
  ->getForm();
  // partie "gestion de la réponse"
  $formulaire->handleRequest($request);
  // est-ce que les champs remplis ont été envoyé au serveur ?
  // si oui, on place les données dans l'instance de Joueur
  if ($formulaire->isSubmitted() && $formulaire->isValid())
  {
    // récupération des données
    $emp->setDateRetourEffectif(new \DateTime('now'));
    $unMat = $formulaire->getData();
    $unMat->setStatutemprunt(false);
    // enregistrement dans la base
    $this->getDoctrine()->getManager()->persist($unMat);
    $this->getDoctrine()->getManager()->persist($emp);
    $this->getDoctrine()->getManager()->flush();
    return $this->redirectToRoute('bienvenue');
  }
  return $this->render('retourEmprunt.html.twig',
  array(
    "formulaire" => $formulaire->createView()
  )
);
}

}