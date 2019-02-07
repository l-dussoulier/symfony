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
use App\Entity\MembreAsso;


//------------------------------------------------------
// supplément pour le formulaire
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;



class AjoutMemFormController extends Controller
{
    /**
     * @Route("/ajoutMem", name="ajoutMem")
     */
    public function ajoutMem(Request $request) // paramètre qui donnera accès aux données saisies
    {

        // On crée une instance, associée au formulaire
        $unMem = new MembreAsso();

        // partie "création"
        $formulaire = $this->createFormBuilder($unMem)
            ->add("NomMembre", TextType::class, array("label"=> "Nom :", "required"=>true))
            ->add("PrenomMembre", TextType::class, array("label"=> "Prenom : ", "required"=>true))

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

              return $this->render('bienvenue.html.twig');
       }

       // prout prout prout test.



          return $this->render('AjouterMem.html.twig',
                array(
                    "formulaire" => $formulaire->createView()
                  )
              );


          }
}
