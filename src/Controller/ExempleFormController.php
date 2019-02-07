<?php
//---------------------------------------
// Exemple de formulaire avec
// l'outil "form builder" de Symfony
//
// => utilisation partielle de l'entité joueur

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Joueur;
use App\Entity\Partie;

//------------------------------------------------------
// supplément pour le formulaire
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


class ExempleFormController extends Controller
{
    /**
     * @Route("/verif", name="verif")
     */
    public function verif()
    {
      $joueur = new Joueur();
      $joueur ->setPrenom("Francisco");
        return $this->render('base.html.twig');
    }

    /**
     * @Route("/saisirJoueur", name="saisirJoueur")
     */
    public function saisirJoueur(Request $request) // paramètre qui donnera accès aux données saisies
    {

        // On crée une instance de Joueur, associée au formulaire
        $unJoueur = new Joueur();
        $unJoueur->setEmail("ici@ou.la");

        // partie "création"
        $formulaire = $this->createFormBuilder($unJoueur)
            ->add("nom", TextType::class, array("label"=> "Nom : ", "required"=>true))
            ->add("prenom", TextType::class, array("label"=> "Prénom : ", "required"=>false))
            ->add("email", EmailType::class, array("label"=> "Email : ", "required"=>false))
            ->add("telephone", TextType::class, array("label"=> "Telephone : ", "required"=>false))

            ->add("valider", SubmitType::class,array("label"=> "Enregistrer "))
            ->getForm();

            // partie "gestion de la réponse"
       $formulaire->handleRequest($request);

       // est-ce que les champs remplis ont été envoyé au serveur ?
       // si oui, on place les données dans l'instance de Joueur
       if ($formulaire->isSubmitted() && $formulaire->isValid())
       {
           // récupération des données
           $unJoueur = $formulaire->getData();

           // enregistrement dans la base
           $this->getDoctrine()->getManager()->persist($unJoueur);
           $this->getDoctrine()->getManager()->flush();

           // on part vers la page de "confirmation"
           //return $this->redirectToRoute("saisieOKYoupi", // atribut "name" de la route
              // array("idJoueur"=>$unJoueur->getId()));
              return $this->render('base.html.twig');
       }



        return $this->render('saisirJoueur.html.twig',
                array(
                    "formulaire" => $formulaire->createView()
                )
            );


}
}
