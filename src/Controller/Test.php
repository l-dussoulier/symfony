<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\VueMateriel;
use App\Entity\Materiel;
use App\Entity\Emprunteur;
use App\Entity\Emprunt;

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
    * @Route("/listeMateriel",name="listeMateriel")
    */
    public function listeMateriel()
    {

        $tabMateriel = $this->getDoctrine()->getRepository(VueMateriel::class)->findAll();

        return $this->render('salut.html.twig',
  		    	array(
  					"message" => "liste des Materiels",
  					"listeMateriel" => $tabMateriel
  		    	));
    }


    /**
    *
    * @Route("/TestRecherche",name="TestRecherche")
    */
    function TestRecherche(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository(Materiel::class)->createQueryBuilder('qb');

        if ($request->request->get("query")) {


          
            $arrData = ['output' => $query];
            return new JsonResponse($arrData);
        }

        if($request->isXmlHttpRequest()){
            $arrData = ['output' => $request->request->get("query")];
            return new JsonResponse($arrData);
        }

        $Materiel = new Materiel();
        $Materiel=$em->getRepository(Materiel::class)->findAll();

        return $this->render('TestRecherche.html.twig',
            array(
            "message" => "liste des Materiels",
            "voitures" => $Materiel
            ));
    }

    /**
    *
    * @Route("/TestRecherche1",name="TestRecherche1")
    */
    public function TestRecherche1(Request $request)
    {
      $em = $this->getDoctrine()->getManager();
      $tabMateriel = $em->getRepository(VueMateriel::class)->findAll();

      if($request->isXmlHttpRequest()){

          return new JsonResponse($request->query->getAlnum('filter'));
      }

      return $this->render('TestRecherche.html.twig');

    }


    /**
    *
    * @Route("/indexAction",name="indexAction")
    */
    public function indexAction(Request $request)
    {
        if($request->request->get('some_var_name')){
            //make something curious, get some unbelieveable data
            $arrData = ['output' => 'here the result which will appear in div'];
            return new JsonResponse($arrData);
        }

        return $this->render('TestRechercheQuiMarche.html.twig');
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
    * @Route("/listeMembres",name="listeMembres")
    */
    public function listeMembres()
    {

        $tabMembre = $this->getDoctrine()->getRepository(Emprunteur::class)->findAll();

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
      $Mem = $this->getDoctrine()->getRepository(Emprunteur::class)->find($idMembres);

      $entityManager->remove($Mem);
      $entityManager->flush();

      $tabMembre = $this->getDoctrine()->getRepository(Emprunteur::class)->findAll();

      return $this->render('AfficherListeMembres.html.twig',
          array(
          "message" => "liste des Materiels",
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
