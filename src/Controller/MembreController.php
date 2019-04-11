<?php
//---------------------------------------
// Exemple de formulaire avec
// l'outil "form builder" de Symfony
//


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Emprunteur;
use App\Entity\User;
use App\Entity\Materiel;


//------------------------------------------------------
// supplément pour le formulaire
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class MembreController extends Controller
{
    /**
     * @Route("/ajoutMem", name="ajoutMem")
     */
    public function ajoutMem(Request $request) // paramètre qui donnera accès aux données saisies
    {

        // On crée une instance, associée au formulaire
        $unMem = new Emprunteur();

        // partie "création"
        $formulaire = $this->createFormBuilder($unMem)
            ->add("Nom", TextType::class, array("label"=> "Nom :", "required"=>true))
            ->add("Prenom", TextType::class, array("label"=> "Prenom : ", "required"=>true))
            ->add("Formation", TextType::class, array("label"=> "Formation: ", "required"=>true))
            ->add("nom_connexion", TextType::class, array("label"=> "Nom de connexion: ", "required"=>true))
            ->add("password", PasswordType::class, array("label"=> "Mot de passe: ", "required"=>true))

            ->add("valider", SubmitType::class,array("label"=> "Ajouter un membre "))
            ->getForm();

            // partie "gestion de la réponse"
       $formulaire->handleRequest($request);

       // est-ce que les champs remplis ont été envoyé au serveur ?
       // si oui, on place les données dans l'instance de Joueur
       if ($formulaire->isSubmitted() && $formulaire->isValid())
       {
           // récupération des données
           $unMem = $formulaire->getData();

           // enregistrement dans la base
           $this->getDoctrine()->getManager()->persist($unMem);
           $this->getDoctrine()->getManager()->flush();

          return $this->redirectToRoute('listeMembres');
       }

        return $this->render('AjouterMem.html.twig',
              array(
                  "formulaire" => $formulaire->createView()
                )
              );


          }

          /**
           * @Route("/modifMem/{idMembre}", name="modifMembre")
           * @Security("has_role('ROLE_ADMIN')")
           */
          public function modifMembre(Request $request,$idMembre) // paramètre qui donnera accès aux données saisies
          {


              // On crée une instance, associée au formulaire
              $unMem = $this->getDoctrine()->getRepository(Emprunteur::class)->find($idMembre);


              // partie "création"
              $formulaire = $this->createFormBuilder($unMem)
              ->add("Nom", TextType::class, array("label"=> "Nom :", "required"=>true))
              ->add("Prenom", TextType::class, array("label"=> "Prenom : ", "required"=>true))
              ->add("Formation", TextType::class, array("label"=> "Formation : ", "required"=>false))
              ->add("nom_connexion", TextType::class, array("label"=> "Nom de connexion: ", "required"=>true))
              ->add("password", TextType::class, array("label"=> "Mot de passe: ", "required"=>true))

              ->add("valider", SubmitType::class,array("label"=> "Modifier un membre "))
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



                  return $this->redirectToRoute('listeMembres');
             }



                return $this->render('ModifMat.html.twig',
                      array(
                          "formulaire" => $formulaire->createView()
                        )
                    );


                }

          /**
          *
          * @Route("listeMembres",name="listeMembres")
          * @Security("has_role('ROLE_ADMIN')")
          */
          public function listeMembres()
          {
              $tabMembre = $this->getDoctrine()->getRepository(User::class)->findAll();
              return $this->render('Membre/ListeMembres.html.twig',
                  array(
                  "message" => "liste des Membres",
                  "listeMembres" => $tabMembre
                  ));
          }




            /**
            *
            * @Route("/effacerMembres/{idMembres}", name="effacerMembres")
            * @Security("has_role('ROLE_ADMIN')")
            */
            public function effacerMembres($idMembres)
            {
              $entityManager = $this->getDoctrine()->getManager();
              $Mem = $this->getDoctrine()->getRepository(User::class)->find($idMembres);
              $entityManager->remove($Mem);
              $entityManager->flush();
              $tabMembre = $this->getDoctrine()->getRepository(User::class)->findAll();
              return $this->render('Membre/ListeMembres.html.twig',
                  array(
                  "message" => "liste des Membres",
                  "listeMembres" => $tabMembre
                  ));
            }
}
