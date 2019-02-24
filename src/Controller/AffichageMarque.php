<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Marque;

class AffichageMarque extends Controller
{
    /**
    *
    * @Route("/AffichageMarque",name="AffichageMarque")
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



  }
