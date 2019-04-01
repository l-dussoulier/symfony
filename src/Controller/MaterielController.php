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
use App\Entity\Categorie;
use App\Entity\Etat;
use App\Entity\Marque;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

//------------------------------------------------------
// supplément pour le formulaire


use Symfony\Component\Form\Extension\Core\Type\DateType;


class MaterielController extends Controller
{

    /**
     * @Route("/ajoutMat", name="ajoutMat")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function ajoutMat(Request $request) // paramètre qui donnera accès aux données saisies
    {

        // On crée une instance, associée au formulaire
        $unMat = new Materiel();


        // partie "création"
        $formulaire = $this->createFormBuilder($unMat)
            ->add("description", TextType::class, array("label"=> "Description :", "required"=>true))
            ->add("provenance", TextType::class, array("label"=> "Provenance : ", "required"=>true))
            ->add('Etat', EntityType::class, array(
                'class' => Etat::class,
                'choice_label' => 'libelle',
                'placeholder' => 'sélectionner un état',

            ))
            ->add('Marque', EntityType::class, array(
                'class' => Marque::class,
                'choice_label' => 'libelle',
                'placeholder' => 'sélectionner une marque',

            ))

            ->add('categorie', EntityType::class, array(
                'class' => categorie::class,
                'choice_label' => 'NomCat',
                'placeholder' => 'sélectionner une categorie',

            ))

            ->add("valider", SubmitType::class,array("label"=> "Ajouter un matériel "))
            ->getForm();

            // partie "gestion de la réponse"
       $formulaire->handleRequest($request);

       // est-ce que les champs remplis ont été envoyé au serveur ?
       // si oui, on place les données dans l'instance de Joueur
       if ($formulaire->isSubmitted() && $formulaire->isValid())
       {
           // récupération des données
           $unMat = $formulaire->getData();
           $unMat->setStatutemprunt(false);
           // enregistrement dans la base
           $this->getDoctrine()->getManager()->persist($unMat);
           $this->getDoctrine()->getManager()->flush();

              return $this->redirectToRoute('ajoutMat');
       }



          return $this->render('AjouterMat.html.twig',
                array(
                    "formulaire" => $formulaire->createView()
                  )
              );


          }

          /**
           * @Route("/modifMat/{idMat}", name="modifMat")
           * @Security("has_role('ROLE_ADMIN')")
           */
          public function modifMat(Request $request,$idMat) // paramètre qui donnera accès aux données saisies
          {


              // On crée une instance, associée au formulaire
            //  $unMat = new Materiel();
              $unMat = $this->getDoctrine()->getRepository(Materiel::class)->find($idMat);
              //$unMat->setDescription();
              //$unmat->SetEtat();
            //  $unMat->SetCategorie();

              // partie "création"
              $formulaire = $this->createFormBuilder($unMat)
                  ->add("description", TextType::class, array("label"=> "Description :", "required"=>true))
                  ->add('Marque', EntityType::class, array(
                        'class' => Marque::class,
                        'choice_label' => 'libelle',
                        'placeholder' => 'sélectionner une Marque',

                    ))
                  ->add("Provenance", TextType::class, array("label"=> "Provenance : ", "required"=>true))
                  ->add('Etat', EntityType::class, array(
                        'class' => Etat::class,
                        'choice_label' => 'libelle',
                        'placeholder' => 'sélectionner un état',

                    ))
                  ->add('categorie', EntityType::class, array(
                        'class' => categorie::class,
                        'choice_label' => 'NomCat',
                        'placeholder' => 'sélectionner une categorie',

                    ))

                  ->add("valider", SubmitType::class,array("label"=> "Modifier"))
                  ->getForm();

                  // partie "gestion de la réponse"
             $formulaire->handleRequest($request);

             // est-ce que les champs remplis ont été envoyé au serveur ?
             // si oui, on place les données dans l'instance de Joueur
             if ($formulaire->isSubmitted() && $formulaire->isValid())
             {
                 // récupération des données
                 $unMat = $formulaire->getData();

                 // enregistrement dans la base
                 $this->getDoctrine()->getManager()->persist($unMat);
                 $this->getDoctrine()->getManager()->flush();

                 return $this->redirectToRoute('listeMateriel');
             }



            return $this->render('ModifMat.html.twig',
                  array(
                      "formulaire" => $formulaire->createView()
                    )
                );


          }
                /**
                *
                * @Route("/listeMaterielBasique",name="listeMaterielBasique")
                * @Security("has_role('ROLE_ADMIN')")
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
                * @Security("has_role('ROLE_ADMIN')")
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
                * @Security("has_role('ROLE_ADMIN')")
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
                * @Security("has_role('ROLE_ADMIN')")
                */
                public function effacerMateriel($idMateriel)
                {

                  $entityManager = $this->getDoctrine()->getManager();
                  $Mat = $this->getDoctrine()->getRepository(Materiel::class)->find($idMateriel);
                  $entityManager->remove($Mat);
                  $entityManager->flush();


                  $tabMateriel = $this->getDoctrine()->getRepository(Materiel::class)->findAll();

                  return $this->render('salut.html.twig',
                      array(
                      "message" => "liste des Materiels",
                      "listeMateriel" => $tabMateriel
                        ));
                }

                /**
          *
          * @Route("/listeUser",name="listeUser")
          */
          public function user()
          {
                $tabMateriel = $this->getDoctrine()->getRepository(Materiel::class)->CheckStatut(false);
                return $this->render('AfficherListeMateriel_user.html.twig',
                    array(
                    "message" => "liste des Materiels",
                    "listeMateriel" => $tabMateriel
                    ));
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

                        $data[] = $ligne;
                  }

                  return new JsonResponse($data);

              }
}
