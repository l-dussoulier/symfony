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


class EmpruntController extends Controller
{


  /**
  *
  * @Route("/listeDemandeEmprunt",name="listeDemandeEmprunt")
  * @Security("has_role('ROLE_ADMIN')")
  */
  public function listeDemandeEmprunt()
  {
    $objStatut = $this->getDoctrine()->getRepository(DemandeEmprunt::class)->checkIdStatutEmprunt(0);

    return $this->render('Emprunt/ListeDemandeEmprunt.html.twig',
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
  * @Security("has_role('ROLE_ADMIN')")
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
  *
  * @Route("/ValiderRetourEmprunt/{id}",name="ValiderRetourEmprunt")
  * @Security("has_role('ROLE_ADMIN')")
  */
  public function ValiderRetourEmprunt(Request $request, $id)
  {

        $unEmprunt = $this->getDoctrine()->getRepository(Emprunt::class)->find($id)
                                         ->setDateRetourEffectif(new \DateTime('now'));

        $formulaire = $this->createFormBuilder($unEmprunt)
            ->add('idUser', EntityType::class, array(
                  'class' => User::class,
                  'choice_label' => 'username'))
            ->add('idMateriel', EntityType::class, array(
                  'class' => Materiel::class,
                  'choice_label' => 'description' ))
            ->add("DatePret", DateType::class, array("label"=> "Date du prêt : "))
            ->add("DateRetourDemander", DateType::class, array("label"=> "Date de retour demendé : "))
            ->add("dateRetourEffectif", DateType::class, array("label"=> "Date de retour effectif : "))
            ->add('Incident', TextareaType::class, array("label"=> "Incidents : ", "required"=>true))
            ->add("valider", SubmitType::class,array("label"=> "Valider le retour"))
            ->getForm();

       // partie "gestion de la réponse"
       $formulaire->handleRequest($request);

       // est-ce que les champs remplis ont été envoyé au serveur ?
       // si oui, on place les données dans l'instance
       if ($formulaire->isSubmitted() && $formulaire->isValid())
       {
           // récupération des données
            $unEmprunt = $formulaire->getData();

            $Mat = $unEmprunt->getIdMateriel();
            $Mat->setStatutEmprunt(0);

           $this->getDoctrine()->getManager()->persist($unEmprunt);
           $this->getDoctrine()->getManager()->persist($Mat);
           $this->getDoctrine()->getManager()->flush();

           return $this->redirectToRoute('listeEmpruntsEnCours');
       }

       return $this->render('Emprunt/RetourMaterielFormulaire.html.twig',
               array(
                   "formulaire" => $formulaire->createView()
                 )
             );
  }


  /**
  * @Route("/retourEmprunt/{idEmprunt}", name="retourEmprunt")
  * @Security("has_role('ROLE_ADMIN')")
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
      return $this->redirectToRoute('listeEmpruntsEnCours');
    }
    return $this->render('Emprunt/RetourMaterielFormulaire.html.twig',
    array(
      "formulaire" => $formulaire->createView()
    )
    );
  }
  /**
  *
  * @Route("/listeEmpruntsEnCours",name="listeEmpruntsEnCours")
  * @Security("has_role('ROLE_ADMIN')")
  */
  public function listeEmpruntsEnCours()
  {
    $objStatut = $this->getDoctrine()->getRepository(Emprunt::class)->DateEffectifNull(true);

    return $this->render('Emprunt/ListeEmpruntEnCours.html.twig',
    array(
      "message" => "liste d'emprunts en cours",
      "listeDemande" => $objStatut
    ));
  }

  /**
  *
  * @Route("/listeEmpruntFin",name="listeEmpruntFin")
  * @Security("has_role('ROLE_ADMIN')")
  */
  public function listeEmpruntFin()
  {
    $objStatut = $this->getDoctrine()->getRepository(Emprunt::class)->DateEffectifNull(false);

    return $this->render('Emprunt/ListeEmpruntFin.html.twig',
    array(
      "message" => "liste d'emprunts terminées",
      "listeDemande" => $objStatut
    ));
  }

  /**
  *
  * @Route("/ValiderModal",name="ValiderModal")
  * @Security("has_role('ROLE_ADMIN')")
  */
  function ValiderModal(Request $request)
  {
      $em = $this->getDoctrine()->getManager();
      $tabMateriel = $this->getDoctrine()->getRepository(DemandeEmprunt::class)
                          ->Find($request->request->get("idEmprunt"));
      $IdEmprunt = $tabMateriel->GetId();
      $User = $tabMateriel->getIdUser()->getUsername();
      $Date = $tabMateriel->getDateDemande()->format('Y-m-d H:i:s');
      $Categorie = $tabMateriel->getIdMateriel()->getCategorie()->getNomCat();
      $Materiel =$tabMateriel->getIdMateriel()->getMarque()->getLibelle();
      $Description = $tabMateriel->getIdMateriel()->getDescription();
      $arrData = [
                  'idEmprunt' => $IdEmprunt,
                  'Categorie' => $Categorie,
                  'Marque' => $Materiel,
                  'Materiel' => $Description,
                  'Date' => $Date,
                  'User' => $User
                   ];
      return new JsonResponse($arrData);
  }


  /**
  * @Route("/ModalEnregistrement", name="ModalEnregistrement")
  * @Security("has_role('ROLE_ADMIN')")
  */
  public function ModalEnregistrement(Request $request) // paramètre qui donnera accès aux données saisies
  {

    $idEmprunt = $request->request->get("idEmprunt");
    $Date =  $request->request->get("dateDemande");

    $em = $this->getDoctrine()->getManager();
    $DemandeEmprunt = $this->getDoctrine()->getRepository(DemandeEmprunt::class)
                        ->Find($idEmprunt)
                        ->setStatut($this->getDoctrine()->getRepository(StatutDemandeEmprunt::class)->Find(1));

    $nouvelEmprunt = new emprunt();
    $nouvelEmprunt->setDateretourdemander(new \DateTime($Date))
                  ->setDatepret(new \DateTime('now'))
                  ->setIdMateriel($DemandeEmprunt->getIdMateriel())
                  ->setIdUser($DemandeEmprunt->getIdUser());

    $this->getDoctrine()->getManager()->persist($nouvelEmprunt);
    $this->getDoctrine()->getManager()->persist($DemandeEmprunt);
    $this->getDoctrine()->getManager()->flush();

    return $this->render('Emprunt/RenderModalEmprunt.html.twig',
    array(
      "message" => $idEmprunt
    ));

  }

  /**
  *
  * @Route("/listeEmpruntHistorique",name="listeEmpruntHistorique")
  */
  public function listeEmpruntHistorique()
  {
    $em = $this->getDoctrine()->getManager();
    $usr = $this->get('security.token_storage')->getToken()->getUser()->getId();
    $objStatut = $this->getDoctrine()->getRepository(Emprunt::class)->DateEffectifNull_IdUser(false,$usr);

    return $this->render('Emprunt/HistoriqueUser.html.twig',
    array(
      "message" => "liste d'emprunts terminées",
      "listeDemande" => $objStatut
    ));
  }
}
