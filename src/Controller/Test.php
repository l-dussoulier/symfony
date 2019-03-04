<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\VueMateriel;
use App\Entity\Materiel;
use App\Entity\User;
use App\Entity\Emprunt;
use App\Entity\Categorie;
use App\Entity\Etat;
use App\Entity\Marque;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use   Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

//------------------------------------------------------
// supplément pour le formulaire
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Form\Extension\Core\Type\DateType;


class Test extends Controller
{
    /**
    *
    * @Route("/listeMaterielBasique",name="listeMaterielBasique")
    */
    public function listeMaterielBasique()
    {

        $tabMateriel = $this->getDoctrine()->getRepository(Materiel::class)->findAll();

        return $this->render('salut.html.twig',
  		    	array(
  					"message" => "liste des Materiels",
  					"listeMateriel" => $tabMateriel
  		    	));
    }

    /**
    *
    * @Route("/listeMateriel",name="listeMateriel")
    */
    function listeMateriel(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $formulaire = $this->createFormBuilder()
      ->add('Rechercher', TextType::class, array("label"=> "Rechercher : "))
      ->add('Marque', EntityType::class, array(
          'class' => Marque::class,
          'choice_label' => 'libelle',
          'placeholder' => 'sélectionner une marque',

      ))
      ->add('Categorie', EntityType::class, array(
          'class' => categorie::class,
          'choice_label' => 'NomCat',
          'placeholder' => 'sélectionner une categorie',

      ))
      ->getForm();


      return $this->render('ListeMateriel.html.twig',
            array(
                "message" => "liste des Materiels",
                "formulaire" => $formulaire->createView()
              )
          );
    }

    /**
    *
    * @Route("/RechercheAjax",name="RechercheAjax")
    */
    function RechercheAjax(Request $request)
    {

      $em = $this->getDoctrine()->getManager();

          if ($request->request->get("Recherche") || $request->request->get("Marque") || $request->request->get("Categorie")){
              $tabMateriel = $this->getDoctrine()->getRepository(Materiel::class)
                                  ->MaterielById($request->request->get("Recherche"),$request->request->get("Marque"),$request->request->get("Categorie"));

              $render = $this->renderView('RenderRecherche.html.twig', [
                                              'listeMateriel' => $tabMateriel
                                          ]);

              $arrData = ['tab' => $render,
                          'output' => $request->request->get("query")
                           ];
              return new JsonResponse($arrData);
          }


          $Materiel=$em->getRepository(Materiel::class)->findAll();

          $render = $this->renderView('RenderRecherche.html.twig', [
                                          'listeMateriel' => $Materiel
                                      ]);

          $arrData = ['tab' => $render,
                      'output' => $request->request->get("query")
                       ];
          return new JsonResponse($arrData);
  }

    /**
    *
    * @Route("/effacerMateriel/{idMateriel}", name="effacerMateriel")
    */
    public function effacerMateriel($idMateriel)
    {

      $entityManager = $this->getDoctrine()->getManager();
      $Mat = $this->getDoctrine()->getRepository(Materiel::class)->find($idMateriel);
      $entityManager->remove($Mat);
      $entityManager->flush();


      $tabMateriel = $this->getDoctrine()->getRepository(VueMateriel::class)->findAll();

      return $this->render('salut.html.twig',
          array(
          "message" => "liste des Materiels",
          "listeMateriel" => $tabMateriel
            ));
    }


    /**
    *
    * @Route("listeMembres",name="listeMembres")
    * @Security("has_role('ROLE_ADMIN')")
    */
    public function listeMembres()
    {

        $tabMembre = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('AfficherListeMembres.html.twig',
            array(
            "message" => "liste des Membres",
            "listeMembres" => $tabMembre
            ));
    }




    /**
    *
    * @Route("/effacerMembres/{idMembres}", name="effacerMembres")
    */
    public function effacerMembres($idMembres)
    {

      $entityManager = $this->getDoctrine()->getManager();
      $Mem = $this->getDoctrine()->getRepository(User::class)->find($idMembres);

      $entityManager->remove($Mem);
      $entityManager->flush();

      $tabMembre = $this->getDoctrine()->getRepository(User::class)->findAll();

      return $this->render('AfficherListeMembres.html.twig',
          array(
          "message" => "liste des Membres",
          "listeMembres" => $tabMembre
          ));

    }


    /**
    *
    * @Route("/listeEmpruntEnCours",name="listeEmprunt")
    */
    public function listeEmpruntEnCours()
    {

        $tabEmprunt = $this->getDoctrine()->getRepository(Emprunt::class)->findAll();

        return $this->render('AfficherListeEmprunt.html.twig',
            array(
            "message" => "liste des Emprunt En Cours",
            "listeEmprunt" => $tabEmprunt
           ));
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
