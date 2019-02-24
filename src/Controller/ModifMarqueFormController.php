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
use App\Entity\Marque;


//------------------------------------------------------
// supplément pour le formulaire
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;



class ModifMarqueFormController extends Controller
{
    /**
     * @Route("/modifMarque/{id}", name="modifMarque")
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
