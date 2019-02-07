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
use App\Entity\Materiel;


//------------------------------------------------------
// supplément pour le formulaire
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use App\Entity\Emprunt;
use App\Entity\Emprunteur;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

//pour le type date
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CreerNouveauEmprunt extends Controller
{
  /**
   * @Route("/CreerNouveauEmprunt/{idMat}", name="CreerNouveauEmprunt")
   */
  public function CreerNouveauEmprunt(Request $request, $idMat) // paramètre qui donnera accès aux données saisies
  {


      // On crée une instance, associée au formulaire
      $unMat = $this->getDoctrine()->getRepository(Materiel::class)->find($idMat);

      $emprunt = new Emprunt();

      // partie "création"
      $formulaire = $this->createFormBuilder($emprunt)
      ->add("dateretourdemander", DateType::class, array("label"=>"Date retour","widget" => "choice"))
      ->add('idEmprunteur', EntityType::class, array(
            'class' => Emprunteur::class,
            'choice_label' => 'Nom',
            'placeholder' => 'sélectionner un emprunteur',

        ))

          ->add("valider", SubmitType::class,array("label"=> "Emprunter"))
          ->getForm();

          // partie "gestion de la réponse"
     $formulaire->handleRequest($request);

     // est-ce que les champs remplis ont été envoyé au serveur ?
     // si oui, on place les données dans l'instance de Joueur
     if ($formulaire->isSubmitted() && $formulaire->isValid())
     {
         // récupération des données
         $unMat->setStatutemprunt(true);

         $emprunt->setDatepret(new \DateTime('now'));
         $emprunt->setId($unMat);
         $emprunt = $formulaire->getData();

         // enregistrement dans la base
         $this->getDoctrine()->getManager()->persist($emprunt);
         $this->getDoctrine()->getManager()->persist($unMat);
         $this->getDoctrine()->getManager()->flush();

                        return $this->redirectToRoute('listeMateriel');
     }



        return $this->render('CreerNouveauEmprunt.html.twig',
              array(
                  "formulaire" => $formulaire->createView()
                )
            );


        }
}
