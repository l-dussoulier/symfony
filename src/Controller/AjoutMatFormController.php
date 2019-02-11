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

use App\Entity\Categorie;
use App\Entity\Etat;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class AjoutMatFormController extends Controller
{
    /**
     * @Route("/verif", name="verif")
     */
    public function verif()
    {
      $unMat = new Joueur();

    }

    /**
     * @Route("/ajoutMat", name="ajoutMat")
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

              return $this->render('bienvenue.html.twig');
       }



          return $this->render('AjouterMat.html.twig',
                array(
                    "formulaire" => $formulaire->createView()
                  )
              );


          }
}
