<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Marque;

//------------------------------------------------------
// supplément pour le formulaire
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
;


class MarqueController extends Controller
{
    /**
    *
    * @Route("/AffichageMarque",name="AffichageMarque")
    * @Security("has_role('ROLE_ADMIN')")
    */
    public function AffichageMarque()
    {

        $tabMarque = $this->getDoctrine()->getRepository(Marque::class)->findAll();



        return $this->render('AfficherListeMarque.html.twig',
  		    	array(
  					"message" => "liste des marques",
  					"listeMarque" => $tabMarque
  		    	));

    }


    /**
    *
    * @Route("/effacerMarque/{id}", name="effacerMarque")
    * @Security("has_role('ROLE_ADMIN')")
    */
    public function effacerMarque($id)
    {

      $entityManager = $this->getDoctrine()->getManager();
      $Marque = $this->getDoctrine()->getRepository(Marque::class)->find($id);

      $entityManager->remove($Marque);
      $entityManager->flush();

      $tabMarque = $this->getDoctrine()->getRepository(Marque::class)->findAll();

      return $this->render('AfficherListeMarque.html.twig',
          array(
          "message" => "liste des marques",
          "listeMarque" => $tabMarque
          ));

    }



    /**
     * @Route("/ajoutMarque", name="ajoutMarque")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function ajoutMarque(Request $request) // paramètre qui donnera accès aux données saisies
    {

        // On crée une instance, associée au formulaire
        $uneMarque = new Marque();


        // partie "création"
        $formulaire = $this->createFormBuilder($uneMarque)
            ->add("libelle", TextType::class, array("label"=> "nom de la marque :", "required"=>true))
            ->add("valider", SubmitType::class,array("label"=> "Ajouter un matériel "))
            ->getForm();

            // partie "gestion de la réponse"
       $formulaire->handleRequest($request);

       // est-ce que les champs remplis ont été envoyé au serveur ?
       // si oui, on place les données dans l'instance de Joueur
       if ($formulaire->isSubmitted() && $formulaire->isValid())
       {
           // récupération des données
           $uneMarque = $formulaire->getData();
           // enregistrement dans la base
           $this->getDoctrine()->getManager()->persist($uneMarque);
           $this->getDoctrine()->getManager()->flush();

              return $this->redirectToRoute('AffichageMarque');
       }



          return $this->render('AjouterMarque.html.twig',
                array(
                    "formulaire" => $formulaire->createView()
                  )
              );


          }



          /**
           * @Route("/modifMarque/{id}", name="modifMarque")
           * @Security("has_role('ROLE_ADMIN')")
           */
          public function modifMarque(Request $request,$id) // paramètre qui donnera accès aux données saisies
          {


              // On crée une instance, associée au formulaire
              $uneMarque = $this->getDoctrine()->getRepository(Marque::class)->find($id);


              // partie "création"
              $formulaire = $this->createFormBuilder($uneMarque)
              ->add("libelle", TextType::class, array("label"=> "Libelle :", "required"=>true))


              ->add("valider", SubmitType::class,array("label"=> "Modifier une marque "))
              ->getForm();

                  // partie "gestion de la réponse"
             $formulaire->handleRequest($request);

             // est-ce que les champs remplis ont été envoyé au serveur ?
             // si oui, on place les données dans l'instance de Joueur
             if ($formulaire->isSubmitted() && $formulaire->isValid())
             {
                 // récupération des données
                 $uneMarque = $formulaire->getData();

                 // enregistrement dans la base
                 $this->getDoctrine()->getManager()->persist($uneMarque);
                 $this->getDoctrine()->getManager()->flush();



                  return $this->redirectToRoute('listeMarque');
             }



                return $this->render('ModifMarque.html.twig',
                      array(
                          "formulaire" => $formulaire->createView()
                        )
                    );


                }



  }
