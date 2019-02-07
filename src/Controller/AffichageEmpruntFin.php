<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Emprunt;

class AffichageEmpruntFin extends Controller
{
    /**
    *
    * @Route("/AffichageEmpruntFin",name="AffichageEmpruntFin")
    */
    public function AffichageEmpruntFin()
    {

        $tabFinEm = $this->getDoctrine()->getRepository(Emprunt::class)->findAll();



        return $this->render('AffichageEmpruntFin.html.twig',
  		    	array(
  					"message" => "liste des emprunt terminées",
  					"listeFinEm" => $tabFinEm
  		    	));
    }



  }
